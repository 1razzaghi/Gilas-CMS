<?php
App::uses('GalleryCategory', 'Model');

/**
 * GalleryCategory Test Case
 *
 */
class GalleryCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gallery_category',
		'app.gallery_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GalleryCategory = ClassRegistry::init('GalleryCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GalleryCategory);

		parent::tearDown();
	}

}
