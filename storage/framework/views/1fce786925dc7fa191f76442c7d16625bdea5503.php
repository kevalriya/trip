 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keyword'); ?>" />
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="author" content="CP Singh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo e(asset('front/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/font-awesome.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/icomoon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/mystyles.css?v=1')); ?>">
    <script src="<?php echo e(asset('front/js/modernizr.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(asset('front/css/switcher.css')); ?>">
   <!--  <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/bright-turquoise.css')); ?>" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/turkish-rose.css')); ?>" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/salem.css')); ?>" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/hippie-blue.css')); ?>" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/mandy.css')); ?>" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/green-smoke.css')); ?>" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/horizon.css')); ?>" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/cerise.css')); ?>" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/brick-red.css')); ?>" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/de-york.css')); ?>" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/shamrock.css')); ?>" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/studio.css')); ?>" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/leather.css')); ?>" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/denim.css')); ?>" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo e(asset('front/css/schemes/scarlet.css')); ?>" title="scarlet" media="all" /> -->
    

  
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<style type="text/css">
  .i-check, .i-radio{
    width: 15px;
    height: 15px;
  }
  .page-title {
    font-size: 40px;
    margin: 30px 0;
}
.logoimg img{
	max-width: 20%;
}
body{
    -webkit-touch-callout:none;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #ffffff;
    background-color: #ed8323;
}
textarea { 
   resize:none; 
} 
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary{
	 background-color: #ed8323;
}
.slimmenu-collapse-button {
    
    right: 10px;
    margin-top: -4%;
 }


@media (max-width: 767px) {

  .text-xs-center {
    text-align: center;
  } 
}
.form-horizontal .control-label{
  text-align: left;
}

.btn:focus, .btn:active:focus, .btn.active:focus{
      outline: 0px auto -webkit-focus-ring-color;
}
.i-check:before, .i-radio:before{
  transition: 0s !important;
}
</style>


  <?php $__env->startSection('headSection'); ?>
  <?php echo $__env->yieldSection(); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/layouts/head.blade.php ENDPATH**/ ?>