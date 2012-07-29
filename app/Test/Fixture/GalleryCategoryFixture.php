<?php
/**
 * GalleryCategoryFixture
 *
 */
class GalleryCategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'category parent id  By default all category added to the app is parent while the admin did \'nt  select a parent for its'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_persian_ci', 'charset' => 'utf8'),
		'folder_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'category folder name for inserting images! for example image category folder is stored to : app/webroot/images/gallery 
 and category name is MyFreinds so the images which added to this category will stored into :  app/webroot/images/gallery/MyFreinds', 'charset' => 'utf8'),
		'published' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'folder_name' => 'Lorem ipsum dolor sit amet',
			'published' => 1
		),
	);

}
