<?php
$title = "Login";
include "header.php";
require_once('class.Person.php');
session_start();
$text = "";
if (!empty($_POST)) {
    $person = new Person();
    $person->setName($_POST['login']);
    $person->setPassword(md5($_POST['password']));
    //$login = $_POST['login'];
    //$passwordHash = md5($_POST['password']);
    $dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
    $sth = $dbh->prepare("SELECT intId, varPasswordHash FROM user WHERE varLogin = :login");
    $sth->execute([':login' => $person->getName()]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $person->setID($result["intId"]);
    $_SESSION["userId"] = $person->getID();
    if ($result) {
        if ($result["varPasswordHash"] === $person->getPassword()) {
            header('Location: /settings.php', true, 303);
            exit;
        } else {
            $text = "Pair login/password does not exist";
        }
    } else {
        $text = "Pair login/password does not exist";
    }
}
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="centered-text">
            <h4>Don't have an account yet? Please <a href="/registration.php">create</a> one.</h4>
            <?= ($text != "") ? '<div class="alert alert-danger" role="alert">' . $text . '</div>' : "" ?>
        </div>
        <form name="loginForm" method="POST" action="login.php">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" placeholder="Enter your login" id="login"
                       name="login">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" id="password"
                       name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default pull-left" id="submitLogin"
                        name="submitLogin">Sign in
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</div>
</body>
</html>