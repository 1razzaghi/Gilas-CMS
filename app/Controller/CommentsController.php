<?php

App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

    private function _haveHttpPrefix($url = Null) {
        if (substr($url, 0, 7) != 'http://')
            $url = 'http://' . $url;
        return $url;
    }

    public function admin_index() {
        
    }

    public function add_comment(array $data, $content_id, $is_published) {

        $this->request->data = $data;
        $this->request->data['Comment']['created'] = Jalali::dateTime();
        $this->request->data['Comment']['content_id'] = $content_id;
        $this->request->data['Comment']['published'] = $is_published;
        $this->request->data['Comment']['website'] = $this->_haveHttpPrefix($this->request->data['Comment']['website']);

        if ($this->Comment->save($this->request->data)) {
            if ($is_published)
                $this->Session->setFlash('نظر با موفقیت افزوده شد.', 'message', array('type' => 'success'));
            else
                $this->Session->setFlash('نظر با موفقیت افزوده شد ولی برای نمایش ابتدا باید به تایید مدیریت برسد!', 'message', array('type' => 'block'));
        } else {
            debug($this->Comment->validationErrors);
            $this->Session->setFlash('امکان درج نظر وجود ندارد');
        }
    }

    public function admin_view($id = NULL) {
        $this->helpers = array('Comment');
        $this->set('title_for_layout', 'مشاهده نظرات مطالب');
        $this->set('comments', $this->Comment->find('threaded', array(
                    'conditions' => array('Comment.content_id' => $id),
                    'order' => array('Comment.created' => 'desc')
                )));
    }

    public function admin_publish_comment($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Comment->saveField('published', 1)) {
            $this->Session->setFlash('نظر با موفقیت منتشر شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_unpublish_comment($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Comment->saveField('published', 0)) {
            $this->Session->setFlash('نظر با موفقیت از حالت انتشار خارج شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

    public function admin_delete($id = NULL) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('خطای شماره 12 - درخواست شما نا معتبر است و امکان بررسی آن وجود ندارد!');
        }
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('خطای شماره 14 – امکان انجام عملیات درخواستی بدلیل ارسال نادرست اطلاعات وجود ندارد!');
        }
        if ($this->Comment->delete()) {
            $this->Session->setFlash('نظر با موفقیت حذف شد.', 'message', array('type' => 'success'));
            $this->redirect($this->referer());
        }
    }

}
