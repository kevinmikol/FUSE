<?php
    require('includes/header.php');
    
    $slug = $_GET['slug'];
    $stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE slug = :slug');
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    
    if($stmt->rowCount() == 0){die;}

    $student = $stmt->fetch();
?>
<div class="container">
    <!-- Portfolio Item Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$student['first_name']." ".$student['last_name']?>
                <small><?=getMajor($student['major'])?></small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-md-4">
            <img class="img-responsive" src="http://rufflifechicago.com/wp-content/uploads/cat-treats.jpg" alt="">
            <?php foreach(unserialize($student['social']) as $key => $value){ ?>
                <a href="<?=$value?>" target="_blank"><i class="fa fa-<?=$key?>"></i></a>
            <? } ?>
            <h6>Anticipated Graduation Date: <?=$student['grad_month']?>/<?=$student['grad_year']?></h6>
        </div>

        <div class="col-md-8">
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
        <?php
            $stmt = $dbh->prepare('SELECT * FROM portfolio_projects WHERE student = :id');
            $stmt->bindParam(':id', $student['id']);
            $stmt->execute();
                
            foreach($stmt as $project){ ?>
                <div class="col-sm-4 col-xs-6">
                    <a href="<?=$project['url']?>" target="_blank">
                        <img class="img-responsive portfolio-item" src="<?=$project['image']?>" alt="">
                    </a>
                    <h4><?=$project['title']?></h4>
                    <p><?=$project['description']?></p>
                </div>
            <? } ?>

    </div>
    <!-- /.row -->
</div>
<?php require('includes/footer.php'); ?>