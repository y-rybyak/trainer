<?php
$title = "Trainer";
include "header.php";
session_start();
if (isset($_POST["dictionary"])) {
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

?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <form class="form-group" name="play" method="POST" action="trainer.php">
            <div class="form-group">
                <label for="inputWord">Word</label>
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