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
use terre\Admin\Models\TeamModel;
use terre\Admin\Models\TeamImageModel;
use terre\Libraries\Alert;
use terre\Systems\Controllers\Systems;

class Team extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title']           = "Team";
        $this->model                        = new TeamModel;
        $this->data['team_admin_size']      = Systems::get('back','product_admin_size');
        $this->data['team_stage_size']      = Systems::get('back','product_stage_size');
    }

    public function index(){
        $this->module_name                  = 'Team';
        $this->base_url                     = '_admin/team';
        $this->set('manage_order', true);
        $this->set('multiple_delete', false);
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
                $this->_order();
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                return $this->build();
                break;
        }
    }

    private function _order(){
        $this->order_model          = new TeamModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= FALSE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= '';
        $this->order_image_path		= '';
    }

    private function _default(){
        $this->order_by   = array('name'=>'asc');
        $this->before_delete  = 'beforeDelete';
        $this->fields = [
            [
                'name'=>'id',
                'title'=>'Image',
                'width'=> 110,
                'before_show'=>'image'
            ],
            [
                'name'=>'name',
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

    public function beforeDelete($data) {
        $teamImages     = TeamImageModel::where('team_id', '=', $data->id)->get();
        $path           = base_path().'/resources/assets/uploads/team/';
        foreach($teamImages as $teamImage) {
            $img    = $teamImage->img;
            if(file_exists($path.$this->data['team_admin_size'].'/'.$img))
	    	unlink($path.$this->data['team_admin_size'].'/'.$img);
	    if(file_exists($path.$this->data['team_stage_size'].'/'.$img))       
            	unlink($path.$this->data['team_stage_size'].'/'.$img);

            $teamImage->delete();
        }
    }

    private function _add(){
        if(Input::get('submit_save')){
            $input          = Request::all();
            $rules          = ['name' => 'required','position' => 'required','description' => 'required'];
            $messages       = ['name.required' => 'The Team Name field is required','position.required' => 'The Position field is required','description.required' => 'The Description field is required',];
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
        $this->data['action']           = "add";
        $this->data['data']             = TeamModel::find(0);
        $this->data['loadmce']          = true;
        $this->data['loadjqueryui']     = true;
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->data['order_id']         = $order_id;
        return $this->render_view("team.form");
    }

    private function _edit(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Team Name field is required','description.required' => 'The Description field is required',];
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
        $this->data['action']          = "edit";
        $this->data['data']            = TeamModel::find($id);
        $this->data['loadmce']         = true;
        $this->data['loadjqueryui']    = true;
        $this->data['order_id']         = $this->data['data']->order_id;
        return $this->render_view("team.form");
    }

    private function save(){
        if(Input::get('submit_save')){
            $action  = Input::get('action');

            if($action == 'add'){
                $team = New TeamModel();
            }else{
                $team = TeamModel::find(Input::get('id'));
            }
            $all = Input::all();

            $postAction   = $all['postAction'];

            foreach ($all as $key => $value) {
                if($key != 'submit_save' && $key != 'action' && $key != 'act' && $key != 'postAction' && $key != '_token'){
                    $save = 1;
                    $team->{$key} = $value;
                }
            }

            if($save){
                $team->permalink = Str::slug($team->name);
                if($action == 'edit')
                {
                    $slugCount = count(TeamModel::where('id', '!=', $team->id)->whereRaw("permalink REGEXP '^" . $team->permalink . "(-[0-9]*)?$'")->get());
                }
                else
                    $slugCount = count( TeamModel::whereRaw("permalink REGEXP '^".$team->permalink."(-[0-9]*)?$'")->get() );


                if($slugCount > 0)
                    $team->permalink .= "-".($slugCount+1);

                $team->save();

                Alert::add(ucfirst($action).' team success!', 'success');

                if($postAction)
                    return Redirect::to('_admin/team?act=edit&id='.$team->id);
                return Redirect::to('_admin/team');
            }
        }
    }

    public function image($team_id){
        $team = TeamModel::find($team_id);
        if($team->images()->first()){
            return "<img width='100' src='".URL::asset('resources/assets/uploads/team/'.$this->data['team_admin_size'].'/'.$team->images()->first()->img)."'/>";
        }else{
            return "<img width='100' src='".URL::asset('resources/assets/images/none.png')."'/>";
        }
    }


    public function _save_sorting_data(){
        dd('a');
    }
}