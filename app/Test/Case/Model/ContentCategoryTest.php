<?php
App::uses('ContentCategory', 'Model');

/**
 * ContentCategory Test Case
 *
 */
class ContentCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.content_category',
		'app.content',
		'app.user',
		'app.gallery_item',
		'app.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ContentCategory = ClassRegistry::init('ContentCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContentCategory);

		parent::tearDown();
	}

}
