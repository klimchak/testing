<?php

namespace all;
include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();

//новый экземпляр класс по валидации данных
$classHandleStr = new validDataQuestAdmin();

//новый экз класса работы с базой
$db = new workDb();

//новый экз класса валидации запросов форм админа
$validAdmin = new validDataQuestAdmin();
//добавляем в статическое свойство нужные для замены символы
$validAdmin::$symbols = ['  ', ',', '.', ';', ':'];

//Проверяем длину строки
if (iconv_strlen($_POST['ValueSearch']) <= 4){
    header('Location: adminPage.php?searchRes=3');
    exit();
}

//получаем новую строку
$handleStr = $validAdmin::exTextArea($_POST['ValueSearch'], ' ', true);
//отправляем в базу и получаем результат
$querry = $db->selHandleSearch($_POST['vus'], $handleStr);

if ($querry){
    //если циклом помещаем данные в сессию и возвращаемся на страницу поиска
    $i = 0;
    foreach ($querry as $item) {
        $_SESSION['searchRes' . ++$i] = $item;
    }
    header('Location: adminPage.php?searchRes=2&vus=' . $_POST['vus']);
}else{
    header('Location: adminPage.php?searchRes=1');
}

exit();

/*
 * Res=2 - результат найден
 * Res=1 - результат не найден
 * Res=3 - длина строки меньше или равен 4м символам
 * */