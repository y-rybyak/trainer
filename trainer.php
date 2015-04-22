<?php
$title = "Trainer";
include "header.php";
session_start();

if (isset($_POST["dictionary"])) {
    $_SESSION["right"] = 0;
    $_SESSION["wrong"] = 0;
    $dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
    $sql = "TRUNCATE TABLE trainer.dictionary";
    $truncate = $dbh->prepare($sql);
    $truncate->execute();

    $dbh->query("SET NAMES 'utf8';");
    foreach ($_POST["dictionary"] as $key => $english) {
        $sth = $dbh->prepare("SELECT russian FROM trainer.words WHERE english = :english");
        $sth->execute([':english' => $english]);
        $dictionary[$english] = $sth->fetch()[0];
    }


    foreach ($dictionary as $english => $russian) {
        $sql = "INSERT INTO trainer.dictionary(intUserId, english, russian)
                         VALUES(:id, :english, :russian)";
        $sth = $dbh->prepare($sql);
        $sth->execute([
            ':id' => $_SESSION["userId"],
            ':english' => $english,
            ':russian' => $russian
        ]);
    }
}
$riddle = selectWord();
if (isset($_POST["inputWord"])) {
    if ($riddle[1] == $_POST["inputWord"]) {
        $_SESSION["right"] += 1;
    } else {
        $_SESSION["wrong"] += 1;
    }
}
print "right = ";
print isset($_SESSION["right"]) ? $_SESSION["right"] . "<br />" : 0 . "<br />";
print "wrong = ";
print isset($_SESSION["wrong"]) ? $_SESSION["wrong"] : 0;

function selectWord()
{
    $dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
    $sth = $dbh->prepare("SELECT english, russian FROM trainer.dictionary ORDER BY RAND() LIMIT 1");
    $sth->execute();
    $randomWord = $sth->fetchAll()[0];
    return $randomWord;
}


?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <form class="form-group" name="play" method="POST" action="trainer.php">
            <div class="form-group">
                <label for="inputWord"><?= ucfirst($riddle[0]) ?></label>
                <input autofocus type="text" class="form-control" id="inputWord" autocomplete="off" name="inputWord">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="col-md-4">
        <h3><a href="settings.php">Settings</a></h3>
    </div>
</div>
</div>
</body>
</html>