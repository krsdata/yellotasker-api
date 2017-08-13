<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Admin\Http\Requests\SyllabusRequest;
use App\Models\Tasks;
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
            if ($request->get('User_ID')) {
                $user_id = $request->get('User_ID');
                $user_data = User::find($user_id);
                if (empty($user_data)) {
                    return response()->json(
                        [ 
                        "status"  => '0',
                        'code'    => '200',
                        "message" => 'No match found for the given user id.',
                        'data'    => []
                        ]
                    );
                } else {
                    if($request->get('Task_Title') && $request->get('Task_Description') && $request->get('Due_Date') && $request->get('User_ID')  && $request->get('People_required') && $request->get('Budget') && $request->get('Budget_Type') ){

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

                }
            } else {
                 $status  = 0;
                $code    = 400;
                $message = 'Unable to add task, user id field is empty.';
                $data    = [];
            }  
        } else {
            $status  = 0;
            $code    = 400;
            $message = 'Unable to add task, no post data found.';
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

    public function getAllTasks(){
        $Tasks = Tasks::all();
    }

    public function getOpenTasks(){
        $tasks = Tasks::where('status', 0)->get();

        if(count($tasks)){
            $status  =  1;
            $code    =  200;
            $message =  "List of all open tasks.";
            $data    =  $tasks;
        } else {
            $status  =  0;
            $code    =  204;
            $message =  "No open tasks found.";
            $data    =  [];
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

    // status '0'=>'open','1'=>'completed','2'=>'in-progress'
    public function getRecentTasks(){
        $tasks = Tasks::where('status', 1)
               ->orderBy('id', 'desc')
               ->take(8)
               ->get();

        if(count($tasks)){
            $status  =  1;
            $code    =  200;
            $message =  "List of recently completed tasks.";
            $data    =  $tasks;
        } else {
            $status  =  0;
            $code    =  204;
            $message =  "No tasks found.";
            $data    =  [];
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

    public function getUserTasks(Request $request)
    {
       $user_id = $request->user_id;

        if($user_id)
        {
            $user_tasks  =   Tasks::where('user_id',$user_id)->get();

            if(count($user_tasks)){
                $status  =  1;
                $code    =  200;
                $message =  "List of tasks posted by user";
                $data    =  $user_tasks;
            } else {
                $status  =  0;
                $code    =  204;
                $message =  "No tasks found for the given user.";
                $data    =  [];
            }
            
        } else {

            $status  =  0;
            $code    =  500;
            $message =  "Invalid User ID."; 
            $data    =  [];

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