@extends('layouts.body')

@section('content')
<!-- ======= Breadcrumbs ======= -->

    <section id="breadcrumbs" class="breadcrumbs">

      <div class="container">



        <div class="d-flex justify-content-between align-items-center">

          <h2>{!! $page['title'] !!}</h2>

          <ol>

            <li><a href="{{ url('/') }}">Home</a></li>

            <li>{!! $page['title'] !!}</li>

          </ol>

        </div>



      </div>

    </section><!-- End Breadcrumbs -->

    
    <section id="contact" class="contact">

      <div class="container">

        <div class="row mt-5 justify-content-center" data-aos="fade-up">

          <div class="col-lg-4">
            @include(('include.sidebar'))            
          </div>
          <div class="col-lg-8">
            Content coming soon..

          </div>


        </div>



      </div>

    </section><!-- End Contact Section -->

@endsection
