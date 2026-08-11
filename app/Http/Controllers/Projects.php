<?php namespace terre\Http\Controllers;


use Illuminate\Support\Facades\DB;
use terre\Http\Models\CategoryModel;
use terre\Http\Models\ProjectImageModel;
use terre\Http\Models\ProjectsModel;
use terre\Http\Requests;

class Projects extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Projects";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $this->data['categories']           = DB::table('project_category')
                                              ->join('category', 'project_category.category_id', '=', 'category.id')
                                              ->select('category.id','category.name', 'category.permalink')
                                              ->where('category.publish',1)
                                              ->groupBy('category_id')
                                              ->get();
        $this->data['projects']             = ProjectsModel::where('publish', '=', 1)->orderBy('order_category','ASC')->get();
        return view('projects', $this->data);
    }

    public function details($id)
    {
        $projectdetails                = ProjectsModel::where('permalink', '=', $id)->first();
        if ( $projectdetails ) {
            $this->data['project_detail']               = $projectdetails;
            $this->data['project_detail_main_image']    = ProjectImageModel::where('project_id',$projectdetails->id)->where('as_default',1)->where('publish',1)->first();
            $this->data['project_detail_images']        = ProjectImageModel::where('project_id',$projectdetails->id)->where('as_default',0)->where('publish',1)->get();
            $this->data['project_detail_total_images']  = count(ProjectImageModel::where('project_id',$projectdetails->id)->where('publish',1)->get());
            return view('project_details', $this->data);
        } else {
            return redirect('projects');
        }
    }
}
