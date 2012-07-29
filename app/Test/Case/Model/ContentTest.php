<?php
App::uses('Content', 'Model');

/**
 * Content Test Case
 *
 */
class ContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.content',
		'app.user',
		'app.gallery_item',
		'app.content_category',
		'app.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Content = ClassRegistry::init('Content');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Content);

		parent::tearDown();
	}

}
