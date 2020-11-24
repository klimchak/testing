<?php


namespace all;


class adminPageSource
{

    public $returnPage;

    /**
     * меню админки
     * @param $searchRes
     */
    public function printAdminMenu($searchRes){
        print "<div class=\"nav flex-column nav-pills\" id=\"v-pills-tab\" role=\"tablist\" aria-orientation=\"vertical\">";
        if ($searchRes == 1){
            print "<a class=\"nav-link text-dark\" id=\"v-pills-home-tab\" data-toggle=\"pill\" href=\"#v-pills-home\" role=\"tab\" aria-controls=\"v-pills-home\" aria-selected=\"true\">Добавление вопроса</a>";
            print "<a class=\"nav-link text-dark active\" id=\"v-pills-profile-tab\" data-toggle=\"pill\" href=\"#v-pills-profile\" role=\"tab\" aria-controls=\"v-pills-profile\" aria-selected=\"false\">Поиск вопросов</a>";
        }elseif($searchRes == 2){
            print "<a class=\"nav-link text-dark active\" id=\"v-pills-home-tab\" data-toggle=\"pill\" href=\"#v-pills-home\" role=\"tab\" aria-controls=\"v-pills-home\" aria-selected=\"true\">Добавление вопроса</a>";
            print "<a class=\"nav-link text-dark\" id=\"v-pills-profile-tab\" data-toggle=\"pill\" href=\"#v-pills-profile\" role=\"tab\" aria-controls=\"v-pills-profile\" aria-selected=\"false\">Поиск вопросов</a>";
            }
        print "    <a class=\"nav-link text-dark\" id=\"v-pills-messages-tab\" data-toggle=\"pill\" href=\"#v-pills-messages\" role=\"tab\" aria-controls=\"v-pills-messages\" aria-selected=\"false\">Результаты тестируемых</a>
                   <a class=\"nav-link text-dark\" id=\"v-pills-mni-tab\" data-toggle=\"pill\" href=\"#v-pills-mni\" role=\"tab\" aria-controls=\"v-pills-mni\" aria-selected=\"false\">База flash</a>
                   <a class=\"nav-link text-dark\" id=\"v-pills-faq-tab\" data-toggle=\"pill\" href=\"#v-pills-faq\" role=\"tab\" aria-controls=\"v-pills-faq\" aria-selected=\"false\">FAQ</a>
                   <button type=\"button\" class=\"btn btn-dark\" data-toggle=\"popover\" title=\"Сообщение\" data-content=\"Выйти в начальное окно программы\">
                        <a class=\"btn-link text-white text-decoration-none\" href=\"/index.php\">Выход</a>
                    </button>
               </div>";
    }


