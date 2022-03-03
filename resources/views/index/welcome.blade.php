@extends('layouts.guest')
@section("pageTitle", "Welcome To EsgCarsc")
@section("currentPageIndex", "active")
@section('closeAllCategoty', '')
@section('pageContent')



  <main>

    <!--  CTA  -->
    <section class="cta-img" id="cta-img">
      <div class="cta-banner">
        <div class="cta-wrapper">
          <h1>DOCUMENT MANAGEMENT SYSTEM</h1>
          <h2>This system manages your file and secury is guarantee</h2>
          <a href="javascript:void(0)" class="quote">Get Started</a>
        </div><!--   end cta-wrapper     -->
      </div><!--   end cta-banner     -->
    </section>

    {{-- <!--  Products  -->
    <section class="products" id="products">
      <h2>Products</h2>
      <div class="products-wrap">
        <div class="product-item">
          <img class="beam-img" src="https://res.cloudinary.com/sharonnt/image/upload/v1533717065/beam-grey.png" width="80" alt="Beams" title="Beams">
          <div class="product-description">
            <p class="product-label">Beams</p>
            <hr class="hr-line">
            <ul class="item-type">
              <li>W Beams</li>
              <li>I-Beams</li>
              <li>H-Beams</li>
              <li>Channel-Beams</li>
            </ul>
          </div>
          <a href="javascript:void(0)">More</a>
        </div>
        <div class="product-item">
          <img class="bolt-img" src="https://res.cloudinary.com/sharonnt/image/upload/v1533749757/bolt-grey.png" width="80" alt="Bolts" title="Bolts">
          <div class="product-description">
            <p class="product-label">Bolts</p>
            <hr class="hr-line">
            <ul class="item-type">
              <li>Hex Bolts</li>
              <li>Machine Screws</li>
              <li>Socket Head Screws</li>
              <li>Carriage Bolts</li>
              <li>Lag Bolts</li>
            </ul>
          </div>
          <a href="javascript:void(0)">More</a>
        </div>
        <div class="product-item">
          <img class="bar-img" src="https://res.cloudinary.com/sharonnt/image/upload/v1533717065/bar-grey.png" width="80" alt="Bars" title="Bars">
          <div class="product-description">
            <p class="product-label">Bars</p>
            <hr class="hr-line">
            <ul class="item-type">
              <li>Mild Steel Bars</li>
              <li>Deformed Steel Bars</li>
            </ul>
          </div>
          <a href="javascript:void(0)">More</a>
        </div>
        <div class="product-item">
          <img class="compass-img" src="https://res.cloudinary.com/sharonnt/image/upload/v1533749758/compass-grey.png" width="80" alt="Design" title="Design">
          <div class="product-description">
          <p class="product-label">Design</p>
            <hr class="hr-line">
            <ul class="item-type">
              <li>CAD</li>
              <li>On-Site Survey</li>
            </ul>
          </div>
          <a href="javascript:void(0)">More</a>
       </div>
      </div>
    </section>

    <!-- Clients-video   -->
    <section class="clients-video" id="clients-video">
      <div class="project-bridge">
        <h2><span>Project success story</span>:<br>Cebu-Cordova bridge, Philippines</h2>
        <div class="video-wrapper">
        <iframe id="video" height="315" src="https://www.youtube.com/embed/JdGYyiutwXE?wmode=opaque" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      </div>
      <div class="customers">
        <h3>Our Customers</h3>
        <div class="client-logo-wrapper">
          <img src="https://res.cloudinary.com/sharonnt/image/upload/v1535569285/client-1.jpg" width="130">
          <img src="https://res.cloudinary.com/sharonnt/image/upload/v1535569862/client-2.jpg" width="130">
          <img src="https://res.cloudinary.com/sharonnt/image/upload/v1535569994/client-3.jpg" width="130">
          <img src="https://res.cloudinary.com/sharonnt/image/upload/v1535570114/client-4.jpg" width="130">
        </div>
      </div>
      <div class="quote-wrapper">
        <blockquote>
          <p>Holdfast Steel took the time to learn our project requirements to make cost-saving recommendations. Their Sales and Technical support is world-class. Responses are fast and accurate, ensuring the quick expedition of deliveries.”</p>
        </blockquote>
        <cite>
          <span>Thomas Bolt</span><br>
          Operations VP<br>
          Bridges & Sons Limited
        </cite>
      </div>
    </section> --}}


@endsection

@section('style')
    <style>

    </style>
@endsection

@section('script')
    <script>

    </script>
@endsection
