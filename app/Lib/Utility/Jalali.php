<?php
/**
 * CakeTime utility class file.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Utility
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Multibyte', 'I18n');

/**
 * Time Helper class for easy use of time data.
 *
 * Manipulation of time data.
 *
 * @package       Cake.Utility
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html
 */
class Jalali {

/**
 * The format to use when formatting a time using `TimeHelper::nice()`
 *
 * The format should use the locale strings as defined in the PHP docs under
 * `strftime` (http://php.net/manual/en/function.strftime.php)
 *
 * @var string
 * @see TimeHelper::format()
 */
	public static $niceFormat = '%a, %b %eS %Y, %H:%M';

/**
 * Temporary variable containing timestamp value, used internally convertSpecifiers()
 */
	protected static $_time = null;

/**
 * Magic set method for backward compatibility.
 *
 * Used by TimeHelper to modify static variables in CakeTime
 */
	public function __set($name, $value) {
		switch ($name) {
			case 'niceFormat':
				self::${$name} = $value;
				break;
			default:
				break;
		}
	}

/**
 * Magic set method for backward compatibility.
 *
 * Used by TimeHelper to get static variables in CakeTime
 */
	public function __get($name) {
		switch ($name) {
			case 'niceFormat':
				return self::${$name};
				break;
			default:
				return null;
				break;
		}
	}

/**
 * Converts a string representing the format for the function strftime and returns a
 * windows safe and i18n aware format.
 *
 * @param string $format Format with specifiers for strftime function.
 *    Accepts the special specifier %S which mimics the modifier S for date()
 * @param string $time UNIX timestamp
 * @return string windows safe and date() function compatible format for strftime
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function convertSpecifiers($format, $time = null) {
		if (!$time) {
			$time = time();
		}
		self::$_time = $time;
		return preg_replace_callback('/\%(\w+)/', array('Jalali', '_translateSpecifier'), $format);
	}

/**
 * Auxiliary function to translate a matched specifier element from a regular expression into
 * a windows safe and i18n aware specifier
 *
 * @param array $specifier match from regular expression
 * @return string converted element
 */
	protected static function _translateSpecifier($specifier) {
		switch ($specifier[1]) {
			case 'a':
				$abday = __dc('cake', 'abday', 5);
				if (is_array($abday)) {
					return $abday[self::date('w', self::$_time)];
				}
				break;
			case 'A':
				$day = __dc('cake', 'day', 5);
				if (is_array($day)) {
					return $day[self::date('w', self::$_time)];
				}
				break;
			case 'c':
				$format = __dc('cake', 'd_t_fmt', 5);
				if ($format != 'd_t_fmt') {
					return self::convertSpecifiers($format, self::$_time);
				}
				break;
			case 'C':
				return sprintf("%02d", self::date('Y', self::$_time) / 100);
			case 'D':
				return '%m/%d/%y';
			case 'e':
				if (DS === '/') {
					return '%e';
				}
				$day = self::date('j', self::$_time);
				if ($day < 10) {
					$day = ' ' . $day;
				}
				return $day;
			case 'eS' :
				return self::date('jS', self::$_time);
			case 'b':
			case 'h':
                return self::date('F', self::$_time);
				$months = __dc('cake', 'abmon', 5);
				if (is_array($months)) {
					return $months[self::date('n', self::$_time) - 1];
				}
				return '%b';
			case 'B':
				$months = __dc('cake', 'mon', 5);
				if (is_array($months)) {
					return $months[self::date('n', self::$_time) - 1];
				}
				break;
			case 'n':
				return "\n";
			case 'p':
			case 'P':
				$default = array('am' => 0, 'pm' => 1);
				$meridiem = $default[self::date('a', self::$_time)];
				$format = __dc('cake', 'am_pm', 5);
				if (is_array($format)) {
					$meridiem = $format[$meridiem];
					return ($specifier[1] == 'P') ? strtolower($meridiem) : strtoupper($meridiem);
				}
				break;
			case 'r':
				$complete = __dc('cake', 't_fmt_ampm', 5);
				if ($complete != 't_fmt_ampm') {
					return str_replace('%p', self::_translateSpecifier(array('%p', 'p')), $complete);
				}
				break;
			case 'R':
				return self::date('H:i', self::$_time);
			case 't':
				return "\t";
			case 'T':
				return '%H:%M:%S';
            case 'Y':
				return self::date('Y', self::$_time);
			case 'u':
				return ($weekDay = self::date('w', self::$_time)) ? $weekDay : 7;
			case 'x':
				$format = __dc('cake', 'd_fmt', 5);
				if ($format != 'd_fmt') {
					return self::convertSpecifiers($format, self::$_time);
				}
				break;
			case 'X':
				$format = __dc('cake', 't_fmt', 5);
				if ($format != 't_fmt') {
					return self::convertSpecifiers($format, self::$_time);
				}
				break;
		}
		return $specifier[0];
	}

/**
 * Converts given time (in server's time zone) to user's local time, given his/her offset from GMT.
 *
 * @param string $serverTime UNIX timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return integer UNIX timestamp
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function convert($serverTime, $userOffset) {
		$serverOffset = self::serverOffset();
		$gmtTime = $serverTime - $serverOffset;
		$userTime = $gmtTime + $userOffset * (60 * 60);
		return $userTime;
	}

/**
 * Returns server's offset from GMT in seconds.
 *
 * @return integer Offset
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function serverOffset() {
		return self::date('Z', time());
	}

/**
 * Returns a UNIX timestamp, given either a UNIX timestamp or a valid strtotime() date string.
 *
 * @param string $dateString Datetime string
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Parsed timestamp
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function fromString($dateString, $userOffset = null) {
		if (empty($dateString)) {
			return false;
		}
		if (is_integer($dateString) || is_numeric($dateString)) {
			$date = intval($dateString);
		} else {
			$date = self::strtotime($dateString);
		}
		if ($userOffset !== null) {
			return self::convert($date, $userOffset);
		}
		if ($date === -1) {
			return false;
		}
		return $date;
	}

/**
 * Returns a nicely formatted date string for given Datetime string.
 *
 * See http://php.net/manual/en/function.strftime.php for information on formatting
 * using locale strings.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @param string $format The format to use. If null, `TimeHelper::$niceFormat` is used
 * @return string Formatted date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function nice($dateString = null, $userOffset = null, $format = null) {
		if ($dateString != null) {
			$date = self::fromString($dateString, $userOffset);
		} else {
			$date = time();
		}
		if (!$format) {
			$format = self::$niceFormat;
		}
		$format = self::convertSpecifiers($format, $date);
		return self::_strftime($format, $date);
	}

/**
 * Returns a formatted descriptive date string for given datetime string.
 *
 * If the given date is today, the returned string could be "Today, 16:54".
 * If the given date was yesterday, the returned string could be "Yesterday, 16:54".
 * If $dateString's year is the current year, the returned string does not
 * include mention of the year.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Described, relative date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function niceShort($dateString = null, $userOffset = null) {
		$date = $dateString ? self::fromString($dateString, $userOffset) : time();

		$y = self::isThisYear($date) ? '' : ' %Y';

		if (self::isToday($dateString, $userOffset)) {
			$ret = __d('cake', 'امروز، %s', self::_strftime("%H:%M", $date));
		} elseif (self::wasYesterday($dateString, $userOffset)) {
			$ret = __d('cake', 'دیروز، %s', self::_strftime("%H:%M", $date));
		} else {
			$format = self::convertSpecifiers("%e %b{$y} ، %H:%M", $date);
			$ret = self::_strftime($format, $date);
		}

		return $ret;
	}

/**
 * Returns a partial SQL string to search for all records between two dates.
 *
 * @param string $begin Datetime string or Unix timestamp
 * @param string $end Datetime string or Unix timestamp
 * @param string $fieldName Name of database field to compare with
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Partial SQL string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function daysAsSql($begin, $end, $fieldName, $userOffset = null) {
		$begin = self::fromString($begin, $userOffset);
		$end = self::fromString($end, $userOffset);
		$begin = self::date('Y-m-d', $begin) . ' 00:00:00';
		$end = self::date('Y-m-d', $end) . ' 23:59:59';

		return "($fieldName >= '$begin') AND ($fieldName <= '$end')";
	}

/**
 * Returns a partial SQL string to search for all records between two times
 * occurring on the same day.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param string $fieldName Name of database field to compare with
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Partial SQL string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function dayAsSql($dateString, $fieldName, $userOffset = null) {
		return self::daysAsSql($dateString, $dateString, $fieldName);
	}

/**
 * Returns true if given datetime string is today.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is today
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function isToday($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('Y-m-d', $date) == self::date('Y-m-d', time());
	}

/**
 * Returns true if given datetime string is within this week.
 *
 * @param string $dateString
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is within current week
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function isThisWeek($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('W o', $date) == self::date('W o', time());
	}

/**
 * Returns true if given datetime string is within this month
 * @param string $dateString
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is within current month
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function isThisMonth($dateString, $userOffset = null) {
		$date = self::fromString($dateString);
		return self::date('m Y', $date) == self::date('m Y', time());
	}

/**
 * Returns true if given datetime string is within current year.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is within current year
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function isThisYear($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('Y', $date) == self::date('Y', time());
	}

/**
 * Returns true if given datetime string was yesterday.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string was yesterday
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 *
 */
	public static function wasYesterday($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('Y-m-d', $date) == self::date('Y-m-d', strtotime('yesterday'));
	}

/**
 * Returns true if given datetime string is tomorrow.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string was yesterday
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function isTomorrow($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('Y-m-d', $date) == self::date('Y-m-d', strtotime('tomorrow'));
	}

/**
 * Returns the quarter
 *
 * @param string $dateString
 * @param boolean $range if true returns a range in Y-m-d format
 * @return mixed 1, 2, 3, or 4 quarter of year or array if $range true
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function toQuarter($dateString, $range = false) {
		$time = self::fromString($dateString);
		$date = ceil(self::date('m', $time) / 3);

		if ($range === true) {
			$range = 'Y-m-d';
		}

		if ($range !== false) {
			$year = self::date('Y', $time);

			switch ($date) {
				case 1:
					$date = array($year . '-01-01', $year . '-03-31');
					break;
				case 2:
					$date = array($year . '-04-01', $year . '-06-30');
					break;
				case 3:
					$date = array($year . '-07-01', $year . '-09-30');
					break;
				case 4:
					$date = array($year . '-10-01', $year . '-12-31');
					break;
			}
		}
		return $date;
	}

/**
 * Returns a UNIX timestamp from a textual datetime description. Wrapper for PHP function strtotime().
 *
 * @param string $dateString Datetime string to be represented as a Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return integer Unix timestamp
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function toUnix($dateString, $userOffset = null) {
		return self::fromString($dateString, $userOffset);
	}

/**
 * Returns a date formatted for Atom RSS feeds.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function toAtom($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);
		return self::date('Y-m-d\TH:i:s\Z', $date);
	}

/**
 * Formats date for RSS feeds
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function toRSS($dateString, $userOffset = null) {
		$date = self::fromString($dateString, $userOffset);

		if (!is_null($userOffset)) {
			if ($userOffset == 0) {
				$timezone = '+0000';
			} else {
				$hours = (int)floor(abs($userOffset));
				$minutes = (int)(fmod(abs($userOffset), $hours) * 60);
				$timezone = ($userOffset < 0 ? '-' : '+') . str_pad($hours, 2, '0', STR_PAD_LEFT) . str_pad($minutes, 2, '0', STR_PAD_LEFT);
			}
			return self::date('D, d M Y H:i:s', $date) . ' ' . $timezone;
		}
		return self::date("r", $date);
	}

/**
 * Returns either a relative date or a formatted date depending
 * on the difference between the current time and given datetime.
 * $datetime should be in a <i>strtotime</i> - parsable format, like MySQL's datetime datatype.
 *
 * ### Options:
 *
 * - `format` => a fall back format if the relative time is longer than the duration specified by end
 * - `end` => The end of relative time telling
 * - `userOffset` => Users offset from GMT (in hours)
 *
 * Relative dates look something like this:
 *	3 weeks, 4 days ago
 *	15 seconds ago
 *
 * Default date formatting is d/m/yy e.g: on 18/2/09
 *
 * The returned string includes 'ago' or 'on' and assumes you'll properly add a word
 * like 'Posted ' before the function output.
 *
 * @param string $dateTime Datetime string or Unix timestamp
 * @param array $options Default format if timestamp is used in $dateString
 * @return string Relative time string.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function timeAgoInWords($dateTime, $options = array()) {
		$userOffset = null;
		if (is_array($options) && isset($options['userOffset'])) {
			$userOffset = $options['userOffset'];
		}
		$now = time();
		if (!is_null($userOffset)) {
			$now = self::convert(time(), $userOffset);
		}
		$inSeconds = self::fromString($dateTime, $userOffset);
		$backwards = ($inSeconds > $now);

		$format = 'j/n/y';
		$end = '+1 month';

		if (is_array($options)) {
			if (isset($options['format'])) {
				$format = $options['format'];
				unset($options['format']);
			}
			if (isset($options['end'])) {
				$end = $options['end'];
				unset($options['end']);
			}
		} else {
			$format = $options;
		}

		if ($backwards) {
			$futureTime = $inSeconds;
			$pastTime = $now;
		} else {
			$futureTime = $now;
			$pastTime = $inSeconds;
		}
		$diff = $futureTime - $pastTime;

		// If more than a week, then take into account the length of months
		if ($diff >= 604800) {
			list($future['H'], $future['i'], $future['s'], $future['d'], $future['m'], $future['Y']) = explode('/', self::date('H/i/s/d/m/Y', $futureTime));

			list($past['H'], $past['i'], $past['s'], $past['d'], $past['m'], $past['Y']) = explode('/', self::date('H/i/s/d/m/Y', $pastTime));
			$years = $months = $weeks = $days = $hours = $minutes = $seconds = 0;

			if ($future['Y'] == $past['Y'] && $future['m'] == $past['m']) {
				$months = 0;
				$years = 0;
			} else {
				if ($future['Y'] == $past['Y']) {
					$months = $future['m'] - $past['m'];
				} else {
					$years = $future['Y'] - $past['Y'];
					$months = $future['m'] + ((12 * $years) - $past['m']);

					if ($months >= 12) {
						$years = floor($months / 12);
						$months = $months - ($years * 12);
					}

					if ($future['m'] < $past['m'] && $future['Y'] - $past['Y'] == 1) {
						$years --;
					}
				}
			}

			if ($future['d'] >= $past['d']) {
				$days = $future['d'] - $past['d'];
			} else {
				$daysInPastMonth = self::date('t', $pastTime);
				$daysInFutureMonth = self::date('t', self::mktime(0, 0, 0, $future['m'] - 1, 1, $future['Y']));

				if (!$backwards) {
					$days = ($daysInPastMonth - $past['d']) + $future['d'];
				} else {
					$days = ($daysInFutureMonth - $past['d']) + $future['d'];
				}

				if ($future['m'] != $past['m']) {
					$months --;
				}
			}

			if ($months == 0 && $years >= 1 && $diff < ($years * 31536000)) {
				$months = 11;
				$years --;
			}

			if ($months >= 12) {
				$years = $years + 1;
				$months = $months - 12;
			}

			if ($days >= 7) {
				$weeks = floor($days / 7);
				$days = $days - ($weeks * 7);
			}
		} else {
			$years = $months = $weeks = 0;
			$days = floor($diff / 86400);

			$diff = $diff - ($days * 86400);

			$hours = floor($diff / 3600);
			$diff = $diff - ($hours * 3600);

			$minutes = floor($diff / 60);
			$diff = $diff - ($minutes * 60);
			$seconds = $diff;
		}
		$relativeDate = '';
		$diff = $futureTime - $pastTime;

		if ($diff > abs($now - self::fromString($end))) {
			$relativeDate = __d('cake', 'on %s', self::date($format, $inSeconds));
		} else {
			if ($years > 0) {
				// years and months and days
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d year', '%d years', $years, $years);
				$relativeDate .= $months > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d month', '%d months', $months, $months) : '';
				$relativeDate .= $weeks > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d week', '%d weeks', $weeks, $weeks) : '';
				$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d day', '%d days', $days, $days) : '';
			} elseif (abs($months) > 0) {
				// months, weeks and days
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d month', '%d months', $months, $months);
				$relativeDate .= $weeks > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d week', '%d weeks', $weeks, $weeks) : '';
				$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d day', '%d days', $days, $days) : '';
			} elseif (abs($weeks) > 0) {
				// weeks and days
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d week', '%d weeks', $weeks, $weeks);
				$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d day', '%d days', $days, $days) : '';
			} elseif (abs($days) > 0) {
				// days and hours
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d day', '%d days', $days, $days);
				$relativeDate .= $hours > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d hour', '%d hours', $hours, $hours) : '';
			} elseif (abs($hours) > 0) {
				// hours and minutes
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d hour', '%d hours', $hours, $hours);
				$relativeDate .= $minutes > 0 ? ($relativeDate ? ', ' : '') . __dn('cake', '%d minute', '%d minutes', $minutes, $minutes) : '';
			} elseif (abs($minutes) > 0) {
				// minutes only
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d minute', '%d minutes', $minutes, $minutes);
			} else {
				// seconds only
				$relativeDate .= ($relativeDate ? ', ' : '') . __dn('cake', '%d second', '%d seconds', $seconds, $seconds);
			}

			if (!$backwards) {
				$relativeDate = __d('cake', '%s ago', $relativeDate);
			}
		}
		return $relativeDate;
	}

/**
 * Returns true if specified datetime was within the interval specified, else false.
 *
 * @param mixed $timeInterval the numeric value with space then time type.
 *    Example of valid types: 6 hours, 2 days, 1 minute.
 * @param mixed $dateString the datestring or unix timestamp to compare
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return boolean
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#testing-time
 */
	public static function wasWithinLast($timeInterval, $dateString, $userOffset = null) {
		$tmp = str_replace(' ', '', $timeInterval);
		if (is_numeric($tmp)) {
			$timeInterval = $tmp . ' ' . __d('cake', 'days');
		}

		$date = self::fromString($dateString, $userOffset);
		$interval = self::fromString('-' . $timeInterval);

		if ($date >= $interval && $date <= time()) {
			return true;
		}

		return false;
	}

/**
 * Returns gmt as a UNIX timestamp.
 *
 * @param string $string UNIX timestamp or a valid strtotime() date string
 * @return integer UNIX timestamp
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function gmt($string = null) {
		if ($string != null) {
			$string = self::fromString($string);
		} else {
			$string = time();
		}
		$hour = intval(self::date("G", $string));
		$minute = intval(self::date("i", $string));
		$second = intval(self::date("s", $string));
		$month = intval(self::date("n", $string));
		$day = intval(self::date("j", $string));
		$year = intval(self::date("Y", $string));

		return gmmktime($hour, $minute, $second, $month, $day, $year);
	}

/**
 * Returns a formatted date string, given either a UNIX timestamp or a valid strtotime() date string.
 * This function also accepts a time string and a format string as first and second parameters.
 * In that case this function behaves as a wrapper for TimeHelper::i18nFormat()
 *
 * @param string $format date format string (or a DateTime string)
 * @param string $date Datetime string (or a date format string)
 * @param boolean $invalid flag to ignore results of fromString == false
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function format($format, $date = null, $invalid = false, $userOffset = null) {
		$time = self::fromString($date, $userOffset);
		$_time = self::fromString($format, $userOffset);

		if (is_numeric($_time) && $time === false) {
			$format = $date;
			return self::i18nFormat($_time, $format, $invalid, $userOffset);
		}
		if ($time === false && $invalid !== false) {
			return $invalid;
		}
		return self::date($format, $time);
	}

/**
 * Returns a formatted date string, given either a UNIX timestamp or a valid strtotime() date string.
 * It take in account the default date format for the current language if a LC_TIME file is used.
 *
 * @param string $date Datetime string
 * @param string $format strftime format string.
 * @param boolean $invalid flag to ignore results of fromString == false
 * @param integer $userOffset User's offset from GMT (in hours)
 * @return string Formatted and translated date string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/time.html#formatting
 */
	public static function i18nFormat($date, $format = null, $invalid = false, $userOffset = null) {
		$date = self::fromString($date, $userOffset);
		if ($date === false && $invalid !== false) {
			return $invalid;
		}
		if (empty($format)) {
			$format = '%x';
		}
		$format = self::convertSpecifiers($format, $date);
		return self::_strftime($format, $date);
	}

/**
 * Multibyte wrapper for strftime.
 *
 * Handles utf8_encoding the result of strftime when necessary.
 *
 * @param string $format Format string.
 * @param int $date Timestamp to format.
 * @return string formatted string with correct encoding.
 */
	protected static function _strftime($format, $date) {
		$format = strftime($format, $date);
		$encoding = Configure::read('App.encoding');

		if (!empty($encoding) && $encoding === 'UTF-8') {
			if (function_exists('mb_check_encoding')) {
				$valid = mb_check_encoding($format, $encoding);
			} else {
				$valid = !Multibyte::checkMultibyte($format);
			}
			if (!$valid) {
				$format = utf8_encode($format);
			}
		}
		return $format;
	}
    function strtotime($time, $now = null){
        if(is_null($now)){
            $now = time();
        }
        $reg = '^1[0-9]{3}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1} [0-9]{2}:[0-9]{2}:[0-9]{2}^';
        if(preg_match($reg, $time)){
            $dateTime = explode(' ',$time);
            $Date = explode('-',$dateTime[0]);
            $Time = explode(':',$dateTime[1]); 
            return self::mktime(
                $Time[0],$Time[1],$Time[2],
                $Date[1],$Date[2],$Date[0]
            );
        }else{
            return strtotime($time, $now);
        }
        return false;
    }
    function dateTime($now = 'now'){
        return self::date('Y-m-d H:i:s',$now);
    }
    function date($type, $maket = "now")
    {

        //set 1 if you want translate number to farsi or if you don't like set 0

        $transnumber = 0;

        ///chosse your timezone

        $TZhours = 0;

        $TZminute = 0;

        $need = "";

        $result1 = "";

        $result = "";

        if ($maket == "now") {

            $year = date("Y");

            $month = date("m");

            $day = date("d");

            list($jyear, $jmonth, $jday) = self::gregorian_to_jalali($year, $month, $day);

            $maket = mktime(date("H") + $TZhours, date("i") + $TZminute, date("s"), date("m"),
                date("d"), date("Y"));

        } else {

            //$maket=0;

            $maket += $TZhours * 3600 + $TZminute * 60;

            $date = date("Y-m-d", $maket);

            list($year, $month, $day) = preg_split('/-/', $date);


            list($jyear, $jmonth, $jday) = self::gregorian_to_jalali($year, $month, $day);

        }


        $need = $maket;

        $year = date("Y", $need);

        $month = date("m", $need);

        $day = date("d", $need);

        $i = 0;

        $subtype = "";

        $subtypetemp = "";

        list($jyear, $jmonth, $jday) = self::gregorian_to_jalali($year, $month, $day);

        while ($i < strlen($type)) {

            $subtype = substr($type, $i, 1);

            if ($subtypetemp == "\\") {

                $result .= $subtype;

                $i++;

                continue;

            }
            switch ($subtype) {


                case "A":

                    $result1 = date("a", $need);

                    if ($result1 == "pm")
                        $result .= "بعدازظهر";

                    else
                        $result .= "قبل ‏ازظهر";

                    break;


                case "a":

                    $result1 = date("a", $need);

                    if ($result1 == "pm")
                        $result .= "ق.ظ";

                    else
                        $result .= "ب.ظ";

                    break;

                case "d":

                    if ($jday < 10)
                        $result1 = "0" . $jday;

                    else
                        $result1 = $jday;

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "D":

                    $result1 = date("D", $need);

                    if ($result1 == "Thu")
                        $result1 = "پ";

                    else
                        if ($result1 == "Sat")
                            $result1 = "ش";

                        else
                            if ($result1 == "Sun")
                                $result1 = "ی";

                            else
                                if ($result1 == "Mon")
                                    $result1 = "د";

                                else
                                    if ($result1 == "Tue")
                                        $result1 = "س";

                                    else
                                        if ($result1 == "Wed")
                                            $result1 = "چ";

                                        else
                                            if ($result1 == "Thu")
                                                $result1 = "پ";

                                            else
                                                if ($result1 == "Fri")
                                                    $result1 = "ج";

                    $result .= $result1;

                    break;

                case "F":

                    $result .= self::monthname($jmonth);

                    break;

                case "g":

                    $result1 = date("g", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "G":

                    $result1 = date("G", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "h":

                    $result1 = date("h", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "H":

                    $result1 = date("H", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "i":

                    $result1 = date("i", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "j":

                    $result1 = $jday;

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "l":

                    $result1 = date("l", $need);

                    if ($result1 == "Saturday")
                        $result1 = "شنبه";

                    else
                        if ($result1 == "Sunday")
                            $result1 = "یکشنبه";

                        else
                            if ($result1 == "Monday")
                                $result1 = "دوشنبه";

                            else
                                if ($result1 == "Tuesday")
                                    $result1 = "سه شنبه";

                                else
                                    if ($result1 == "Wednesday")
                                        $result1 = "چهارشنبه";

                                    else
                                        if ($result1 == "Thursday")
                                            $result1 = "پنجشنبه";

                                        else
                                            if ($result1 == "Friday")
                                                $result1 = "جمعه";

                    $result .= $result1;

                    break;

                case "m":

                    if ($jmonth < 10)
                        $result1 = "0" . $jmonth;

                    else
                        $result1 = $jmonth;

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "M":

                    $result .= self::short_monthname($jmonth);

                    break;

                case "n":

                    $result1 = $jmonth;

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "s":

                    $result1 = date("s", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "S":

                    $result .= "ام";

                    break;

                case "t":

                    $result .= self::lastday($month, $day, $year);

                    break;

                case "w":

                    $result1 = date("w", $need);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "y":

                    $result1 = substr($jyear, 2, 4);

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "Y":

                    $result1 = $jyear;

                    if ($transnumber == 1)
                        $result .= self::Convertnumber2farsi($result1);

                    else
                        $result .= $result1;

                    break;

                case "U":

                    $result .= mktime();

                    break;

                case "Z":

                    $result .= self::days_of_year($jmonth, $jday, $jyear);

                    break;

                case "L":

                    list($tmp_year, $tmp_month, $tmp_day) = self::jalali_to_gregorian(1384, 12, 1);

                    echo $tmp_day;

                    /*if(self::lastday($tmp_month,$tmp_day,$tmp_year)=="31")

                    $result.="1";

                    else 

                    $result.="0";

                    */

                    break;

                default:

                    $result .= $subtype;

            }

            $subtypetemp = substr($type, $i, 1);

            $i++;

        }

        return $result;

    }


    function mktime($hour = "", $minute = "", $second = "", $jmonth = "", $jday =
        "", $jyear = "")
    {

        if (!$hour && !$minute && !$second && !$jmonth && !$jmonth && !$jday && !$jyear)
            return mktime();

        list($year, $month, $day) = self::jalali_to_gregorian($jyear, $jmonth, $jday);

        $i = mktime($hour, $minute, $second, $month, $day, $year);

        return $i;

    }


    ///Find num of Day Begining Of Month ( 0 for Sat & 6 for Sun)

    function mstart($month, $day, $year)
    {

        list($jyear, $jmonth, $jday) = self::gregorian_to_jalali($year, $month, $day);

        list($year, $month, $day) = self::jalali_to_gregorian($jyear, $jmonth, "1");

        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        return date("w", $timestamp);

    }


    //Find Number Of Days In This Month

    function lastday($month, $day, $year)
    {

        $jday2 = "";

        $jdate2 = "";

        $lastdayen = date("d", mktime(0, 0, 0, $month + 1, 0, $year));

        list($jyear, $jmonth, $jday) = self::gregorian_to_jalali($year, $month, $day);

        $lastdatep = $jday;

        $jday = $jday2;

        while ($jday2 != "1") {

            if ($day < $lastdayen) {

                $day++;

                list($jyear, $jmonth, $jday2) = self::gregorian_to_jalali($year, $month, $day);

                if ($jdate2 == "1")
                    break;

                if ($jdate2 != "1")
                    $lastdatep++;

            } else {

                $day = 0;

                $month++;

                if ($month == 13) {

                    $month = "1";

                    $year++;

                }

            }


        }

        return $lastdatep - 1;

    }


    //Find days in this year untile now

    function days_of_year($jmonth, $jday, $jyear)
    {

        $year = "";

        $month = "";

        $year = "";

        $result = "";

        if ($jmonth == "01")
            return $jday;

        for ($i = 1; $i < $jmonth || $i == 12; $i++) {

            list($year, $month, $day) = self::jalali_to_gregorian($jyear, $i, "1");

            $result += self::lastday($month, $day, $year);

        }

        return $result + $jday;

    }


    //translate number of month to name of month

    function monthname($month)
    {


        if ($month == "01")
            return "فروردین";


        if ($month == "02")
            return "اردیبهشت";


        if ($month == "03")
            return "خرداد";


        if ($month == "04")
            return "تیر";


        if ($month == "05")
            return "مرداد";


        if ($month == "06")
            return "شهریور";


        if ($month == "07")
            return "مهر";


        if ($month == "08")
            return "آبان";


        if ($month == "09")
            return "آذر";


        if ($month == "10")
            return "دی";


        if ($month == "11")
            return "بهمن";


        if ($month == "12")
            return "اسفند";

    }


    function short_monthname($month)
    {


        if ($month == "01")
            return "فرو";


        if ($month == "02")
            return "ارد";


        if ($month == "03")
            return "خرد";


        if ($month == "04")
            return "تیر";


        if ($month == "05")
            return "مرد";


        if ($month == "06")
            return "شهر";


        if ($month == "07")
            return "مهر";


        if ($month == "08")
            return "آبا";


        if ($month == "09")
            return "آذر";


        if ($month == "10")
            return "دی";


        if ($month == "11")
            return "بهم";


        if ($month == "12")
            return "اسف ";

    }


    ////here convert to  number in persian

    function Convertnumber2farsi($srting)
    {

        $num0 = "&#1776;";

        $num1 = "&#1777;";

        $num2 = "&#1778;";

        $num3 = "&#1779;";

        $num4 = "&#1780;";

        $num5 = "&#1781;";

        $num6 = "&#1782;";

        $num7 = "&#1783;";

        $num8 = "&#1784;";

        $num9 = "&#1785;";


        $stringtemp = "";

        $len = strlen($srting);

        for ($sub = 0; $sub < $len; $sub++) {

            if (substr($srting, $sub, 1) == "0")
                $stringtemp .= $num0;

            elseif (substr($srting, $sub, 1) == "1")
                $stringtemp .= $num1;

            elseif (substr($srting, $sub, 1) == "2")
                $stringtemp .= $num2;

            elseif (substr($srting, $sub, 1) == "3")
                $stringtemp .= $num3;

            elseif (substr($srting, $sub, 1) == "4")
                $stringtemp .= $num4;

            elseif (substr($srting, $sub, 1) == "5")
                $stringtemp .= $num5;

            elseif (substr($srting, $sub, 1) == "6")
                $stringtemp .= $num6;

            elseif (substr($srting, $sub, 1) == "7")
                $stringtemp .= $num7;

            elseif (substr($srting, $sub, 1) == "8")
                $stringtemp .= $num8;

            elseif (substr($srting, $sub, 1) == "9")
                $stringtemp .= $num9;

            else
                $stringtemp .= substr($srting, $sub, 1);


        }

        return $stringtemp;


    } ///end conver to number in persian


    function is_kabise($year)
    {

        if ($year % 4 == 0 && $year % 100 != 0)
            return true;

        return false;

    }


    function jcheckdate($month, $day, $year)
    {

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        if ($month <= 12 && $month > 0) {

            if ($j_days_in_month[$month - 1] >= $day && $day > 0)
                return 1;

            if (self::is_kabise($year))
                echo "Asdsd";

            if (self::is_kabise($year) && $j_days_in_month[$month - 1] == 31)
                return 1;

        }


        return 0;


    }


    function jtime()
    {

        return mktime();

    }


    function jgetdate($timestamp = "")
    {

        if ($timestamp == "")
            $timestamp = mktime();


        return array(0 => $timestamp, "seconds" => self::date("s", $timestamp), "minutes" =>
            self::date("i", $timestamp), "hours" => self::date("G", $timestamp), "mday" => self::date("j",
            $timestamp), "wday" => self::date("w", $timestamp), "mon" => self::date("n", $timestamp),
            "year" => self::date("Y", $timestamp), "yday" => self::days_of_year(self::date("m", $timestamp),
            self::date("d", $timestamp), self::date("Y", $timestamp)), "weekday" => self::date("l", $timestamp),
            "month" => self::date("F", $timestamp), );

    }

    function div($a, $b)
    {

        return (int)($a / $b);

    }


    function gregorian_to_jalali($g_y, $g_m, $g_d)
    {

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


        $gy = $g_y - 1600;

        $gm = $g_m - 1;

        $gd = $g_d - 1;


        $g_day_no = 365 * $gy + self::div($gy + 3, 4) - self::div($gy + 99, 100) + self::div($gy + 399,400);


        for ($i = 0; $i < $gm; ++$i)
            $g_day_no += $g_days_in_month[$i];

        if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
            /* leap and after Feb */
            $g_day_no++;

        $g_day_no += $gd;


        $j_day_no = $g_day_no - 79;


        $j_np = self::div($j_day_no, 12053);
         /* 12053 = 365*33 + 32/4 */

        $j_day_no = $j_day_no % 12053;


        $jy = 979 + 33 * $j_np + 4 * self::div($j_day_no, 1461);
         /* 1461 = 365*4 + 4/4 */


        $j_day_no %= 1461;


        if ($j_day_no >= 366) {

            $jy += self::div($j_day_no - 1, 365);

            $j_day_no = ($j_day_no - 1) % 365;

        }


        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
            $j_day_no -= $j_days_in_month[$i];

        $jm = $i + 1;

        $jd = $j_day_no + 1;


        return array($jy, $jm, $jd);

    }


    function jalali_to_gregorian($j_y, $j_m, $j_d)
    {

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


        $jy = $j_y - 979;

        $jm = $j_m - 1;

        $jd = $j_d - 1;


        $j_day_no = 365 * $jy + self::div($jy, 33) * 8 + self::div($jy % 33 + 3, 4);

        for ($i = 0; $i < $jm; ++$i)
            $j_day_no += $j_days_in_month[$i];


        $j_day_no += $jd;


        $g_day_no = $j_day_no + 79;


        $gy = 1600 + 400 * self::div($g_day_no, 146097);
         /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */

        $g_day_no = $g_day_no % 146097;


        $leap = true;

        if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {

            $g_day_no--;

            $gy += 100 * self::div($g_day_no, 36524);
             /* 36524 = 365*100 + 100/4 - 100/100 */

            $g_day_no = $g_day_no % 36524;


            if ($g_day_no >= 365)
                $g_day_no++;

            else
                $leap = false;

        }


        $gy += 4 * self::div($g_day_no, 1461);
         /* 1461 = 365*4 + 4/4 */

        $g_day_no %= 1461;


        if ($g_day_no >= 366) {

            $leap = false;


            $g_day_no--;

            $gy += self::div($g_day_no, 365);

            $g_day_no = $g_day_no % 365;

        }


        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
            $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);

        $gm = $i + 1;

        $gd = $g_day_no + 1;


        return array($gy, $gm, $gd);

    }
}
