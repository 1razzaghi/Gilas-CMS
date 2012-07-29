<?php
App::uses('WeblinkCategory', 'Model');

/**
 * WeblinkCategory Test Case
 *
 */
class WeblinkCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.weblink_category',
		'app.weblink'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WeblinkCategory = ClassRegistry::init('WeblinkCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WeblinkCategory);

		parent::tearDown();
	}

}
