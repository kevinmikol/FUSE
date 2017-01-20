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
    
    $cols = "social, ";
    $values = "'".$student_values['social']."', ";
    
    unset($student_values['social']);

    foreach($student_values as $key => $value){
        $cols .= $key.", ";
        $values .= "'".htmlentities($value, ENT_QUOTES)."', ";
    }

    $sql = "INSERT INTO portfolio_students (".substr($cols, 0, -2).") VALUES (".substr($values, 0, -2).")";
    $dbh->query($sql);

    $student_id = $dbh->lastInsertId();    

    foreach($student_portfolio as $num => $item){

        $cols = 'student, ';
        $values = $student_id.', ';
        
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item['image']));
        //$base = '../beta/_students/uploads/'; //THIS IS WHERE THE FILES GO
        $base = '../_';
        $url = 'students/uploads/'.slugify($student_values['first_name']." ".$student_values['last_name']).'-'.$num.'.png';
        file_put_contents($base.$url, $data);
        
        $item['image'] = $url;
        
        foreach($item as $key => $value){
            $cols .= $key.", ";
            $values .= "'".htmlentities($value, ENT_QUOTES)."', ";
        }

        $sql = "INSERT INTO portfolio_projects (".substr($cols, 0, -2).") VALUES (".substr($values, 0, -2).")";
        $dbh->query($sql);
    }

    echo "Information added. Thanks ".$student_values['first_name']."!";

?>