<?php
//header('Location: /students');
require('includes/header.php'); ?>

<div id="video-wrap">
    <video preload="metadata" autoplay loop id="header-video">
        <source src="http://hilltopstudios.trinix.co/assets/videos/stock.mp4" type="video/mp4">
    </video>
    
    <div class="content">
        <div class="countdown">
            <span class="days"></span>
            <span class="hours"></span>
            <span class="minutes"></span>
            <span class="seconds"></span>
        </div>
        <h1>Immerse yourself in the experience.</h1>
        <a class="arrow"><i class="fa fa-arrow-circle-down"></i></a>
    </div>
</div>

<div class="row cta">
    <div class="container">
        <h1>Hello!</h1>
    </div>
</div>

<?php require('includes/footer.php'); ?>