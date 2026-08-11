<?php namespace terre\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use terre\Http\Models\ContactMessageModel;
use terre\Http\Requests;

class Contact extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Customer Service";
        $this->data['title']	 			= "Customer Service";
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['contact_image']          = $this->data['contact_image'];
        $this->data['contact_single_address']    = $this->data['contact_single_address'];

        return view('contact', $this->data);;
    }
    
    public function index_dsv2()
    {
        $this->data['contact_image']          = $this->data['contact_image'];
        $this->data['contact_single_address']    = $this->data['contact_single_address'];

        return view('contactv2', $this->data);;
    }

    public function message()
    {
        $json['class']		= "error";
        $data['name']		= Input::get('name');
        $data['email']		= Input::get('email');
        $data['branch']       = Input::get('branch');
        $data['problem']      = Input::get('problem');
        $data['voucher_number']      = Input::get('voucher_number');
        $data['subject']    = Input::get('subject');
        $data['message']    = Input::get('message');
        $rules		= array(
            'email'=>'required',
            'name'=>'required',
            'branch'=>'required',
            'problem'=>'required',
            'voucher_number'=>'required',
            'subject'=>'required',
            'message'=>'required',
        );
        $validation	= Validator::make($data, $rules);

        if($validation->fails()){
            $json['message']		= $validation->messages();
        }else{
            $contactmessagedt           = new ContactMessageModel;
            $contactmessagedt->name     = $data['name'];
            $contactmessagedt->email    = $data['email'];
            $contactmessagedt->subject  = $data['branch']." - ".$data['problem']." - ".$data['voucher_number']." - ".$data['subject'];
            $contactmessagedt->message  = $data['message'];
            $contactmessagedt->branch     = $data['branch'];
            $contactmessagedt->problem    = $data['problem'];
            $contactmessagedt->voucher_number    = $data['voucher_number'];
            $contactmessagedt->save();
            $json['class']			= "success";
            $json['message']		= "Thank You we will reply you soon!";

            // E-MAIL
            $data = array('name' => $contactmessagedt->name,'branch'=>$data['branch'],'problem'=>$data['problem'],'voucher_number'=>$data['voucher_number'], 'email' => $contactmessagedt->email, 'subject' => $contactmessagedt->subject,  'msg' => $contactmessagedt->message);
            Mail::send('templates.emails.contact_message', $data, function( $message ) use ($data)
            {
                $email      = Input::get('email');
                $to = explode(',', $this->data['no_reply_email']);
                $message->from($this->data['no_reply_email'], 'Dua Sisi Money Changer')->to($to)->subject( 'Contact Message From : '.$email );
            });

            $data_user = array('name' => $contactmessagedt->name,'branch'=>$data['branch'],'problem'=>$data['problem'],'voucher_number'=>$data['voucher_number'], 'email' => $contactmessagedt->email, 'subject' => $contactmessagedt->subject,  'msg' => $contactmessagedt->message);
            Mail::send('templates.emails.contact_message', $data_user, function( $message ) use ($data_user)
            {
                $message->from($this->data['no_reply_email'], 'Dua Sisi Money Changer')->to($data_user['email'])->subject( 'Contact Message' );
            });
        }
        echo json_encode($json);
    }

}
