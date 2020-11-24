<?php
namespace all;

include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');

session_start();

$dbMni = new workDb();

if (isset($_POST["sel"]) and $_POST["sel"] == 'del'){
    $dbMni->delMni($_POST['IdNumber']);
    header('Location: adminPage.php');
    exit();
}

if (isset($_POST["sel"]) and $_POST["sel"] == 'edit'){
    $dbMni->upMni($_POST['IdNumber'], $_POST["serialN"], $_POST["RegNumber"], $_POST["division"]);
    header('Location: adminPage.php');
    exit();
}

$dbMni->addMni($_POST['serialN'],  $_POST['RegNumber'],  $_POST['division']);
header('Location: adminPage.php');
exit();