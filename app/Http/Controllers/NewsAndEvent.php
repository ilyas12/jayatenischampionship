<?php namespace terre\Http\Controllers;

use terre\Http\Models\NewsEventsModel;
use terre\Http\Models\ConfigModel;
use terre\Http\Requests;
use DB;

class NewsAndEvent extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "News & Events";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['main_newsandevent']    = NewsEventsModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['newsandevents']        = NewsEventsModel::where('publish', '=', 1)->where('order_id', '<>', 1)->orderBy('order_id','ASC')->get();
        return view('newsandevents', $this->data);
    }

    public function details($id)
    {
        $newsandeventdetails                = NewsEventsModel::where('permalink', '=', $id)->first();
        if ( $newsandeventdetails ) {
            $this->data['newsandevent_detail']  = $newsandeventdetails;
            return view('newsandevent_details', $this->data);
        } else {

        }
    }
    
    public function index_dsv2()
    {
        $this->data['main_newsandevent']    = NewsEventsModel::where('publish', '=', 1)->where('placement','=', 1)->orderBy('order_id','ASC')->first();
        $this->data['top_newsandevents']        = NewsEventsModel::where('publish', '=', 1)->where('placement','=', 2)->take(5)->orderBy('order_id','ASC')->get();
        $this->data['newsandevents']        = NewsEventsModel::where('publish', '=', 1)->where('placement','=', 0)->orderBy('order_id','DESC')->get();
        return view('newsandevents_v2', $this->data);
    }
    
    public function details_dsv2($id)
    {
        $newsandeventdetails                = NewsEventsModel::where('permalink', '=', $id)->first();
        if ( $newsandeventdetails ) {
            $this->data['newsandevent_detail']  = $newsandeventdetails;
            return view('newsandevent_details', $this->data);
        } else {

        }
    }
    
    public function details_underlying()
    {
        $this->data['page_title']                           = "Underlying";
        $configNames = array(
            'underlying_title',
            'underlying_individual_jkt_title',
            'underlying_individual_jkt_files',
            'underlying_individual_sby_title',
            'underlying_individual_sby_files',
            'underlying_corporate_jkt_title',
            'underlying_corporate_jkt_files',
            'underlying_corporate_sby_title',
            'underlying_corporate_sby_files',
            'underlying_img_banner'
        );
        
        $configRows = DB::table('config')
        ->whereIn('name', $configNames)
        ->get();
        
        $config = array();
        
        foreach ($configRows as $row) {
            $config[$row->name] = $row->value;
        }
        
        foreach ($configNames as $name) {
            $dataKey = $name === 'whitelist_ip' ? 'ip_whitelist' : $name;
        
            $this->data[$dataKey] = isset($config[$name])
                ? $config[$name]
                : null;
        }
        $newsandeventdetails	            = (object)array_merge((array)$this->data);

        if ( $newsandeventdetails ) {
            $this->data['underlying_detail']  = $newsandeventdetails;
            return view('underlying', $this->data);
        } else {

        }
    }
}
