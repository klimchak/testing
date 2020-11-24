<?php


namespace all;

include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();


/*
 * Галки стоят правильно, значит проверяем наличие файла базы. Иаче он создается по макету
 * */
$dataBase = new workDb();
$dataBase->validFileDb();

if (isset($_POST['del'])){
    $resulDel = $dataBase->delQuest($_POST['vus'], $_POST['idQuest']);
    if ($resulDel == null){
        header('Location: adminPage.php?del=1');
        exit();
    }
}


//класс валидации данных форм админки
// если что-то не прошло проверку - редирект на страницу с кодом ошибки, сообщением и старыми данными, подставленными в форму
$validData = new validDataQuestAdmin();


//циклом убираем все перекаты
foreach ($_POST as $item) {
    $arrDataInDb[] = $validData::exTextArea($item, ' ', true);
}

$resulUp = $dataBase->updateQuest($_GET['vus'], $arrDataInDb[3], $arrDataInDb[0], $arrDataInDb[1], $arrDataInDb[4], $arrDataInDb[5], $arrDataInDb[6], $arrDataInDb[7], $arrDataInDb[2]);

if ($resulUp == null){
    //добавляем введенные данные в сессию, данные при каждом добавлении вопроса будут переписываться
    $_SESSION['text'] = $arrDataInDb[1];
    if ($arrDataInDb[2] == 1){
        $_SESSION['ans'] = $arrDataInDb[4];
    }elseif ($arrDataInDb[2] == 2){
        $_SESSION['ans'] = $arrDataInDb[5];
    }elseif ($arrDataInDb[2] == 3){
        $_SESSION['ans'] = $arrDataInDb[6];
    }elseif ($arrDataInDb[2] == 4){
        $_SESSION['ans'] = $arrDataInDb[7];
    }

    //редирект на страницу добавления вопроса
    header('Location: adminPage.php?result=1&vus=' . str_replace('vus', '', $_GET['vus']));
}

