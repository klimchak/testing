<?php
/*
 * Данная страница нужна только для валидации пароля и логиа, вывода сообщения
 * и отправки на страницу админа. После окончания можно убрать
 * */



namespace all;


include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');


$conf = new configFile();
$ps = new pageSource();
$ps->name = $conf->config['nameprog'];
$ps->css = $conf->config['bootstrapcss'];
$ps->bootstrapJs = $conf->config['bootstrapjs'];
$ps->poperJs = $conf->config['poperjs'];

if (isset($_POST) and $_POST['InputLogin'] == '' and $_POST['InputPassword'] == ''){
    $ps->alertError = 'alert ("Не переданы какие-либо значения в форме входа")';
}else{
    $entree = new validDataForm();
    $resultValidFormEntree = $entree->validDataFormEntree($_POST['InputLogin'], $_POST['InputPassword']);
    if ($resultValidFormEntree != 'ok'){
            $ps->alertError = 'alert ("' . $resultValidFormEntree . '")';
    }

}



?>

<!doctype html>
<html lang="ru">
<head>

    <?
    if ($ps->alertError != ''){
        $ps->printHead();
        exit();
    }
    $ps->printHead();
    ?>

</head>
<body class="bg-secondary">
<div class="container">
    <div class="row">
        <? $ps->printAdminIntoNotification($ps->adminlink); ?>
    </div>
</div>
<!-- Подключение скриптов -->
<?php $ps->printJs();?>
</body>
</html>
