<?php
    Route::get('admin/login','Modules\Admin\Http\Controllers\AuthController@index');
    Route::get('admin/forgot-password','Modules\Admin\Http\Controllers\AuthController@forgetPassword');
    Route::post('password/email','Modules\Admin\Http\Controllers\AuthController@sendResetPasswordLink');
    Route::get('admin/password/reset','Modules\Admin\Http\Controllers\AuthController@resetPassword');  
    Route::get('admin/logout','Modules\Admin\Http\Controllers\AuthController@logout');  

    Route::post('admin/login',function(App\Admin $user){
   
    $credentials = ['email' => Input::get('email'), 'password' => Input::get('password')]; 
    
   // $credentials = ['email' => 'kundan@gmail.com', 'password' => 123456]; 
    $auth = auth()->guard('admin');
    

        if ($auth->attempt($credentials)) {
            return Redirect::to('admin');
        }else{ 
           //return Redirect::to('admin/login')->withError(['message'=>'Invalid Credential!']);
            return redirect()
                        ->back()
                        ->withInput()  
                        ->withErrors(['message'=>'Invalid email or password. Try again!']);
            } 
    }); 
      
    Route::group(['middleware' => ['admin']], function () { 

        Route::get('admin', 'Modules\Admin\Http\Controllers\AdminController@index');
        
        /*------------User Model and controller---------*/

        Route::bind('user', function($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource('admin/user', 'Modules\Admin\Http\Controllers\UsersController', [
            'names' => [
                'edit' => 'user.edit',
                'show' => 'user.show',
                'destroy' => 'user.destroy',
                'update' => 'user.update',
                'store' => 'user.store',
                'index' => 'user',
                'create' => 'user.create',
            ]
                ]
        );


        Route::bind('student', function($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource('admin/student', 'Modules\Admin\Http\Controllers\StudentController', [
            'names' => [
                'edit' => 'student.edit',
                'show' => 'student.show',
                'destroy' => 'student.destroy',
                'update' => 'student.update',
                'store' => 'student.store',
                'index' => 'student',
                'create' => 'student.create',
            ]
                ]
        );

         /*------------User Category and controller---------*/

        Route::bind('category', function($value, $route) {
            return Modules\Admin\Models\Category::find($value);
        });
 
        Route::resource('admin/category', 'Modules\Admin\Http\Controllers\CategoryController', [
            'names' => [
                'edit' => 'category.edit',
                'show' => 'category.show',
                'destroy' => 'category.destroy',
                'update' => 'category.update',
                'store' => 'category.store',
                'index' => 'category',
                'create' => 'category.create',
            ]
                ]
        );

        Route::bind('category_group', function($value, $route) {
            return Modules\Admin\Models\CategoryGroup::find($value);
        });
        /*------------ Category Group ---------*/
        Route::resource('admin/category-group', 'Modules\Admin\Http\Controllers\CategoryGroupController', [
                'names' => [
                    'edit' => 'category-group.edit',
                    'show' => 'category-group.show',
                    'destroy' => 'category-group.destroy',
                    'update' => 'category-group.update',
                    'store' => 'category-group.store',
                    'index' => 'category-group',
                    'create' => 'category-group.create'
                ]
                    ]
        ); 

        Route::bind('professor', function($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource('admin/professor', 'Modules\Admin\Http\Controllers\ProfessorController', [
            'names' => [
                'edit' => 'professor.edit',
                'show' => 'professor.show',
                'destroy' => 'professor.destroy',
                'update' => 'professor.update',
                'store' => 'professor.store',
                'index' => 'professor',
                'create' => 'professor.create',
            ]
                ]
        );


        /*---------End---------*/   

        Route::bind('course', function($value, $route) {
            return Modules\Admin\Models\Course::find($value);
        });

        Route::resource('admin/course', 'Modules\Admin\Http\Controllers\CourseController', [
            'names' => [
                'edit' => 'course.edit',
                'show' => 'course.show',
                'destroy' => 'course.destroy',
                'update' => 'course.update',
                'store' => 'course.store',
                'index' => 'course',
                'create' => 'course.create',
            ]
                ]
        );


          Route::bind('syllabus', function($value, $route) {
            return Modules\Admin\Models\Syllabus::find($value);
        });

        Route::resource('admin/syllabus', 'Modules\Admin\Http\Controllers\SyllabusController', [
            'names' => [
                'edit' => 'syllabus.edit',
                'show' => 'syllabus.show',
                'destroy' => 'syllabus.destroy',
                'update' => 'syllabus.update',
                'store' => 'syllabus.store',
                'index' => 'syllabus',
                'create' => 'syllabus.create',
            ]
                ]
        );


        Route::bind('assignment', function($value, $route) {
            return Modules\Admin\Models\Assignment::find($value);
        });

        Route::resource('admin/assignment', 'Modules\Admin\Http\Controllers\AssignmentController', [
            'names' => [
                'edit'      => 'assignment.edit',
                'show'      => 'assignment.show',
                'destroy'   => 'assignment.destroy',
                'update'    => 'assignment.update',
                'store'     => 'assignment.store',
                'index'     => 'assignment',
                'create'    => 'assignment.create',
            ]
                ]
        );


        Route::get('admin/corporateUser/{name}','Modules\Admin\Http\Controllers\CorporateProfileController@corporateUser');
        Route::get('admin/recentInterview/{id}', 'Modules\Admin\Http\Controllers\InterviewController@recentInterview'); 
        Route::get('admin/condidateDirectory', 'Modules\Admin\Http\Controllers\InterviewController@condidateDirectory'); 
        /*----------End---------*/    
        
        Route::match(['get','post'],'admin/profile', 'Modules\Admin\Http\Controllers\AdminController@profile'); 
        
        Route::match(['get','post'],'admin/monthly-report/{name}', 'Modules\Admin\Http\Controllers\MonthlyReportController@corporateUser'); 
        Route::match(['get','post'],'admin/corporate-monthly-report', 'Modules\Admin\Http\Controllers\MonthlyReportController@index'); 
             
  });



 
 
     
 
  