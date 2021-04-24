<?php 
$ActiveSide='route';
?>  
@extends('admin.layouts.app')

@section('title','Route Detail')
@section('headSection')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
<style type="text/css"> 
  .ui-sortable-handle {
    cursor: move; /* fallback if grab cursor is unsupported */
    cursor: grab;
    cursor: -moz-grab;
    cursor: -webkit-grab;
}
   .ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px; 
    min-height:150px;  
    height: 200px;
    max-height: 250px;
    overflow-y: auto;
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
th.next,th.prev{
 cursor: pointer;
}
.scroll-li{
  height: 300px;
    max-height: 400px;
    overflow-y: auto;
   
}
</style>
@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

         <?php
    $ActiveSub="route";
    ?>
@include('admin.layouts.routeHeader')


      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-number">Route Stop Point</span>
     @foreach ($data as $i)
        <textarea id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</textarea>
        @endforeach
      <button class="btn-aqua" id="infoUpdate"><i class="fa fa-check fa-2x"></i></button>
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
       


                <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$Route->ROUTE_NAME}}</h3>
          <br><small>Stop Points</small>
        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
             <div class="col-md-12">
              @include('includes.messages') 
          
          <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
           
                  <div id="CRoutesMDetail" >
            
            <table class="table table-responsive unsortable" id="add_route_table">
                 {{ csrf_field() }}
         <thead>
          <tr>
  
          <td style="width: 20px">StopsId </td>
          <td style="width: 20px">RouteId </td>
          <td style="width: 150px">State </td>
          <td style="width: 150px">City </td>
          <td style="width: 150px">Type </td>
          <td style="width: 70px">Seq No </td>
         
          <td style="width: 250px">Additional Info </td>
          
          <td>Action </td>
          <td></td>
          </tr>
        </thead>
          <tbody>
            <?php 
            $i=0;
            ?>
            @forelse ($RoutePoint as $Point)
        <?php 

        if($Point['ROUTE_STOPPOINT_TYPE'] == 'START'){
          $arvd="readonly";
          $acls="";
        }
        else{
          $arvd="";
          $acls="timepicker";
        }

    if($Point['ROUTE_STOPPOINT_TYPE'] == 'FINAL'){
    $depd="readonly";
     $dcls="";
        }
        else{
          $depd="";
           $dcls="timepicker";
        }


       $Avtime= (!empty($Point->ARRIVAL_TIME)) ? date('H:i',strtotime($Point->ARRIVAL_TIME)) : '';
       $DPtime=  (!empty($Point->DEPARTURE_TIME)) ? date('H:i',strtotime($Point->DEPARTURE_TIME)) : '';
        ?>
    <tr>
    
          <td>
         <input type="text" class="form-control" value="{{$Point->ROUTE_STOPPOINT_ID}}" readonly="">

          </td>
          <td>
         <input type="text" class="form-control rtid" value="{{$Route->ROUTE_ID}}" readonly="">

          </td>

                <td>
            <select class="form-control state" name="state[]" data-cls="ocity" id="ostate" name="ostate"  data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}"
                      @if ($State->STATE_CODE == $Point->STATE_CODE)
                        selected
                      @endif>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
      </td>

              <td>
                  <input type="hidden" name="oldId[]" value="{{$Point->ROUTE_STOPPOINT_ID}}">

                
                  <input id="searchi-city-<?php echo $i ?>" class="form-control search-city required" placeholder="City" name="cityName[]"  value="{{$Point->CITY_NAME}}" type="text" oninput="clientSelOpt(this)"  autocomplete="something" />
                <input type="hidden" class="cityinput" value="{{$Point->CITY_CODE}}"  name="city[]"> 

               </td>
               <td>

                <select class="form-control select2 required rtype" name="type[]" >
                  <option value="">Select Type</option>
                  <option value="START" <?php echo ($Point->ROUTE_STOPPOINT_TYPE == 'START') ? 'selected' : '' ?> >START</option>
                  <option value="PICK-UP" <?php echo ($Point->ROUTE_STOPPOINT_TYPE == 'PICK-UP') ? 'selected' : '' ?> >PICK-UP</option>
                  <option value="REST" <?php echo ($Point->ROUTE_STOPPOINT_TYPE == 'REST') ? 'selected' : '' ?> >REST</option>
                  <option value="DROP-OFF" <?php echo ($Point->ROUTE_STOPPOINT_TYPE == 'DROP-OFF') ? 'selected' : '' ?> >DROP-OFF</option>
                  <option value="FINAL" <?php echo ($Point->ROUTE_STOPPOINT_TYPE == 'FINAL') ? 'selected' : '' ?> >FINAL</option>
                 
                </select>
               </td>

               <td> 

                <input  type="text" class="form-control sequence" name="sequence[]"  value="{{$Point->ROUTE_STOPPOINT_SEQNO}}">
               </td>
             
             

                <td> 

                <input type="text" class="form-control" name="addInfo[]"  value="{{ $Point->additional_info }}">
              
               </td>
             
               <td>
              
                <button class="btn btn-xs btn-danger delete-route" data-delete="{{$Point->ROUTE_STOPPOINT_ID}}"> <span class="glyphicon glyphicon-trash"></span> </button>

               </td>
             
            </tr>
            <?php $i++ ?>
