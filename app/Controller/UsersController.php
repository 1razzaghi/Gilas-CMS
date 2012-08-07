<?php

/*
 * Created By : Mohammad Razzaghi
 * Email : 1razzaghi@gmail.com
 * Blog : http://bigitblog.ir
 * Social Networks : 
 *          http://facebook.com/1razzaghi
 *          http://twitter.com/1razzaghi
 */

class UsersController extends AppController {

    public function beforeRender() {
        parent::beforeRender();
        if ($this->request->params['action'] == 'admin_login')
            $this->layout = 'login';
    }

    public function admin_login() {
        $this->layout = 'login';
        $this->set('title_for_layout', 'ورود به قسمت مدیریت');
        if ($this->_isLogedIn()) {
            $this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'admin' => TRUE));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash('شما با موفقیت وارد سیستم شدید', 'message', array('type' => 'success'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('خطای شماره 11 - امکان ورود به سیستم وجود ندارد!', 'message', array('type' => 'error'));
            }
        } /* else {
          $this->Session->setFlash('خطای شماره 12 - درخواست شما نامعتبر می باشد و امکان بررسی آن وجود ندارد!', 'message', array('type' => 'alert-error'));
          } */
    }

    public function admin_logout() {
        $this->Session->setFlash('شما با موفقیت از سیستم خارج شدید', 'message', array('type' => 'success'));
        $this->redirect($this->Auth->logout());
    }

    public function register() {
        $this->set('title_for_layout', 'ثبت نام در سیستم');
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('ثبت نام شما تکمیل شد. می توانید وارد شوید'), 'default', array('class' => 'alert alert-success', 'id' => 'error'));
                $this->redirect(array('action' => 'login', 'admin' => TRUE));
            } else {
                $this->Session->setFlash('خطای شماره 13 - اطلاعات وارد شده معتبر نمی باشد. لطفا به خطاهای سیستم دقت کرده و مجددا تلاش نمایید.', 'message', array('type' => 'error'));
            }
        }
        $this->layout = 'login';
    }

}

?>
