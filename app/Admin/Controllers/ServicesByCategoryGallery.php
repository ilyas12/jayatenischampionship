<?php

namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use terre\Admin\Models\GalleriesByCategoryModel;
use terre\Admin\Models\ServicesByCategoryGalleryModel;
use terre\Admin\Models\ServicesByCategoryModel;

class ServicesByCategoryGallery extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $service_id                   = \Input::get('service_id');
        $service                      = ServicesByCategoryModel::find($service_id);
        $this->data['page_title']   = "Gallery of ".$service->title;
        $this->model                = new ServicesByCategoryGalleryModel();
    }

    public function index() {
        $service_id           = Input::get('service_id');
        $this->module_name 	= 'Service by Category Gallery';
        $this->base_url 	= '_admin/services-by-category/gallery?service_id='.$service_id;
        $this->set('manage_order', false);
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

    private function _default() {
        $service_id         = \Input::get('service_id');
        $this->model        = $this->model->where('fkserviceid',$service_id);
        $this->order_by 	= array('id'=>'asc');
        $this->fields = [
            [
                'name'=>'fkgalleryid',
                'title'=>'Gallery',
                'belongs_to'=>array('gallery','title'),
            ],
        ];
    }

    public function _get_gallery() {
        $gallery = GalleriesByCategoryModel::get();
        $return[0]  = '--Select Category--';
        foreach ( $gallery as $cat ) {
            $service_id       = \Input::get('service_id');
            $list_gallery       = ServicesByCategoryGalleryModel::where('fkserviceid',$service_id)->get();
            if ( count($list_gallery) !== 0 ) {
                foreach ( $list_gallery as $list ) {
                    if ( $list->fkgalleryid == $cat->id ) {
                        break;
                    } else {
                        $return[$cat->id]   = $cat->title;
                    }
                }
            } else {
                $return[$cat->id]   = $cat->title;
            }
        }
        return $return;
    }

    private function _add(){
        $service_id       = \Input::get('service_id');
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->fields 	= [
            [  'name'=>'fkgalleryid',
                'label'=>'Gallery',
                'type'=>'select',
                'option'=>$this->_get_gallery(),
                'validation'=>'required'
            ],
            [
                'name'=>'fkserviceid',
                'type'=>'hidden',
                'value'=>$service_id,
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
            [  'name'=>'fkgalleryid',
                'label'=>'Gallery',
                'type'=>'select',
                'option'=>$this->_get_gallery(),
                'validation'=>'required'
            ],
        ];
    }

}