@empty
   
            <tr >
           

          <td>
         <input type="text" class="form-control" value="-"  readonly="">

          </td>
          <td>
         <input type="text" class="form-control rtid" value="{{$Route->ROUTE_ID}}" readonly="">

          </td>

      <td>
            <select class="form-control state" name="state[]" data-cls="ocity" id="ostate" name="ostate"  data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}">{{ $State->NAME }}</option>
                    @endforeach
                  </select>
      </td>

              <td>
           <input type="hidden" name="oldId[]" value="0">

 <input id="searchi-city-fir" class="form-control search-city" name="cityName[]"  placeholder="City"  type="text" oninput="clientSelOpt(this)"  autocomplete="something" />
                <input type="hidden" class="cityinput"  name="city[]"> 
               </td>
               <td>

                <select class="form-control select2 rtype" name="type[]" >
                  <option value="">Select Type</option>
                  <option value="START">START</option>
                  <option value="PICK-UP">PICK-UP</option>
                  <option value="REST">REST</option>
                  <option value="DROP-OFF">DROP-OFF</option>
                  <option value="FINAL">FINAL</option>
                 
                </select>
               </td>


               <td> 

           <input type="text" name="sequence[]" class="form-control sequence" value="1">
              
               </td>
             

              

                
          
             
               <td> 

                <input type="text" class="form-control" name="addInfo[]" >
              
               </td>

               <td>
              
                <button class="btn btn-xs btn-danger delete-route" data-delete="no"> <span class="glyphicon glyphicon-trash"></span> </button>

               </td>
            
            </tr>

@endforelse
          </tbody>


        </table>
             <div class="clearfix"></div>

        </div>
     </div> 


         
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-md-3  pull-left text-left">
          <button class="btn btn-xs btn-warning add-newRoutes" data-type="newroute"> + </button>
        </div>
          <div class="col-md-3  pull-right text-right">
          <button class="btn btn-primary submit-point">Submit</button>
         <a href='{{ route('route.index') }}' class="btn btn-warning">Back</a>
        </div>
        <div class="clearfix"></div>
        </div>
      </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>

    <div class="hide"  style="display: none">
      <table id="CtackTable">
        <tr>

       
          <td>
         <input type="text" class="form-control" value="-"  readonly="">

          </td>
          <td>
         <input type="text" class="form-control rtid" value="{{$Route->ROUTE_ID}}" readonly="">

          </td>

      <td>
            <select class="form-control state" name="state[]" data-cls="ocity" id="ostate" name="ostate"  data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}">{{ $State->NAME }}</option>
                    @endforeach
                  </select>
      </td>


              <td>
          <input type="hidden" name="oldId[]" value="0">


 <input class="form-control search-city" placeholder="City" name="cityName[]"  type="text" oninput="clientSelOpt(this)"  autocomplete="something" />
                <input type="hidden" class="cityinput"  name="city[]"> 
               </td>
               <td>

                <select class="form-control select2 rtype"  name="type[]" >
                  <option value="">Select Type</option>
                  <option value="START">START</option>
                  <option value="PICK-UP">PICK-UP</option>
                  <option value="REST">REST</option>
                  <option value="DROP-OFF">DROP-OFF</option>
                  <option value="FINAL">FINAL</option>
                 
                </select>
               </td>

               <td> 

         <input type="text" name="sequence[]" class="form-control sequence" value="1">
              
               </td>
               
              
          
                <td> 

                <input type="text" class="form-control" name="addInfo[]"  value="">
              
               </td>
                
             
               <td>
              
                <button class="btn btn-xs btn-danger delete-route" data-delete="no"> <span class="glyphicon glyphicon-trash"></span> </button>

               </td>
             
            </tr>
        </table>
    </div>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/dist/js/info.js') }}"></script>
