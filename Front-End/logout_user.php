<?php
session_start();
session_destroy();
header('Location: index3.php');
?>