<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\CategoryRequest;
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
class CategoryController extends Controller {
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

    public function index(Category $category, Request $request) 
    { 
        $page_title = 'Category';
        $page_action = 'View Category'; 
        /*if ($request->ajax()) {
            $id = $request->get('id'); 
            $category = Category::find($id); 
            $category->status = $s;
            $category->save();
            echo $s;
            exit();
        }
        // Search by name ,email and group
        $search = Input::get('search');
        $status = Input::get('status');
        if ((isset($search) && !empty($search))) {

            $search = isset($search) ? Input::get('search') : '';
               
            $categories = Category::where(function($query) use($search,$status) {
                        if (!empty($search)) {
                            $query->Where('category_name', 'LIKE', "%$search%")
                                    ->OrWhere('sub_category_name', 'LIKE', "%$search%");
                        }
                        
                    })->Paginate($this->record_per_page);
        } else {
            $categories = Category::with('subcategory')->Paginate($this->record_per_page);
        }
        // Category sub category list-----
        $html = "";
        $categories2 = Category::with('children')->where('parent_id',0)->get();
        $cname = [];
        $level = 1;*/

        //$deals = Category::with('categorygroup')->get();

        //$categories = $deals;

        $categories = Category::select('category_new.id','name','description','image','group_id','group_name')->join('category_group', 'category_new.group_id' , '=', 'category_group.id')->orderBy('category_new.id', 'desc')->paginate($this->record_per_page);

        //$categories = $categories->orderBy('id','desc')->Paginate($this->record_per_page);
        
        return view('packages::category.index', compact('result_set','categories','data', 'page_title', 'page_action','html'));
    }

    /*
     * create Group method
     * */

    public function create(Category $category) 
    {
         
        $page_title = 'Category';
        $page_action = 'Create category';
       /* $sub_category_name  = Category::all();

        $html =  Category::renderAsHtml(); 

        $categories =  Category::attr(['name' => 'categories'])
                        ->selected([3])
                        ->renderAsDropdown();*/

        //example usage.
        $posts = CategoryGroup::all();
        
        $items = [];
        /*$posts->each(function($post) { // foreach($posts as $post) { }
        
            $groups[]= $posts->groupName();
                        //do something
        });*/
        $items['0']= 'Select';
        foreach($posts as $post) { 
            $items[$post->id]= $post->group_name;
        }

        return view('packages::category.create', compact('categories', 'items','html','category','sub_category_name', 'page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(CategoryRequest $request, Category $category) 
    {  

        $name = $request->get('name');

        $cat = new Category;
        $cat->name             =  $request->get('name');
        $cat->description      =  $request->get('description');
        $cat->group_id         =  $request->get('group_id');
        
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $destinationPath = base_path() . '/public/uploads/yt/categories/';
            $file->move($destinationPath, $file->getClientOriginalName());
            $cat->image            =  $file->getClientOriginalName();
            // Now you have your file in a variable that you can do things with
        }

        $cat->save();   

        return Redirect::to(route('category'))
                            ->with('flash_alert_notice', 'New category was successfully created.');
        }

    /*
     * Edit Group method
     * @param 
     * object : $category
     * */

    public function edit(Category $category) {

        $page_title = 'Category';
        $page_action = 'Edit category'; 

        $posts = CategoryGroup::all();
        $items = [];

        foreach($posts as $post) { 
            $items[$post->id]= $post->group_name;
        }

        $id = $category->id;
        $category = Category::find($id);

        return view('packages::category.edit', compact( 'category', 'items','page_title', 'page_action'));
    }

    public function update(Request $request, Category $category) {

        $cat = Category::find($category->id);
        $cat->name        =  $request->get('name');
        $cat->description =  $request->get('description');
        $cat->group_id    =  $request->get('group_id');

        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $destinationPath = base_path() . '/public/uploads/yt/categories/';
            $file->move($destinationPath, $file->getClientOriginalName());
            $cat->image            =  $file->getClientOriginalName();
            // Now you have your file in a variable that you can do things with
        }

        $cat->save();   

        return Redirect::to(route('category'))
                        ->with('flash_alert_notice', 'Category was successfully updated.');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(Category $category) {
        
        $d = Category::where('id',$category->id)->delete(); 
        return Redirect::to(route('category'))
                        ->with('flash_alert_notice', 'Category was successfully deleted.');
    }

    public function show(Category $category) {
        
    }

}
