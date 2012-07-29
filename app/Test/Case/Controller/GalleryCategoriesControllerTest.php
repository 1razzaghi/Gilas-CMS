<?php
App::uses('GalleryCategoriesController', 'Controller');

/**
 * GalleryCategoriesController Test Case
 *
 */
class GalleryCategoriesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gallery_category',
		'app.gallery_item',
		'app.user',
		'app.content',
		'app.content_category',
		'app.comment'
	);

}
