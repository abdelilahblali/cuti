@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

@foreach($travel as $item)
<div class="col-md-6 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          Show & Edit  
          @if($item->act==0)<label class="badge badge-warning" style="float:right">Pending</label>@endif
          @if($item->act==1)<label class="badge badge-success" style="float:right">Enabled</label>@endif
          @if($item->act==-1)<label class="badge badge-danger" style="float:right">Disabled</label>@endif
        </h4>
        <form method="POST" action="{{ route('travel_edited', [ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col md-6">
                <label class="sr-only" for="purpose">Travel Purpose <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="purpose" id="purpose" value="{{$item->purpose}}">
            </div>
            <div class="col md-6">
                <label class="sr-only" for="destination">Destination <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="destination" id="destination" value="{{$item->destination}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" value="{{$item->from_date}}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="to_date">To (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="to_date" id="to_date" value="{{$item->to_date}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="sr-only" for="agenda">Agenda</label>
          <textarea class="form-control form-control-lg" name="agenda" style="min-height: 150px;">{{ $item->agenda }}</textarea>
        </div>
        
        @if($item->act==0)
        <button id="btnUpdate" type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-refresh  btn-icon-prepend"></i>Update</button>
        @endif
      </form>
    </div>
  </div>
</div>

<div class="col-md-6 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Expense Management</h4>
        <form method="POST" id="expense-added-form" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="travel" id="travel" value="{{ $item->ref }}">
        <div class="form-group">
          <div class="row">
            <div class="col md-6">
                <label class="sr-only" for="type">Type of expense <span class="span_required">*</span></label>
                <select name="type" id="type" data-placeholder="" class="form-control form-control-lg">
                  <option></option>
                  <option>Plane Ticket</option>
                  <option>Hotel</option>
                  <option>Ground Transport</option>
                  <option>Meals</option>
                  <option>Others</option>
                </select>
            </div>
            <div class="col md-6">
                <label class="sr-only" for="budget">Budget (IDR) <span class="span_required">*</span></label>
                <input type="number" class="form-control form-control-lg" name="budget" id="budget" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="sr-only" for="description">Description</label>
          <textarea class="form-control form-control-lg" name="description" id="description" style="min-height: 150px;"></textarea>
        </div>
        <div class="container">
          <div class="btn-holder">
          @if($item->act==0)
            <button id="btnDetail" type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
          @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-12" id="alert2"><div class="alert alert-success">Detail has been added successfully, please add other details! </div></div>
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Expense Details</h4>
        <form method="POST" action="{{ route('travel_saved') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-responsive">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Budget</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="dataExpense">
            </tbody>
            <tfoot id="FootdataExpense">
            </tfoot>
          </table>
          @if($item->act==0)
            <button id="btnSend" type="submit" class="btn btn-success btn-icon-text btn-md mt-5 mb-2" style="float: right;"><i class=" mdi mdi-content-save  btn-icon-prepend"></i>Save</button>
          @endif
          </div>
      </form>
    </div>
  </div>
</div>

@if($item->act==1)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Upload Proof</h4>
        <form method="POST" action="{{ route('travelProof_added', [ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <div class="row">
            <div class="col md-12">
                <label class="sr-only" for="invoice">Upload invoice <span class="span_required">* </span></label>
                @if($item->invoice!='') <a target="_blank" href="https://hr.magnitudeconstruction.com/media/travel/{{ $item->invoice }}"> View </a> 
                  | <a href="{{ route('travelProof_deleted', [ 'ref' => $item->ref ]) }}" style="color: red;"> Delete </a>  @endif
                <input type="file" name="invoice[]" id="invoice" class="form-control form-control-lg">
            </div>
          </div>
          @if($item->invoice=='')
          <div class="row">
            <div class="col md-12">
              <button id="btnSend" type="submit" class="btn btn-success btn-icon-text btn-md mt-4 mb-4" style="float: left;"><i class=" mdi mdi-content-save  btn-icon-prepend"></i>Save</button>
            </div>
          </div>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endif

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type='text/javascript'>
  function getList(travel) {
    var urlGet = "{{  route('travelJSON') }}"
    $.ajax({
      url: urlGet,
      method: 'GET',
      data: {      
        travel: travel,  
      },
      beforeSend: function() {
        console.log('Loading to get list')
      },
      complete: function(response) {            
        var data = response.responseJSON.data;
        var total = 0;
        $('#dataExpense').html(''); //reset
        for(i = 0; i < response.responseJSON.data.length; i++) {     
          new Intl.NumberFormat('en-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(total,budget);
          var budget = parseFloat(data[i].budget);
          $('#dataExpense').append(`
            <tr>
              <td style="font-weight:bold;">${data[i].type}</td>
              <td>${data[i].description}</td>
              <td>${new Intl.NumberFormat('en-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(parseFloat(data[i].budget))}</td>
              <td>
                <a href="javascript:void();" onclick="editProduct(${data[i].ref}, ${data[i].travel})"><i class="far fa-edit"></i></i></a>
                <a href="javascript:void();" onclick="deleteProduct(${data[i].ref}, ${data[i].travel})"><i class="far fa-trash-alt" style="color: red;"></i></a>
              </td>
            </tr>
          `);
          total += budget;
        }
        $('#FootdataExpense').html(''); //reset
            $('#FootdataExpense').append(`
                <tr>
                  <td style="font-weight:bold;" colspan="2">TOTAL</td>
                  <td style="font-weight:bold;" colspan="2">${new Intl.NumberFormat('en-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(total)} IDR</td>
                </tr>
            `);
      }
    })
  }

  $(document).ready(function(){
    $("#btnUpdate").hide();
    // $("#btnSend").hide();
    $("#alert1").hide();
    $("#alert2").hide();
    var travel = $('#travel').val();     
    getList(travel);
    
     //alert choosen
     $('#type').on('change', function() {
      if(this.value=='Hotel') {
        alert('Caution!, you can not choose hotel with more than 3 stars , if not your request will be canceled!')
      }
    });
    
    //save data travel business
    $('#travel-added-form').on('submit', function (e) {
      var urlPostAjax = "{{ route('travel_added') }}";        
      e.preventDefault();
      
      var purpose = $('#purpose').val();      
      var destination = $('#destination').val();
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var agenda = $('#agenda').val();
  
      $.ajax({
        url: urlPostAjax,
        method: 'POST',
        data: {      
          purpose: purpose,      
          destination: destination,     
          from_date: from_date,     
          to_date: to_date,     
          agenda: agenda,     
          _token: $('input[name="_token"]').val(),
        },
        beforeSend: function() {
          console.log('Save data travel business loading..')
        },
        complete: function(response) {   
          $('#travel').val(response.responseJSON.data.travel);     
          $('#btnDetail').show();
          $('#alert1').show();
          $('#btnAdd').hide();
        }
      });
    });

    //save detail travel business
    $('#expense-added-form').on('submit', function (e) {
      var urlPostAjax = "{{ route('travel_detail_added') }}";        
      e.preventDefault();
      
      var travel = $('#travel').val();      
      var type = $('#type').val();
      var description = $('#description').val();
      var budget = $('#budget').val();
  
      $.ajax({
        url: urlPostAjax,
        method: 'POST',
        data: {      
          travel: travel,      
          type: type,     
          description: description,     
          budget: budget,     
          _token: $('input[name="_token"]').val(),
        },
        beforeSend: function() {
          console.log('Save data travel business loading..')
        },
        complete: function(response) {   
          getList(travel);
          $('#alert1').hide();
          $('#alert2').show();
          $("#type").val($("#type option:first").val());
          $('#budget').val('');
          $('#description').val('');
          $("#btnSend").show();
        }
      });
    });

  }); //end document

</script>
@endforeach

@endsection