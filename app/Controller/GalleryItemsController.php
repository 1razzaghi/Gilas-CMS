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
        
    }

}
