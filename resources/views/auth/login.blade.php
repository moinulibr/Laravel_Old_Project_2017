<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="EBUSi" />
<meta name="description" content="Business Management System" />
<meta name="developer" content="www.rdnetworkbd.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>EBUSi - Business Management Syatem</title>

<!-- favicon icon -->
<link rel="shortcut icon" href="https://ebusi.rdnetworkbd.com/images/favicon.png" />

<!-- inject css start -->
<!--== bootstrap -->
<link href="https://ebusi.rdnetworkbd.com/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<!--== animate -->
<link href="https://ebusi.rdnetworkbd.com/css/animate.css" rel="stylesheet" type="text/css" />
<!--== fontawesome -->
<link href="https://ebusi.rdnetworkbd.com/css/fontawesome-all.css" rel="stylesheet" type="text/css" />
<!--== line-awesome -->
<link href="https://ebusi.rdnetworkbd.com/css/line-awesome.min.css" rel="stylesheet" type="text/css" />
<!--== magnific-popup -->
<link href="https://ebusi.rdnetworkbd.com/css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
<!--== owl-carousel -->
<link href="https://ebusi.rdnetworkbd.com/css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
<!--== base -->
<link href="https://ebusi.rdnetworkbd.com/css/base.css" rel="stylesheet" type="text/css" />
<!--== shortcodes -->
<link href="https://ebusi.rdnetworkbd.com/css/shortcodes.css" rel="stylesheet" type="text/css" />
<!--== default-theme -->
<link href="https://ebusi.rdnetworkbd.com/css/style.css" rel="stylesheet" type="text/css" />
<!--== responsive -->
<link href="https://ebusi.rdnetworkbd.com/css/responsive.css" rel="stylesheet" type="text/css" />
<!--== color-customizer -->
<link href="https://ebusi.rdnetworkbd.com/css/theme-color/color-5.css" data-style="styles" rel="stylesheet">
<link href="https://ebusi.rdnetworkbd.com/css/color-customize/color-customizer.css" rel="stylesheet" type="text/css" />
<!-- inject css end -->

</head>

<body class="home">

<!-- page wrapper start -->

<div class="page-wrapper">

<!-- preloader start -->

<div id="ht-preloader">
  <div class="loader clear-loader">
    <div class="loader-box"></div>
    <div class="loader-box"></div>
    <div class="loader-box"></div>
    <div class="loader-box"></div>
	<div class="loader-box"></div>
    <div class="loader-wrap-text">
      <div class="text"><span>E</span><span>B</span><span>U</span><span>S</span><span>i</span><!--span>N</span><span>O</span-->
      </div>
    </div>
  </div>
</div>

<!-- preloader end -->


<!--header start-->

<header id="site-header" class="header">
  <div class="container">
    <div id="header-wrap">
      <div class="row">
        <div class="col-lg-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo" href="index.php">
              <img id="logo-img" class="img-center" src="https://ebusi.rdnetworkbd.com/images/ebusi-logo.svg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> 
			<span></span>
            <span></span>
            <span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <!-- Left nav -->
              <ul id="main-menu" class="nav navbar-nav ml-auto mr-auto">
                <li class="nav-item"> <a class="nav-link active" href="https://ebusi.rdnetworkbd.com/index.php"><i class="fas fa-home"></i></a></li>
				<li class="nav-item"> <a class="nav-link" href="#">EBUSi</a>
                    <ul>
                      <li><a href="https://ebusi.rdnetworkbd.com/invoice-billing.php">Invoice/Billing Software</a></li>
                      <li><a href="https://ebusi.rdnetworkbd.com/hr-payroll.php">HR & Payroll Software</a></li>
					  <li><a href="https://ebusi.rdnetworkbd.com/accounting-inventory.php">Accounting & Inventory Software</a></li>
					  <li><a href="https://ebusi.rdnetworkbd.com/pos-php">Point Of Sales(POS) Software</a></li>
                    </ul>
                </li>
				<li class="nav-item"> <a class="nav-link" href="https://www.rdnetworkbd.com/about-us.php">About</a></li>
				<li class="nav-item"> <a class="nav-link" href="https://www.rdnetworkbd.com/contact.php">Contact</a></li>
              </ul>
            </div>
            @if (Route::has('login'))
                @auth
                <a class="btn btn-white btn-sm" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                    <a class="btn btn-white btn-sm" href="" data-text="Login">
                        <span>L</span><span>o</span><span>g</span><span>i</span><span>n</span>
                    </a>

                    {{-- 
                     @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-white btn-sm" data-text="Register">
                            <span>R</span><span>e</span><span>g</span><span>i</span><span>s</span><span>t</span><span>e</span><span>r</span>
                        </a>
                    @endif
                    --}}    

                @endauth
            @endif
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>

<!--header end-->













<!--page title start-->

<section class="page-title o-hidden pos-r md-text-center" data-bg-color="#fbf3ed">
  <canvas id="confetti"></canvas>
  <div class="container">
    <div class="row align-items-center">
      <!--div class="col-lg-7 col-md-12">
        <h1 class="title"><span>L</span>ogin</h1>
        <p>We're Building Modern And High Software</p>
      </div>
      <div class="col-lg-5 col-md-12 text-lg-right md-mt-3">
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
          </ol>
        </nav>
      </div-->
    </div>
  </div>
  <div class="page-title-pattern"><img class="img-fluid" src="https://ebusi.rdnetworkbd.com/images/bg/11.png" alt=""></div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--login start-->

