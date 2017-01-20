<?php
    require('includes/header.php');

    $slug = $_GET['slug'];
    $stmt = $dbh->prepare('SELECT * FROM portfolio_students WHERE slug = :slug');
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    
    if($stmt->rowCount() == 0){die;}

    $student = $stmt->fetch();

    $dateObj   = DateTime::createFromFormat('!m', $student['grad_month']);
    $monthName = $dateObj->format('F'); // March
?>
<div class="container" style="padding-bottom:40px;">
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
        <div class="col-md-4" style="text-align:center;">
            <?php if(file_exists('_students/profiles/'.$student['slug'].'-profile.jpg')){
		        $profile = '_students/profiles/'.$student['slug'].'-profile.jpg';
	        }else{
		        $profile = 'http://placehold.it/400x300/ffffff?text=image+coming+soon';
	        }?>
	        <img src="<?=$profile?>" class="img-responsive" />
            <div class="social-links">
            <?php if($student['social'] !== "N;"){
		        foreach(unserialize($student['social']) as $key => $value){ ?>
                <a href="<?=$value?>" target="_blank"><i class="fa fa-<?=$key?>"></i></a>
            <? }
	         }
            ?>
            </div>
            <a class="btn btn-lg btn-primary btn-contact" data-toggle="modal" data-target="#myModal">Contact Me</a>
        </div>

        <div class="col-md-8">
            <h2>About Me</h2>
            <p><?=nl2br(html_entity_decode($student['bio']))?></p>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Featured Projects</h2>
        </div>
        <?php
            $stmt = $dbh->prepare('SELECT * FROM portfolio_projects WHERE student = :id');
            $stmt->bindParam(':id', $student['id']);
            $stmt->execute();
                
            foreach($stmt as $project){ ?>
                <div class="col-sm-4 col-xs-12">
                    <?if($project['url'] !== ''){?>
                    	<a href="<?=$project['url']?>" target="_blank">
	                <?}else{?>
	               		 <a class="fancybox" rel="gallery1" href="_<?=$project['image']?>" data-fancybox-group="gallery" title="<?=$project['title']?>">
		            <? } ?>
				   		 	<img class="img-responsive portfolio-item" src="_<?=$project['image']?>" alt="<?=$project['title']?>">
				   		 </a>
                    <h4><?=$project['title']?></h4>
                    <p><?=html_entity_decode($project['description'])?></p>
                </div>
            <? } ?>
    </div>
    <!-- /.row -->
    
    <?php
        $stmt = $dbh->prepare('SELECT * FROM exhibits WHERE `id` = :id');
        $stmt->bindParam(':id', $student['exhibit_group']);
	    $stmt->execute();
	    $exhibit = $stmt->fetch();
	    if($stmt->rowCount() > 0){ ?>
		    <div class="row">
			    <div class="col-lg-12">
				    <h2 class="page-header">on <b><?=$exhibit['name']?></b> <small>as <?=$student['role']?></small></h2>
			    </div>
				<div class="col-lg-5">
					<a href="exhibit/<?=slugify($exhibit['name'])?>" class="exhibits"><img src="<?=$exhibit['logo']?>" class="img-responsive" /></a>
				</div>
				<div class="col-lg-7">
					<?=$exhibit['description']?>
				</div>
		    </div>
		<?}?>
</div>

<!-- Modal -->
<div class="modal fade slide left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title" id="myModalLabel">Contact Me</h1>
      </div>
      <div class="modal-body">
	    <div class="results"></div>
        <form method="post" id="contactMe">
          <div class="form-group">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="" required/>
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="" required/>
          </div>
          <div class="form-group">
            <textarea class="form-control" id="message" name="message" required rows="5" placeholder="A friendly comment or question"></textarea>
          </div>
          <input type="hidden" name="to" value="<?=$student['email']?>" />
        </form>
      </div>
      <div class="modal-footer">
      	<input type="submit" name="submit" class="sendEmail btn btn-primary btn-lg" value="submit">
      </div>
    </div>
  </div>
</div>

<?php require('includes/footer.php'); ?>