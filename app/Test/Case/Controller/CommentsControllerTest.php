<?php
App::uses('CommentsController', 'Controller');

/**
 * CommentsController Test Case
 *
 */
class CommentsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comment',
		'app.content',
		'app.user',
		'app.gallery_item',
		'app.gallery_category',
		'app.content_category'
	);

}
