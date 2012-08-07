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
        $this->set('contentCategories', $this->Content->ContentCategory->generateTreeList());
        if ($this->request->is('post')) {
            $this->request->data['Content']['user_id'] = $this->Auth->user('id');
            $this->request->data['Content']['created'] = $this->request->data['Content']['modified'] = Jalali::dateTime();
            if (!empty($this->request->data['Content']['slug']))
                $this->request->data['Content']['slug'] = Inflector::slug($this->request->data['Content']['slug']);
            else
                $this->request->data['Content']['slug'] = Inflector::slug($this->request->data['Content']['title']);

            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('مطلب با موفقیت ذخیره شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
    }

    public function admin_index() {
        $this->set('title_for_layout', 'مدیریت مطالب');
        $this->paginate = array('limit' => 20);
        $contents = $this->paginate('Content');
        $this->set(compact('contents'));
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }

        if ($this->Content->delete()) {
            $this->Session->setFlash('مطلب با موفقیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

    public function admin_edit($id = NULL) {
        $this->helpers = array('TinyMCE.TinyMCE');
        $this->set('title_for_layout', 'ویرایش مطلب');
        $this->set('contentCategories', $this->Content->ContentCategory->generateTreeList());
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Content']['modified'] = Jalali::dateTime();
            if (!empty($this->request->data['Content']['slug']))
                $this->request->data['Content']['slug'] = Inflector::slug($this->request->data['Content']['slug']);
            else
                $this->request->data['Content']['slug'] = Inflector::slug($this->request->data['Content']['title']);
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('مطلب با موفقیت ویرایش شد.', 'message', array('type' => 'success'));
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        } else {
            $this->request->data = $this->Content->read();
        }
    }

    public function index() {
        
    }

    public function view($id = NULL) {
        $this->Content->id = $id;
        $content = $this->Content->read();
        $this->set('content', $content);
        $this->set('comments', $this->Content->Comment->find('all', array('conditions' => array('Comment.content_id' => $id, 'Comment.published' => '1'))));
        if ($this->request->isPost()) {
            App::uses('CommentsController', 'Controller');
            $commentObj = new CommentsController();
            $commentObj->constructClasses();
            $success = $commentObj->add_comment($this->request->data, $content['Content']['id'], $content['Content']['published_comment']);
        }
    }

    public function admin_publish_content($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('published', 1)) {
            $this->Session->setFlash('مطلب با موفقیت منتشر شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_unpublish_content($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('published', 0)) {
            $this->Session->setFlash('مطلب با موفقیت از حالت انتشار خارج شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_add_content_to_frontpage($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('frontpage', 1)) {
            $this->Session->setFlash('مطلب با موفقیت به صفحه اصلی اضافه شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_remove_content_from_frontpage($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('frontpage', 0)) {
            $this->Session->setFlash('مطلب با موفقیت از صفحه اصلی حذف شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_dis_allow_comment_to_content($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('allow_comment', 0)) {
            $this->Session->setFlash('نظر دهی به مطلب با موفقیت غیرفعال شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_allow_comment_to_content($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Content->saveField('allow_comment', 1)) {
            $this->Session->setFlash('نظر دهی به مطلب با موفقیت فعال شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

}

?>
