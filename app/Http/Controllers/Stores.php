<?php namespace terre\Http\Controllers;

use terre\Http\Models\StoresModel;
use terre\Http\Requests;

class Stores extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Stores";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['main_store']           = StoresModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['stores']               = StoresModel::where('publish', '=', 1)->where('order_id', '<>', 1)->orderBy('order_id','ASC')->get();
        return view('stores', $this->data);;
    }
    
    public function index_dsv2()
    {
        $this->data['main_store']           = StoresModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['stores_jakarta']               = StoresModel::where('publish', '=', 1)->where('region', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['stores_surabaya']               = StoresModel::where('publish', '=', 1)->where('region', '=', 2)->orderBy('order_id','ASC')->get();
        return view('storesv2', $this->data);;
    }
}
