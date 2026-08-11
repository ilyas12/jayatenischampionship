<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\ServicesModel;

class Services extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Services";
        $this->model                = new ServicesModel;
        $this->file_path            = base_path().'/resources/assets/uploads/services/';
    }

    public function index() {
        $this->module_name 	= 'Services';
        $this->base_url 	= '_admin/services';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/services/'));

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
        $this->order_model          = new ServicesModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/services/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Thumbnail',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/services/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Title',
                'sort'=> TRUE
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
                'label'=>'Thumbnail',
                'validation'=>'required',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/services/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
                'validation'=>'required',
                'permalink'=>'permalink',
            ],
            [
                'name'=>'subtitle',
                'label'=>'Sub Title',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Description',
                'type'=>'tinymce',
                'validation'=> 'required'
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
                'label'=>'Thumbnail',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/services/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
                'validation'=>'required',
                'permalink'=>'permalink',
            ],
            [
                'name'=>'subtitle',
                'label'=>'Sub Title',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Description',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
        ];
    }

}