<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\BannerModel;

class Banner extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Banner";
        $this->model                = new BannerModel;
    }

    public function index() {
        $this->module_name 	= 'Banner';
        $this->base_url 	= '_admin/banner';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/home_banner/'));

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
        $this->order_model          = new BannerModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/home_banner/';
    }

    private function _default(){
        $banner          = BannerModel::get();
        if ( count($banner) == 4  ) {
            $this->remove_button('add');
        }
        $this->order_by     = array('order_id'=>'ASC');
        $this->fields       = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/home_banner/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Title',
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
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [
                'name'=>'subtitle',
                'label'=>'SubTitle',
                'type'=>'text',
            ],
//            [
//                'name'=>'button',
//                'label'=>'Button',
//                'type'=>'text',
//            ],
            [
                'name'=>'url',
                'label'=>'URL',
                'type'=>'text',
                'suffix'=>'Notes : Use http:// or https://'
            ],
            [
                'name'=>'img',
                'label'=>'Image',
                'validation'=>'required|max:200',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_banner/",
                'file_notes'=>'For Best Resolution: 400 x 283 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200 Kb'
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
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [
                'name'=>'subtitle',
                'label'=>'SubTitle',
                'type'=>'text',
            ],
//            [
//                'name'=>'button',
//                'label'=>'Button',
//                'type'=>'text',
//            ],
            [
                'name'=>'url',
                'label'=>'URL',
                'type'=>'text',
                'suffix'=>'Notes : Use <b>http://</b> or <b>https://</b>'
            ],
            [
                'name'=>'img',
                'label'=>'Image',
                'validation'=>'max:200',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_banner/",
                'file_notes'=>'For Best Resolution: 400 x 283 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200 Kb'
            ],
        ];
    }
}