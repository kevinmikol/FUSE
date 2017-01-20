<?php
    require('includes/header.php');
    
    $stmt = $dbh->prepare('SELECT first_name, last_name, major, class, slug FROM portfolio_students WHERE `shown` = 1');
    $stmt->execute();

    $students = $stmt->fetchAll();
    shuffle($students);
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h1>The Students</h1>
		</div>
		<div class="col-md-6">
			<span class="filter-title">major</span>
				<ul class="filter" data-type="major">
					<li data-value="-1" class="active">all</li>
					<li data-value="0">game design</li>
					<li data-value="1">animation</li>
					<li data-value="2">web & app</li>
					<li data-value="3">animation & fx</li>
				</ul>
		</div>
		<div class="col-md-6">
			<span class="filter-title">class</span>
				<ul class="filter" data-type="class">
					<li data-value="-1" class="active">all</li>
					<li data-value="0">freshman</li>
					<li data-value="1">sophomore</li>
					<li data-value="2">junior</li>
					<li data-value="3">senior</li>
				</ul>
		</div>
	</div>
</div>

<div class="row grid">
	<?foreach($students as $student){ ?>
    <div class="item col-md-3 col-sm-4 col-xs-6" data-major="<?=$student['major']?>" data-class="<?=$student['class']?>">
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
    </div>
    <? }?>
</div>
<!-- /.row -->

<?php require('includes/footer.php'); ?>