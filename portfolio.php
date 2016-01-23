<?php
    require('includes/header.php');
    
    $slug = $_GET['slug'];
    $stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE slug = :slug');
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    
    if($stmt->rowCount() == 0){die;}

    $student = $stmt->fetch();
?>
<!-- Portfolio Item Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$student['name']?>
            <small><?=getMajor($student['major'])?></small>
        </h1>
    </div>
</div>
<!-- /.row -->

<!-- Portfolio Item Row -->
<div class="row">

    <div class="col-md-8">
        <img class="img-responsive" src="<?=$student['image']?>" alt="">
    </div>

    <div class="col-md-4">
        <h3>About Me</h3>
        <p><?=$student['bio']?></p>
    </div>

</div>
<!-- /.row -->

<!-- Related Projects Row -->
<div class="row">

    <div class="col-lg-12">
        <h3 class="page-header">Featured Projects</h3>
    </div>

    <div class="col-sm-4 col-xs-6">
        <a href="#">
            <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6">
        <a href="#">
            <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6">
        <a href="#">
            <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
        </a>
    </div>

</div>
<!-- /.row -->
<?php require('includes/footer.php'); ?>