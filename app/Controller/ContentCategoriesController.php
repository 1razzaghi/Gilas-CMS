<?php

App::uses('AppController', 'Controller');

/**
 * ContentCategories Controller
 *
 * @property ContentCategory $ContentCategory
 */
class ContentCategoriesController extends AppController {

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن مجموعه مطالب');
        $this->set('parents', $this->ContentCategory->generateTreeList());
        if ($this->request->is('post')) {
            if ($this->ContentCategory->save($this->request->data)) {
                $this->Session->setFlash('مجموعه با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت مجموعه مطالب');
        $this->paginate = array('limit' => 20);
        $contentCategories = $this->paginate('ContentCategory');
        $this->set(compact('contentCategories'));
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->ContentCategory->id = $id;
        if (!$this->ContentCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->ContentCategory->delete()) {
            $this->Session->setFlash('مجموعه با موفقیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش مجموعه مطلب');
        $this->ContentCategory->id = $id;
        if (!$this->ContentCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ContentCategory->save($this->request->data)) {
                $this->Session->setFlash('مجموعه با موفقیت ویرایش شد', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->set('parents', $this->ContentCategory->generateTreeList());
            $this->request->data = $this->ContentCategory->read();
        }
    }

}
