<?php
//header('Location: /students');
require('includes/header.php'); ?>

<div class="row">
	<div class="container" style="padding-bottom:20px;">
		<div class="col-md-7">
			<h1>Creation, development, innovation</h1>
			<h3>We're developers, designers, and dreamers</h3>
			<p>We're devoted to creating something new. Something that has never been done before. Something almost magical.</p>
			<p>The Department of Interactive Media at Bradley University empowers students to pursue their dreams as developers, designers, and innovators.  The FUSE show allows these students to share their work with the greater Peoria community.</p>
		</div>
		<div class="col-md-5">
			<img class="img-responsive" src="assets/img/2015-fuse-1.png" alt="">
		</div>
	</div>
</div>

<div class="row grid">
	<div class="container">
		<hr />
		<div class="col-md-12">
			<h1>Leadership Team</h1>
		</div>
	<?php
		$stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE `group` = 1');
	    $stmt->execute();
	    $students = $stmt->fetchAll(); 
	    
	    foreach($students as $student){ ?>
		<div class="item col-md-3 col-sm-4 col-xs-6" data-major="<?=$student['major']?>">
			<a href="student/<?=$student['slug']?>">
			    <div class="overlay">
				    <h2><?=$student['first_name'].' '.$student['last_name']?></h2>
				    <h5><?=getMajor($student['major'])?></h5>
			    </div>
		        <?php if(file_exists('_students/profiles/'.$student['slug'].'-profile.jpg')){
			        $profile = '_students/profiles/'.$student['slug'].'-profile.jpg';
		        }else{
			        $profile = 'http://placehold.it/400x300/ffffff?text=image+coming+soon';
		        }?>
		        <img src="<?=$profile?>" class="img-responsive" />
		    </a>
		    <div class="bottom">
		    	<h3><?=$student['first_name'].' '.$student['last_name']?></h3>
				<small><h5><?=$student['role']?></h5></small>
		    </div>
		</div>
	<?	} ?>
	</div>
</div>

<div class="row grid">
	<div class="container">
		<hr />
		<div class="col-md-12">
			<h1>Faculty</h1>
		</div>
		<?php
			$stmt = $dbh->prepare('SELECT * FROM faculty WHERE `group` = 1 AND `shown` = 1');
		    $stmt->execute();
		    $faculty = $stmt->fetchAll(); 
		    
		    foreach($faculty as $person){ ?>
			<div class="item col-md-3 col-sm-4 col-xs-6">
				<a href="<?=$person['website']?>" target="_blank">
				    <div class="overlay">
					    <h2><?=$person['name']?></h2>
					    <h5><?=$person['role']?></h5>
				    </div>
			        <?php if(file_exists('_students/profiles/'.slugify($person['name']).'-profile.jpg')){
				        $profile = '_students/profiles/'.slugify($person['name']).'-profile.jpg';
			        }else{
				        $profile = 'http://placehold.it/400x300/ffffff?text=image+coming+soon';
			        }?>
			        <img src="<?=$profile?>" class="img-responsive" />
			    </a>
			    <div class="bottom">
			    	<h3><?=$person['name']?></h3>
					<small><h5><?=$person['role']?></h5></small>
			    </div>
			</div>
		<?	} ?>
	</div>
</div>

<div class="row form">
	<div class="container">
		<div class="col-md-12">
			<div style="text-align:center;margin-bottom:40px;">
				<h1>Contact the Team</h1>
				<p>We would love to hear from you!</p>
				<div class="results"></div>
			</div>
			<form role="form" id="contactMe">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="name" id="name" placeholder="name">
						</div>
					</div>
					<div class="col-md-6 email-wrap">
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" placeholder="e-mail">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<textarea class="form-control textarea" rows="4" name="message" id="message" placeholder="message"></textarea>
						</div>
					</div>
				</div>
				<input type="hidden" name="to" value="qyoung@mail.bradley.edu">
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-lg pull-right sendEmail">Send a message</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php require('includes/footer.php'); ?>