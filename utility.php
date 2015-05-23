<?php

function calc_course_fee($level,$credits) {
    $per_level =0;
    switch ($credits) {
        case 1:
            $per_level=1000;
            break;
        case 2:
            $per_level=1000;
            break;
        case 3:
            $per_level=1100;
            break;
        case 4:
            $per_level=1100;
            break;
        case 5:
            $per_level=1200;
            break;
        case 6:
            $per_level=1200;
            break;
        case 7:
            $per_level=4000;
            break;
        default:
            echo("Wrong Level");
            die;
            break;
    }
    return $per_level * $credits;
}

function getGradePoint($strGrade) {
    $gp = array("A+" => 4.0, "A" => 4.0, "A-" => 3.7, "B+" => 3.3, "B" => 3.0,
                    "B-" => 2.7, "C+" => 2.3, "C" => 2.0);
    if(array_key_exists($strGrade, $gp))
    {
       return $gp[$strGrade];
    }
    else
    {
         return 0;
    }
}

?>
