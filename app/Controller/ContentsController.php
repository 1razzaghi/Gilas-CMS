<?php

App::uses('AppController', 'Controller');

/**
 * Content Controller
 *
 * @property Content $Content
 */
class ContentsController extends AppController {

    public function admin_add() {
        $this->helpers = array('TinyMCE.TinyMCE');
        $this->set('title_for_layout', 'افزودن مطلب');
        $this->set('contentCategories', $this->Content->ContentCategory->find('list'));
        if ($this->request->is('post')) {
            $this->request->data['Content']['user_id'] = $this->Auth->user('id');
            $this->request->data['Content']['created'] = Jalali::dateTime();
            $this->request->data['Content']['modified'] = Jalali::dateTime();
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('مطلب با موفقیت ذخیره شد.', 'message', array('type' => 'alert-success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'alert-error'));
            }
        }
    }

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت مطالب');
        $this->paginate = array('limit' => 20);
        $contents = $this->paginate('Content');
        $this->set(compact('contents'));
    }

    public function add() {
        
    }

    public function index() {
        
    }

}

?>
