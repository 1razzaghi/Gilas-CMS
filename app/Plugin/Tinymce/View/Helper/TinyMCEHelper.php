<?php

/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license LGPL License (http://www.opensource.org/licenses/lgpl-2.1.php)
 */

/**
 * TinyMCE Helper
 *
 * @package TinyMCE
 * @subpackage TinyMCE.View.Helper
 */
class TinyMCEHelper extends AppHelper {

    /**
     * Other helpers used by FormHelper
     *
     * @var array
     */
    public $helpers = array('Html');

    /**
     * Configuration
     *
     * @var array
     */
    public $configs = array();

    /**
     * Default values
     *
     * @var array
     */
    protected $_defaults = array();

    /**
     * Constructor
     *
     * @param View $View The View this helper is being attached to.
     * @param array $settings Configuration settings for the helper.
     */
    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
        $configs = Configure::read('TinyMCE.configs');
        if (!empty($configs) && is_array($configs)) {
            $this->configs = $configs;
        }
    }

    /**
     * Adds a new editor to the script block in the head
     *
     * @see http://www.tinymce.com/wiki.php/Configuration for a list of keys
     * @param mixed If array camel cased TinyMCE Init config keys, if string it checks if a config with that name exists
     * @return void
     */
    public function editor($options = array()) {
        $this->configs['simple'] = $this->configs['advanced'] = array(
            'script_url' => $this->Html->url('/tinymce/js/tiny_mce.js'),
            // General options
            'theme' => 'advanced',
            'plugins' => 'pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist',
            'directionality' => 'rtl',
            // Skin options
            'skin' => 'o2k7',
            'skin_variant' => 'silver',
            'language' => 'fa',
            // Theme options
            'theme_advanced_buttons1' => 'bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,ltr,rtl,|,bullist,numlist,|,link,unlink,image,|,forecolor,backcolor,formatselect,fontselect,fontsizeselect',
            'theme_advanced_buttons2' => null,
            'theme_advanced_buttons3' => null,
            'document_base_url' => $this->Html->url('/'),
            'relative_urls' => false,
            // Drop lists for link/image/media/template dialogs
            'template_external_list_url' => "lists/template_list.js",
            'external_link_list_url' => "lists/link_list.js",
            'external_image_list_url' => "lists/image_list.js",
            'media_external_list_url' => "lists/media_list.js",
            'theme_advanced_toolbar_location' => "top",
            'theme_advanced_toolbar_align' => "left",
            //	'theme_advanced_statusbar_location' => "bottom",
            'theme_advanced_resizing' => 'true',
            // Example content CSS (should be your site CSS)
            'content_css' => $this->Html->url('/css/style.css'),
        );
        $this->configs['advanced'] = array_merge($this->configs['advanced'], array(
            'plugins' => 'pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,imagemanager',
            'theme_advanced_buttons1' => "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            'theme_advanced_buttons4' => "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertimage",
                //'theme_advanced_buttons1' => 'fullscreen,preview,|,undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,ltr,rtl,|,styleselect,formatselect,fontselect,fontsizeselect',
                //'theme_advanced_buttons2' => 'pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,|,forecolor,backcolor,|,tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print',
                ));
        if (is_string($options)) {
            if (isset($this->configs[$options])) {
                $options = $this->configs[$options];
            } else {
                throw new OutOfBoundsException(sprintf(__('Invalid TinyMCE configuration preset %s'), $options));
            }
        }
        $options = array_merge($this->_defaults, $options);
        $lines = '';

        foreach ($options as $option => $value) {
            $lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
        }
        // remove last comma from lines to avoid the editor breaking in Internet Explorer
        $lines = rtrim($lines);
        $lines = rtrim($lines, ',');
        $this->Html->script('/TinyMCE/js/tiny_mce/jquery.tinymce.js', false);
        $this->Html->scriptBlock('$().ready(function() {$("textarea.tinymce").tinymce(' . json_encode($options) . ')});', array('inline' => false));
    }

    /**
     * beforeRender callback
     *
     * @return void
     */
    public function beforeRender() {
        $appOptions = Configure::read('TinyMCE.editorOptions');
        if ($appOptions !== false && is_array($appOptions)) {
            $this->_defaults = $appOptions;
        }
        $this->Html->script('/TinyMCE/js/tiny_mce/tiny_mce.js', array('inline' => false));
    }

}
