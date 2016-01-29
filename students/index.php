<?php $projects = 3;
date_default_timezone_set('utc');
$SocialNetworks = array(
    "Website" => "globe",
    "LinkedIn" => "linkedin",
    "Twitter" => "twitter",
    "Behance" => "behance",
    "Github" => "github",
    "Tumblr" => "tumblr",
    "Instagram" => "instagram"
);
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>FUSE Student Information</title>

	<link rel="stylesheet" href="assets/form-basic.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <style>
        .cropit-image-preview {
            /* You can specify preview size in CSS */
            width: 500px;
            height: 300px;
            cursor: move;
        }
    </style>
</head>
<body>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->
        <div class="loading" style="display:none;">
            <h1>Loading... Please keep this page open.</h1>
            <h3>Be sure to upload your pieces to the server in at least 1920x1080.</h3>
        </div>
        <form class="form-basic" method="post" action="index.php">

            <div class="form-title-row">
                <h1>FUSE Website Registration</h1>
            </div>
            <h2>Who are you?</h2>
            <div class="form-row">
                <label>
                    <span>First Name</span>
                    <input type="text" name="first_name">
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Last Name</span>
                    <input type="text" name="last_name">
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
                    <span>T-Shirt Size</span>
                    <select name="shirt_size">
                        <option value="0">Small</option>
                        <option value="1">Medium</option>
                        <option value="2">Large</option>
                        <option value="3">Extra Large</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Biography</span>
                    <textarea placeholder="html allowed" name="bio" style="height:200px;"></textarea>
                    <p style="text-align:right;font-weight:100;font-size:12px;margin-right:85px;"><b class="bio-count">200</b>/200 words required.</p>
                </label>
            </div>
            
            <h2>Social Links</h2>
            
            <div class="form-row">
                <label>
                    <span>Add Link:</span>
                    <select class="network-list">
                            <option style="display:none;" disabled selected value="default">choose network</option>
                        <?php foreach($SocialNetworks as $label => $value){ ?>
                            <option value="<?=$value?>"><?=$label?></option>
                        <? } ?>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>My Links:</span>
                    <div class="social-links"></div>
                </label>
            </div>
            
            <h2>What do you study?</h2>
            <div class="form-row">
                <label>
                    <span>Major</span>
                    <select name="major">
                        <option value="0">Game Design</option>
                        <option value="1">Animation</option>
                        <option value="2">Web and App</option>
                        <option value="3">Animation & Visual Effects</option>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Class</span>
                    <select name="class">
                        <option value="0">Freshman</option>
                        <option value="1">Sophmore</option>
                        <option value="2">Junior</option>
                        <option value="3">Senior</option>
                    </select>
                </label>
            </div>
            
            <div class="form-row">
                <label>
                    <span>Graduation Month & Year</span>
                    <select name="grad_month">
                        <option value="5">May</option>
                        <option value="12">December</option>
                    </select>
                    <input type="number" name="grad_year" style="width:80px;" value="<?=date('Y');?>" />
                </label>
            </div>
            
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
                    <div class="form-row description">
                        <label>
                            <span>Description</span>
                            <textarea placeholder="role in project, year completed, software used, etc.," name="portfolio[<?=$i?>][description]"></textarea>
                            <p style="text-align:right;font-weight:100;font-size:12px;margin-right:85px;"><b class="count">50</b>/50 words required.</p>
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            <span>URL - if applicable (with http://)</span>
                            <input type="text" name="portfolio[<?=$i?>][url]" class="notRequired">
                        </label>
                    </div>
                    <h4 style="font-weight:200;">Image to Display (thumbnail)</h4>
                    <div class="image-cropper" style="text-align:center;">
                        <!-- This is where the preview image is displayed -->
                        <div class="cropit-image-preview" style="display:none; margin: 0 auto;"></div>

                        <!-- This range input controls zoom -->
                        <!-- You can add additional elements here, e.g. the image icons -->
                        <input type="range" class="cropit-image-zoom-input" style="display:none;"/>

                        <!-- This is where user selects new image -->
                        <input type="file" class="cropit-image-input" />
                        <input type="hidden" class="image-data" name="portfolio[<?=$i?>][image]" />
                        <p style="text-align:center;font-weight:100;font-size:12px;margin-right:85px;"><i>target size: 500px by 300px</i></p>
                    </div>
                    <!-- This wraps the whole cropper -->
            <?  $i++;
                } ?>
            <hr />
            <div class="form-row">
                <label>
                    <span>Dietary Restrictions?</span>
                    <input type="text" name="diet">
                </label>
            </div>
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
        
        function validateForm(){
            var isValid = true;
            
            $('input').each(function(){
                if(!$(this).hasClass('notRequired')){
                    if($(this).val() == '')
                        isValid = false;
                }
            });
            
            return isValid;
        }
        
        $('.image-cropper').cropit();
        $('.cropit-image-input').change(function(){
            $(this).parent().find('.cropit-image-preview').fadeIn();
            $(this).parent().find('.cropit-image-zoom-input').fadeIn();
        });
        
        function removeLink(link){
            $('.social-links').find('div[data-network='+link+']').remove();
            $('.network-list').find('option[value='+link+']').show();
        }
        
        $('textarea[name=bio]').bind("change keyup input",function() { 
            $('.bio-count').text(200 - $('textarea[name=bio]').val().trim().replace(/\s+/gi, ' ').split(' ').length);
        });
        
        $('.description textarea').bind("change keyup input",function() { 
            $(this).parent().find('.count').text(50 - $(this).val().trim().replace(/\s+/gi, ' ').split(' ').length);
        });
        
        $('.network-list').change(function(){
            $('.social-links').append('<div data-network="'+$(this).val()+'"><i class="fa fa-'+$(this).val()+'"></i> <input type="text" name="social['+$(this).val()+']" placeholder="url (with http://)" /> <a onClick="removeLink(\''+$(this).val()+'\')">remove</a><br /></div>');
            
            $(this).find('option[value='+$(this).val()+']').hide();
            $(this).val('default');
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
            
            if(!validateForm()){
                alert("Uhoh! Missing content in some form fields. Please make sure that everything is filled out and try submitting again.");
                return false;
            }
            
            $(this).slideUp();
            $('.loading').fadeIn();
            
            $.post("go.php", $(this).serialize(),
                function(data){
                    $('.loading').fadeOut(100);
                    $('.loading').html(data);
                    $('.loading').delay(100).fadeIn(100);
                }
            );

            return false;
        });
    </script>

</html>