<script src="{{ asset('admin/plugins/timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jQueryUI/jquery-ui.min.js') }}"></script>


<script>
updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {

  

       $(document).on('click', ".add-newRoutes", function(e) {

        e.preventDefault;
        var totalRowCount = $("#CRoutesMDetail tr").length;

     var cloned = $('#CtackTable tr:last').clone().end();
    

     
        cloned.clone().appendTo('#CRoutesMDetail tbody'); 

        $(".timepicker").hunterTimePicker();
      $('#CRoutesMDetail tbody').find('tr').each(function() {
        var index=$(this).index()+1;
         $(this).find('.sequence').val(index);
         $(this).find('.search-city').attr('id','search-city-'+index);
     
        }); 

          
        
          return false;
          });

            $(document).on('click', ".delete-route", function(e) {
 
    e.preventDefault;

       var t=this;
    var con = confirm('Are you sure to delete this ?');
    var id=$(this).attr('data-delete');
            if(con == true) {
              if(id == 'no'){
        $(t).parent('td').parent('tr').remove();

              }
              else{
         $.ajax({
        url: "{{route('deletePoint')}}",
        type: "POST",
        data : {id:id, _token: "{{csrf_token()}}"},
       
        success: function(data){
          $(t).parent('td').parent('tr').remove();

        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
              }
              
          }
   });
      
  
    
   $(".timepicker").hunterTimePicker();

       
  $(document).on('change', ".statezz", function(e) {
      e.preventDefault;
      var cls=$(this).parent('td').parent('tr').find('.scity');
     
      var country=$(this).find('option:selected').val();

    if(country != '')
      $.ajax({
        url: "{{route('getCity')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
          
        cls.empty();
       cls.html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  

  }); 



       $(document).on('click', ".submit-point", function(e) {
    
    e.preventDefault;
    
       var errorCounter = validateForm();

    if (errorCounter > 0) {
      console.log('error');
    }

    else{
      
    if($("#add_route_table").find('tr').length > 1 ){
    var shiftSub=$(this).attr('data-shiftsub');
    var Dtype=$(this).attr('data-type');
    
        $.ajax({

        url: "{{route('addRoutePoint')}}",
        type: 'POST',
        data: $("#add_route_table :input").serialize()+"&routeId=<?php echo $Route->ROUTE_ID ?>",
        dataType: 'json',
        success: function(data){
             $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
           $("#response .message").html('Update Success');
           location.reload();
      }
 
        
        });
    }
  }
  });
     


var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });

    return $helper;
},
   /*  updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            //$(this).html(i + 1);
      alert(i)
        });
    }; */
  updateIndex = function(event, ui) {

  $(this).find('tr').each(function() {
            var index=$(this).index()+1;

         $(this).find('.sequence').val(index);
        });
    
    }
$("#add_route_table>tbody").sortable({
  
    helper: fixHelperModified,
    update: updateIndex
}).disableSelection();

});

    function clientSelOpt(t) {
    var id='#'+t.id;
   $(t).next('.cityinput').val(''); // save selected id to input

       $(id).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "{{route('getCityJson')}}",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term, _token: "{{csrf_token()}}"
    },
    success: function( data ) {
      response( $.map( data, function( item ) {

                        return {    label: item.label,
                                    value: item.label,
                                    mid: item.value,
                                   

                                    }
                    }));
    }
   });
  },
   change: function(event,ui) {

      var input = $(t).val().trim();
    
        if ( input == '') {
            $(t).next('.cityinput').val(''); // save selected id to input

        }
   },
  select: function (event, ui) {
   // Set selection

   $(id).val(ui.item.label); // display the selected text
  $(t).next('.cityinput').val(ui.item.mid); // save selected id to input

   return false;
  },
      
  
 }).focus(function () {
    
    $(this).autocomplete("search");
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {


      return $( "<li>" )
        .append( "<div class='underline'><i class='fa fa-map-marker' aria-hidden='true'></i> " + item.label + "</div>" )
        .appendTo( ul );
    };


  }

</script>
@endsection