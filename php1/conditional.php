<!DOCTYPE html>
<html>
<head>
    <?
    
    //Hard coded variable
    $age = 10;
    

    if($age <= 12) {
        $person_type = "Kiddo";
    }
    elseif($age > 12 and $age <=19) {
        $person_type = "Teenager";
    }
    elseif($age > 19 and $age <= 80)   {
        $person_type = "Adult";
    }
    else {
        $person_type = "Super wise person";
    }
   
    
    ?>
</head>
<body>
    The person is a <?=$person_type?>
</body>

</html>