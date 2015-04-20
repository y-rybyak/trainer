<?php
$title = "Registration";
include "header.php";
require_once('class.Person.php');
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
    if ($password1 != $password2) {
        $text = '<p class="text-danger">Passwords doesn\'t match.</p>';
    } else if (strlen($password1) < 8) {
        $text = '<p class="text-danger">The password is too short.</p>';
    } else if (!preg_match("#[0-9]+#", $password1)) {
        $text = '<p class="text-danger">Password must include at least one number!</p>';
    } else if (!preg_match("#[a-zA-Z]+#", $password1)) {
        $text = '<p class="text-danger">Password must include at least one letter!</p>';
    } else if ($login == '') {
        $text = '<p class="text-danger">Login is required.</p>';
    } else {
        session_start();
        $dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
        $dbh->query("SET NAMES 'utf8';");
        $sql = "INSERT INTO trainer.user(varLogin, varPasswordHash)
                            VALUES(:login, :password)";
        $sth = $dbh->prepare($sql);
        if ($sth->execute([
            ':login' => $login,
            ':password' => md5($password1)
        ])
        ) {
            $person = new Person();
            $person->setName($login);
            $person->setPassword(md5($password1));
            $person->setID($dbh->lastInsertId());
            $_SESSION["userId"] = $person->getID();

            header('Location: /settings.php', true, 303);
            exit;
        } else {
            $text = '<p class="text-danger">This login is already in use.</p>';
        }
    }
}
?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="centered-text">
            <h4>Already have an account? Please <a href="/login.php">login.</a></h4>
            <?= (isset($text)) ? '<div class="alert alert-danger" role="alert">' . $text . '</div>' : '' ?>
        </div>
        <form name="loginForm" enctype="multipart/form-data" method="POST" action="registration.php">

            <div class="form-group">

                <label for="login">Login</label>
                <input type="text" class="form-control" placeholder="Enter your login" id="login"
                       name="login" autocomplete="off" value="<?= (isset($login)) ? $login : '' ?>">
            </div>
            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" class="form-control" placeholder="Choose password" id="password1"
                       name="password1">
            </div>
            <div class="form-group">
                <label for="password2">Password verification</label>
                <input type="password" class="form-control" placeholder="Re-enter password" id="password2"
                       name="password2">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default pull-right" id="submitLogin"
                        name="submitLogin">Sign up
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</div>
</body>
</html>