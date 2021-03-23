<?php 
$ActiveSide='faq';
?>  
@extends('front.layouts.app')

@section('title','TripOn - FAQ')
@section('headSection')

  <style type="text/css">
      .panel-title > a{
        background: transparent;
      }
      .panel-success > .panel-heading {
    color: #ffffff;
    background-color: #ed8323;
    border-color: #d6e9c6;
}

.accordion-section a:hover {
    color: #ece8e8;
    text-decoration: none;
}
  </style>
  @endsection
  @section('main-content')
    <section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
  <div class="container">
  
      <h2 class="page-title">Frequently Asked Questions </h2>
      <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
       @forelse ($Faqs as $Faq)

        <div class="panel panel-success">
          <div class="panel-heading p-3 mb-3" role="tab" id="heading{{$Faq->ID}}">
            <h3 class="panel-title">
              <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion-{{$Faq->ID}}" href="#collapse{{$Faq->ID}}" aria-expanded="true" aria-controls="collapse{{$Faq->ID}}">
                {{$Faq->QUE}}
              </a>
            </h3>
          </div>
          <div id="collapse{{$Faq->ID}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$Faq->ID}}">
            <div class="panel-body px-3 mb-4">
                {!! $Faq->ANS !!}
            </div>
          </div>
        </div>

        @empty
            <p>No FAQ found</p>
        @endforelse
        
      </div>
  
  </div>
</section>


           


  @endsection
