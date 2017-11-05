<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
        <div class="form-group">
            <strong>ID</strong>
            {!! Form::text('id', null, array('placeholder' => 'MSSV','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>Name</strong>
            {!! Form::text('name', null, array('placeholder' => 'Your Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
        <div class="form-group">
            <strong>Date of birth</strong>
            {!! Form::text('birthday', null, array('placeholder' => 'Your Date of Birth','class' => 'form-control')) !!}
        </div>
    </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
        <div class="form-group">
            <strong>Address</strong>
            {!! Form::text('address', null, array('placeholder' => 'Your Address','class' => 'form-control')) !!}
        </div>
    </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
        <div class="form-group">
            <strong>Class</strong>
            {!! Form::text('class', null, array('placeholder' => 'Your Class','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
