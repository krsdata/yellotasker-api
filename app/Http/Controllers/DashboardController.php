<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Admin\Http\Requests\SyllabusRequest;
use App\Models\Tasks;
use App\Models\CategoryDashboard;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Course;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use Hash;
use View;
use URL;
use Lang;
use Session;
use DB;
use Route;
use Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Dispatcher; 
use App\Helpers\Helper; 
use App\ProfessorProfile;
use App\StudentProfile;
use Modules\Admin\Models\Syllabus;
use Modules\Admin\Models\Assignment;
 


/**
 * Class AdminController
 */
class DashboardController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct() {
     
    }

    /*
     * Dashboard
     * */

    public function getCategories(Request $request){

           $dashboard_categories = CategoryDashboard::select('categoryDashboard.category_id','categoryDashboard.name','categoryDashboard.display_order','categories.category_image','categories.parent_id')->join('categories', 'categoryDashboard.category_id' , '=', 'categories.id')->orderBy('display_order')->where('parent_id','!=','0')->take(8)->get();

           if (count($dashboard_categories)) {

                $cat_array = [];
                $image_url = env('IMAGE_URL',url::asset('storage/uploads/category/'));
                
                foreach($dashboard_categories as $key=>$value){
                    $cat_array[$key]  = ['cat_id'=>$value['category_id'],'cat_name'=>$value['name'],'cat_order'=>$value['display_order'],'cat_image'=>$image_url.'/'.$value['category_image'],'group_id'=>$value['parent_id']];

                }

                $status  = 1;
                $code    = 200;
                $message = 'List of dashboard categories.';
                $data    = $cat_array;

           } else {
                $status  = 1;
                $code    = 200;
                $message = 'No data found.';
                $data    = [];
           }
            
            return response()->json(
                            [ 
                            "status"  =>$status,
                            'code'    => $code,
                            "message" =>$message,
                            'data'    => $data
                            ]
                        );
    }
   
}
