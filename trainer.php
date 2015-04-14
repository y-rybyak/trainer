<?php
$title = "Trainer";
include "header.php";
session_start();

if (!empty($_POST["dictionary"])) {
    print "<pre>";
    var_dump($_POST["dictionary"]);
    print "</pre>";
} else {
    print "empty";
}