<?php

include '../includes/classloader.php';

$selectObj = new Select();

$grades = $selectObj->getGradeDictionary();

echo json_encode($grades);