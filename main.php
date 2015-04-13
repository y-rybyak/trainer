<?php
$title = 'Profile <small><a href="/logout.php">(log out)</a></small>';
include "header.php";
session_start();
$id = $_SESSION["userId"];
$dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
$sth = $dbh->prepare("SELECT russian, ukrainian, english, german FROM words WHERE intUserId = :id");
$sth->execute([':id' => $id]);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

print "<pre>";
var_dump($result);
print "</pre>";