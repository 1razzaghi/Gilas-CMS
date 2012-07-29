<?php
App::uses('ContactDetail', 'Model');

/**
 * ContactDetail Test Case
 *
 */
class ContactDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contact_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ContactDetail = ClassRegistry::init('ContactDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContactDetail);

		parent::tearDown();
	}

}
