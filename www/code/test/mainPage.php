<?php

namespace all;

include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');

session_start();
session_unset();
$ps = new pageSource();
$conf = new configFile();
$ps->name = $conf->config['nameprog'];
$ps->css = $conf->config['bootstrapcss'];
$ps->bootstrapJs = $conf->config['bootstrapjs'];
$ps->jquery = $conf->config['jqueryjs'];
$ps->poperJs = $conf->config['poperjs'];


if (!isset($_POST) and $_POST == null){
    echo 'ничего не введено';
}

//класс валидации данных форм админки
// если что-то не прошло проверку - редирект на страницу с кодом ошибки, сообщением и старыми данными, подставленными в форму
$validData = new validDataQuestAdmin();
//циклом убираем все перекаты

foreach ($_POST as $item) {
    $item1 = $validData::exTextArea($item, '', true);
    $_SESSION['student'][] = ucfirst($item1);
}




$arrIdVus903 = $db->selIdTest('vus903');
shuffle($arrIdVus903);
if (count($arrIdVus903) > 15){
    $arrIdVus901 = array_splice($arrIdVus903, 0, 15);
}

$arrIdVus905 = $db->selIdTest('vus905');
shuffle($arrIdVus905);
if (count($arrIdVus903) > 15){
    $arrIdVus901 = array_splice($arrIdVus903, 0, 15);
}

?>

<!doctype html>
<html lang="ru">
<head>

    <?$ps->printHead();?>

</head>
<body class="bg-secondary">
<div class="container">
    <div class="row">
        <? $ps->printTestIntoNotification('testingPage.php'); ?>
    </div>
</div>
<!-- Подключение скриптов -->
<?php $ps->printJs();?>
</body>
</html>
