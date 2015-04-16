<?php
$title = "Trainer";
include "header.php";
session_start();
if (!empty($_POST["dictionary"])) {
    $dictionary = $_POST["dictionary"];
}
?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <form class="form-inline">
            <div class="form-group">
                <label for="exampleInputName2">Word</label>
                <input type="text" class="form-control" id="exampleInputName2">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>

        <?php
        if (!empty($dictionary)) {
            foreach ($dictionary as $word) {
                print $word . "<br />";
            }
        }?>
    </div>
    <div class="col-md-4">
        <h3><a href="settings.php">Settings</a></h3>
    </div>
</div>
</div>
</body>
</html>