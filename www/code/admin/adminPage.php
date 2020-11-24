<?php
namespace all;

include ($_SERVER['DOCUMENT_ROOT'] . '/config.php');

session_start();

if (!isset($_COOKIE['PHPSESSID']) or $_COOKIE['PHPSESSID'] != session_id()){
    header("Location: /index.php");
    exit();
}

$ps = new pageSource();
$conf = new configFile();
$ps->name = $conf->config['nameprog'];
$ps->css = $conf->config['bootstrapcss'];
$ps->bootstrapJs = $conf->config['bootstrapjs'];
$ps->jquery = $conf->config['jqueryjs'];
$ps->poperJs = $conf->config['poperjs'];


$menuPage = new adminPageSource();
$mniWork = new mniWork();

?>
<!doctype html>
<html lang="ru">
<head>
    <? $ps->printHead(); ?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-2 sticky-top">
            <!-- если был произведен поиск и присутствует $_GET['searchRes'] то вкладка поиск будет открыта по умолчанию -->
            <? if (isset($_GET['searchRes']) and ($_GET['searchRes'] == 1 or $_GET['searchRes'] == 2 or $_GET['searchRes'] == 3)){
                $menuPage->printAdminMenu(1);
            }else{
                $menuPage->printAdminMenu(2);
            } ?>

        </div>
        <div class="col-sm-9 col-md-9 col-lg-10">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- Форма добавления вопроса на на тему -->
                <? if (isset($_GET['err']) and $_GET['err'] == 1){
                    //если поставлено неправильное количество галок, будет ошибка и данные вернуться в форму
                    $menuPage->printMenu1('validDataNewQuestion.php', 'post', 'submit', 0, $_SESSION['InputQestions'], $_SESSION['InputQestionsAnswer1'], $_SESSION['InputQestionsAnswer2'], $_SESSION['InputQestionsAnswer3'], $_SESSION['InputQestionsAnswer4']);
                    print "<script>alert ('Некорректно заполнены поля формы')</script>";
                    session_unset();
                }elseif (isset($_GET['result']) and $_GET['result'] == 1){
                    // Если данные верны, то отобразится модальное окно с текстом вопроса и правильным ответов
                    $menuPage->printMenu1('validDataNewQuestion.php', 'post', 'submit');
                    $menuPage->printModal($_SESSION['text'], $_SESSION['ans']);
                    session_unset();
                }else{
                    //если данная страница загружается впервые, то отобразится только форма нового вопроса
                    // в противном случае будет открываться вкладка поиска. Зависит от $_GET['searchRes']
                    if (isset($_GET['searchRes']) and ($_GET['searchRes'] == 1 or $_GET['searchRes'] == 2 or $_GET['searchRes'] == 3)){
                        $menuPage->printMenu1('validDataNewQuestion.php', 'post', 'submit', 1);
                    }else{
                        $menuPage->printMenu1('validDataNewQuestion.php', 'post', 'submit');
                    }

                }
                 ?>
                <? if (isset($_GET['searchRes']) and $_GET['searchRes'] == 2){
                    //если поиск удачный, то будет выведен кликабельный результат
                    $menuPage->printMenu2('validDataSearch.php', 'post', 'submit', 2);
                    session_unset();
                }elseif(isset($_GET['searchRes']) and $_GET['searchRes'] == 1){
                    //если поиск неудачный, то будет выведено только сообщение
                    $menuPage->printMenu2('validDataSearch.php', 'post', 'submit', 1);
                }elseif(isset($_GET['searchRes']) and $_GET['searchRes'] == 3){
                    //если длина символов 4 и менеее будет выведено сообщение
                    $menuPage->printMenu2('validDataSearch.php', 'post', 'submit', 3);
                }else{
                    //стандартное сообщение поиска
                    $menuPage->printMenu2('validDataSearch.php', 'post', 'submit');

                }
                if (isset($_GET['del']) and $_GET['del'] == 1){
                    print " <script>alert ('Вопрос удален');</script>";
                    session_unset();
                }
                 ?>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    Окно вывода все результатов тестируемых
                </div>
                <div class="tab-pane fade" id="v-pills-mni" role="tabpanel" aria-labelledby="v-pills-mni-tab">
                    <h3 class="align-content-center">Работа с Flash</h3>



                    <div class="accordion" id="accordionMni">
                        <div class="card">
                            <div class="card-header" id="headOne">
                                <h5 class="m-0 p-0">
                                    <button class="btn btn-link text-decoration-none text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Добавить Flash
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headOne" data-parent="#accordionMni">
                                <div class="card-body">
                                    <?
                                    $mniWork->printFormAddMni('validDataMni.php');
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headTwo">
                                <h5 class="m-0 p-0">
                                    <button class="btn btn-link text-decoration-none text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Просмотр базы Flash
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headTwo" data-parent="#accordionMni">
                                <div class="card-body">
                                    <?
                                    $db = new workDb();
                                    $arr = $db->selMni('all');
                                    $mniWork->selRegMni($arr);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="v-pills-faq" role="tabpanel" aria-labelledby="v-pills-faq-tab">
                    Помощь по работе
                </div>
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
