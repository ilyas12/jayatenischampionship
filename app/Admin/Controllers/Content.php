<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 8:24 AM
 */
namespace terre\Admin\Controllers;

use terre\Libraries\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use terre\Admin\Models\ConfigModel;
use terre\Libraries\Alert;

class Content extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function header_link() {
        $this->_do_save_edit();
        $this->add_breadcrumb('Banner', URL::route('admin_header_link'));
        $this->data['page_title']   = "Bakeware&Co Link";
        $content                    = ConfigModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/header_link');
    }

    public function seo() {
        $this->_do_save_edit();
        $this->add_breadcrumb('SEO', URL::route('admin_seo'));
        $this->data['page_title']   = "SEO";
        $content                    = ConfigModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content.seo');
    }

    public function banner(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Banner', URL::route('admin_banner'));
        $this->data['page_title']   = "Banner";
        $content                    = ConfigModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/banner');
    }

    public function video() {
        // $this->_do_save_edit();
        if( Request::isMethod('POST') ){
            $input      = Request::all();
            $rules      = ['instagram_message' => 'required|max:200'];
            $messages   = ['instagram_message.required' => 'The Instagram Message field is required','instagram_message.max:100' => 'The Instagram Message Max Input is 100 characters',];
            $validator     = Validator::make($input, $rules, $messages);
            $do_save 		= !$validator->fails();
            $error 		 	= $validator->messages();
            if ($do_save) {
                $this->_do_save_edit();
            } else {
                $message = implode('<br />', $error->all());
                Alert::add($message);
                Redirect::back()->withInput(Input::all());
            }
        }
        $this->add_breadcrumb('Home Video', URL::route('admin_home_video'));
        $this->data['page_title']   = "Home Video";
        $content                    = ConfigModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('content/video');
    }

    public function footer() {
        $this->_do_save_edit();
        $this->add_breadcrumb('Footer', URL::route('admin_banner'));
        $this->data['page_title']   = "Footer";
        $content			        = ConfigModel::all();

        foreach($content as $list){
            $edit_data[$list->name]		= $list->value;
        }
        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();
        return $this->render_view('content/footer');
    }

    private function _do_save_edit(){
        $this->data['error_message']	= "";
        if(isset($_POST['save'])){
            $post				= Input::all();
            $content			= ConfigModel::all();
            foreach($content as $list){
                if(Input::hasfile($list->name)){
                    $file 			= Input::file($list->name);
                    $success 		= $file->move('resources/assets/uploads/content', $file->getClientOriginalName());
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $file->getClientOriginalName();
                    $update->save();
                }else if(isset($post[$list->name])){
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $post[$list->name];
                    $update->save();
                }
            }
            Alert::add('Update data success.', 'success');
            return Redirect::to('author/add')->withInput();
        }
    }
}