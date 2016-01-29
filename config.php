<?php
    //Database Information
    $dbhost = "trinix.co";
    $dbname = "fuse_cms";
    $dbuser = "fuse_cms";
    $dbpass = "3ZM3TI8q3t";

    $dbh = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass);

    function slugify($text){ 
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }

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
?>