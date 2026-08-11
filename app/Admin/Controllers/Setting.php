<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:39 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use terre\Admin\Models\ConfigModel;
use terre\Libraries\Input;
use terre\Libraries\Alert;
use DB;

class Setting extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Email', URL::route('admin_setting'));
        $this->data['page_title']   = "Setting";
        $content                    = ConfigModel::where('name', '=','no_reply_email')->first();

        $edit_data[$content->name]  = $content->value;

        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('setting/email');
    }

    public function about(){
        $this->_do_save_edit();
        $this->add_breadcrumb('About', URL::route('admin_about'));
        $this->data['page_title']   = "About";
        $about_image                        = ConfigModel::where('name', '=','about_image')->first();
        $about_title                        = ConfigModel::where('name', '=','about_title')->first();
        $about_description                  = ConfigModel::where('name', '=','about_description')->first();
        $this->data['about_image']          = $about_image->value;
        $this->data['about_title']          = $about_title->value;
        $this->data['about_description']    = $about_description->value;
        $this->data['edit_data']	        = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();
        return $this->render_view('setting/about');
    }

    public function uploadlogo(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Upload Logo', URL::route('admin_upload_logo'));
        $this->data['page_title']           = "Setting";
        $website_logo                       = ConfigModel::where('name', '=','website_logo')->first();
        $dashboad_logo                      = ConfigModel::where('name', '=','admin_logo')->first();
        $login_admin_logo                   = ConfigModel::where('name', '=','login_admin_logo')->first();
        $favicon_logo                       = ConfigModel::where('name', '=','website_favicon')->first();
        $this->data['website_logo']         = $website_logo->value;
        $this->data['dashboad_logo']        = $dashboad_logo->value;
        $this->data['login_admin_logo']     = $login_admin_logo->value;
        $this->data['favicon_logo']         = $favicon_logo->value;
        $this->data['edit_data']	        = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']           = $this->get_breadcrumb();

        return $this->render_view('setting/uploadlogo',$this->data);
    }

    public function ga(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Google Analytics', URL::route('admin_ga'));
        $this->data['page_title']   = "Setting";
        $content                    = ConfigModel::where('name', '=','ga_code')->first();

        $edit_data[$content->name]  = $content->value;

        $this->data['edit_data']	= (object)array_merge((array)$edit_data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('setting/ga');
    }

    public function seo(){
        $this->_do_save_edit();
        $this->add_breadcrumb('SEO', URL::route('admin_seo'));
        $this->data['page_title']           = "Setting";
        $meta_title                         = ConfigModel::where('name', '=','meta_title')->first();
        $meta_description                   = ConfigModel::where('name', '=','meta_description')->first();
        $meta_keywords                      = ConfigModel::where('name', '=','meta_keywords')->first();
        $this->data['meta_title']           = $meta_title->value;
        $this->data['meta_description']     = $meta_description->value;
        $this->data['meta_keywords']        = $meta_keywords->value;
        $this->data['edit_data']	        = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']           = $this->get_breadcrumb();

        return $this->render_view('setting/seo');
    }

    public function others(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Others', URL::route('admin_others'));
        $this->data['page_title']                           = "Setting";
        
        // $popup_image                                        = ConfigModel::where('name', '=','popup_image')->first();
        // $popup_email_newsletter                             = ConfigModel::where('name', '=','popup_email_newsletter')->first();
        // $google_analytics                                   = ConfigModel::where('name', '=','ga_code')->first();
        // $error404_title                                     = ConfigModel::where('name', '=','error404_title')->first();
        // $error404_title_colour                              = ConfigModel::where('name', '=','error404_title_colour')->first();
        // $error404_subtitle                                  = ConfigModel::where('name', '=','error404_subtitle')->first();
        // $error404_subtitle_colour                           = ConfigModel::where('name', '=','error404_subtitle_colour')->first();
        // $error404_message                                   = ConfigModel::where('name', '=','error404_message')->first();
        // $error404_message_colour                            = ConfigModel::where('name', '=','error404_message_colour')->first();
        // $error404_button_text                               = ConfigModel::where('name', '=','error404_button_text')->first();
        // $error404_button_text_colour                        = ConfigModel::where('name', '=','error404_button_text_colour')->first();
        // $error404_button_background_colour                  = ConfigModel::where('name', '=','error404_button_background_colour')->first();
        // $error404_background_image                          = ConfigModel::where('name', '=','error404_background_image')->first();
        // $maintenance_mode                                   = ConfigModel::where('name', '=','maintenance_mode')->first();
        // $mt_logo                                            = ConfigModel::where('name', '=','mt_logo')->first();
        // $mt_text_1                                          = ConfigModel::where('name', '=','mt_text_1')->first();
        // $mt_text_2                                          = ConfigModel::where('name', '=','mt_text_2')->first();
        // $mt_text_3                                          = ConfigModel::where('name', '=','mt_text_3')->first();
        // $mt_contact_1_icon                                  = ConfigModel::where('name', '=','mt_contact_1_icon')->first();
        // $mt_contact_1                                       = ConfigModel::where('name', '=','mt_contact_1')->first();
        // $mt_contact_2_icon                                  = ConfigModel::where('name', '=','mt_contact_2_icon')->first();
        // $mt_contact_2                                       = ConfigModel::where('name', '=','mt_contact_2')->first();
        // $mt_contact_3_icon                                  = ConfigModel::where('name', '=','mt_contact_3_icon')->first();
        // $mt_contact_3                                       = ConfigModel::where('name', '=','mt_contact_3')->first();
        // $mt_contact_4_icon                                  = ConfigModel::where('name', '=','mt_contact_4_icon')->first();
        // $mt_contact_4                                       = ConfigModel::where('name', '=','mt_contact_4')->first();
        // $ip_whitelist                                       = ConfigModel::where('name', '=','whitelist_ip')->first();
        // $marker                                             = ConfigModel::where('name', '=','marker')->first();
        // $this->data['popup_image']                          = $popup_image->value;
        // $this->data['popup_email_newsletter']               = $popup_email_newsletter->value;
        // $this->data['ga_code']                              = $google_analytics->value;
        // $this->data['error404_title']                       = $error404_title->value;
        // $this->data['error404_title_colour']                = $error404_title_colour->value;
        // $this->data['error404_subtitle']                    = $error404_subtitle->value;
        // $this->data['error404_subtitle_colour']             = $error404_subtitle_colour->value;
        // $this->data['error404_message']                     = $error404_message->value;
        // $this->data['error404_message_colour']              = $error404_message_colour->value;
        // $this->data['error404_button_text']                 = $error404_button_text->value;
        // $this->data['error404_button_text_colour']          = $error404_button_text_colour->value;
        // $this->data['error404_button_background_colour']    = $error404_button_background_colour->value;
        // $this->data['error404_background_image']            = $error404_background_image->value;
        // $this->data['maintenance_mode']                     = $maintenance_mode->value;
        // $this->data['mt_logo']                              = $mt_logo->value;
        // $this->data['mt_text_1']                            = $mt_text_1->value;
        // $this->data['mt_text_2']                            = $mt_text_2->value;
        // $this->data['mt_text_3']                            = $mt_text_3->value;
        
        // $this->data['mt_contact_1_icon']                    = $mt_contact_1_icon->value;
        // $this->data['mt_contact_1']                         = $mt_contact_1->value;
        // $this->data['mt_contact_2_icon']                    = $mt_contact_2_icon->value;
        // $this->data['mt_contact_2']                         = $mt_contact_2->value;
        // $this->data['mt_contact_3_icon']                    = $mt_contact_3_icon->value;
        // $this->data['mt_contact_3']                         = $mt_contact_3->value;
        // $this->data['mt_contact_4_icon']                    = $mt_contact_4_icon->value;
        // $this->data['mt_contact_4']                         = $mt_contact_4->value;
        // $this->data['ip_whitelist']                         = $ip_whitelist->value;
        
        // $this->data['underlying_title']                     = $underlying_title->value;
        // $this->data['underlying_individual_jkt_title']      = $underlying_individual_jkt_title->value;
        // $this->data['underlying_individual_jkt_files']      = $underlying_individual_jkt_files->value;
        // $this->data['underlying_individual_sby_title']      = $underlying_individual_sby_title->value;
        // $this->data['underlying_individual_sby_files']      = $underlying_individual_sby_files->value;
        // $this->data['underlying_corporate_jkt_title']       = $underlying_corporate_jkt_title->value;
        // $this->data['underlying_corporate_jkt_files']       = $underlying_corporate_jkt_files->value;
        // $this->data['underlying_corporate_sby_title']       = $underlying_corporate_sby_title->value;
        // $this->data['underlying_corporate_sby_files']       = $underlying_corporate_sby_files->value;
        // $this->data['marker']                               = $marker->value;
        $configNames = array(
            'popup_image',
            'popup_email_newsletter',
            'ga_code',
        
            'error404_title',
            'error404_title_colour',
            'error404_subtitle',
            'error404_subtitle_colour',
            'error404_message',
            'error404_message_colour',
            'error404_button_text',
            'error404_button_text_colour',
            'error404_button_background_colour',
            'error404_background_image',
        
            'maintenance_mode',
        
            'mt_logo',
            'mt_text_1',
            'mt_text_2',
            'mt_text_3',
        
            'mt_contact_1_icon',
            'mt_contact_1',
            'mt_contact_2_icon',
            'mt_contact_2',
            'mt_contact_3_icon',
            'mt_contact_3',
            'mt_contact_4_icon',
            'mt_contact_4',
        
            'whitelist_ip',
            'marker',
        
            'underlying_title',
            'underlying_individual_jkt_title',
            'underlying_individual_jkt_files',
            'underlying_individual_sby_title',
            'underlying_individual_sby_files',
            'underlying_corporate_jkt_title',
            'underlying_corporate_jkt_files',
            'underlying_corporate_sby_title',
            'underlying_corporate_sby_files',
        );
        
        /*
        |--------------------------------------------------------------------------
        | Execute only one database query
        |--------------------------------------------------------------------------
        */
        
        $configRows = DB::table('config')
        ->whereIn('name', $configNames)
        ->get();
        
        $config = array();
        
        foreach ($configRows as $row) {
            $config[$row->name] = $row->value;
        }
        
        /*
        |--------------------------------------------------------------------------
        | Assign configuration values to view data
        |--------------------------------------------------------------------------
        */
        
        foreach ($configNames as $name) {
            // Handle aliases where the database name and view variable differ.
            $dataKey = $name === 'whitelist_ip' ? 'ip_whitelist' : $name;
        
            $this->data[$dataKey] = isset($config[$name])
                ? $config[$name]
                : null;
        }
        $this->data['edit_data']	            = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']               = $this->get_breadcrumb();

        return $this->render_view('setting/others');
    }

    public function instagramfeed(){
        if( Request::isMethod('POST') ){
            $input      = Request::all();
            $rules      = ['instagram_userid' => 'required','instagram_message' => 'required|'];
            $messages   = ['instagram_userid.required' => 'The Instagram User ID field is required','instagram_message.required' => 'The Instagram Message field is required','instagram_message.max:200' => 'The Instagram Message Max Input is 200 characters',];
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

        $this->add_breadcrumb('Instagram Feed', URL::route('admin_instagram_feed'));
        $this->data['page_title']   = "Setting";
        $instagram_userid                                   = ConfigModel::where('name', '=','instagram_userid')->first();
        $instagram_hastag                                   = ConfigModel::where('name', '=','instagram_hastag')->first();
        $instagram_message                                  = ConfigModel::where('name', '=','instagram_message')->first();
        $instagram_feed                                     = ConfigModel::where('name', '=','instagram_feed')->first();
        $this->data['instagram_userid']                     = $instagram_userid->value;
        $this->data['instagram_hastag']                     = $instagram_hastag->value;
        $this->data['instagram_message']                    = $instagram_message->value;
        $this->data['instagram_feed']                       = $instagram_feed->value;
        $this->data['edit_data']	            = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();

        return $this->render_view('setting/instagram_feed');
    }

    public function address(){
        $this->_do_save_edit();
        $this->add_breadcrumb('Contact Address', URL::route('admin_contact_single_address'));
        $this->data['page_title']   = "Contact Address";
        $contact_single_address                             = ConfigModel::where('name', '=','contact_single_address')->first();
        $contact_contacts                                   = ConfigModel::where('name', '=','contact_contacts')->first();
        $footer_contact_us                                  = ConfigModel::where('name', '=','footer_contact_us')->first();
        $contact_image                                      = ConfigModel::where('name', '=','contact_image')->first();
        $contact_latitude                                   = ConfigModel::where('name', '=','contact_latitude')->first();
        $contact_longitude                                  = ConfigModel::where('name', '=','contact_longitude')->first();
        $this->data['contact_single_address']               = $contact_single_address->value;
        $this->data['contact_contacts']                     = $contact_contacts->value;
        $this->data['footer_contact_us']                    = $footer_contact_us->value;
        $this->data['contact_image']                        = $contact_image->value;
        $this->data['contact_latitude']                     = $contact_latitude->value;
        $this->data['contact_longitude']                    = $contact_longitude->value;
        $this->data['edit_data']	                        = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']   = $this->get_breadcrumb();
        return $this->render_view('setting/contact_single_address');
    }

    public function download(){
        $this->_do_save_download();
        $this->add_breadcrumb('Download Catalog', URL::route('admin_download'));
        $this->data['page_title']           = "Download Catalog";
        $download                           = ConfigModel::where('name', '=','download')->first();
        $download_thumbnail                 = ConfigModel::where('name', '=','download_thumbnail')->first();
        $this->data['download']             = $download->value;
        $this->data['download_thumbnail']   = $download_thumbnail->value;
        $this->data['edit_data']	        = (object)array_merge((array)$this->data, $_POST);
        $this->data['breadcrumb']           = $this->get_breadcrumb();

        return $this->render_view('setting/download',$this->data);
    }

    private function _do_save_download(){
        $this->data['error_message']	= "";
        if(isset($_POST['save'])){
            $post				= Input::all();
            $content			= ConfigModel::all();
            foreach($content as $list){
                if(Input::hasfile($list->name)){
                    File::delete('resources/assets/uploads/download/'.$list->value);
                    $file           = Input::file($list->name);
                    $filename       = \Illuminate\Support\Str::random(5).'_'.$file->getClientOriginalName();
                    $file->move('resources/assets/uploads/download/', $filename);
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $filename;
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

    private function _do_save_edit(){
        $this->data['error_message']	= "";
        if(isset($_POST['save'])){
            $post				= Input::all();
            $content			= ConfigModel::all();
            foreach($content as $list){
                if(Input::hasfile($list->name)){
                    File::delete('resources/assets/images/'.$list->value);
                    $file           = Input::file($list->name);
                    $filename       = \Illuminate\Support\Str::random(5).'_'.$file->getClientOriginalName();
                    $file->move('resources/assets/images/', $filename);
                    $update			= ConfigModel::find($list->id);
                    $update->value	= $filename;
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