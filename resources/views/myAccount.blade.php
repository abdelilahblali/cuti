@extends('master.theme')


@section('content')

<style type="text/css">
  .c3_color { color: red !important; }
</style>

<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
  <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
    <h3 class="text-white fw-bolder fs-2qx me-5">Modifier mon mot de passe</h3>
    <div class="d-flex align-items-center flex-wrap py-2">
      @include('master.aide')
    </div>
  </div>
</div>

<div id="kt_content_container" class="d-flex align-items-start container-xxl">
  <div class="content flex-row-fluid" id="kt_content">
   @if(session()->has('yes'))
    <div class="col-md-12">
      <div class="alert alert-success">
        {{ session()->get('yes') }}
      </div>
    </div>
    @endif

    @if(session()->has('no'))
    <div class="col-md-12">
      <div class="alert alert-success">
        {{ session()->get('no') }}
      </div>
    </div>
    @endif
  </div>
</div>
 





<!-- Passport################## -->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
  <div class="content flex-row-fluid" id="kt_content">
    <div class="card card-page">
      <div class="card-body" style="padding-top: 0px">
        <div class="card card-xxl-stretch">

          <div class="card-header" style="padding-top: 20px">

            <div class="card-toolbar" style="margin-top:30px">
              <form method="POST" action="{{ route('myAccountUpdated') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <h6><label for="pas1" class="control-label form-label label01">Nouveau mot de passe <span class="c3_color">*</span></label></h6>
                        <input type="password" name="pas1" id="pas1" class="form-control" required minlength="6" />
                    </div>

                    <div class="col-md-12" style="margin-top:20px">
                        <h6><label for="pas2" class="control-label form-label label01">Confirmation du mot de passe <span class="c3_color">*</span></label></h6>
                        <input type="password" name="pas2" id="pas2" class="form-control" required  minlength="6"/>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px; margin-bottom: 20px">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" style="padding-right: 10px"></i>Mise à jour</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
