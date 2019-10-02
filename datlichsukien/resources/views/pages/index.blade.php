@extends('pages.home')
@section('content-section')
<section class="page-section">
            <div class="container">

                <div class="clear clearfix overflowed">
                    <div class="section-title pull-left" style="width: auto;">
                        <span class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-star fa-stack-1x"></i></span></span>
                    </div>
                    <ul id="filtrable-events" class="filtrable clearfix">
                        <li class="all"><a href="#" data-filter="*">All</a></li>
                        <li class="festival current"><a href="#" data-filter=".festival">Festival</a></li>
                        <li class="playground"><a href="#" data-filter=".playground">Playground</a></li>
                        <li class="conferance"><a href="#" data-filter=".conference">Conference</a></li>
                    </ul>
                </div>

                <div class="row thumbnails events vertical isotope isotope-items">

                    <div class="col-md-6 col-sm-6 isotope-item festival">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item conference">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item miscellaneous">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item festival playground">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item festival conference">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item conference playground">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item festival conference">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 isotope-item playground">
                        <div class="thumbnail no-border no-padding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                        <img src="assets/img/preview/event-1.jpg" alt="">
                                        <div class="caption hovered"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                        <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October at 20:00 - 22:00 on Manhattan / New York</p>
                                        <p class="caption-price">Tickets from $49,99</p>
                                        <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                                        <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center margin-top">
                    <a data-animation="fadeInUp" data-animation-delay="100" href="#" class="btn btn-theme btn-theme-grey-dark btn-theme-md"><i class="fa fa-file-text-o"></i> See all events</a>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section light">
            <div class="container">

                <div class="row thumbnails info-thumbs clear">
                    <div class="col-sm-6 col-md-3" data-animation="fadeInUp" data-animation-delay="100">
                        <div class="thumbnail no-border no-padding text-center">
                            <div class="rehex">
                                <div class="rehex-deg">
                                    <div class="rehex-deg">
                                        <div class="rehex-inner">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-calendar"></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title">7/24 Event avaliable</h3>
                                <p class="caption-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vel velit</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Details</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                    <div class="col-sm-6 col-md-3" data-animation="fadeInUp" data-animation-delay="300">
                        <div class="thumbnail no-border no-padding text-center">
                            <div class="rehex">
                                <div class="rehex-deg">
                                    <div class="rehex-deg">
                                        <div class="rehex-inner">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-map-marker"></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title">Great Locations</h3>
                                <p class="caption-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vel velit</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Details</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                    <div class="col-sm-6 col-md-3" data-animation="fadeInUp" data-animation-delay="500">
                        <div class="thumbnail no-border no-padding text-center">
                            <div class="rehex">
                                <div class="rehex-deg">
                                    <div class="rehex-deg">
                                        <div class="rehex-inner">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-users"></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title">More Then 200 Speakers</h3>
                                <p class="caption-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vel velit</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Details</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                    <div class="col-sm-6 col-md-3" data-animation="fadeInUp" data-animation-delay="700">
                        <div class="thumbnail no-border no-padding text-center">
                            <div class="rehex">
                                <div class="rehex-deg">
                                    <div class="rehex-deg">
                                        <div class="rehex-inner">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-music"></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title">Lets Party After Event</h3>
                                <p class="caption-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vel velit</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

        <!-- PAGE -->
        <section class="page-section">
            <div class="container">

                <h1 class="section-title">
                    <span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-h-square fa-stack-1x"></i></span></span>
                    <span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">HOTELS <small> / dont forget book your room</small></span>
                </h1>

                <div class="row thumbnails hotels">

                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/hotel-1.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons"><a href="#" class="btn btn-theme caption-link"><i class="fa fa-file-text"></i> Details</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title"><a href="#">Standard Hotel Name Here</a></h3>
                                <div class="caption-rating rating">
                                    <span class="star"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span>
                                </div>
                                <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Book</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/hotel-1.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons"><a href="#" class="btn btn-theme caption-link"><i class="fa fa-file-text"></i> Details</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title"><a href="#">Standard Hotel Name Here</a></h3>
                                <div class="caption-rating rating">
                                    <span class="star"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span>
                                </div>
                                <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Book</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/hotel-1.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons"><a href="#" class="btn btn-theme caption-link"><i class="fa fa-file-text"></i> Details</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title"><a href="#">Standard Hotel Name Here</a></h3>
                                <div class="caption-rating rating">
                                    <span class="star"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span>
                                </div>
                                <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Book</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/hotel-1.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons"><a href="#" class="btn btn-theme caption-link"><i class="fa fa-file-text"></i> Details</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title"><a href="#">Standard Hotel Name Here</a></h3>
                                <div class="caption-rating rating">
                                    <span class="star"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span><!--
                                                        --><span class="star active"></span>
                                </div>
                                <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.</p>
                                <p class="caption-more"><a href="#" class="btn btn-theme">Book</a></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center margin-top">
                    <a data-animation="fadeInUp" data-animation-delay="100" href="#" class="btn btn-theme btn-theme-grey-dark btn-theme-md"><i class="fa fa-h-square"></i> See all hotels</a>
                </div>

            </div>
        </section>
        
        <section class="page-section no-padding-bottom">
            <div class="container">
                <div class="section-title pull-left" style="width: auto;">
                    <span class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-star fa-stack-1x"></i></span></span>
                </div>
                <ul id="filtrable-gallery" class="filtrable clearfix">
                    <li class="all current"><a href="#" data-filter="*">All</a></li>
                    <li class="photos"><a href="#" data-filter=".photos">Photos</a></li>
                    <li class="videos"><a href="#" data-filter=".videos">Videos</a></li>
                    <li class="gallery"><a href="#" data-filter=".gallery">Gallery</a></li>
                </ul>
                <div class="clear clearfix overflowed"></div>
            </div>
        </section>

        <section class="page-section no-padding-top light">
            <div class="container full-width">

                <div class="row thumbnails no-padding gallery isotope isotope-items">

                    <div class="col-md-3 col-sm-6 isotope-item photos ">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-1a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">CONFERENCE PARTY</h3>
                                            <p class="caption-category">in Istanbul</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item videos">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-2a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">FINDING NEW WAY EVENT</h3>
                                            <p class="caption-category">in Tokyo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item gallery">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-3a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">PHP MEETING</h3>
                                            <p class="caption-category">in Foshan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item photos gallery">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-4a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">CONFERENCE PARTY</h3>
                                            <p class="caption-category">in Manhattan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item photos videos">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-5a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">WINNING AWARDS MEETING</h3>
                                            <p class="caption-category">in Istanbul</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item videos gallery">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-6a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">GALLERY IMAGE NAME</h3>
                                            <p class="caption-category">in Tokyo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item photos videos">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-7a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">EVERYBODY HERE EVENT</h3>
                                            <p class="caption-category">in Foshan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 isotope-item gallery">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="assets/img/preview/latest-8a.jpg" alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="#" class="btn caption-zoom"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="btn caption-link"><i class="fa fa-plus"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption hovered back">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title">YOGA CLASS MET AT AUGUST</h3>
                                            <p class="caption-category">in Manhattan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-center margin-top">
                    <a data-animation="flipInY" data-animation-delay="500" href="#" class="btn btn-theme btn-theme-grey-dark btn-theme-md"><i class="fa fa-photo"></i> See All Gallery</a>
                </div>

            </div>
        </section>
       
        <!-- /PAGE -->

        <!-- PAGE LOCATION -->
        <section class="page-section" id="location">
            <div class="container full-width gmap-background">

                <div class="container">
                    <div class="on-gmap color">
                        <h1 class="section-title">
                            <span data-animation="flipInY" data-animation-delay="100" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
                            <span data-animation="fadeInRight" data-animation-delay="100" class="title-inner">Event Location</span>
                        </h1>
                        <p data-animation="fadeInUp" data-animation-delay="200" class="text-uppercase">Apple Store SOHO‎ <br/>
                            103 Prince St New York, <br/>
                            NY 10012, United States <br/>
                            +1 212-226-3126</p>
                        <p><a href="mailto:youremail@domain.com">hello@imevent.com</a></p>
                        <a href="#" class="btn btn-theme"
                           data-animation="flipInY" data-animation-delay="300">Get Direction <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Google map -->
                <div class="google-map">
                    <div id="map-canvas"></div>
                </div>
                <!-- /Google map -->

            </div>
        </section>
        <!-- /PAGE LOCATION -->


    </div>
    <!-- /Content area -->
@endsection