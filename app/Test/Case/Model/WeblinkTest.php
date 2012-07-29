<?php
App::uses('Weblink', 'Model');

/**
 * Weblink Test Case
 *
 */
class WeblinkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.weblink',
		'app.weblink_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Weblink = ClassRegistry::init('Weblink');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Weblink);

		parent::tearDown();
	}

}
