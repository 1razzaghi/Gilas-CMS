<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => 'menu parent id for example a gallery menu which link\'s to My Friends Gallery is a Child of Gallery menu which was an separator menu type  
 By default all menu is parent=>0'),
		'title' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_persian_ci', 'comment' => 'menu alias for using on slugs', 'charset' => 'utf8'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => 'menu type for example :  1) contact 2) gallery 3) static page(linked to content) 4) web links 5) register 6) menu separator 7) site map ,.....'),
		'published' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'comment' => 'By default all menu is published'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null),
		'level' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 20),
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
			'parent_id' => 1,
			'title' => 1,
			'alias' => 'Lorem ipsum dolor sit amet',
			'type' => 1,
			'published' => 1,
			'lft' => 1,
			'rght' => 1,
			'level' => 1
		),
	);

}
