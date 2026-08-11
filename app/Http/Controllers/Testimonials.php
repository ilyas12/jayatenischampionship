<?php namespace terre\Http\Controllers;

use terre\Http\Models\TestimonialsModel;
use terre\Http\Requests;

class Testimonials extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Testimonials";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['main_testimonial']      = TestimonialsModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();

        $limit = 6;
        $testimonial                         = TestimonialsModel::where('publish', '=', 1)->where('order_id', '<>', 1)->orderBy('order_id','ASC')->paginate($limit);

        $this->data['loadMore']             = $testimonial->currentPage() == $testimonial->lastPage() ? false : true;
        $this->data['limit']                = $limit;
        $this->data['total_testimonial']    = count($testimonial);
        $this->data['testimonials']         = $testimonial; 

        return view('testimonials', $this->data);;
    }
}
