<?php
$title = 'Your dictionary';
include "header.php";
session_start();
$id = $_SESSION["userId"];
$dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
$sth = $dbh->prepare("SELECT russian, english FROM words WHERE intUserId = :id");
$sth->execute([':id' => $id]);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="centered-text">
            <h1>Select words to study <small><a href="logout.php">Log out</a></small></h1>
        </div>

        <form name="dictionary" method="POST" action="trainer.php">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>Russian</th>
                    <th>English</th>
                    <th></th>
                </tr>
                <?php
                foreach ($result as $val) {
                    $word = $val["english"];
                    print "<tr>";
                    print "<td><input type=checkbox name=dictionary[] value=$word></td>";
                    print "<td>" . $val["russian"] . "</td><td>" . $val["english"] . "</td>";
                    print '<td><span class="glyphicon glyphicon-trash"></td>';
                    print "</tr>";
                }
                ?>
            </table>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Start!
                </button>
            </div>
        </form><br />
        <h3>Add new word to your dictionary!</h3>
        <form class="form-inline" name="new" method="POST" action="settings.php">
            <input type="text" class="form-control" id="english" autocomplete="off" placeholder="English word">
            <input type="text" class="form-control" id="russian" autocomplete="off" placeholder="Russian word">
            <button type="submit" class="btn btn-default">Add</button>
        </form>
        <?php
        if (isset($_POST)) {
            var_dump($_POST);
        }
        ?>
    </div>
    <div class="col-md-4"></div>
</div>
</div>
</body>
</html>