<?php 
use App\Helper\serviceHelper;
?>
<div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Company</h3>
            <p>
              {{ serviceHelper::getSettings('LOCATION')->value }}<br><br>
              <strong>Phone:</strong>{{ serviceHelper::getSettings('PHONE1')->value }}<br>
              <strong>Email:</strong> {{ serviceHelper::getSettings('EMAIL1')->value }}<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>SERVICES</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Stocks</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Futures & Options</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">IPOs</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Mutual Funds</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Fixed Deposit</a></li>
              

              
              
              
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>KALPATARU</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('about') }}">About Us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/career') }}">Career</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contact Us</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>QUICK LINKS</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/user/login') }}">Login</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/services') }}">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/testimonials') }}">Testimonials</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">FAQ</a></li>              
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>