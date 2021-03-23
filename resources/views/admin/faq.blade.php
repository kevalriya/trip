<?php 
$ActiveSide='faq';
?>  
@extends('admin.layouts.app')

@section('title','Fleet Type')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">

    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">FAQ</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">FAQ</h3>
        <a href="{{route('addfaq')}}" class='col-md-2 pull-right btn btn-success' >Add New</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Question</th>
                          <th>Action</th>
                        
                         
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($FAQS as $FAQ)
                          <tr>
                           
                            <td >{{ $FAQ->QUE }}</td>
                         
                              <td>
                             <a href="{{route('editfaq',$FAQ->ID)}}" class="btn btn-xs btn-primary"> <span class="glyphicon glyphicon-edit"></span></a>

                              <form id="delete-form-{{ $FAQ->ID }}" method="post" action="{{ route('faqdelete',$FAQ->ID) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <button  class="btn btn-xs btn-danger"  onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{$FAQ->ID }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></button>

                              </td>
                            </tr>
                          </tr>
                        @endforeach
                        </tbody>
                      
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->


  </section>

    
  
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function() {
     
  
$('#dataTables').DataTable();

 });
</script>
@endsection