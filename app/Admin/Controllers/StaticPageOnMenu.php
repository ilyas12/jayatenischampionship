<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\StaticPageOnMenuModel;

class StaticPageOnMenu extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Static Page";
        $this->model                = new StaticPageOnMenuModel;
    }

    public function index() {
        $this->module_name 	= 'Static Page';
        $this->base_url 	= '_admin/static-page-on-menu';
        $this->set('manage_order', true);
        $this->set('delete_file', 'image');

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                $this->_order();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }
    
    private function _order(){
        $this->order_model          = new StaticPageOnMenuModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'image';
        $this->order_image_path		= 'resources/assets/uploads/pages/';
    }

    private function _default(){

        if ( count(StaticPageOnMenuModel::get()) == 3 ) {
            $this->remove_button('add');
        }

        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'name',
                'title'=>'Page',
                'sort'=> TRUE
            ],
            [
                'name'=>'name_alias',
                'title'=>'URL',
                'before_show'=>'_get_url'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
    }

    protected function _get_url($permalink) {
        return config('app.url').'page/'.$permalink;
    }

    private function _add(){
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Page Name',
                'type'=>'text',
                'permalink'=>'name_alias',
                'validation'=>'required',
            ],
            [
                'name'=>'image',
                'label'=>'Image',
                'type'=>'image',
                'validation'=>'required|Max:500',
                'path'=> base_path()."/resources/assets/uploads/pages/",
                'file_notes'=>'<br/>For Best Resolution: 1435 x 429 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'content',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=>'required',
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
                'type'=>'text',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
                'type'=>'textarea',
            ],
            [
                'name'=>'meta_keywords',
                'label'=>'Meta Keywords',
                'type'=>'text',
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=>$order_id,
            ],
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Page Name',
                'type'=>'text',
                'permalink'=>'name_alias',
                'validation'=>'required',
            ],
            [
                'name'=>'image',
                'label'=>'Image',
                'type'=>'image',
                'validation'=>'Max:500',
                'path'=> base_path()."/resources/assets/uploads/pages/",
                'file_notes'=>'<br/>For Best Resolution: 1435 x 429 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'content',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=>'required',
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
                'type'=>'text',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
                'type'=>'textarea',
            ],
            [
                'name'=>'meta_keywords',
                'label'=>'Meta Keywords',
                'type'=>'text',
            ],
        ];
    }

}