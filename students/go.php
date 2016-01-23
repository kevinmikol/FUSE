<?php

    function slugify($text){
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
            return 'n-a';
        return $text;
    }

    //Database Information
    $dbhost = "trinix.co";
    $dbname = "fuse_cms";
    $dbuser = "fuse_cms";
    $dbpass = "3ZM3TI8q3t";

    $dbh = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpass);

    $student_values = $_POST;
    $student_portfolio = $student_values['portfolio'];
    unset($student_values['portfolio']);

    $student_values['slug'] = slugify($student_values['name']);
    
    $cols = '';
    $values = '';

    foreach($student_values as $key => $value){
        $cols .= $key.", ";
        $values .= "'".$value."', ";
    }

    $sql = "INSERT INTO portfolio_students (".substr($cols, 0, -2).") VALUES (".substr($values, 0, -2).")";
    $dbh->query($sql);
    
    $student_id = $dbh->lastInsertId();    

    foreach($student_portfolio as $num => $item){
        print_r($student_portfolio);
        $cols = 'student, ';
        $values = $student_id.', ';
        
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item['image']));
        $url = 'uploads/'.$student_values['slug'].'-'.$num.'.png';
        file_put_contents($url, $data);
        
        $item['image'] = 'students/'.$url;
        
        foreach($item as $key => $value){
            $cols .= $key.", ";
            $values .= "'".$value."', ";
        }

        $sql = "INSERT INTO portfolio_projects (".substr($cols, 0, -2).") VALUES (".substr($values, 0, -2).")";
        $dbh->query($sql);
    }

?>