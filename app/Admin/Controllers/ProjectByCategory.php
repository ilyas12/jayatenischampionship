<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:51 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use terre\Admin\Models\CategoryModel;
use terre\Admin\Models\ProjectByCategoryModel;
use terre\Admin\Models\ProjectImageByCategoryModel;
use terre\Libraries\Alert;
use terre\Systems\Controllers\Systems;

class ProjectByCategory extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title']           = "Project";
        $this->model                        = new ProjectByCategoryModel;
        $this->data['project_admin_size']   = Systems::get('back','product_admin_size');
        $this->data['project_stage_size']   = Systems::get('back','product_stage_size');
    }

    public function index(){
        $this->module_name                  = 'Project';
        $this->base_url                     = '_admin/projects-by-category';
        $this->set('multiple_delete', false);
        $this->add_button('order_category', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order&type=category"), '<i class="glyphicon glyphicon-th-large"></i> Order By Category', array('class'=>'btn btn-warning'));
        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                return $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                return $this->_add();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                if (\Request::has('type')){
                    \Cache::forget('type');
                    \Cache::add('type',\Request::input('type'), 60);
                }
                $type = \Cache::get('type');
                if ($type == "category"){
                    $this->_order_category();
                }
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                return $this->build();
                break;
        }
    }

    private function _order_category(){
        $this->order_model       = New ProjectByCategoryModel;
        $this->model                = $this->model->orderBy('order_category');
        $this->order_field      = 'order_category';
        $this->order_text_field  = 'name';
        $this->order_image_path  = 'resources/assets/uploads/projects/';
        $this->order_filter      = [
                                      'category_id' => [
                                                          'title' => "Select Category",
                                                          'data'  => $this->_get_parent_category()
                                                       ]
                                   ];
    }

    private function _get_parent_category(){
        $cat_model = New Categorymodel;
        $all = $cat_model->where('order_id','!=','0')->orderBy('name', 'asc')->get();
        $cat[''] = '&laquo; Select Parent category &raquo;';
        foreach($all as $c){
            $cat[$c->id] = $c['name']; 
        }
        return $cat;
    }

    private function _default(){
        $this->order_by   = array('name'=>'asc');
        // $this->add_range_filter('created_at');
        $this->before_delete  = 'beforeDelete';
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/projects/400/'),
                'width'=> 160
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'category_id',
                'title'=>'Category',
                'belongs_to'=>array('category','name'),
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

    public function beforeDelete($data) {
        $projectImages  = ProjectImageByCategoryModel::where('project_id', '=', $data->id)->get();
        $path           = base_path().'/resources/assets/uploads/projects/';
        foreach($projectImages as $projectImage) {
            $img    = $projectImage->img;
            if(file_exists($path.$this->data['project_admin_size'].'/'.$img))
	    	    unlink($path.$this->data['project_admin_size'].'/'.$img);
	        if(file_exists($path.$this->data['project_stage_size'].'/'.$img))
            	unlink($path.$this->data['project_stage_size'].'/'.$img);
            $projectImage->delete();
        }
    }

    public function _get_category() {
        $categories = CategoryModel::get();
        $return[0]  = '--Select Category--';
        foreach ($categories as $cat) {
            $return[$cat->id]   = $cat->name;
        }
        return $return;
    }

    private function _add(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','category_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Project Name field is required','category_id.required' =>'The Category field is required','description.required' => 'The Description field is required',];
            $validator      = Validator::make($input, $rules, $messages);
            $do_save 		= !$validator->fails();
            $error 		 	= $validator->messages();
            if ($do_save) {
                return $this->save();
            } else {
                $message = implode('<br />', $error->all());
                Alert::add($message);
                Redirect::back()->withInput(Input::all());
            }
        }
        $this->data['action']               = "add";
        $this->data['data']                 = ProjectByCategoryModel::find(0);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['category_list']        = CategoryModel::all();
        $order_category = $this->model->orderBy('order_category', 'DESC')->first();
        if ( !empty($order_category) ) {
            $order_category   = $order_category->order_category + 1;
        } else {
            $order_category   = 1;
        }
        $this->data['order_category']       = $order_category;
        return $this->render_view("project.form_category");
    }

    private function _edit(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','category_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Project Name field is required','category_id.required' =>'The Category field is required','description.required' => 'The Description field is required',];
            $validator      = Validator::make($input, $rules, $messages);
            $do_save 		= !$validator->fails();
            $error 		 	= $validator->messages();
            if ($do_save) {
                return $this->save();
            } else {
                $message = implode('<br />', $error->all());
                Alert::add($message);
                Redirect::back()->withInput(Input::all());
            }
        }
        $id = Input::get('id');
        $this->data['action']               = "edit";
        $this->data['data']                 = ProjectByCategoryModel::find($id);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['category_list']        = CategoryModel::all();
        $this->data['order_category']       = $this->data['data']->order_category;
        return $this->render_view("project.form_category");
    }

    private function save(){
        if(Input::get('submit_save')){
            $action  = Input::get('action');
            if($action == 'add'){
                $project = New ProjectByCategoryModel();
            }else{
                $project = ProjectByCategoryModel::find(Input::get('id'));
                $project_img = $project->img;
            }
            $all = Input::all();
            $postAction   = $all['postAction'];
            foreach ($all as $key => $value) {
                if($key != 'submit_save' && $key != 'action' && $key != 'act' && $key !='category' && $key != 'postAction' && $key != '_token'){
                    $save = 1;
                    $project->{$key} = $value;
                }
            }
            if($save){
                if ( $project->img == null ) {
                    $project->img   = $project_img;
                }
                $project->permalink = Str::slug($project->name);
                if($action == 'edit')
                {
                    $slugCount = count(ProjectByCategoryModel::where('id', '!=', $project->id)->whereRaw("permalink REGEXP '^" . $project->permalink . "(-[0-9]*)?$'")->get());
                }
                else
                    $slugCount = count( ProjectByCategoryModel::whereRaw("permalink REGEXP '^".$project->permalink."(-[0-9]*)?$'")->get() );
                if($slugCount > 0)
                    $project->permalink .= "-".($slugCount+1);
                    $project->save();

                if(isset($all['category'])){
                    foreach ($all['category'] as $cat) {
                        $category = array('category_id'=>$cat, 'project_id'=>$project->id);
                        CategoryModel::insert($category);
                    }
                }
                Alert::add(ucfirst($action).' project success!', 'success');
                if($postAction)
                    return Redirect::to('_admin/projects-by-category?act=edit&id='.$project->id);
                return Redirect::to('_admin/projects-by-category');
            }
        }
    }

    public function image($project_id){
        $project = ProjectByCategoryModel::find($project_id);
        if($project->images()->first()){
            return "<img width='100' src='".URL::asset('resources/assets/uploads/projects/'.$this->data['project_admin_size'].'/'.$project->images()->first()->img)."'/>";
        }else{
            return "<img width='100' src='".URL::asset('resources/assets/images/none.png')."'/>";
        }
    }

    public function _save_sorting_data(){
        dd(\Request::method());
    }
}