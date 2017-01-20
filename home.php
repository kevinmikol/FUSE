<?php require('includes/header.php'); ?>

<div id="video-wrap">
	<div class="fill"></div>
	
    <video preload="metadata" autoplay loop id="header-video">
        <source src="assets/videos/Pre-FUSE-2016.mp4" type="video/mp4">
    </video>
    
    <div class="content" style="margin-top:10%;">
	    <h1>Immerse yourself in the experience.</h1>
        <img class="arrow" src="assets/img/icons/arrow.svg" />
    </div>
</div>

<div class="row cta">
    <div class="container">
        <div class="col-md-4">
	        <img class="icon" src="assets/img/icons/game_design.svg" />
	        <h3>Play <span>with industry-leading technology.</span></h3>
        </div>
        <div class="col-md-4">
	        <img class="icon" src="assets/img/icons/animation.svg" />
	        <h3>Watch <span>videos and artwork made by students.</span></h3>
        </div>
        <div class="col-md-4">
	    	<img class="icon" src="assets/img/icons/web_app.svg" />
	        <h3>Interact <span>with immersive environments.</span></h3>
        </div>
    </div>
</div>

<div class="row">
	<div class="container">
		<div class="col-md-7">
			<h1>Something for everyone</h1>
		</div>
		<div class="col-md-7">
			<h3>FUSE represents the creative process behind the entire Department of Interactive Media</h3>
			<p>Combining art and technology, media and community, FUSE 2016 will bring to the public the best of Bradley’s Interactive Media Department, showcasing what it means to be a student in the growing field of Interactive Media. From its ideation, FUSE is meant to bring the public and industry professionals alike closer to the artists and developers found at Bradley.</p>
			<p>With activities for all ages, it's a great way to get family and friends immersed into a world of cutting edge technology.  With a day filled with interactive exhibits, video presentations, conversations with students, and engaging learning environments, FUSE is an event you won't want to miss.</p>
			<p>This fun-filled day is graciously hosted at the <a href="https://www.peoriariverfrontmuseum.org/" target="_blank"><b>Peoria Riverfront Museum</b></a> with support from <!-- <b>Maui Jim</b>,--> <a href="https://gowithfloat.com/" target="_blank"><b>Float</b></a>, and  <a href="http://onefire.com/" target="_blank"><b>OneFire Media</b></a>.</p>
		</div>
		<div class="col-md-5">
			<img class="img-responsive" src="assets/img/2015-fuse-2.png" alt="">
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="sponsors">
			<div class="col-md-4">
				<a href="http://www.bradley.edu/academic/departments/interactive/" target="_blank"><img src="assets/img/bradley.svg" class="img-responsive" /></a>
			</div>
			<div class="col-md-2">
				<a href="https://www.peoriariverfrontmuseum.org/" target="_blank"><img src="assets/img/PRM-Logo.png" class="img-responsive"/></a>
			</div>
			<div class="col-md-2">
				<a href="http://gowithfloat.com/" target="_blank"><img src="assets/img/float-logo.png" class="img-responsive" /></a>
			</div>
			<div class="col-md-4">
				<a href="http://onefire.com/" target="_blank"><img src="assets/img/onefire_374x80.png" class="img-responsive" /></a>
			</div>
<!--
			<div class="col-md-2">
				<a href="http://mauijim.com/" target="_blank"><img src="assets/img/Maui-Jim-Logo-2014%20sm.jpg" class="img-responsive" /></a>
			</div>
-->
		</div>
	</div>
</div>
<hr />
<div class="row exhibits">
	<div class="container" style="padding-top:0;">
		<div class="col-md-12" style="padding-bottom:30px;">
			<h1>Featured Exhibits</h1>
		</div>
		<?php $stmt = $dbh->prepare("SELECT * FROM exhibits");
			$stmt->execute();
			$exhibits = $stmt->fetchAll();
		foreach($exhibits as $exhibit){?>
		<div class="col-md-3">
			<?php if(file_exists($exhibit['logo'])){
		        $logo = $exhibit['logo'];
	        }else{
		        $logo = 'http://placehold.it/500x300/ffffff?text=image+coming+soon';
	        }?>
	        <a href="exhibit/<?=slugify($exhibit['name'])?>"><img src="<?=$logo?>" class="img-responsive" /></a>
		</div>
		<? } ?>
	</div>
</div>

<?php require('includes/footer.php'); ?>