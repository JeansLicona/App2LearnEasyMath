<?php

function isEmpty($value) {
    if (isset($value)) {
        if (trim($value) != '') {
            return false;
        }
    }
    return true;
}

function isEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    }
    return false;
}

function isAlfaNumeric($value) {
    if (preg_match('/^[1-9A-Za-z]*$/', $value)) {
        return true;
    }
    return false;
}

function isNumeric($value) {
    if (preg_match('/^[1-9]*$/', $value)) {
        return true;
    }
    return false;
}

function isDateFormat($value) {
    if (preg_match('/^\d{2}\/\d{2}\/\d{2}*$/', $value)) {
        return true;
    }
    return false;
}

function existDate($date, $format) {
    $date = DateTime::createFromFormat($format, $date);
    if (!$date) {
        return false;
    } else {
        return true;
    }
}

?>
