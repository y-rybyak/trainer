<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: /main.php', true, 303);
} else {
    header('Location: /login.php', true, 303);
}