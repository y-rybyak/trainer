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
        <h1><a href="/logout.php">Log out</a></h1>
        <table class="table table-striped">
            <tr>
                <th>Select</th>
                <th>Russian</th>
                <th>English</th>
            </tr>
            <?php
            foreach ($result as $val) {
                print "<tr>";
                print "<td>".'<input type="checkbox" checked>'."</td>"."<td>" . $val["russian"] . "</td>" . "<td>" . $val["english"] . "</td>";
                print "</tr>";
            }
            ?>
        </table>
        <form name="dictionary" method="POST" action="trainer.php">
            <div class="form-group">
                <button type="submit" class="btn btn-default" id="submitWords"
                        name="submitWords">Start!
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</div>
</body>
</html>