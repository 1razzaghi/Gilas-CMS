<?php

App::uses('AppModel', 'Model');

/**
 * GalleryItem Model
 *
 * @property User $User
 * @property GalleryCategory $GalleryCategory
 */
class GalleryItem extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'ورود عنوان تصویر الزامی است',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'isUniqueName' => array(
                'rule' => array('isUniqueName'),
                'message' => 'تصویر دیگری با این نام در این مجموعه وجود دارد. لطفا از صحت فایل آپلودی اطمینان حاصل کرده و مجددا تلاش نمایید',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'extension' => array(
                'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
                'message' => 'فرمت فایل برای آپلود پشتیبانی نمی شود. لطفا از فرمت های رایج عکس استفاده نمایید.'
            )
        ),
        'gallery_category_id' => array(
            'comparison' => array(
                'rule' => array('comparison', '!=', 0),
                'message' => 'لطفا یک مجموعه برای تصویر انتخاب نمایید'
            )
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'GalleryCategory' => array(
            'className' => 'GalleryCategory',
            'foreignKey' => 'gallery_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function isUniqueName($check) {
        $count = NULL;
        if (isset($this->data[$this->alias]['name'])) {
            $count = $this->find('count', array(
                'conditions' => array(
                    'gallery_category_id' => $this->data[$this->alias]['gallery_category_id'],
                    'GalleryItem.name' => $this->data[$this->alias]['name']
                )
                    )
            );
            if ($count)
                return FALSE;
            return TRUE;
        }
    }

}
