<?php
/*
 * Начало проекта 19.44 29.06.2020
 */
namespace all;



include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');

session_abort();

$conf = new configFile();

//новый экз класса шапки первой страницы
$head = new pageSource;
$head->name = $conf->config['nameprog'];
$head->css = $conf->config['bootstrapcss'];
$head->bootstrapJs = $conf->config['bootstrapjs'];
$head->jquery = $conf->config['jqueryjs'];
$head->poperJs = $conf->config['poperjs'];



//выдача сообщения о валидации файлов
$varValidProject = new validFileP;
$varValidProject->validAllFiles();



?>

<!doctype html>
<html lang="ru">
<head>
    <?php
    /*
     * Проверка пустое ли значение после проверки всех контролируемых файлов
     * если пустое, то огонь. Иначе сообщение из массива ошибок приложения.
     * */
        if ($varValidProject->alertError != ''){
            $head->alertError = 'alert ("' . $varValidProject->alertError . '")';
            $head->printHead();
            exit();
        }
            $head->printHead();

    ?>

    <style>
        .ioio{height: 40em;}
        .opop{display: flex; justify-content: center !important;}

    </style>
</head>
<body class="bg-secondary">
    <div class="container-fluid">
        <div class="row ioio align-items-center ">
            <!-- Отображение двух колонок форм регистрации и ввода данных перед началом тестирования -->

                <div class="col opop bg-dark w-50 p-2">
                    <button class="btn btn-light" type="button" data-toggle="modal" data-target="#inputModal">Войти в меню администратора</button>
                    <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inputModalLabel">Окно ввода данных</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $head->printFormEntree('/code/admin/mainPage.php', 'submit');?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>



                <div class="col opop bg-light w-50 p-2">
                    <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#startTestModal">Пройти тестирование</button>
                    <div class="modal fade" id="startTestModal" tabindex="-1" role="dialog" aria-labelledby="startTestModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="min-width: 80%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="startTestModalLabel">Окно ввода данных</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php $head->getIntoTest('/code/test/mainPage.php', 'submit');?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col opop bg-dark w-50 p-2">
                    <a href="work_mni/work.php"><button class="btn btn-light" type="submit">Просмотр МНИ</button></a>
                </div>
        </div>

    </div>
    <!-- Подключение скриптов -->
    <?php $head->printJs();?>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover({trigger:'hover'});
        });
        let options = {
            'backdrop' : 'true',
            'show' : 'true',
        }
        // $('#inputModal').modal({show: true});
        // $('#startTestModal').modal({show: true});
        let inputP = document.querySelector(".textP");
        inputP.addEventListener("input", function () {
            this.value = this.value[0].toUpperCase() + this.value.slice(1);
        })
        let inputL = document.querySelector(".textL");
        inputL.addEventListener("input", function () {
            this.value = this.value[0].toUpperCase() + this.value.slice(1);
        })
        let inputF = document.querySelector(".textF");
        inputF.addEventListener("input", function () {
            this.value = this.value[0].toUpperCase() + this.value.slice(1);
        })
        let inputT = document.querySelector(".textT");
        inputT.addEventListener("input", function () {
            this.value = this.value[0].toUpperCase() + this.value.slice(1);
        })
    </script>
</body>
</html>
