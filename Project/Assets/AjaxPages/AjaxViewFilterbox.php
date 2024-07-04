<?php
session_start();
if (isset($_GET['ftr'])) {
    $_SESSION['ftr'] = $_GET['ftr'];
}
?>