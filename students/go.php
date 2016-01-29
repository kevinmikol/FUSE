<?php
    if(!$_POST){
        die;
    }

    require('../config.php');

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

    $student_values = $_POST;
    $student_portfolio = $student_values['portfolio'];
    unset($student_values['portfolio']);

    $student_values['slug'] = slugify($student_values['first_name']." ".$student_values['last_name']);
    $student_values['social'] = serialize($student_values['social']);
    
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

        $cols = 'student, ';
        $values = $student_id.', ';
        
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item['image']));
        $url = 'uploads/'.slugify($student_values['last_name']." ".$student_values['first_name']).'-'.$num.'.png';
        file_put_contents($url, $data);
        
        $item['image'] = 'students/'.$url;
        
        foreach($item as $key => $value){
            $cols .= $key.", ";
            $values .= "'".$value."', ";
        }

        $sql = "INSERT INTO portfolio_projects (".substr($cols, 0, -2).") VALUES (".substr($values, 0, -2).")";
        $dbh->query($sql);
    }

    echo "Information added. Thanks ".$student_values['first_name']."!";

?>