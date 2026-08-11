<?php namespace terre\Http\Controllers;

use terre\Http\Models\StaticPageModel;
use terre\Http\Requests;

class Pages extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Products";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index($id)
    {
        $pages                                           = StaticPageModel::where('name_alias', '=', $id)->first();
        if ( $pages ) {
            if ( $pages->fgfooter == 0 ) {
                $this->data['page_details'] = $pages;
                return view('page_details', $this->data);
            } else {
                $this->data['pages_name'] = $id;
                $this->data['pages'] = StaticPageModel::where('publish', '=', 1)->where('fgfooter', '<>', 0)->orderBy('order_id', 'ASC')->get();
                $this->data['pages_details'] = $pages;
                return view('pages_details', $this->data);
            }
        } else {
            return redirect('home');
        }
    }

}
