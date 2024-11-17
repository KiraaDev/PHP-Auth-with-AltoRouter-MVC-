<?php 

function checkLoginMiddleware() {
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        require './views/401.php';
        exit();
    }
}
