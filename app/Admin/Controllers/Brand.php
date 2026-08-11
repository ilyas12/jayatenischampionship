<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\BrandModel;

class Brand extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Brand";
        $this->model                = new BrandModel;
    }

    public function index() {
        $this->module_name 	= 'Brand';
        $this->base_url 	= '_admin/brand';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/home_brand/'));

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
        $this->order_model          = new BrandModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/home_brand/';
    }

    private function _default(){
        $brand          = BrandModel::get();
        $this->order_by     = array('order_id'=>'asc');
        $this->fields       = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/home_brand/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
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
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'required|Max:200',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_brand/",
                'file_notes'=>'For Best Resolution: 250 x 100 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'title',
                'label'=>'Name',
                'type'=>'text',
                'permalink'=>'url',
                'validation'=>'required',
            ],
            [
                'name'=>'custom_url',
                'label'=>'URL',
                'type'=>'text',
                'suffix'=>'Notes : Use <b>http://</b> or <b>https://</b>'
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
                'type'=>'text',
            ],
            [
                'name'=>'meta_keyword',
                'label'=>'Meta Keyword',
                'type'=>'text',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
                'type'=>'textarea',
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
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'Max:200',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_brand/",
                'file_notes'=>'For Best Resolution: 250 x 100 px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ],
            [
                'name'=>'title',
                'label'=>'Name',
                'type'=>'text',
                'permalink'=>'url',
                'validation'=>'required',
            ],
            [
                'name'=>'custom_url',
                'label'=>'URL',
                'type'=>'text',
                'suffix'=>'Notes : Use <b>http://</b> or <b>https://</b>'
            ],
            [
                'name'=>'meta_title',
                'label'=>'Meta Title',
                'type'=>'text',
            ],
            [
                'name'=>'meta_keyword',
                'label'=>'Meta Keyword',
                'type'=>'text',
            ],
            [
                'name'=>'meta_description',
                'label'=>'Meta Description',
                'type'=>'textarea',
            ],
        ];
    }
}