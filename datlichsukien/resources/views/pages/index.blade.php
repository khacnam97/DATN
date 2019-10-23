@extends('pages.home')
@section('content-section')
<div class="carousel slide" data-ride="carousel" id="demo">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li class="active" data-slide-to="0" data-target="#demo">
        </li>
        <li data-slide-to="1" data-target="#demo">
        </li>
        <li data-slide-to="2" data-target="#demo">
        </li>
    </ul>
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img alt="Los Angeles" height="500" src="https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2017/12/22223742/Events-1200x630.jpg" width="1100">
            </img>
        </div>
        <div class="carousel-item">
            <img alt="Chicago" height="500" src="https://www.ucb.ac.uk/content/images/courses/hospitality-tourism-events/events-management-3.jpg" width="1100">
            </img>
        </div>
        <div class="carousel-item">
            <img alt="New York" height="500" src="https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2017/12/22223742/Events-1200x630.jpg" width="1100">
            </img>
        </div>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" data-slide="prev" href="#demo">
        <span class="carousel-control-prev-icon">
        </span>
    </a>
    <a class="carousel-control-next" data-slide="next" href="#demo">
        <span class="carousel-control-next-icon">
        </span>
    </a>
</div>
<div class="row" style="height: 1000px; width: 100%; margin-top: 20px;" >
    <div class="col-3" style="background-color:  #e9ecef;">
        
        <div  style="width: 90%; margin-left: 5%; margin-top: 30px;">
            <div class="map-responsive">
                <iframe allowfullscreen="" frameborder="0" height="200" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=ĐaNang" style="border:0" width="300">
                </iframe>
            </div>
        </div>
        <div style="width: 90%; margin-left: 5%; margin-top: 30px;">
            <form class="form-inline">
                <input aria-label="Search" class="form-control" placeholder="Search" type="search">
                    <button class="btn btn-outline-success " type="submit">
                        Search
                    </button>
                </input>
            </form>
        </div>
    </div>

    <div class="col-9">
    	<div class="row">
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
				  <img src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/1625503371011059215_wh_135" alt="Avatar" style="width:100%">
				  <div class="container">
				    <h4><b>John Doe</b></h4> 
				    <p>Architect & Engineer</p> 
				  </div>
				</div>
    		</div>
    	</div>
    </div>

</div>
<div class="container">
	<div style="text-align: center;margin-top:50px;" id="contact">
		<h2 class="section-heading" style="color: #b3b3ba;">Contact Us</h2>
		<hr align="content" width="20%" color="#3997A6" size="0.1px" style="padding-bottom: 1px; margin-bottom: 40px;"> 
	</div>
	<div class="row"  style="justify-content: center;">
		<div class="col-sm-4 text-center">
			<a href="tel:+91-8238566835"><em style="color: #3997A6;" class="fa fa-phone fa-3x sr-contact"></em></a>
			<p>+84-199001950</p>
		</div>
		<div class="col-sm-4 text-center">
			<a href="info@travelbrewery.com"><em style="color: #3997A6;" class="fa fa-envelope fa-3x sr-contact"></em></a>
			<p>Nam@gmail.com</p>
		</div>
	</div>
</div>
@endsection