<section class="login" style="margin-top: -140px;padding-bottom: 100px;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12">
          <!---changes-->
        <img class="img-fluid" src="{{ asset('links') }}/img/banner/06.png" alt="ebusi" style="width: 300px;">
      </div>
      <div class="col-lg-5 col-md-12 ml-auto mr-auto md-mt-5">
        <div class="login-form text-center">
           <!---changes-->
        <img class="img-center mb-5" src="../images/ebusi-logo.svg" alt="">
        @if (Route::has('login'))
            @auth
          
            @else
          <form method="POST" action="{{ route('login') }}">
            @csrf
		  <div class="form-group has-feedback">
			<input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" data-error="Username is required." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

		  <div class="form-group has-feedback">
			<input type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  data-error="password is required.">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          
            <div class="form-group mt-4 mb-5">
              <div class="remember-checkbox d-flex align-items-center justify-content-between">
                <div class="checkbox">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
               
                {{-- 
                @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                --}}
              </div>
            </div> 
            <button type="submit" name="submit" class="btn btn-theme btn-block btn-circle" data-text="Sign in">
                <span>S</span><span>i</span><span>g</span><span>n</span><span> </span><span>I</span><span>n</span>
            </button>
          </form>
        
        {{-- <h5class="mb-0mt-4text-capitalize">Don'tHaveAnAccount?<ahref="route('register') "><i>Sign Up!</i></a></h5>--}}
          @endauth
        @endif

          
          <!--div class="social-icons fullwidth social-colored mt-4 text-center clearfix">
            <ul class="list-inline">
              <li class="social-facebook"><a href="#">Facebook</a>
              </li>
              <li class="social-twitter"><a href="#">Twitter</a>
              </li>
              <li class="social-gplus"><a href="#">Google Plus</a>
              </li>
            </ul>
          </div-->
        </div>
      </div>
    </div>
  </div>
</section>

<!--login end-->

</div>

<!--body content end--> 




<!--footer start-->

<footer class="footer dark-bg pos-r animatedBackground" data-bg-img="https://ebusi.rdnetworkbd.com/images/pattern/03.png">  
  <div class="footer-wave" data-bg-img="https://ebusi.rdnetworkbd.com/images/bg/08.png">
  </div>


  <div class="secondary-footer">
    <div class="container">
      <div class="copyright">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12"> <span>© 2020 EBUSi a product of <a href="https://rdnetworkbd.com">RD NETWORK BD</a></span>
          </div>
          <div class="col-lg-6 col-md-12 text-lg-right md-mt-3">
            <div class="footer-social">
              <ul class="list-inline">
                <li class="mr-2"><a href="https://www.facebook.com/rdnetworkbd/"><i class="fab fa-facebook-f"></i> Facebook</a>
                </li>
                <li class="mr-2"><a href="https://twitter.com/rdnbd"><i class="fab fa-twitter"></i> Twitter</a>
                </li>
                <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!--footer end-->


</div>




<!--back-to-top start-->

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-go-up-in-web"></i></a></div>

<!--back-to-top end-->

 
<!-- inject js start -->

<!--== jquery -->
<script src="https://ebusi.rdnetworkbd.com/js/jquery.min.js"></script>
<!--== popper -->
<script src="https://ebusi.rdnetworkbd.com/js/popper.min.js"></script>
<!--== bootstrap -->
<script src="https://ebusi.rdnetworkbd.com/js/bootstrap.min.js"></script>
<!--== appear -->
<script src="https://ebusi.rdnetworkbd.com/js/jquery.appear.js"></script> 
<!--== modernizr -->
<script src="https://ebusi.rdnetworkbd.com/js/modernizr.js"></script> 
<!--== easing -->
<script src="https://ebusi.rdnetworkbd.com/js/jquery.easing.min.js"></script> 
<!--== menu --> 
<script src="https://ebusi.rdnetworkbd.com/js/menu/jquery.smartmenus.js"></script>
<!--== owl-carousel -->
<script src="https://ebusi.rdnetworkbd.com/js/owl-carousel/owl.carousel.min.js"></script> 
<!--== magnific-popup --> 
<script src="https://ebusi.rdnetworkbd.com/js/magnific-popup/jquery.magnific-popup.min.js"></script>
<!--== counter -->
<script src="https://ebusi.rdnetworkbd.com/js/counter/counter.js"></script> 
<!--== countdown -->
<script src="https://ebusi.rdnetworkbd.com/js/countdown/jquery.countdown.min.js"></script> 
<!--== canvas -->
<script src="https://ebusi.rdnetworkbd.com/js/canvas.js"></script>
<!--== confetti -->
<script src="https://ebusi.rdnetworkbd.com/js/confetti.js"></script>
<!--== step animation -->
<script src="https://ebusi.rdnetworkbd.com/js/snap.svg.js"></script>
<script src="https://ebusi.rdnetworkbd.com/js/step.js"></script>
<!--== contact-form -->
<script src="https://ebusi.rdnetworkbd.com/js/contact-form/contact-form.js"></script>
<!--== wow -->
<script src="https://ebusi.rdnetworkbd.com/js/wow.min.js"></script>
<!--== color-customize -->
<script src="https://ebusi.rdnetworkbd.com/js/color-customize/color-customizer.js"></script> 
<!--== theme-script -->
<script src="https://ebusi.rdnetworkbd.com/js/theme-script.js"></script>
<!-- inject js end -->

</body>


</html>



{{-- --
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 --}}