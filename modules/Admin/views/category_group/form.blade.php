
<div class="col-md-6">

    <div class="form-group{{ $errors->first('group_name', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Group Name <span class="error">*</span></label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('group_name',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="help-block">{{ $errors->first('group_name', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('group_image', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Group Image <span class="error">*</span></label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::file('group_image',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="help-block">{{ $errors->first('group_image', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-8 col-md-8">

            {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

            <a href="{{route('category-group')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
        </div>
    </div>

</div> 