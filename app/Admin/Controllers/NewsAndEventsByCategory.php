<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 9:06 AM
 */
namespace terre\Admin\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use terre\Admin\Models\AdministratorModel;
use terre\Admin\Models\CategoryModel;
use terre\Admin\Models\NewsEventsByCategoryModel;

class NewsAndEventsByCategory extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "News & Events";
        $this->model                = new NewsEventsByCategoryModel;
    }

    public function index() {
        $this->module_name  = 'News & Events';
        $this->base_url     = '_admin/news-and-event-by-category';
        $this->set('manage_order', true);

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            // case "order":
            //     $this->data['sub_title'] = "Order ".$this->module_name;
            //     $this->_order();
            //     break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->order_by     = array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'type',
                'title'=>'Type',
                'sort'=> TRUE,
                'type'=>'custom',
                'before_show'=>'_get_type',
            ],
            [
                'name'=>'title',
                'title'=>'Title',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
			[
                'name'=>'author',
                'title'=>'Author',
                'sort'=> TRUE,
            ],
            [
                'name'=>'events_date',
                'title'=>'Date',
                'sort'=> TRUE,
                'type'=>'custom',
                'before_show'=>'_get_date',
                'width'=>200
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    private function _order(){
        $this->order_model          = new NewsEventsByCategoryModel;
        $this->order_field          = 'order_id';
        $this->order_type_image     = false;
        $this->order_text_field     = 'title';
    }

    protected  function _get_type($data) {
        if ( $data->type == 1 ) {
            $type = 'Events';
        } else {
            $type = 'News';
        }
        return $type;
    }

    protected  function _get_date($data) {

        $date_format    = 'd M Y';
        $is_period  = $data->period_time;

        if($is_period) {
            if ( $data->type == 2 ) {
                return $data->events_date->format($date_format);
            } else {
                return $data->start_date->format($date_format).' - '.$data->end_date->format($date_format);
            }
        } else {
            return $data->events_date->format($date_format);
        }
    }

    private function _add(){
        //dd(Request::all());
        $author = AdministratorModel::find(Auth::user()->id);
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->fields   = [
            [
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/news_and_events/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ],
			[  'name'=>'category_id',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'type',
                'label'=>'Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('3'=>'Choose', '2'=>'News', '1'=>'Events'),
                'toggle'=> array('0'=>'oneday', '1'=>'period_time', '2'=>'news') 
            ],
            [
                'name'=>'period_time',
                'label'=>'Event Date Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('2'=>'Choose','0'=>'Whole Day', '1'=>'Period Time'),
                'toggle'=> array('0'=>'oneday', '1'=>'period'),
                'group' =>'period_time'
            ],
            [
                'name'=>'events_date',
                'label'=>'Date',
                'type'=>'datepicker',
                'group'=>'oneday',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'start_date',
                'label'=>'Start Date',
                'type'=>'datepicker',
                'group'=>'period',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'end_date',
                'label'=>'End Date',
                'type'=>'datepicker',
                'group'=>'period',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'short_description',
                'label'=>'Short Description',
                'type'=>'tinymce',
                'group'=>'news'
            ],
			[
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
            [
                'name'=>'author',
                'type'=>'hidden',
                'value'=>$author->name,
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=>$order_id,
            ],
        ];
    }


    private function _edit(){
        $this->fields   = [
            [
                'name'=>'img',
                'label'=>'Image',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/news_and_events/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'validation'=> 'required',
                'permalink'=>'permalink'
            ],
            [  'name'=>'category_id',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'type',
                'label'=>'Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('3'=>'Choose', '2'=>'News', '1'=>'Events'),
                'toggle'=> array('0'=>'oneday', '1'=>'period_time', '2'=>'news')
            ],
            [
                'name'=>'period_time',
                'label'=>'Event Date Type',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array('2'=>'Choose','0'=>'Whole Day', '1'=>'Period Time'),
                'toggle'=> array('0'=>'oneday', '1'=>'period'),
                'group' =>'period_time'
            ],
            [
                'name'=>'events_date',
                'label'=>'Date',
                'type'=>'datepicker',
                'group'=>'oneday',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'start_date',
                'label'=>'Start Date',
                'type'=>'datepicker',
                'group'=>'period',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'end_date',
                'label'=>'End Date',
                'type'=>'datepicker',
                'group'=>'period',
                'value'=>date('Y-m-d')
            ],
            [
                'name'=>'short_description',
                'label'=>'Short Description',
                'type'=>'tinymce',
                'group'=>'news'
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
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