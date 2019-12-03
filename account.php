<?php
session_start();
//session_regenerate_id(TRUE);

$userID = $_SESSION['userID'];

echo "welcome " . $userID;