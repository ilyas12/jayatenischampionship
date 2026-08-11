<?php namespace terre\Http\Controllers;

use terre\Http\Models\PageModel;
use terre\Http\Models\StaticPageModel;
use terre\Http\Requests;

class Page extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Products";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index($id)
    {
        $page                                           = PageModel::where('name_alias', '=', $id)->first();
        if ( $page ) {
            $this->data['page_details']                 = $page;
            return view('page_details', $this->data);
        } else {
            return redirect('home');
        }
    }

        public function currency()
    {
        $pages                                           = StaticPageModel::where('name_alias', '=', "currency")->first();
        if ( $pages ) {
                $this->data['page_name'] = "currency";
                $this->data['page_details'] = $pages;

                return view('page_details', $this->data);
        } else {
            return redirect('home');
        }
    }

}
