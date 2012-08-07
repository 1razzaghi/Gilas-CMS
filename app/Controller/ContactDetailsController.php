<?php

App::uses('AppController', 'Controller');

/**
 * ContactDetails Controller
 *
 * @property ContactDetail $ContactDetail
 */
class ContactDetailsController extends AppController {

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن اطلاعات تماس');
        if ($this->request->is('post')) {
            if ($this->ContactDetail->save($this->request->data)) {
                $this->Session->setFlash('اطلاعات تماس با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش اطلاعات تماس');
        $this->ContactDetail->id = $id;
        if (!$this->ContactDetail->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ContactDetail->save($this->request->data)) {
                $this->Session->setFlash('اطلاعات تماس با موفقیت ویرایش شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->request->data = $this->ContactDetail->read();
        }
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->ContactDetail->id = $id;
        if (!$this->ContactDetail->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->ContactDetail->delete()) {
            $this->Session->setFlash('اطلاعات تماس با موفیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت اطلاعات تماس');
        $this->set('contactDetails', $this->ContactDetail->find('all'));
    }

}
