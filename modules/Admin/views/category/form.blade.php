
<div class="col-md-6">

    <div class="form-group{{ $errors->first('name', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Category Name <span class="required error">*</span></label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('name',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('description', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Category Description <span class="required error">*</span></label>
        <div class="col-md-4"> 
            {!! Form::textarea('description',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="help-block">{{ $errors->first('description', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('group_id', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Category Group
                <span class="required error"> * </span>
        </label>
        <div class="col-lg-8 col-md-8">
            {!! Form::select('group_id', $items, null, ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('group_id', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('image', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Category Image <span class="required error">*</span></label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::file('image',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="help-block">{{ $errors->first('image', ':message') }}</span>
        </div>
    </div> 

    
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-8 col-md-8">

            {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

            <a href="{{route('category')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
        </div>
    </div>

</div> 