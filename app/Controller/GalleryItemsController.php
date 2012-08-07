<?php

App::uses('AppController', 'Controller');

/**
 * GalleryItems Controller
 *
 * @property GalleryItem $GalleryItem
 */
class GalleryItemsController extends AppController {

    public function admin_index() {
        $this->set('title_for_layout', 'لیست تصاویر گالری');
        $this->paginate = array('limit' => 20);
        $galleryItems = $this->paginate('GalleryItem');
        $this->set(compact('galleryItems'));
    }

    public function admin_add() {
        $this->set('title_for_layout', 'افزودن تصویر به گالری');
        $this->set('galleryCategories', $this->GalleryItem->GalleryCategory->find('list'));
        if ($this->request->is('post')) {
            $uploded_file = $this->request->data['GalleryItem']['name']['tmp_name'];
            $this->request->data['GalleryItem']['name'] = $this->request->data['GalleryItem']['name']['name'];
            $this->request->data['GalleryItem']['user_id'] = $this->Auth->user('id');
            $folder_path = $this->GalleryItem->GalleryCategory->findById($this->request->data['GalleryItem']['gallery_category_id'], array('folder_name'));
            if ($this->GalleryItem->save($this->request->data)) {
                $this->_imageUpload($uploded_file, $folder_path['GalleryCategory']['folder_name'], $this->request->data['GalleryItem']['name']);
                $this->Session->setFlash('تصویر با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    private function _imageUpload($imgTmpName = NULL, $galleryName = NULL, $imageName = NULL) {
        if (!empty($imgTmpName) && !empty($imageName) && !empty($galleryName)) {
            move_uploaded_file($imgTmpName, WWW_ROOT . 'gallery' . DS . $galleryName . DS . $imageName);
            return TRUE;
        }
        return FALSE;
    }

    public function admin_edit($id = NULL) {
        $this->set('title_for_layout', 'ویرایش اطلاعات تصویر');
        $this->GalleryItem->id = $id;
        $this->set('galleryCategories', $this->GalleryItem->GalleryCategory->find('list'));
        $requestData = $this->GalleryItem->read();
        if (!$this->GalleryItem->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            debug($this->request->data);
            if (empty($this->request->data['GalleryItem']['name']['name'])) {
                $this->request->data['GalleryItem']['name'] = $requestData['GalleryItem']['name'];
                $mustUpload = FALSE;
            } else {
                $uploded_file = $this->request->data['GalleryItem']['name']['tmp_name'];
                $this->request->data['GalleryItem']['name'] = $this->request->data['GalleryItem']['name']['name'];
                $folder_path = $this->GalleryItem->GalleryCategory->findById($this->request->data['GalleryItem']['gallery_category_id'], array('folder_name'));
                $mustUpload = TRUE;
            }
            debug($this->request->data);
            die;
            if ($this->GalleryItem->save($this->request->data)) {
                if ($mustUpload)
                    $this->_imageUpload($uploded_file, $folder_path['GalleryCategory']['folder_name'], $this->request->data['GalleryItem']['name']);
                $this->Session->setFlash('تصویر با موفقیت ویرایش شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->request->data = $requestData;
        }
    }

}
