 @extends('packages::layouts.master')
  @section('title', 'Dashboard')
    @section('header')
    <h1>Dashboard</h1>
    @stop
    @section('content') 
    @include('packages::partials.main-header')
    <!-- Left side column. contains the logo and sidebar -->
    <div class="page-container-new">
      @include('packages::partials.sidebar')
      <!-- Content Wrapper. Contains page content -->

 <!-- BEGIN CONTENT -->
             <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#">Category</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Create New</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                     <div class="row">
                        <div class="col-md-12">
                          <section style="margin:15px 30px -30px 30px">
                            @if(Input::has('error'))
                              <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4> <i class="icon fa fa-check"></i>  
                                Sorry! You are trying to access invalid URL. <a href="{{url('admin')}}"> Reset</a></h4>
                              </div>
                            @endif
                            <hr>  
                          </section>
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Create Category</span>
                                    </div>
                                     
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">

                                            @if(Session::has('flash_alert_notice'))
                                                <div class="alert alert-success bg-olive btn-flat margin alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <i class="icon fa fa-check"></i>  
                                                {{ Session::get('flash_alert_notice') }} 
                                                </div>
                                            @endif 
                                        
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <!-- <button id="sample_editable_1_new" class="btn green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button> 
                                                     <a class="btn btn-success" href="{{ route('category-group.create') }}"> Create New
                                                     <i class="fa fa-plus"></i> 
                                                     </a>-->
                                                </div>
                                            </div>
                                            @if(!Input::has('error'))
                                              <div class="row">
                                                <div class="col-lg-12 margin-tb">
                                                  <div class="pull-left">
                                                  <!--  <h2>Category Groups</h2> -->
                                                  </div>
                                                  <!-- <div class="pull-right">
                                                    <a class="btn btn-success" href="{{ route('category-group.create') }}"> Create New Group</a>
                                                  </div> -->
                                                </div>
                                              </div>

                                              @if ($message = Session::get('success'))
                                                <div class="alert alert-success">
                                                  <p>{{ $message }}</p>
                                                </div>
                                              @endif

                                              {!! Form::model($category, ['route' => ['category.store'],'class'=>'form-horizontal','id'=>'cat_group_form','files' => true]) !!}
                                                  @include('packages::category.form')
                                              {!! Form::close() !!}
                                           
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
    </div>
@stop
