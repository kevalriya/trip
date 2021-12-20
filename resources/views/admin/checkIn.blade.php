<?php 
$ActiveSide='trip';
?>  
@extends('admin.layouts.app')

@section('title','Trip')
@section('headSection')
<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<style type="text/css">
	.box-barcode {
   display: flex;
   justify-content: center;
   margin-top: 20px;
   margin-bottom: 20px;
  }
  .modal-body {
    min-height: 350px;
  }
  #successCheckIn {
    color: green;
    margin-top: 10px;
    font-size: 16px;
  }
  #errorMsg {
    color: red;
  }
</style>

@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ticket scanner</h3>
      </div>
      <div class="box-body">
        <div class="box-barcode">
          <div style="width: 500px" id="reader"></div>
        </div>
      </div>
      <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
       
      </button> -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Customer information - <sapn id="ticket-status"></span></h3>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success" onclick="checkIn()" id="checkIns">Check-in</button>
              <p id="successCheckIn"></p>
              <p id="errorMsg"></p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script>

  function checkIn() {
    var getBarcode = $('#barcodeVal').val();
    $.ajax({
      url: "{{route('updateQRCode')}}",
      type: "put",
      data: { _token: "{{csrf_token()}}", barcodeToUpdate: getBarcode },
      success: function(data) {
        $('#successCheckIn').text('The passanger has succefully check-in.')
        setTimeout(function(){ 
          $('#exampleModal').modal('toggle')
         }, 1000);
        
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    })
  }

  function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);

    $.ajax({
        url: "{{route('opScanQRCode')}}",
        type: "post",
        data : { _token: "{{csrf_token()}}", scannedQRCode: decodedText, tripId: <?php echo $id; ?> },
        success: function(data){
          $('#exampleModal').modal({
              show: true
          })
          $('#successCheckIn').text('')
          $('#errorMsg').text('')
          if(data.length > 0) {
            if(data[0].IS_BARCODE_SCANNED === 1) {
              $('#errorMsg').text('This ticket already checked-in.')
              $('#checkIns').hide()
            }
            $('#modal-body').html(`
              <div class="col-md-12">
                <div class="col-md-4"><label>Name: </label></div>
                <div class="col-md-8">${data[0].PASSENGER_FIRSTNAME} ${data[0].PASSENGER_LASTNAME}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Boarding point: </label></div>
                <div class="col-md-8">${data[0].BOARDING_POINT}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Dropoff point: </label></div>
                <div class="col-md-8">${data[0].DROPOFF_POINT}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Email: </label></div>
                <div class="col-md-8">${data[0].EMAIL}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Phone no: </label></div>
                <div class="col-md-8">${data[0].PHONE_NUMBER}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Age: </label></div>
                <div class="col-md-8">${data[0].PASSENGER_AGE}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Gender: </label></div>
                <div class="col-md-8">${data[0].PASSENGER_GENDER}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Seat no: </label></div>
                <div class="col-md-8">${data[0].PASSENGER_SEATNO}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Payment method: </label></div>
                <div class="col-md-8">${data[0].PAYMENT_METHOD}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Payment status: </label></div>
                <div class="col-md-8">${data[0].PAYMENT_STATUS}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Travel insurance: </label></div>
                <div class="col-md-8">${data[0].TRAVEL_INS_FLAG}</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-4"><label>Ticket scanned before: </label></div>
                <div class="col-md-8">${data[0].IS_BARCODE_SCANNED === 0 ? "Not scanned" : `Scanned`}</div>
              </div>
               <div class="col-md-12">
                <input type="hidden" value="${data[0].BARCODE}" id="barcodeVal" />
              </div>
            `)

            $('#ticket-status').html(data[0].IS_BARCODE_SCANNED === 0 ? "<b style='color: green;'>Not scanned</b>" : "<b style='color: red;'>Scanned</b>")
            
          } else {
            $('#checkIns').hide()
            $('#modal-body').html(`
              <div class="col-md-12">
                <h4 style='color:red'>This is not current trip ticket. Please use current trip ticket.</h4>
              </div>
            `);
          }
            
          console.log("Return Data", data)
        },

        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

    // html5QrcodeScanner.clear();
  }
  function onScanError(errorMessage) {
    // handle on error condition, with error message
  }

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endsection