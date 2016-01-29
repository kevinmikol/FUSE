<?php
    require('includes/header.php');

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
        }
    }
    
    $slug = $_GET['slug'];
    $stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE slug = :slug');
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    
    if($stmt->rowCount() == 0){die;}

    $student = $stmt->fetch();

    $dateObj   = DateTime::createFromFormat('!m', $student['grad_month']);
    $monthName = $dateObj->format('F'); // March
?>
<div class="container">
    <!-- Portfolio Item Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$student['first_name']." ".$student['last_name']?>
                <small>
                    <?=getMajor($student['major'])?>
                    <h5>Anticipated Graduation Date: <?=$monthName?> <?=$student['grad_year']?></h5>
                </small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Item Row -->
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive" src="http://rufflifechicago.com/wp-content/uploads/cat-treats.jpg" alt="">
            <div class="social-links">
            <?php foreach(unserialize($student['social']) as $key => $value){ ?>
                <a href="<?=$value?>" target="_blank"><i class="fa fa-<?=$key?>"></i></a>
            <? } ?>
            </div>
        </div>

        <div class="col-md-8">
            <h2>About Me</h2>
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