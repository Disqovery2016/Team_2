<?php
require 'logininfo.php';
session_destroy();
die(header('Location:panchtattva.php'));
?>