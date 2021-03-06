@extends('manager.layouts.frame')
@section('title', 'Edit Location')
@section('description', 'Please make sure to check all input')
@section('button')
  <a href="{{ url('/manager/location') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">

            {!! Form::model($information, [
              'method' => 'PATCH',
              'url' => ['/manager/location', $information->id],
              'files' => true,
              'id' => 'formValidate',
              ]) !!}

              <div class="row">
                <div class="col-md-12">
                  <div aria-required="true" class="form-group form-group-default required {{ $errors->has('name') ? 'has-error' : ''}}">
                      {!! Form::label('name', "Nama") !!}
                      {!! Form::text('name', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "Nama"]) !!}
                  </div>
                  {!! $errors->first('name', '<label class="error">:message</label>') !!}
                </div>

              </div>


              <br/>

              <button class="btn btn-default btn-rounded btn-sm p-l-30 p-r-30 m-r-10" type="reset">CLEAR</button>
              {!! Form::submit('SAVE', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-sm p-l-30 p-r-30']) !!}


              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#formValidate').validate();

    });
  </script>
@endpush
