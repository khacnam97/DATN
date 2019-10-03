@extends('layouts.app')

@section('content')
<!-- SLIDER -->
<section class="page-section no-padding background-img-slider">
    <div class="container">

        <div id="main-slider" class="owl-carousel owl-theme">

            <!-- Slide -->
            <div class="item page text-center slide5">
                <div class="caption">
                    <div class="container">
                        <div class="div-table">
                            <div class="div-cell">
                             
                             
                                <h3 class="caption-subtitle" data-animation="fadeInUp" data-animation-delay="300">PHP Conference ın Manhattan</h3>
                                
                                <p class="caption-text">
                                    <a class="btn btn-theme btn-theme scroll-to" href="#" data-animation="flipInY" data-animation-delay="600">Register</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide -->
            <div class="item page text-center slide4">
                <div class="caption">
                    <div class="container">
                        <div class="div-table">
                            <div class="div-cell">
                                <h3 class="caption-subtitle">We are Event professionals</h3>
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <form action="#" class="location-search">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control text" placeholder="FIND EXPERIENCES"/>
                                                    <select class="selectpicker">
                                                        <option>LOCATION</option>
                                                        <option>LOCATION</option>
                                                        <option>LOCATION</option>
                                                    </select>
                                                    <button class="form-control button-search"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <p class="caption-text">
                                <a class="btn btn-theme btn-theme btn-theme-dark scroll-to" href="#" data-animation="flipInY" data-animation-delay="600">Popular Events</a><!--
                            --><a class="btn btn-theme btn-theme btn-theme-transparent-white" href="http://www.youtube.com/watch?v=O-zpOMYRi0w" data-gal="prettyPhoto" data-animation="flipInY" data-animation-delay="900">Latest Events</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
</section>
<!-- /SLIDER -->
</div>
<main class="container" >
  @yield('content-section')
</main>
@endsection