 <header class="header fixed">
        <div class="container">
            <div class="header-wrapper clearfix">

            <!-- Logo -->
            <div class="logo">
                <a href="index.html" class="scroll-to">
                    <span class="fa-stack">
                        <i class="fa logo-hex fa-stack-2x"></i>
                        <i class="fa logo-fa fa-map-marker fa-stack-1x"></i>
                    </span>
                    im Event
                </a>
            </div>
            <!-- /Logo -->

            <!-- Navigation -->
            <div id="mobile-menu"></div>
            <nav class="navigation closed clearfix">
                <a href="#" class="menu-toggle btn"><i class="fa fa-bars"></i></a>
                <ul class="sf-menu nav">
                    <li class="active">
                        <a href="index.html">Home</a>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="index-2.html">Home 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="event-list.html">Events</a>
                        <ul>
                            <li><a href="event-list.html">Event List</a></li>
                            <li><a href="event-grid.html">Event Grid</a></li>
                            <li><a href="event-single.html">Single Event</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">Pages</a>
                        <ul>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                            <li><a href="coming-soon-1.html">Coming Soon 1</a></li>
                            <li><a href="coming-soon-2.html">Coming Soon 2</a></li>
                            <li><a href="coming-soon-3.html">Coming Soon 3</a></li>
                            <li><a href="error-page.html">404</a></li>
                        </ul>
                    </li>
                    <li><a href="contact-us.html">Contact Us</a></li>
                    <li class="header-search-wrapper">
                        <form action="#" class="header-search-form">
                            <input type="text" class="form-control header-search" placeholder="Search"/>
                            <input type="submit" hidden="hidden"/>
                        </form>
                    </li>
                    <li><a href="" class="btn-search-toggle"><i class="fa fa-search"></i></a></li>
                  
                 <li><a  href="{{ route('show.register') }}"><i class="fa fa-file-text-o"></i> Register Now</a></li>
                    <li><a href="{{ route('show.login') }}"><i class="fa fa-user"></i> Login</a></li>
                </ul>

            </nav>

            
            <!-- /Navigation -->

            </div>
        </div>
       
    </header>


    <!-- /HEADER -->