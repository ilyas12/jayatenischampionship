<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use terre\Admin\Models\DownloadByCategoryModel;
use terre\Admin\Models\CategoryModel;

class DownloadByCategory extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Download";
        $this->model                = new DownloadByCategoryModel;
        $this->file_path            = base_path().'/resources/assets/uploads/download/';
    }

    public function index() {
        $this->module_name 	= 'Download';
        $this->base_url 	= '_admin/download-by-category';
        $this->set('manage_order', true);
        $this->set('delete_file', 'file');
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/download/'));

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            case "download":
                $this->data['sub_title'] = "Download ".$this->module_name;
                $this->_download();
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

    private function _download(){
        $id = Input::get('id');
        $document = DownloadByCategoryModel::where('id', $id)->first();
        if (file_exists($this->file_path.'/'.$document->file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($this->file_path.'/'.$document->file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($this->file_path.'/'.$document->file));
            readfile($this->file_path.'/'.$document->file);
            exit;
        }
    }

    private function _order(){
        $this->order_model          = new DownloadByCategoryModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/download/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->add_action_button('Download', URL::to('_admin/download-by-category?'."act=download&id="."{".$this->table_id."}"), '<i class="fa fa-download"></i>', array('class'=>'btn btn-xs btn-success'));
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Thumbnail',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/download/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Title',
                'sort'=> TRUE
            ],
            [
                'name'=>'fkcategoryid',
                'title'=>'Category',
                'sort'=> TRUE,
                'belongs_to'=> array('category', 'name'),       //--array('function di model', '1 field tabel / *', 'callback')
                'search'=> $this->_get_category()
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
                'label'=>'Thumbnail ',
                'validation'=>'required',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/download/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'file',
                'label'=>'File',
                'validation'=>'required',
                'type'=>'file',
                'thumbnail'=>false,
                'path'=> base_path()."/resources/assets/uploads/download/",
                'file_notes'=>'File type:.jpg | .jpeg | .png | .pdf<br>Max size: 2Mb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [  'name'=>'fkcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
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
                'label'=>'Thumbnail ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/download/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [  'name'=>'fkcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
        ];
    }

    private function _get_category(){
        $model = New CategoryModel;
        $all = $model->all();
        $data['']       = "Choose";
        foreach($all as $prov){
            $data[$prov->id] = $prov['name']; 
        }
        return $data;
    }

}