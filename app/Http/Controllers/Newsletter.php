<?php namespace terre\Http\Controllers;


use terre\Libraries\Input;
use Illuminate\Support\Facades\Validator;
use terre\Http\Models\NewsletterModel;

class Newsletter extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Home";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $json['class']		= "error";
        $data['email']		= Input::get('email');
        $rules		= array(
            'email'=>'required|email|unique:newsletter,email',
        );
        $validation	= Validator::make($data, $rules);

        if($validation->fails()){
            $json['message']		= $validation->messages();
        }else{
            $newsletterdt           = new NewsletterModel;
            $newsletterdt->email    = $data['email'];
            $newsletterdt->save();
            $json['class']			= "success";
            $json['message']		= "Thank You we will reply you soon!";
        }
        echo json_encode($json);
    }
}
