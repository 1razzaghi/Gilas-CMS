<?php

App::uses('AppModel', 'Model');

/**
 * Weblink Model
 *
 * @property WeblinkCategory $WeblinkCategory
 */
class Weblink extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'ورود عنوان وب لینک الزامی است',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'address' => array(
            'url' => array(
                'rule' => array('url'),
                'message' => 'لطفا آدرس وب را به شکل صحیح وارد نمایید',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'ورود آدرس وب الزامی است',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'hits' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'تعداد بازدید باید به صورت عددی باشد',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'weblink_category_id' => array(
            'comparison' => array(
                'rule' => array('comparison', '!=', 0),
                'message' => 'لطفا یک مجموعه برای وب لینک انتخاب نمایید',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'WeblinkCategory' => array(
            'className' => 'WeblinkCategory',
            'foreignKey' => 'weblink_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
