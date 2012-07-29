<?php
/**
 * ContactDetailFixture
 *
 */
class ContactDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'title of contact', 'charset' => 'utf8'),
		'manager' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'manager name of company or web site', 'charset' => 'utf8'),
		'telephone_1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_persian_ci', 'comment' => 'company tel #1 example : 05118456628', 'charset' => 'utf8'),
		'telephone_2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_persian_ci', 'comment' => 'company tel #2 example : 05118456629', 'charset' => 'utf8'),
		'fax' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_persian_ci', 'comment' => 'company fax number', 'charset' => 'utf8'),
		'mobile' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_persian_ci', 'comment' => 'manger mobile number or company mobile number', 'charset' => 'utf8'),
		'sms_center' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 14, 'collate' => 'utf8_persian_ci', 'comment' => 'company sms center for example : 3000662849', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_persian_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'manager' => 'Lorem ipsum dolor sit amet',
			'telephone_1' => 'Lorem ips',
			'telephone_2' => 'Lorem ips',
			'fax' => 'Lorem ips',
			'mobile' => 'Lorem ips',
			'sms_center' => 'Lorem ipsum '
		),
	);

}
