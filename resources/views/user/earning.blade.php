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
                    <span class="mb-3 heading-text">Earning</span>
                </div>
                <div class="wow fadeInUp " data-wow-delay="0.5s">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert"> 
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                          {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="row ">
                        <div class="col-lg-2 col-md-6 mt-4 mt-lg-0 ">
                        </div> 
                        <div class="col-lg-8 col-md-6 mt-4 mt-lg-0 "> 
                            <table class="table table-striped">
                                
                                @if(count($data)>0)
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Year</th>
                                        <th scope="col" class="text-end">Earning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $details)
                                    <tr>
                                        <th scope="row">{!! $details['sl'] !!}</th>
                                        <td>{!! $details['month'] !!}</td>
                                        <td>{!! $details['year'] !!}</td>
                                        <td class="text-end">{!! $details['amount'] !!}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th class="table-dark" colspan="3">Total Earning</th>
                                        <td class="table-dark text-end">{!! $total !!}</td>
                                    </tr>
                                </tbody>
                                @else
                                    <tr>
                                        <th class="table-dark" >You do not have any earning.</th>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                        
                        
                            
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- About End -->

@endsection
@section('styles')
  
@endsection
@section('scripts')

  
@endsection