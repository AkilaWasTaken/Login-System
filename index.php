<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
} else{
    header('Location: ./client/dashboard.php');
    exit;
}

