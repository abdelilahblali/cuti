@extends('master.theme')

@section('content')

<style type="text/css">
  .span_required { color:red  }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-md-12" id="alert1"><div class="alert alert-success">Business Travel has been added successfully, please add the details! </div></div>

<div class="col-md-6 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add new business travel request</h4>
        <form method="POST" id="travel-added-form" action="{{ route('travel_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col md-6">
                <label class="sr-only" for="purpose">Travel Purpose <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="purpose" id="purpose" required>
            </div>
            <div class="col md-6">
                <label class="sr-only" for="destination">Destination <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="destination" id="destination" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="to_date">To (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="to_date" id="to_date" required>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="sr-only" for="agenda">Travel Agenda <span class="span_required">*</span></label>
          <textarea class="form-control form-control-lg" name="agenda" id="agenda" style="min-height: 150px;" required></textarea>
        </div>
        <button id="btnAdd" type="submit" class="btn btn-success btn-icon-text btn-md"><i class="mdi mdi-chevron-right  btn-icon-prepend"></i>Next</button>
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

        <input type="hidden" name="travel" id="travel">
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
            <button id="btnDetail" type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
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
        <form method="POST" action="{{ route('travel_sent_notif') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="table-responsive">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>Type</th>
                <th>Budget</th>
                <th>Description</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="dataExpense">
            </tbody>
            <tfoot id="FootdataExpense">
            </tfoot>
          </table>
        </div>
        <button id="btnSend" type="submit" class="btn btn-success btn-icon-text btn-md mt-5 mb-2" style="float: right;"><i class=" mdi mdi-send  btn-icon-prepend"></i>Save & Send</button>
      </form>
    </div>
  </div>
</div>

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
    $("#btnDetail").hide();
    $("#btnSend").hide();
    $("#alert1").hide();
    $("#alert2").hide();
    
    //alert choosen
    $('#type').on('change', function() {
      if(this.value=='Hotel') {
        alert("Maximal 3-star hotel, can't be more than a 3-star hotel !")
      }
    });
    $('#type').on('change', function() {
      if(this.value=='Meals') {
        alert("Maximal Rp. 200.000/day !")
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

@endsection