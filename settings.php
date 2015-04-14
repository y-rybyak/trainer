<?php
$title = 'Your dictionary';
include "header.php";
$text = "";

session_start();
$id = $_SESSION["userId"];
$dbh = new PDO('mysql:host=localhost; dbname=trainer; charset=UTF8', 'root', '6710omne8864');
$sth = $dbh->prepare("SELECT russian, english FROM words WHERE intUserId = :id");
$sth->execute([':id' => $id]);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
$result = array_reverse($result);

?>

<div class="row">
    <div class="col-md-4">
        <h3>Add new word to your dictionary</h3>

        <form class="form-inline" name="new" method="POST" action="settings.php">
            <input type="text" class="form-control" name="english" id="english" autocomplete="off"
                   placeholder="English word">
            <input type="text" class="form-control" name="russian" id="russian" autocomplete="off"
                   placeholder="Russian word">
            <button type="submit" class="btn btn-default">Add</button>
        </form>
        <br/>
    </div>
    <div class="col-md-4">
        <h3>Select words to study</h3>

        <form name="dictionary" method="POST" action="trainer.php">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th>English</th>
                    <th>Russian</th>
                    <th></th>
                </tr>
                <?php
                foreach ($result as $val) {
                    $word = $val["english"];
                    print "<tr>";
                    print "<td><input type=checkbox name=dictionary[] value=$word checked></td>";
                    print "<td>" . $val["english"] . "</td><td>" . $val["russian"] . "</td>";
                    print '<td><span class="glyphicon glyphicon-trash"></td>';
                    print "</tr>";
                }
                ?>
            </table>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Start!
                </button>
            </div>
        </form>
        <?php
        if (!empty($_POST["english"]) AND !empty($_POST["russian"])) {
            $english = $_POST["english"];
            $russian = $_POST["russian"];
            $sql = "INSERT INTO trainer.words(intUserId, english, russian)
                            VALUES(:intUserId, :english, :russian)";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                ':intUserId' => $id,
                ':english' => $english,
                ':russian' => $russian
            ]);
            header('Location: /settings.php', true, 303);
        }
        ?>

    </div>
    <div class="col-md-4">
        <h3><a href="logout.php">Logout</a></h3>
    </div>
</div>
</div>
</body>
</html>