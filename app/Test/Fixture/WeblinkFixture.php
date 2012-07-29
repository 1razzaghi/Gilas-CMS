<?php
/**
 * WeblinkFixture
 *
 */
class WeblinkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'weblink_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'links title', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_persian_ci', 'comment' => 'links description', 'charset' => 'utf8'),
		'link' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_persian_ci', 'comment' => 'link address', 'charset' => 'utf8'),
		'hits' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => 'number of link hits after each click on link hits +1'),
		'published' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'comment' => 'By default all link is published'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'weblink_category_id' => array('column' => 'weblink_category_id', 'unique' => 0)
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
			'weblink_category_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit amet',
			'hits' => 1,
			'published' => 1,
			'created' => '2012-07-25 10:35:18'
		),
	);

}
