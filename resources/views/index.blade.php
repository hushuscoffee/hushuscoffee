<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Hushus Coffee | Home</title>
    
    <!-- Favicon  -->
    {{-- <link rel="icon" href="img/core-img/favicon.ico"> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  

    <!-- Style CSS -->
    {{-- <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="{{ asset('css/theme.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css')}}" type="text/css">
    <link rel="icon" href="{{ asset('images/logo/logo.png')}}">
    <style>
 .chip{
     border-radius: 50%;
 }
    </style>

</head>
<body>
    @include('partials._nav')
    <div id="preloader">
        <div class="preload-content">
            <div id="world-load"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- ***** Header Area Start ***** -->
    
     @include('partials._nav') 
    
    <!-- ***** Header Area End ***** -->

    <!-- ********** Hero Area Start ********** -->
    
    <!-- ********** Hero Area End ********** -->

    <div class="container" style="margin-top:90px">
            <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                    <!--Indicators-->
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-2" data-slide-to="1"></li>
                      <li data-target="#carousel-example-2" data-slide-to="2"></li>
                      <li data-target="#carousel-example-2" data-slide-to="3"></li>
                    </ol>
                    <!--/.Indicators-->
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                            <?php $flag=true; ?>
                            @foreach($brewings as $brewing)
                            @if($flag==true)
                            <div class="carousel-item active">
                            @else
                            <div class="carousel-item">
                            @endif
                            <div class="view">
                                    <center><img class="d-block" src="{{asset($brewing->file)}}" alt="First slide" style="width:1000px"></center>
                                          <div class="mask rgba-black-strong"></div>
                                        </div>
                                          <div class="carousel-caption">
                                            <h3 class="h3-responsive"><a style="color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);" href="{{route('brewing.show',$brewing->slug)}}">{{$brewing->title}}</a></h3>
                                            <p style="color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);">{{ substr(strip_tags($brewing->description), 0, 150)}} {{strlen(strip_tags($brewing->description))>150?"...":""}}</p>
                                          </div>  
                            </div>
                            <?php $flag=false; ?>
                            @endforeach
            
                            @foreach($recipes as $recipe)
                            <div class="carousel-item">
                            <div class="view">
                                    <center><img class="d-block" src="{{asset($recipe->file)}}" alt="First slide" style="width:1000px"></center>
                                          <div class="mask rgba-black-light"></div>
                                        </div>
                                          <div class="carousel-caption">
                                            <h3><a style="color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);" href="{{route('recipe.show',$recipe->slug)}}">{{$recipe->title}}</a></h3>
                                            <p style="color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);">{{ substr(strip_tags($recipe->description), 0, 150)}} {{strlen(strip_tags($recipe->description))>150?"...":""}}</p>
                                          </div>  
                            </div>
                            @endforeach
                                  
                      {{-- <div class="carousel-item active">
                        <div class="view">
                          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg" alt="First slide">
                          <div class="mask rgba-black-light"></div>
                        </div>
                        <div class="carousel-caption">
                          <h3 class="h3-responsive">Light mask</h3>
                          <p>First text</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <!--Mask color-->
                        <div class="view">
                          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(6).jpg" alt="Second slide">
                          <div class="mask rgba-black-strong"></div>
                        </div>
                        <div class="carousel-caption">
                          <h3 class="h3-responsive">Strong mask</h3>
                          <p>Secondary text</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <!--Mask color-->
                        <div class="view">
                          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(9).jpg" alt="Third slide">
                          <div class="mask rgba-black-slight"></div>
                        </div>
                        <div class="carousel-caption">
                          <h3 class="h3-responsive">Slight mask</h3>
                          <p>Third text</p>
                        </div>
                      </div> --}}
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                    <!--/.Controls-->
                  </div>
                  <!--/.Carousel Wrapper-->
    </div>
    <hr>
    <div class="main-content-wrapper">
        <div class="container">
            <!--Carousel Wrapper-->


            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="title sidebar-widget-area">
                            <h5 class="title">Latest Articles</h5>
                        </div>

                        <!-- Single Blog Post -->
                        @foreach($articles as $article)
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{asset($article->file)}}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div style="font-weight: Bolder;">
                                    @if($article->id_category==1)
            <strong><a href="{{route('recipe.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}" font-family="Avenir-Bold">{{$article->title}}</a></strong>
            @elseif($article->id_category==2)
            <a href="{{route('brewing.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}" font-family="Avenir-Bold">{{$article->title}}</a>
            @elseif($article->id_category==3)
            <strong><a href="{{route('news.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}" font-family="Avenir-Bold">{{$article->title}}</a></strong>
            @elseif($article->id_category==4)
            <strong><a href="{{route('tips.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}" font-family="Avenir-Bold">{{$article->title}}</a></strong>
            @elseif($article->id_category==5)
            <strong><a href="{{route('event.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}" font-family="Avenir-Bold">{{$article->title}}</a></strong>
            @endif
        </div>                                 
                                <p>{{ substr(strip_tags($article->description), 0, 200)}} {{strlen(strip_tags($article->description))>200?"...":""}}</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="{{ route('people.show', $article->id_user) }}" class="post-author">{{$article->profile->fullname}}</a> on <a href="#" class="post-date">{{$article->created_at}}</a></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Widget Area -->
                        {{-- <div class="sidebar-widget-area">
                            <h5 class="title">People</h5>
                            <div class="widget-content">
                                <!-- Single Blog Post -->
                                @foreach($brewings as $story)
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail" height="300px">
                                        <img class="chip" src="{{$story->file}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">{{$story->title}}</h5>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Newest People</h5>
                            <div class="widget-content">
                                {{-- <p>Find new informtation about coffee. Make your own recipes and techniques. Share it to public. Get your rating. Get updated coffee news and read many recipes from coffee maker. Make your own unique coffee. Share your story about coffee.</p> --}}
                                @foreach($people as $p)
                                <div class="row">
                                <div class="col-md-3">
                                        <div class="text-center">
                                                <a href=" {{ route('people.show', $p->id_user) }}">
                                            @if(($p->photo == 'images/unknown.png') && ($p->gender == 'Male'))
                                                <img src=" {{ asset('/images/man.png') }}" style="width: 6em" alt="default-man">
                                            @elseif(($p->photo == 'images/unknown.png') && ($p->gender == 'Female'))
                                                <img src=" {{ asset('/images/woman.png') }}" style="width: 6em" alt="default-woman">
                                            @else
                                                <img src="{{ asset('image/avatar/'. $p->photo) }}" style="width: 8em" alt="User Image">
                                            @endif</a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                            <a href=" {{ route('people.show', $p->id_user) }}">
                                                    <div style="font-family:Avenir-Medium;">{{ $p->fullname }}</div>
                                                    <p>{{ substr(strip_tags($p->aboutme), 0, 80)}} {{strlen(strip_tags($p->aboutme))>80?"...":""}}</p>
                                            </a>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                        {{-- <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Stay Connected</h5>
                            <div class="widget-content">
                                <div class="social-area d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-vimeo"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Widget Area -->
                        {{-- <div class="sidebar-widget-area">
                            <h5 class="title">Today’s Pick</h5>
                            <div class="widget-content">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post todays-pick">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="img/blog-img/b22.jpg" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content px-0 pb-0">
                                        <a href="#" class="headline">
                                            <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- <div class="row justify-content-center">
                <!-- ========== Single Blog Post ========== -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="img/blog-img/b4.jpg" alt="">
                            <!-- Post Content -->
                            <div class="post-content d-flex align-items-center justify-content-between">
                                <!-- Catagory -->
                                <div class="post-tag"><a href="#">travel</a></div>
                                <!-- Headline -->
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========== Single Blog Post ========== -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.4s">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="img/blog-img/b5.jpg" alt="">
                            <!-- Post Content -->
                            <div class="post-content d-flex align-items-center justify-content-between">
                                <!-- Catagory -->
                                <div class="post-tag"><a href="#">travel</a></div>
                                <!-- Headline -->
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========== Single Blog Post ========== -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.6s">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="img/blog-img/b6.jpg" alt="">
                            <!-- Post Content -->
                            <div class="post-content d-flex align-items-center justify-content-between">
                                <!-- Catagory -->
                                <div class="post-tag"><a href="#">travel</a></div>
                                <!-- Headline -->
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="world-latest-articles">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="title">
                            <h5>Latest Articles</h5>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b18.jpg" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.3s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b19.jpg" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.4s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b20.jpg" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.5s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b21.jpg" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="title">
                            <h5>Most Popular Videos</h5>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b7.jpg" alt="">
                                <!-- Catagory -->
                                <div class="post-cta"><a href="#">travel</a></div>
                                <!-- Video Button -->
                                <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.4s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="img/blog-img/b8.jpg" alt="">
                                <!-- Catagory -->
                                <div class="post-cta"><a href="#">travel</a></div>
                                <!-- Video Button -->
                                <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="headline">
                                    <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                </a>
                                <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

            <!-- Load More btn -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="load-more-btn mt-50 text-center">
                        <a href="#" class="btn world-btn">Load More</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
   @include('partials._footer')
    
    <!-- ***** Footer Area End ***** -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('js/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{ asset('js/active.js')}}"></script>
</body>