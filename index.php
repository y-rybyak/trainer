<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: /settings.php', true, 303);
} else {
    header('Location: /login.php', true, 303);
}