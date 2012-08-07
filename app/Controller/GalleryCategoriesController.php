<?php

App::uses('AppController', 'Controller');

/**
 * GalleryCategories Controller
 *
 * @property GalleryCategory $GalleryCategory
 */
class GalleryCategoriesController extends AppController {

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت مجموعه گالری');
        $this->paginate = array('limit' => 20);
        $galleryCategories = $this->paginate('GalleryCategory');
        $this->set(compact('galleryCategories'));
    }

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن مجموعه گالری');
        $this->set('parents', $this->GalleryCategory->generateTreeList());
        if ($this->request->is('post')) {
            if ($this->GalleryCategory->save($this->request->data)) {
                mkdir(WWW_ROOT . 'gallery' . DS . $this->request->data['GalleryCategory']['folder_name'], 0777);
                $this->Session->setFlash('مجموعه با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->Session->setFlash('پوشه تصاویر مجموعه با موفقیت ساخته شد.', 'message_1', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش مجموعه گالری');
        $this->GalleryCategory->id = $id;

        if (!$this->GalleryCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }

        $requestData = $this->GalleryCategory->read();

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->GalleryCategory->save($this->request->data)) {
                if (!is_dir(WWW_ROOT . 'gallery' . DS . $this->request->data['GalleryCategory']['folder_name'])) {
                    rename(WWW_ROOT . 'gallery' . DS . $requestData['GalleryCategory']['folder_name'], WWW_ROOT . 'gallery' . DS . $this->request->data['GalleryCategory']['folder_name']);
                }
                $this->Session->setFlash('مجموعه با موفقیت ویرایش شد', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->set('parents', $this->GalleryCategory->generateTreeList());
            $this->request->data = $requestData;
        }
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->GalleryCategory->id = $id;
        if (!$this->GalleryCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        $galleryCategory = $this->GalleryCategory->read();
        if ($this->GalleryCategory->delete()) {
            rmdir(WWW_ROOT . 'gallery' . DS . $galleryCategory['GalleryCategory']['folder_name']);
            $this->Session->setFlash('مجموعه با موفقیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

    public function admin_publishGalleryCategory($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->GalleryCategory->id = $id;
        if (!$this->GalleryCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->GalleryCategory->saveField('published', 1)) {
            $this->Session->setFlash('مجموعه گالری با موفقیت منتشر شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_unPublishGalleryCategory($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->GalleryCategory->id = $id;
        if (!$this->GalleryCategory->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->GalleryCategory->saveField('published', 0)) {
            $this->Session->setFlash('مجموعه گالری با موفقیت از حالت انتشار خارج شد', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

}
