<?php

App::uses('AppController', 'Controller');

/**
 * Weblinks Controller
 *
 * @property Weblink $Weblink
 */
class WeblinksController extends AppController {

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت وب لینک ها');
        $this->paginate = array('limit' => '20');
        $weblinks = $this->paginate('Weblink');
        $this->set('weblinks', $weblinks);
    }

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن وب لینک');
        $this->set('weblinkCategories', $this->Weblink->WeblinkCategory->find('list'));
        if ($this->request->is('post')) {
            $this->request->data['Weblink']['created'] = Jalali::dateTime();
            if ($this->Weblink->save($this->request->data)) {
                $this->Session->setFlash('وب لینک با موفقیت اضافه شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش وب لینک');
        $this->Weblink->id = $id;
        if (!$this->Weblink->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Weblink->save($this->request->data)) {
                $this->Session->setFlash('وب لینک با موفقیت ویرایش شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->set('weblinkCategories', $this->Weblink->WeblinkCategory->find('list'));
            $this->request->data = $this->Weblink->read();
        }
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Weblink->id = $id;
        if (!$this->Weblink->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Weblink->delete()) {
            $this->Session->setFlash('وب لینک با موفیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

}
