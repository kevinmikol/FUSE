<?php $projects = 3;
if($_POST){
    print_r($_POST);
}?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>FUSE Student Information</title>

	<link rel="stylesheet" href="assets/form-basic.css">
    
    <style>
        .cropit-image-preview {
            /* You can specify preview size in CSS */
            width: 500px;
            height: 300px;
        }
    </style>
</head>
<body>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="index.php">

            <div class="form-title-row">
                <h1>FUSE Website Registration</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Full Name</span>
                    <input type="text" name="name">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Email</span>
                    <input type="email" name="email">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Major</span>
                    <select name="major">
                        <option value="0">Game Design</option>
                        <option value="1">Animation</option>
                        <option value="2">Web and App</option>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Grade</span>
                    <select name="grade">
                        <option value="0">Freshman</option>
                        <option value="1">Sophmore</option>
                        <option value="2">Junior</option>
                        <option value="3">Senior</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Short Biography</span>
                    <textarea name="bio"></textarea>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Portfolio Website (with http://)</span>
                    <input type="text" name="website">
                </label>
            </div>
            
            <hr />
            
            <?php
                $i = 1;
                while($i-1 < $projects){ ?>
                    <h2>Portfolio Project #<?=$i?></h2>
                    <div class="form-row">
                        <label>
                            <span>Project Name</span>
                            <input type="text" name="portfolio[<?=$i?>][title]">
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            <span>Short Biography</span>
                            <textarea name="portfolio[<?=$i?>][description]"></textarea>
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            <span>URL - if applicable (with http://)</span>
                            <input type="text" name="portfolio[<?=$i?>][url]">
                        </label>
                    </div>
                    <h4>Image to Display</h4>
                    <div class="image-cropper" style="text-align:center;">
                        <!-- This is where the preview image is displayed -->
                        <div class="cropit-image-preview" style="display:none; margin: 0 auto;"></div>

                        <!-- This range input controls zoom -->
                        <!-- You can add additional elements here, e.g. the image icons -->
                        <input type="range" class="cropit-image-zoom-input" style="display:none;"/>

                        <!-- This is where user selects new image -->
                        <input type="file" class="cropit-image-input" />
                        <input type="hidden" class="image-data" name="portfolio[<?=$i?>][image]" />
                    </div>
                    <!-- This wraps the whole cropper -->
            <hr style="margin-top:50px;"/>
            <?  $i++;
                } ?>
            <p>Please make sure that all the information above is correct before submitting.</p>
            <div class="form-row">
                <button type="submit">Submit Form</button>
            </div>

        </form>

    </div>

</body>
    
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="assets/crop.js"></script>
    
    <script>
        $('.image-cropper').cropit();
        $('.cropit-image-input').change(function(){
            $(this).parent().find('.cropit-image-preview').fadeIn();
            $(this).parent().find('.cropit-image-zoom-input').fadeIn();
        });
        
        $('form').submit(function(e){
            e.preventDefault();
            
            $('.image-cropper').each(function(i, obj){
                var imageData = $(this).cropit('export', {
                    type: 'image/jpeg',
                    quality: .9
                });
                
                $(this).find('.image-data').val(imageData);
            });
            
            $.post("go.php", $(this).serialize(),
                function(data){
                    alert(data);
                }
            );

            return false;
        });
    </script>

</html>
