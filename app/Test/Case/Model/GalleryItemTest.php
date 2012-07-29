<?php
App::uses('GalleryItem', 'Model');

/**
 * GalleryItem Test Case
 *
 */
class GalleryItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gallery_item',
		'app.user',
		'app.content',
		'app.content_category',
		'app.comment',
		'app.gallery_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GalleryItem = ClassRegistry::init('GalleryItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GalleryItem);

		parent::tearDown();
	}

}
