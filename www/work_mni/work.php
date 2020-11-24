<?php

namespace all;
error_reporting(E_ALL);
include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();

$ps = new pageSource();
$conf = new configFile();
$ps->name = $conf->config['nameprog'];
$ps->css = $conf->config['bootstrapcss'];
$ps->bootstrapJs = $conf->config['bootstrapjs'];
$ps->jquery = $conf->config['jqueryjs'];
$ps->poperJs = $conf->config['poperjs'];
$db = new workDb();


/*
 * создание пути для работы USBDev, её запуск и создание отчета в виде текстового файла
 * */
//$arch = system("echo %PROCESSOR_ARCHITECTURE%");
$var = 'programm\USBDeview.exe /stext programm\mnilog';

$r = shell_exec($var);

//чтение файла лога USBDev
$mniWork = new mniWork();
$arr2 = $mniWork->getPathUsbDev();


$arrReg = $db->selMni('all','', true);
$t = 1;
foreach ($arr2 as $line){
    foreach ($arrReg as $var){
        if ($line[3] == $var[0]){
            array_push($arr2[$t], $var[1]);
        }
    }
    if ($t == count($arr2)){
        $t = 0;
    }
    ++$t;
}

foreach ($arr2 as $var){
    if (!isset($var[6])){
        array_push($arr2[$t], 'Не учтено');
    }
    if ($t == count($arr2)){
        $t = 0;
    }
    ++$t;
}


/*
 * оформление распарсенного файла в виде страницы
 * */
?>

    <!doctype html>
    <html lang="ru">
    <head>
        <? $ps->printHead(); ?>
    </head>
    <body class="bg-dark text-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="/index.php"><button class="btn btn-secondary">На главную</button></a>
                <?
                $mniWork->selAllMni($arr2);
                ?>
            </div>
            </div>
        </div>




    </div>


    <!-- Подключение скриптов -->
    <?php $ps->printJs();?>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover({trigger:'hover'});
        });
        let options = {
            'backdrop' : 'true',
            'show' : 'true',
        }
        $('#exampleModal').modal({show: true});
    </script>
    </body>
    </html>