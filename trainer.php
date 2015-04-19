<?php
$title = "Trainer";
include "header.php";
session_start();
if (!empty($_POST["dictionary"])) {
    $dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
    foreach ($_POST["dictionary"] as $word) {
        $sth = $dbh->prepare("SELECT russian FROM words WHERE english = :word");
        $sth->execute([':word' => $word]);
        $_SESSION["dictionary"][$word] = $sth->fetchAll()[0][0];
    }
}
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <form class="form-group" name="play" method="POST" action="trainer.php">
            <div class="form-group">
                <label for="inputWord">
                    <?php
                    $word = array_rand($_SESSION["dictionary"], 1);
                    print ucfirst($word);
                    
                    ?>
                </label>
                <input autofocus type="text" class="form-control" id="inputWord" autocomplete="off" name="inputWord">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>

        <?php
            print $_POST["inputWord"];
            print $_SESSION["dictionary"][$word];
        ?>

    </div>
    <div class="col-md-4">
        <h3><a href="settings.php">Settings</a></h3>
    </div>
</div>
</div>
</body>
</html>