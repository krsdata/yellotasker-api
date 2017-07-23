<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Admin\Http\Requests\SyllabusRequest;
use Modules\Admin\Models\User;
use App\Models\Tasks;
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
class TaskController extends Controller {
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

    /*
     * create Group method
     * */

    public function create(Request $request)
    {
        $post_request = $request->all();
        
        if (!empty($post_request)) 
        {
            if(isset($post_request['Task_Title']) && isset($post_request['Task_Description']) && isset($post_request['Due_Date']) && isset($post_request['User_ID']) && isset($post_request['People_required']) && isset($post_request['Budget']) && isset($post_request['Budget_Type']) ){

                $task = new Tasks;

                $date = $request->get('Due_Date');
                $task->title = $request->get('Task_Title');
                $task->description = $request->get('Task_Description');
                $due_date = Carbon::createFromFormat('m/d/Y', $date);
                $task->user_id = $request->get('User_ID');
                $task->due_date = $due_date;
                $task->people_required = $request->get('People_required');
                $task->budget = $request->get('Budget');
                $task->budget_type = $request->get('Budget_Type');

                $task->save();

                $status  = 1;
                $code    = 200;
                $message = 'Task  successfully inserted.';
                $data    = [];
                
            } else {

                $status  = 0;
                $code    = 400;
                $message = 'Required request params not found.';
                $data    = [];

            }   
        } else {
            $status  = 0;
            $code    = 400;
            $message = 'Unable to add task, no data found.';
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