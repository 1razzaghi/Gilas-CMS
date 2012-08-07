<?php

App::uses('AppModel', 'Model');

/**
 * GalleryCategory Model
 *
 * @property GalleryCategory $ParentGalleryCategory
 * @property GalleryCategory $ChildGalleryCategory
 * @property GalleryItem $GalleryItem
 */
class GalleryCategory extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Tree');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'ورود نام مجموعه الزامی است',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'folder_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'ورود نام فولدر ذخیره سازی تصاویر مجموعه الزامی است',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'این نام برای پوشه تصاویر گالری قبلا انتخاب شده است. لطفا نام دیگری را وارد کنید'
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
        'ParentGalleryCategory' => array(
            'className' => 'GalleryCategory',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'ChildGalleryCategory' => array(
            'className' => 'GalleryCategory',
            'foreignKey' => 'parent_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'GalleryItem' => array(
            'className' => 'GalleryItem',
            'foreignKey' => 'gallery_category_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
