<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\CategoryRequest;
use Modules\Admin\Http\Requests\CategoryGroupRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\CategoryGroup;
//use App\Category;
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

/**
 * Class AdminController
 */
class CategoryGroupController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct() {
        $this->middleware('admin');
        View::share('viewPage', 'category');
        View::share('helper',new Helper);
        $this->record_per_page = Config::get('app.record_per_page');
    }

    protected $categories;

    /*
     * Dashboard
     * */

    public function index(CategoryGroup $category_group, Request $request) 
    {   
        $msg = '';
        $page_title = 'Category Groups';
        $page_action = 'Create Category Groups';
        $category_groups = $category_group->orderBy('id','desc')->Paginate(5);
        return view('packages::category_group.index', compact('result_set','category_groups','data', 'page_title', 'page_action','html'))->with('flash_alert_notice', $msg);
    }

    /*
     * create Group method
     * 
     */
    /*public function create(Category $category) 
    {
         
        $page_title = 'Category';
        $page_action = 'Create category';
        $sub_category_name  = Category::all();

        $html =  Category::renderAsHtml(); 

        $categories =  Category::attr(['name' => 'categories'])
                        ->selected([3])
                        ->renderAsDropdown();

        return view('packages::category.create', compact('categories', 'html','category','sub_category_name', 'page_title', 'page_action'));
    }*/

        /*
     * create Group method
     * 
     */
    public function create(CategoryGroup $category_group) 
    {
         
        $page_title = 'Category Groups';
        $page_action = 'Create category';
        /*$sub_category_name  = Category::all();

        $html =  Category::renderAsHtml(); 

        $categories =  Category::attr(['name' => 'categories'])
                        ->selected([3])
                        ->renderAsDropdown();*/

        return view('packages::category_group.create', compact('categories', 'html','category_group','sub_category_name', 'page_title', 'page_action'))->with('flash_alert_notice', 'Category Group was successfully Created.');;
    }

    /*
     * Save Group method
     *
     */
    public function store(CategoryGroup $category_group, CategoryGroupRequest $request) 
    {

        $cat_group = new CategoryGroup;
        if( $request->hasFile('group_image') ) {
            $file = $request->file('group_image');
            $destinationPath = base_path() . '/public/uploads/yt/category_group/';
            $file->move($destinationPath, $file->getClientOriginalName());
            $cat_group->group_image  =  $file->getClientOriginalName();
            // Now you have your file in a variable that you can do things with
        }

        
        $cat_group->group_name   =  $request->get('group_name');

        $cat_group->save(); 
        return Redirect::to(route('category-group.create'))
                            ->with('flash_alert_notice', 'New category group was successfully created.');

       /* $validation = Validator::make($input, CategoryGroup::$rules);

        if ($validation->passes())
        {
            CategoryGroup::create($input);

            return Redirect::route('users.index');
        }

        return Redirect::route('users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');*/




    }

    /*
     * Edit Group method
     * @param 
     * object : $category
     *
     */
    public function edit(CategoryGroup $category_group) {

        $page_title = 'Category';
        $page_action = 'Edit category'; 

        $id = $category_group->id;
        $category_group = CategoryGroup::find($id);

        return view('packages::category_group.edit', compact( 'category_group', 'page_title', 'page_action'));
    }

    public function update(Request $request, CategoryGroup $category_group) {

        $cat_group = CategoryGroup::find($category_group->id);
        $cat_group->group_name =  $request->get('group_name');

        if( $request->hasFile('group_image') ) {
            $file = $request->file('group_image');
            $destinationPath = base_path() . '/public/uploads/yt/category_group/';
            $file->move($destinationPath, $file->getClientOriginalName());
            $cat_group->group_image  =  $file->getClientOriginalName();
            // Now you have your file in a variable that you can do things with
        }

        $cat_group->save();   

        return Redirect::to(route('category-group'))
                        ->with('flash_alert_notice', 'Category Group was successfully updated.');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(CategoryGroup $category_group) {
        
        $d = CategoryGroup::where('id',$category_group->id)->delete(); 
        return Redirect::to(route('category-group'))
                        ->with('flash_alert_notice', 'Category Group was successfully deleted.');
    }

    public function show(Category $category) {
        
    }

}
