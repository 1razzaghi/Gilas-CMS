<?php

App::uses('AppController', 'Controller');

/**
 * WeblinkCategories Controller
 *
 * @property WeblinkCategory $WeblinkCategory
 */
class WeblinkCategoriesController extends AppController {

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت مجموعه های وب لینک');
        $this->paginate = array('limit' => 20);
        $weblinkCategories = $this->paginate('WeblinkCategory');
        $this->set(compact('weblinkCategories'));
    }

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن مجموعه وب لینک');
        if ($this->request->is('post')) {
            if ($this->WeblinkCategory->save($this->request->data)) {
                $this->Session->setFlash('مجموعه با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش مجموعه وب لینک');
        $this->WeblinkCategory->id = $id;
        if (!$this->WeblinkCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->WeblinkCategory->save($this->request->data)) {
                $this->Session->setFlash('مجموعه وب لینک با موفقیت ویرایش شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->request->data = $this->WeblinkCategory->read();
        }
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->WeblinkCategory->id = $id;
        if (!$this->WeblinkCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->WeblinkCategory->delete()) {
            $this->Session->setFlash('مجموعه وب لینک با موفیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

}
