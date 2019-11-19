<!-- Controller -->
<?php

$view = new stdClass();
$view-> pageTitle = "Database";

require_once('model/StudentsDataSet.php');

$view = new stdClass();

$view->pageTitle = 'Student Information System';

$studentsDataSet = new StudentsDataSet();

$view->studentsDataSet = $studentsDataSet->fetchAllStudents();

require_once('view/database.phtml');

