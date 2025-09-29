@extends('master.theme')

@section('content')



@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif

<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">My Profile</h4>
        <form method="POST" action="{{ route('user_profil_updated') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="sr-only" for="username">Email</label>
          <input type="text" class="form-control form-control-lg" name="username" value="{{ Auth::user()->username }}" disabled required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="pre">First name</label>
          <input type="text" class="form-control form-control-lg" name="pre" value="{{ Auth::user()->pre }}" required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="nom">Last name</label>
          <input type="text" class="form-control form-control-lg" name="nom" value="{{ Auth::user()->nom }}" required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="phone">Phone</label>
          <input type="text" class="form-control form-control-lg" name="phone" value="{{ Auth::user()->phone }}" required>
        </div>

        <div class="form-group">
          <label class="sr-only" for="department">Department</label>
          <select class="form-control form-control-lg" name="department" required>
            <option></option>
            @foreach($departments as $d)
            <option value="{{ $d->ref }}" @if(Auth::user()->department==$d->ref) selected @endif >{{ $d->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="sr-only" for="position">Position</label>
          <select class="form-control form-control-lg" name="position" required>
            <option></option>
            @foreach($positions as $d)
            <option value="{{ $d->ref }}" @if(Auth::user()->position==$d->ref) selected @endif >{{ $d->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="sr-only" for="manager">Manager</label>
          <select class="form-control form-control-lg" name="manager" required>
            <option></option>
            @foreach($managers as $m)
            <option value="{{ $m->ref }}" @if($manager==$m->ref) selected @endif >{{ $m->civ }} {{ $m->nom }} {{ $m->pre }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-content-save-all  btn-icon-prepend"></i>Save</button>
      </form>
    </div>
  </div>
</div>

<div class="col-md-6 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">My Picture</h4>
        <form method="POST" action="{{ route('user_photo_updated') }}">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-12">
                  <h6><label for="img" class="control-label form-label label01">Choose a picture <span class="c3_color">*</span></label></h6>
                  <input type="file" name="upload_image" id="upload_image" class="form-control form-control-lg" required />
                  <br />
                  <div id="uploaded_image"></div>
              </div>
          </div>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-8">
              <button type="submit" class="btn btn-success" style="display: none" id='save'  onclick="this.style.display='none'"><i class=" mdi mdi-content-save-all  btn-icon-prepend"></i> Save the picture</button>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="col-md-6 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
          @if(Auth::user()->img!='')
          <img src="{{ url('media/profil/') }}/{{ Auth::user()->img }}" >
          @endif
    </div>
  </div>
</div>



<div id="uploadimageModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <a href=""><button type="button" class="close" >&times;</button></a>
            <h4 class="modal-title">Crop the photo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-8 text-center col-md-offset-2">
              <div id="image_demo" style="width:350px; margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_image" onclick="this.style.display='none'; document.getElementById('save').style.display='block'">Next</button>
          </div>
      </div>
    </div>
</div>



<script type="text/javascript">
  
  $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:250,
      height:250,
      type:'square'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }

    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"{{ url('uploadimg/upload.php') }}",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
        }
      });
    })
  });

</script>


@endsection