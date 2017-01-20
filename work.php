<?php
    require('includes/header.php');
    
    $stmt = $dbh->prepare('SELECT student, title, image FROM portfolio_projects');
    $stmt->execute();

    $projects = $stmt->fetchAll();
    shuffle($projects);
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h1>The Projects</h1>
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
<!--
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
-->
	</div>
</div>

<div class="row grid">
	<?foreach($projects as $project){
		$stmt = $dbh->prepare('SELECT slug, major, class FROM portfolio_students WHERE id = :id AND `shown` = 1');
		$stmt->bindParam(':id', $project['student']);
		$stmt->execute();
		
		if($stmt->rowCount() == 0)
			continue;
			
		$student = $stmt->fetch(); ?>
    <div class="item col-md-3 col-sm-4 col-xs-6" data-major="<?=$student['major']?>" data-class="<?=$student['class']?>">
	    <a href="student/<?=$student['slug']?>">
		    <div class="overlay">
			    <h3><?=$project['title']?></h3>
			    <h5><?=getMajor($student['major'])?></h5>
		    </div>
	        <img src="_<?=$project['image']?>" class="img-responsive" />
	    </a>
    </div>
    <? }?>
</div>
<!-- /.row -->

<?php require('includes/footer.php'); ?>