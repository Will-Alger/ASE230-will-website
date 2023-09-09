<?php
require_once 'data.php';

// calculates age from dob in the form mm/dd/yy
function calculateAge($dob)
{
    $birthdate = date_create($dob);
    if ($birthdate === false) {
        return "[ERROR: Date of birth not valid]";
    }

    $age = date_diff($birthdate, date_create('now'))->y;
    return $age;
}
