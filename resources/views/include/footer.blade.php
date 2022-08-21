<?php 
use App\Helper\serviceHelper;
use App\Helper\general;
?>
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
      <div class="row g-5">
          <div class="col-lg-3 col-md-6">
              <h5 class="text-white mb-4">Get In Touch</h5>
              <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ serviceHelper::getSettings('LOCATION')->value }}</p>
              <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ serviceHelper::getSettings('PHONE1')->value }}</p>
              <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ serviceHelper::getSettings('EMAIL1')->value }}</p>
              <div class="d-flex pt-2">
                  <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                  <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                  <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                  <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <h5 class="text-white mb-4">Quick Links</h5>
              <a class="btn btn-link text-white-50" href="{{ url('/about') }}">About Us</a>
              <a class="btn btn-link text-white-50" href="{{ url('/services') }}">Our Services</a>
              <a class="btn btn-link text-white-50" href="{{ url('/testimonials') }}">Testimonials</a>              
              <a class="btn btn-link text-white-50" href="{{ url('/privacy') }}">Privacy Policy</a>
              <a class="btn btn-link text-white-50" href="{{ url('/terms') }}">Terms & Condition</a>
          </div>
          <div class="col-lg-3 col-md-6">
              <h5 class="text-white mb-4">Photo Gallery</h5>
              <div class="row g-2 pt-2">
                  <?php
                    $gallery_images=general::footerGallery();
                   //dd($gallery_images);
                  ?>
                  @foreach($gallery_images as $fimages)
                  <div class="col-4">
                      <img class="rounded bg-light p-1" src="{!! $fimages['image'] !!}" alt="{!! $fimages['image'] !!}" width="80" height="54">
                  </div>
                  @endforeach
                  
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <h5 class="text-white mb-4">Share Market</h5>
              <!-- <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
              <div class="position-relative mx-auto" style="max-width: 400px;">
                  <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                  <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
              </div> -->
              <?php
                $livemarket=general::livemarket();
               //dd($livemarket);
              ?>
              <div class="ticker-wrapper-h">
                <div class="heading">Live</div>
                
                <ul class="news-ticker-h">
                  @foreach($livemarket as $mkt)
                    <li><a href="#" class="black"><strong>{!! $mkt['title'] !!}-</strong></a> 
                        <span class="black">{!! $mkt['curvalue'] !!}
                          {!! $mkt['arrowclass'] !!}
                          <span class="{!! $mkt['colorclass'] !!}">{!! $mkt['changeval'] !!}{!! $mkt['changeper'] !!}</span>
                        </span> || </li>
                  @endforeach
                </ul>
              </div>
          </div>
      </div>
  </div>
  <div class="container">
      <div class="copyright">
          <div class="row">
              <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                  &copy; <a class="border-bottom" href="https://kalpatarushares.com/">Kalpataru</a>, All Right Reserved. 
              </div>
              <div class="col-md-6 text-center text-md-end">
                  <div class="footer-menu">
                      <a href="https://www.nseindia.com" target="_blank">NSE</a>
                      <a href="https://www.bseindia.com" target="_blank">BSE</a>
                      <a href="https://www.mcxindia.com" target="_blank">MCX</a>
                      <a href="https://www.cdslindia.com" target="_blank">CDSL</a>
                      <a href="https://nsdl.co.in" target="_blank">NSDL</a>
                      <a href="https://www.sebi.gov.in" target="_blank">SEBI</a>
                      <a href="https://www.rbi.org.in" target="_blank">RBI</a>
                      <a href="https://www.irdai.gov.in" target="_blank">IRDA</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<style>
  /*****************************
* horizontal news ticker
******************************/

.ticker-wrapper-h{
  display: flex;  
  position: relative;
  overflow: hidden;
  border: 1px solid #1c6547;
  background: #ffffff;
}

.ticker-wrapper-h .heading{
  background-color: #1c6547;
  color: #fff;
  padding: 5px 10px;
  flex: 0 0 auto;
  z-index: 1000;
}
.ticker-wrapper-h .heading:after{
  content: "";
  position: absolute;
  top: 0;
  border-left: 20px solid #1c6547;
  border-top: 17px solid transparent;
  border-bottom: 15px solid transparent;
}


.news-ticker-h{
  display: flex;
  margin:0;
  padding: 0;
  padding-left: 90%;
  z-index: 999;
  
  animation-iteration-count: infinite;
  animation-timing-function: linear;
  animation-name: tic-h;
  animation-duration: 30s;
  
}
.news-ticker-h:hover { 
  animation-play-state: paused; 
}

.news-ticker-h li{
  display: flex;
  width: 100%;
  align-items: center;
  white-space: nowrap;
  padding-left: 20px;
}

.news-ticker-h li a{
  color: #212529;
  font-weight: bold;
}

@keyframes tic-h {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
  </style>