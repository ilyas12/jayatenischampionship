<?php namespace terre\Http\Controllers;

use terre\Http\Requests;

class About extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "About";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['about_title']          = $this->data['about_title'];
        $this->data['about_description']    = $this->data['about_description'];
        return view('about', $this->data);;
    }
    
    public function index_dsv2()
    {
        $this->data['about_title']          = $this->data['about_title'];
        $this->data['about_description']    = $this->data['about_description'];
        return view('aboutv2', $this->data);;
    }
}
