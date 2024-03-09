<!doctype html>
<html class="no-js" lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap/css/bootstrap.min.css">

      <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">

      <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">

      <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css">
</head>

<body>
    <div id="app">
      <admin-component></admin-component>
    </div>


   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @vite('resources/js/app.js')
    <script type="text/javascript" src="/assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript" src="/assets/js/modernizr/modernizr.js"></script>

<script src="/assets/pages/widget/amchart/amcharts.min.js"></script>
<script src="/assets/pages/widget/amchart/serial.min.js"></script>

<script type="text/javascript " src="/assets/pages/todo/todo.js "></script>
<!-- Custom js -->
<script type="text/javascript" src="/assets/pages/dashboard/custom-dashboard.js"></script>
<script type="text/javascript" src="/assets/js/script.js"></script>
<script type="text/javascript " src="/assets/js/SmoothScroll.js"></script>
<script src="/assets/js/pcoded.min.js"></script>
<script src="/assets/js/demo-12.js"></script>
<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>
</body>

</html>