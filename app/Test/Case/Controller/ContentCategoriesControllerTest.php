<?php
App::uses('ContentCategoriesController', 'Controller');

/**
 * ContentCategoriesController Test Case
 *
 */
class ContentCategoriesControllerTest extends ControllerTestCase {

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
		'app.gallery_category',
		'app.comment'
	);

}
