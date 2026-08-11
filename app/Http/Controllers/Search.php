<?php namespace terre\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use terre\Http\Models\ProductByCategoryModel;
use terre\Http\Models\ProjectsModel;
use terre\Http\Requests;

class Search extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Home";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {
        $keyword    = Input::get('keyword');
        $i          = 0;
        $key        = array($keyword);

        // PRODUCTS
        $checkProducts  = ProductByCategoryModel::where('name', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%')->orWhere('projects', 'like', '%'.$keyword.'%')->where('publish', 1)->get();
        foreach($checkProducts as $listProduct){
            $dataSearch[$i]['id']           = $i;
            $dataSearch[$i]['name']        = $listProduct->name;
            $dataSearch[$i]['description']  = strip_tags($listProduct->description);
            $dataSearch[$i]['route']        = 'product_details';
            $dataSearch[$i]['permalink']    = $listProduct->permalink;
            $i++;
        }
        // PROJECTS
        $checkProjects  = ProjectsModel::where('name', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%')->where('publish', 1)->get();
        foreach($checkProjects as $listProject){
            $dataSearch[$i]['id']           = $i;
            $dataSearch[$i]['name']        = $listProject->name;
            $dataSearch[$i]['description']  = strip_tags($listProject->description);
            $dataSearch[$i]['route']        = 'project_details';
            $dataSearch[$i]['permalink']    = $listProject->permalink;
            $i++;
        }
        if(isset($dataSearch)) {
            foreach($dataSearch as &$list){
                $tempString = '';
                $list['name']           = $this->hl($list['name'], $key);
                if (strlen($this->hl($list['description'], $key)) > 250)    $tempString = '...';
                $list['description']    = substr($this->hl($list['description'], $key), 0, 250).$tempString;
            }

            $dataSearch = $this->paginate($dataSearch, 15);
        }

        $this->data['title']            = 'Search Result';
        $this->data['page']             = 'search';
        $this->data['search_result']    = isset($dataSearch) ? $dataSearch : false;
        $this->data['keyword']          = $keyword;

        return $this->render_view('search_result');
    }

    private function hl($input, $words)
    {
        $replace = array_flip(array_flip($words)); // remove duplicates
        $pattern = array();
        foreach ($replace as $k=>$fword) {
            $pattern[] = '/\b(' . $fword . ')(?!>)\b/i';
            $replace[$k] = '<span>$1</span>';
        }
        return preg_replace($pattern, $replace, $input);
    }

    private function paginate($items,$perPage){
        $pageStart = Input::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
