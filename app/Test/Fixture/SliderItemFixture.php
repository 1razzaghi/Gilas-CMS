<?php
/**
 * SliderItemFixture
 *
 */
class SliderItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'link' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_persian_ci', 'comment' => 'reference link for this slide', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'image title', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_persian_ci', 'comment' => 'image description for displaying under title!', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_persian_ci', 'comment' => 'image name for accessing the true image on the slider folder! for example :  app/webroot/images/slider/slide_01.jpg', 'charset' => 'utf8'),
		'published' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'comment' => 'By default all images in slider is published!'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'link' => 'Lorem ipsum dolor sit amet',
			'title' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'published' => 1,
			'created' => '2012-07-25 10:33:37'
		),
	);

}
