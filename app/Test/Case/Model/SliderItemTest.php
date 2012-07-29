<?php
App::uses('SliderItem', 'Model');

/**
 * SliderItem Test Case
 *
 */
class SliderItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.slider_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SliderItem = ClassRegistry::init('SliderItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SliderItem);

		parent::tearDown();
	}

}
