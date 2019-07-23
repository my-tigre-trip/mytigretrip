<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Tigre Trip | Checkout</title>
    @php
    $templateFolder = get_template_directory_uri();
    $child = get_stylesheet_directory_uri();
    $schedule = '';
    if ($myBoat->boat === SPEEDBOAT || $myBoat->boat === FULL_DAY) {
      $schedule = 'full-day';
    } else {
      $schedule = $myBoat->mood1->schedule;
    }
    
    @endphp
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> -->
     <link href="https://fonts.gstatic.com/s/raleway/v12/1Ptug8zYS_SKggPNyC0ITw.woff2" type="font/woff2" rel="stylesheet">
    <link rel="stylesheet" id="mkdf_font_elegant-css" href="{{$templateFolder}}/assets/css/elegant-icons/style.min.css?ver=4.8.6" type="text/css" media="all">
    <link rel="stylesheet" id="mkdf_font_awesome-css" href="{{$templateFolder}}/assets/css/font-awesome/css/font-awesome.min.css?ver=4.8.6" type="text/css" media="all">
    @include('style.font')
    <link rel="stylesheet" href="{{$child}}/css/datepicker.min.css">
    <link rel="stylesheet" href="{{$child}}/css/mtt-form.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="schedule" value="{{$schedule}}">
    
  </head>
  <body>
  <div class="container">
  <header class="py-2">
      @php
        $logo = wp_upload_dir();      
      @endphp

       <div class="row">
       <div class="col-md-4 offset-md-3 col-sm-12">
          <div class="text-center">
             <img src="{{$logo['baseurl']}}/2016/04/logo-mtt3.png" class="img-fluid" alt="My tigre trip Logo">
          </div>
         
        </div>        
       </div>       
  </header>

  <div class="row ">
    @yield('content')
  </div>

  <div class="row mt-3">
    <div class="w-100 d-inline-block align-right">
    <a class="clear-confirm text-danger mr-5" href="<?php echo home_url().'/clear-option'?>"><i class="fa fa-window-close text-danger" aria-hidden="true"></i> <small> Clear My Tigre Trip and start again</small></a>
    </div>    
  </div>  

  </div>
  @include('snippets.footer')

  <script src="{{get_template_directory_uri()}}/assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="{{$child}}/js/datepicker.min.js" type="text/javascript"> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"  type="text/javascript"></script>
  <script type="text/javascript" src="{{$child}}/js/utils.js"></script>
  <script type="text/javascript" src="{{$child}}/js/cart.js"></script>
  @if(strpos(get_site_url(), 'mytigretrip.nayra' ) === false  && !is_user_logged_in())
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109851945-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109851945-1');
    </script>
  @endif
  @stack('javascript')
</body>
</html>