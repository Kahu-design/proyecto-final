<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: Pages/dashboard.php');
} else {
    header('Location: Pages/login.php');
}
exit;
?>