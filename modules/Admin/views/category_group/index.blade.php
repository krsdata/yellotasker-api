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
                            <a href="#">Category Group</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">View All</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Category Groups</span>
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
                                                    </button> -->
                                                     <a class="btn btn-success" href="{{ route('category-group.create') }}"> Create New
                                                     <i class="fa fa-plus"></i>
                                                     </a>
                                                </div>
                                            </div>
                                           <!-- <div class="col-md-6">
                                                <div class="btn-group pull-right">
                                                    <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;"> Print </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"> Save as PDF </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"> Export to Excel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                        <thead>
                                            <tr>
                                                <th> Group Name </th>
                                                <th> Group Image </th>
                                                <!-- <th> Edit </th>
                                                <th> Delete </th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($category_groups as $key => $item)
                                            <tr>
                                                <td>{{ $item->group_name }}</td>
                                                <!-- <td>{{ $item->group_image }}</td> -->
                                                <td>
                                                <img src="{{ URL::asset('/public/uploads/yt/category_group/'.$item->group_image ) }}" width="90px" height="40px;" alt="{{ $item->group_image }}" class="logo-default">
                                                </td>
                                                <!--<td>
                                                     <a class="btn btn-info" href="{{ route('category-group.show',$item->id) }}">Show</a> 
                                                    <a class="edit" data-toggle="modal" href="{{ route('category-group.edit',$item->id) }}">Edit</a>
                                                </td>
                                                <td> -->
                                                   <!--  <a class="edit" data-toggle="modal" href="{{ route('category-group.destroy',$item->id) }}">Delete</a>  -->

                                                  <!--  {!! Form::open(['method' => 'DELETE','route' => ['category-group.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'delete']) !!}
                                                {!! Form::close() !!}
                                                </td> -->

                                                <td> 
                                                    <a href="{{ route('category-group.edit',$item->id)}}">
                                                        <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                    </a>

                                                    {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$item->id, 'route' => array('category-group.destroy', $item->id))) !!}
                                                    <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$item->id}}"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                    
                                                     {!! Form::close() !!}

                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $category_groups->render() !!}
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