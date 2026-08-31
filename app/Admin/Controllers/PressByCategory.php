<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\CategoryModel;
use terre\Admin\Models\PressByCategoryModel;
use terre\Libraries\Alert;

class PressByCategory extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Press & Awards";
        $this->model                = new PressByCategoryModel;
    }

    public function index() {
        $this->module_name 	= 'Press & Awards by Category';
        $this->base_url 	= '_admin/press-by-category';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/home_press_awards/'));

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
        $this->order_model          = new PressByCategoryModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'title';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/home_press_awards/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'image',
                'title'=>'File',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/home_press_awards/'),
                'width'=> 160
            ],
            [
                'name'=>'title',
                'title'=>'Title',
                'sort'=> TRUE,
                //'search'=> 'text'
            ],
            [
                'name'=>'category_id',
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
        $this->fields 	= [
            [
                'name'=>'title',
                'label'=>'Title'
            ],
            [  'name'=>'category_id',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'image',
                'label'=>'Image ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_press_awards/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ]
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'title',
                'label'=>'Title'
            ],
            [  'name'=>'category_id',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'image',
                'label'=>'Image (1600 x 620 px)',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_press_awards/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ]
        ];
    }

    private function _get_category(){
        $model = new CategoryModel;
        $all = $model->all();
        $data['']       = "Choose";
        foreach($all as $prov){
            $data[$prov->id] = $prov['name']; 
        }
        return $data;
    }
}