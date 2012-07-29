<?php
App::uses('GalleryItemsController', 'Controller');

/**
 * GalleryItemsController Test Case
 *
 */
class GalleryItemsControllerTest extends ControllerTestCase {

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

}
