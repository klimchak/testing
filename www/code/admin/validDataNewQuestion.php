<?php
namespace all;

include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();


//класс валидации данных форм админки
// если что-то не прошло проверку - редирект на страницу с кодом ошибки, сообщением и старыми данными, подставленными в форму
$validData = new validDataQuestAdmin();


/*
 * Галки стоят правильно, значит проверяем наличие файла базы. Иаче он создается по макету
 * */
$dataBase = new workDb();
$dataBase->validFileDb();

//циклом убираем все перекаты
foreach ($_POST as $item) {
    $arrDataInDb[] = $validData::exTextArea($item, ' ', true);
}



$resultCreat = $dataBase->creatNewQ($arrDataInDb['2'], $arrDataInDb['0'], $arrDataInDb['3'], $arrDataInDb['4'], $arrDataInDb['5'], $arrDataInDb['6'], $arrDataInDb['1']);

if ($resultCreat == null){
    //добавляем введенные данные в сессию, данные при каждом добавлении вопроса будут переписываться
    $_SESSION['text'] = $_POST['InputQestions'];
    $_SESSION['ans'] = $_POST['InputQestionsAnswer' . $_POST['IQ']];
    //редирект на страницу добавления вопроса
    header('Location: adminPage.php?result=1');
}