    /**
     * Меню первой вкладки
     * @param $action - куда передать значение
     * @param $method - каким методом
     * @param $typeBtn - тип кнопки
     * @param int $serchRes
     * @param string $InputQestions - текст вопроса, в случае ошибки
     * @param string $IQAnswer1 - текст 1 ответа, в случае ошибки
     * @param string $IQAnswer2 - текст 2 ответа, в случае ошибки
     * @param string $IQAnswer3 - текст 3 ответа, в случае ошибки
     * @param string $IQAnswer4 - текст 4 ответа, в случае ошибки
     */
    public function printMenu1($action, $method, $typeBtn, $serchRes = 0, $select = 0, $selectBtn = 'Добавить' , $InputQestions = '', $IQAnswer1 = '', $IQAnswer2 = '', $IQAnswer3 = '', $IQAnswer4 = '', $questId = '' ){

        if ($serchRes == 0){
            print "<div class=\"tab-pane fade show active\" id=\"v-pills-home\" role=\"tabpanel\" aria-labelledby=\"v-pills-home-tab\">";
        }else{
            print "<div class=\"tab-pane fade\" id=\"v-pills-home\" role=\"tabpanel\" aria-labelledby=\"v-pills-home-tab\">";
        }
        print "<form class='was-validated' action=\"$action\" method=\"$method\">";
                        if ($select != 0){
                            print "<h2 class=\"h2\">Форма изменения вопроса</h2>";
                        }else{
                            print "<h2 class=\"h2\">Форма добавления вопроса</h2>";
                        }

                 print "<div class=\"container-fluid m-0 p-0\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <div class=\"form-group\">";
                                if ($select != 0){
                                    print "<input type=\"text\" class=\"form-control\" name=\"idQuest\" value='$questId' readonly>
                                    </div>
                                    <div class=\"form-group\">
                                    ";
                                }

                                 print "
                                        <label for=\"InputQestions\">Текст вопроса</label>
                                        <textarea type=\"text\" class=\"form-control\"  id=\"InputQestions\" name=\"InputQestions\" aria-describedby=\"InputQestionsHelp\" value='' required placeholder='Текст вопроса'>$InputQestions</textarea>
                                        <small id=\"InputQestionsHelp\" class=\"form-text text-muted\">Укажите текса вопроса</small>
                                    </div>
                                    <div class=\"container-fluid\">
                                        <div class=\"row\">
                                            <div class=\"col-3 align-items-center justify-content-center\">
                                                <h6 class=\"h6\">Укажите правильный ответ</h6>
                                                <div class=\"form-check\">
                                                    <input type=\"radio\" class=\"form-check-input\" name=\"IQ\" id=\"IQ1\" value='1' checked>
                                                    <label for=\"IQ1\">Вариант 1</label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input type=\"radio\" class=\"form-check-input\" name=\"IQ\" id=\"IQ2\" value='2'>
                                                    <label for=\"IQ2\">Вариант 2</label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input type=\"radio\" class=\"form-check-input\" name=\"IQ\" id=\"IQ3\" value='3'>
                                                    <label for=\"IQ3\">Вариант 3</label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input type=\"radio\" class=\"form-check-input\" name=\"IQ\" id=\"IQ4\" value='4'>
                                                    <label for=\"IQ4\">Вариант 4</label>
                                                </div>
                                                <label for=\"SearchInputHelp\">Укажите код должности для добавления вопроса</label>
                                                <div class=\"form-check\">
                                                      <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios1\" value=\"vus901\" checked>
                                                      <label class=\"form-check-label\" for=\"vusRadios1\">
                                                        КОД-*9901
                                                      </label>
                                                </div>
                                                <div class=\"form-check\">
                                                      <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios2\" value=\"vus903\">
                                                      <label class=\"form-check-label\" for=\"vusRadios2\">
                                                        КОД-*9903
                                                      </label>
                                                </div>
                                                <div class=\"form-check disabled\">
                                                      <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios3\" value=\"vus905\" >
                                                      <label class=\"form-check-label\" for=\"vusRadios3\">
                                                        КОД-*9905
                                                      </label>
                                                </div>
                                            </div>
                                            <div class=\"col-9\">
                                                <div class=\"form-group\">
                                                    <label for=\"InputQestionsAnswer1\">Текст ответа вариант 1</label>
                                                    <textarea type=\"text\" class=\"form-control\" name=\"InputQestionsAnswer1\" value='' id=\"InputQestions\" placeholder='Ответ 1' aria-describedby=\"InputQestionsHelp1\" required>$IQAnswer1</textarea>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"InputQestionsAnswer2\">Текст ответа вариант 2</label>
                                                    <textarea type=\"text\" class=\"form-control\" name=\"InputQestionsAnswer2\" value='' id=\"InputQestions\" placeholder='Ответ 2' aria-describedby=\"InputQestionsHelp2\" required>$IQAnswer2</textarea>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"InputQestionsAnswer3\">Текст ответа вариант 3</label>
                                                    <textarea type=\"text\" class=\"form-control\" name=\"InputQestionsAnswer3\" value='' id=\"InputQestions\" placeholder='Ответ 3' aria-describedby=\"InputQestionsHelp3\" required>$IQAnswer3</textarea>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"InputQestionsAnswer4\">Текст ответа вариант 4</label>
                                                    <textarea type=\"text\" class=\"form-control\" name=\"InputQestionsAnswer4\" value='' id=\"InputQestions\" placeholder='Ответ 4' aria-describedby=\"InputQestionsHelp4\" required>$IQAnswer4</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                    if ($selectBtn != 0){
                                        print "<button type=\"$typeBtn\" class=\"btn btn-primary mr-3\">Изменить</button>";
                                        print "<button type=\"$typeBtn\" class=\"btn btn-primary ml-3\" name='del' value='ok' data-toggle=\"popover\"title=\"Внимание\" data-content=\"Данное действие необратимо\">Удалить</button>";
                                    }else{
                                        print "<button type=\"$typeBtn\" class=\"btn btn-primary\">Добавить</button>";
                                    }

