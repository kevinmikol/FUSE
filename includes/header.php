<?php require('config.php');
	
	function slugify($text){
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
            return 'n-a';
        return $text;
    }
    
    function getMajor($int){
	    switch($int){
	        case 0:
	            return "Interactive Media - Game Design";
	        case 1:
	            return "Interactive Media - Animation";
	        case 2:
	            return "Interactive Media - Web and App";
	        case 3:
	            return "Interactive Media - Animation & Visual Effects";
	        case 4:
	        	return "Graphic Design";
	    }
	}
	
	$pageName = str_ireplace(array('-', '.php'), array(' ', ''), basename($_SERVER['PHP_SELF']));
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<base href="http://bradleyinteractive.com/2016/">
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bradley University's Interactive Media Portfolio Show">
    <meta name="author" content="Kevin Mikolajczak">
    <link rel="shortcut icon" href="assets/img/icon.png"/>

    <title><?=ucwords($pageName)?> | FUSE</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/TimeCircles.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body<?if($pageName == "home"){?> class="home"<? }?>>
	<div class="loading">
		<div class="sk-cube-grid">
		  <div class="sk-cube sk-cube1"></div>
		  <div class="sk-cube sk-cube2"></div>
		  <div class="sk-cube sk-cube3"></div>
		  <div class="sk-cube sk-cube4"></div>
		  <div class="sk-cube sk-cube5"></div>
		  <div class="sk-cube sk-cube6"></div>
		  <div class="sk-cube sk-cube7"></div>
		  <div class="sk-cube sk-cube8"></div>
		  <div class="sk-cube sk-cube9"></div>
		</div>
		loading something great
	</div>
	
	<header>
	    <nav class="navbar navbar-fixed-top">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	                    <span class="sr-only">Toggle navigation</span>
	                    <i class="fa fa-bars"></i>
	                </button>
	                <a class="navbar-brand" href="home"><img src="assets/img/logo.png" /></a>
	            </div>
	            <div id="navbar" class="navbar-collapse collapse">
	                <ul class="nav navbar-nav navbar-right">
	                    <li><a<? if($pageName == "about"){?> class="active"<?}?> href="about">About</a></li>
	                    <li><a<? if($pageName == "students"){?> class="active"<?}?> href="students">Students</a></li>
	                    <li><a<? if($pageName == "exhibits"){?> class="active"<?}?> href="exhibits">Exhibits</a></li>
	                    <li><a<? if($pageName == "work"){?> class="active"<?}?> href="work">Work</a></li>
	                    <li><a<? if($pageName == "attend"){?> class="active"<?}?> href="attend" class="btn btn-primary">Attend</a></li>
	                </ul>
	            </div><!--/.nav-collapse -->
	        </div>
	    </nav>
	</header>