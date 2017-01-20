<?php require('includes/header.php'); ?>

<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h1>The Exhibits</h1>
			<h3>Some featured pieces that will be on display.</h3>
		</div>
	</div>
</div>

<div class="row">
	<div class="container">
		<?	$stmt = $dbh->prepare("SELECT * FROM exhibits");
			$stmt->execute();
			$exhibits = $stmt->fetchAll();
		foreach($exhibits as $exhibit){?>
		<div class="row">
			<div class="col-md-4">
				<?php if(file_exists($exhibit['logo'])){
			        $logo = $exhibit['logo'];
			    }else{
			        $logo = 'http://placehold.it/500x300/ffffff?text=image+coming+soon';
			    }?>
			    <img src="<?=$logo?>" class="img-responsive" />
			</div>
			<div class="col-md-8" data-slug="<?=slugify($exhibit['name'])?>">
				<h2><?=$exhibit['name']?></h2>
				<h4><?=$exhibit['description']?></h4>
			</div>
		</div>
		<div class="row grid">
			<div class="container">
				<div class="col-md-12">
					<h3>Project Team</h3>
				</div>
				<div class="items">
				<?php
					$stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE `exhibit_group` = :group');
					$stmt->bindParam(':group', $exhibit['id']);
				    $stmt->execute();
				    $students = $stmt->fetchAll(); 
				    
				    foreach($students as $student){ ?>
					<div class="item col-md-2 col-sm-3 col-xs-6" data-major="<?=$student['major']?>">
						<a href="student/<?=$student['slug']?>">
						    <div class="overlay">
							    <h2><?=$student['first_name'].' '.$student['last_name']?></h2>
							    <p><?=getMajor($student['major'])?></p>
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
		</div>
		<hr />
		<? } ?>
	</div>
</div>

<?php require('includes/footer.php'); ?>

<?php if(isset($_GET['slug'])){ ?>
	<script>
		$(window).bind("load", function() {
			$('html, body').animate({
		        scrollTop: $("[data-slug='<?=$_GET['slug']?>']").offset().top - $('nav').height()
		    }, 500);
	    });
	</script>	
<? } ?>