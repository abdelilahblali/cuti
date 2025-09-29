@extends('master.theme')

@section('content')

<style type="text/css">
  .span_required { color:red  }

  .Loading {
    position: relative;
    display: inline-block;
    width: 100%;
    height: 10px;
    background: #f1f1f1;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, .2);
    border-radius: 4px;
    overflow: hidden;
  }

.Loading:after {
  content: '';
  position: absolute;
  left: 0;
  width: 0;
  height: 100%;
  border-radius: 4px;
  box-shadow: 0 0 5px rgba(0, 0, 0, .2);
  animation: load 5s infinite;
}

@keyframes load {
  0% {
    width: 0;
    background: #a28089;
  }
  
  25% {
    width: 40%;
    background: #a0d2eb;
  }
  
  50% {
    width: 60%;
    background: #5780d1;
  }
  
  75% {
    width: 75%;
    background: #d0bdf4;
  }
  
  100% {
    width: 100%;
    background: #0aa2a5;
  }
}

@keyframes pulse {
  0% {
    background: #a28089;
  }
  
  25% {
    background: #a0d2eb;
  }
  
  50% {
    background: #ffa8b6;
  }
  
  75% {
    background: #d0bdf4;
  }
  
  100% {
    background: #494d5f;
  }
}

</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="row">
  <div class="col-sm-12">
    <div class="home-tab">
      <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <div class="btn-wrapper"></div>
        <div class="btn-wrapper">
          <a href="{{ url('salary') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-history "></i> History</a>
          <a href="{{ url('salary_add') }}" class="btn btn-inverse-success"><i class="mdi mdi-plus "></i> New Salary</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add new salary</h4>
        <form method="POST" action="{{ route('salary_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="year">Year <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="year" id="year" required>
                <option></option>
                <?php for($i=2023; $i<=date('Y')+1; $i++) { ?>
                  <option value="{{ $i }}">{{ $i }}</option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="month">Month <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="month" id="month" required>
                <option></option>
                <?php for($i=1; $i<=12; $i++) { ?>
                  <option value="{{ $i }}">{{ $i }}</option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="file">File <span class="span_required">*</span></label>
              <input type="file" class="form-control form-control-lg" name="file" id="file" required>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="container">
              <div class="Loading" id="loading"></div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success btn-icon-text btn-md" id="upload"><i class=" mdi mdi-upload  btn-icon-prepend"></i>Upload</button>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $( "#loading" ).hide();
  $('#upload').on('click', function() {
    if($("#year").val()!='' && $("#month").val()!='') {
      $( "#upload" ).prop( "disabled", true );
      $( "#loading" ).show();
    }
  });
</script>

@endsection