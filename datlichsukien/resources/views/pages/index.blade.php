@extends('pages.home')
@section('content-section')

  <!-- PAGE -->
        <section class="page-section with-sidebar sidebar-right first-section">
            <div class="container">

                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar col-sm-4 col-md-3">

                    <div class="widget google-map-widget">
                        <!-- Google map -->
                        <div class="google-map">
                            <div id="map-canvas"></div>
                        </div>
                        <!-- /Google map -->
                        <a href="#" class="link"><i class="fa fa-map-marker"></i> ISTANBUL,TURKEY</a>
                    </div>

                    <div class="widget">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!--div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Event Type
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Date
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Price
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </aside>
                <!-- /Sidebar -->

                <hr class="page-divider transparent visible-xs"/>

                <!-- Content -->
                <section id="content" class="content col-sm-8 col-md-9">

                    <div class="listing-meta">

                        <div class="filters">
                            <a href="#">Business <i class="fa fa-times"></i></a>
                            <a href="#">Networking <i class="fa fa-times"></i></a>
                            <a href="#">Free <i class="fa fa-times"></i></a>
                        </div>

                        <div class="options">
                            <a class="byrevelance" href="#">Revelance</a>
                            <a class="bydate active" href="#">DATE</a>
                            <a class="view-list" href="#"><i class="fa fa-th-list"></i></a>
                            <a class="view-th active" href="#"><i class="fa fa-th"></i></a>
                        </div>

                    </div>

                    <div class="row thumbnails events">

                        <div class="col-md-4 col-sm-6 isotope-item festival">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item miscellaneous">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item conference playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- /Pagination -->

                </section>
                <!-- /Content -->

            </div>
        </section>
@endsection