@extends('layouts.body')

@section('content')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-centerp">
            <div class="col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                @include(('include.sidebar'))
            </div>

            <div class="col-lg-9 wow fadeIn" data-wow-delay="0.5s">
                <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                    <span class="aux-head-before heading-text">My</span>
                    <span class="mb-3 heading-text">Listing</span>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    
                    <ul id="tree1">  
                      @foreach($categories as $category)
                        <li>                    
                          <a data-bs-html="true" href="javascript:void(0);"  data-bs-toggle="tooltip" title="<div class='row'><div class='col-lg-12'><div class='col-lg-12'><img class='img-thumbnail' width='200' src='{{ $arr['image'] }}' /></div><div class='col-lg-12'><div><span class='tool_heading'>Name : </span><span class='tool_text'>{{ $arr['name'] }}</span></div><div><span class='tool_heading'>PAN : </span><span class='tool_text'>{{ $arr['pan'] }}</span></div><div><span class='tool_heading'>Mobile : </span><span class='tool_text'>{{ $arr['phone'] }}</span></div><div><span class='tool_heading'><img class='img-thumbnail' alt='money-bag' width='30' src='../public/icons8-money-bag-rupee-100.png' /> : </span><span class='tool_text'>{{ $arr['amount_display'] }}</span></div></div></div></div>" style="margin: 5px; color:{{ $arr['color'] }}" >
                          {{ $category->title }}
                          </a> 
                          @if(count($category->childs))
                            @include('manageChild',['childs' => $category->childs])
                          @endif
                        </li>
                    @endforeach
                    </ul>                    
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- About End -->

<style type="text/css">
    
    
</style>
@endsection
@section('styles')
  
  
  <link href="{{ asset('assets/css/treeview.css') }}" rel="stylesheet">
@endsection

@section('scripts')  
<script src="{{ asset('assets/js/treeview.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
@endsection