                                print "</div>
                            </div>
                        </div>
                    </form>
                </div>";

    }

    /**
     * Форма поиска
     *
     * @param $action - куда пересылать данные
     * @param $method - каким методом
     * @param $typeBtn - тип кнопки
     * @param int $searchRes
     */
    public function printMenu2( $action, $method, $typeBtn, $searchRes = 0){

        if ($searchRes == 0){
            print "<div class=\"tab-pane fade\" id=\"v-pills-profile\" role=\"tabpanel\" aria-labelledby=\"v-pills-profile-tab\">";
        }else{
            print "<div class=\"tab-pane fade show active\" id=\"v-pills-profile\" role=\"tabpanel\" aria-labelledby=\"v-pills-profile-tab\">";
        }

         print "    <div class=\"container-fluid\">
                        <div class=\"row\">
                            <div class=\"col\">
                                <form class='needs-validation mt-3' action=\"$action\" method=\"$method\" >
                                    <div class=\"form-group\">
                                        <input type=\"search\" id=\"SearchInput\" name=\"ValueSearch\" class=\"form-control\" placeholder=\"Укажите ключевое слово (слова)\" aria-describedby=\"SearchInputHelp\" required>
                                        <label for=\"SearchInputHelp\">Укажите текст запроса и КОД должности для поиска</label>
                                        <div class=\"form-check\">
                                              <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios1\" value=\"vus901\" checked>
                                              <label class=\"form-check-label\" for=\"vusRadios1\">
                                                КОД-*9901
                                              </label>
                                        </div>
                                        <div class=\"form-check\">
                                              <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios2\" value=\"vus903\">
                                              <label class=\"form-check-label\" for=\"vusRadios2\">
                                                КОД-*9903
                                              </label>
                                        </div>
                                        <div class=\"form-check disabled\">
                                              <input class=\"form-check-input\" type=\"radio\" name=\"vus\" id=\"vusRadios3\" value=\"vus905\" >
                                              <label class=\"form-check-label\" for=\"vusRadios3\">
                                                КОД-*9905
                                              </label>
                                        </div>
                                        <button type=\"$typeBtn\" class=\"btn btn-primary\">Поиск</button>
                                    </div>
                                </form>
                            </div>
                        </div>";
        if ($searchRes == 2){
            print "<div class=\"row\">";
            print "    <div class=\"col\">
                            <h4 class=\"col\">Результаты поиска по КОДу-" . str_replace('vus', '', $_GET['vus']) . "</h4>
    ";
            $i = 1;


            foreach ($_SESSION as $item){
                if ($item != 'ok'){
                    print "<h5 class=\"p-1 border-top \" data-toggle=\"modal\" data-target=\"#searchRes$i\">Вопрос $i</h5>";
                    print "<p class=\"p-1 border-bottom \" data-toggle=\"modal\" data-target=\"#searchRes$i\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">" . $item['text'] . "</span></p>";
                    $this->printModalResSearch('searchRes' . $i, 'searchRes' . $i . 'ModalLabel' , 'updateDataQuest.php?vus=' . $_GET['vus'], 'post', 'submit', 0, $item['text'], $item['v1'], $item['v2'], $item['v3'], $item['v4'], $item['id']);
                }
                ++$i;
            }
             print "     </div>";
             print "</div>";
        }elseif ($searchRes == 1){
            print "<div class=\"row\">
                        <div class=\"col\">
                            <p class='text-primary'>Поиск не дал результатов.</p>
                        </div>
                    </div>";
        }elseif ($searchRes == 3){
                print "<div class=\"row\">
                            <div class=\"col\">
                                <p class='text-alert'>Длина запроса должна превышать 4 символа.</p>
                            </div>
                        </div>";

        }else{
            print "<div class=\"row\">
                            <div class=\"col\">
                                <p class='text-primary'>Результаты поиска.</p>
                            </div>
                        </div>";
        }
        print "     </div>
                </div>";

    }

    /**
     * Вывод модального окна при успешной записи вопроса в базу
     * @param $text - текст вопроса
     * @param $ans - текста правильного ответа
     * @param string $idModal
     */


    public function printModal($text, $ans, $idModal = 'exampleModal', $vus = ''){

        print " <div class=\"modal fade\" id=\"$idModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\" role=\"document\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <h5 class=\"modal-title\" id=\"exampleModalLabel\">Вопрос добавлен</h5>
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>
                            <div class=\"modal-body\">";
            if (isset($_GET['vus']) and $_GET['vus'] != null){
                print " <p class=\"p-0 text-danger text-uppercase\">Текст вопроса:</p>";
            }else{
                print " <p class=\"p-0 text-danger text-uppercase\">Текст вопроса:</p>";
            }
                        print " <p class=\"p-0\">$text</p>
                                <p class=\"p-0 text-danger text-uppercase\">С правильным вариантом ответа:</p>
                                <p class=\"p-0\">$ans</p>
                            </div>
                            <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>";

    }


    /**
     * @param string $idModal
     * @param $ariaLab
     * @param $actionS
     * @param $methodS
     * @param $typeBtnS
     * @param $serchRes
     * @param $InputQestionsS
     * @param $IQAnswer1S
     * @param $IQAnswer2S
     * @param $IQAnswer3S
     * @param $IQAnswer4S
     * @param $questId
     */
    public function printModalResSearch($idModal = 'exampleModal', $ariaLab, $actionS, $methodS, $typeBtnS, $serchRes, $InputQestionsS, $IQAnswer1S, $IQAnswer2S, $IQAnswer3S, $IQAnswer4S, $questId){

        print " <div class=\"modal fade\" id=\"$idModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"$ariaLab\" aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-dialog-centered modal-dialog-scrollable\" role=\"document\" \">
                        <div class=\"modal-content\" style=\"min-width: 150%;\">
                            <div class=\"modal-header\">
                                <h5 class=\"modal-title\" id=\"exampleModalLabel\">Изменение вопроса</h5>
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>
                            <div class=\"modal-body\">";
                                $this->printMenu1($actionS, $methodS, $typeBtnS, $serchRes, 1, 1, $InputQestionsS, $IQAnswer1S, $IQAnswer2S, $IQAnswer3S, $IQAnswer4S, $questId);
        print "             </div>
                            <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>";

    }

}