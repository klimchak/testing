<?php


namespace all;


class pageSource
{

    /**
     * тег Head для страниц
     * @param $name - имя проекта. Можно переопределить в конфиге
     * @param $css - путь стилей бутстрап
     * @param $alertError - стандартное значение пустое, при ошибке будет выведен текст сообщения
     */
    public $name;
    public $css;
    public $alertError;
    public function printHead()
    {
        print"    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>$this->name</title> 
    <link rel=\"stylesheet\" href=\"$this->css\">
    <script type=\"text/javascript\">$this->alertError</script>
    ";
    }

    /**
     * Форма входа в панель админа
     * @param $pageValid - параметр куда отдать данные на валидацию и вход
     * @param $typeEntree - тип формы (для использования Ajax)
     */
    public function printFormEntree($pageValid, $typeEntree)
    {
        print"
       <!-- <div class=\"col-3\">  -->
            <form action=\"$pageValid\" method=\"post\">
              <h2 class=\"p-0\">Войти в программу</h2>
              <div class=\"form-group\">
                <label for=\"InputLogin\">Логин</label>
                <input type=\"text\" class=\"form-control\" name=\"InputLogin\" id=\"InputLogin\" aria-describedby=\"LoginHelp\">
                <small id=\"LoginHelp\" class=\"form-text text-muted\">Введите Ваш логин для входа в меню администрирования</small>
              </div>
              <div class=\"form-group\">
                <label for=\"InputPassword\">Password</label>
                <input type=\"password\" class=\"form-control\" name=\"InputPassword\" id=\"InputPassword\" aria-describedby=\"PassHelp\">
                <small id=\"PassHelp\" class=\"form-text text-muted\">Введите Ваш пароль</small>
              </div>
              <!--<div class=\"form-group form-check\">
                <input type=\"checkbox\" class=\"form-check-input\" id=\"exampleCheck1\">
                <label class=\"form-check-label\" for=\"exampleCheck1\">Check me out</label>
              </div>-->
              <button type=\"$typeEntree\" class=\"btn btn-primary\">Войти</button>
            </form>
   <!-- </div>  -->";
    }

    /**
     * @param $bootstrap - путь JS bootstrap
     * @param $jquery - путь JS jquery
     */
    public $bootstrapJs;
    public $jquery;
    public $poperJs;

    public function printJs()
    {
        if ($this->jquery != null){
            print "    <script type=\"text/javascript\" src=\"$this->jquery\"></script>";
        }
        if ($this->poperJs != null){
            print "<script type=\"text/javascript\" src=\"$this->poperJs\"></script>";

        }
        if ($this->bootstrapJs != null){
            print "    <script type=\"text/javascript\" src=\"$this->bootstrapJs\"></script>";
        }

    }

    /**
     * Форма главной страницы перед началом тестирования
     * @param $pageValidIntoTest - путь валидации данных формы и начала прохождения теста
     * @param $typeIntoTest - тип формы (для использования Ajax)
     *
     * на развитие, если нужно будет использовать много ВУС - сделать вываливающийся список
     */
    public function getIntoTest($pageValidIntoTest, $typeIntoTest)
    {
        print " <form action=\"$pageValidIntoTest\" method=\"post\" class='form needs-validation' name='formTest'>
                      <h2 class=\"p-0\">Основные сведения о тестируемом</h2>
                            <div class=\"row\">
                                  <div class=\"col\">
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Отдел:</span>
                                        </div>
                                        <input type=\"text\" class=\"form-control\" id=\"InputRank\" name=\"position\" aria-describedby=\"inputSerialHelp\" placeholder='Укажите ваш отдел' required>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Фамилия:</span>
                                        </div>
                                        <input type=\"text\" class=\"form-control\" id=\"InputLastName\" name=\"lastName\" aria-describedby=\"inputSerialHelp\" placeholder='Введите фамилию' required>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Имя:</span>
                                        </div>
                                        <input type=\"text\" class=\"form-control\" id=\"InputName\" name=\"firstName\" aria-describedby=\"InputNameHelp\" placeholder='Введите имя' required>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Отчество:</span>
                                        </div>
                                        <input type=\"text\" class=\"form-control\" id=\"InputTridName\" name=\"tridName\" aria-describedby=\"InputTridNameHelp\" placeholder='Введите отчество' required>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Дата прохождения:</span>
                                        </div>
                                        <input type=\"date\" class=\"form-control\" id=\"InputDate\" name=\"dateTest\" aria-describedby=\"InputDateTestHelp\" placeholder='Укажите дату' autocomplete='on' required>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Код должности:</span>
                                        </div>
                                        <select name='vus' class=\"form-control\"  id='Check901'>
                                            <option value='vus901'>*9901</option>
                                            <option value='vus903'>*9903</option>
                                            <option value='vus905'>*9905</option>
                                        </select>
                                    </div>
                                    <div class=\"input-group mb-2\">
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Должность тестируемого:</span>
                                        </div>
                                        <select name='vus' class=\"form-control\"  id='Check901'>
                                            <option value='vus901'>Доставка</option>
                                            <option value='vus903'>Доставка (область)</option>
                                            <option value='vus905'>Техник</option>
                                            <option value='vus9906'>Старший техник</option>
                                            <option value='vus9907'>Начальник линии</option>
                                            <option value='vus9908'>Охрана</option>
                                            <option value='vus9909'>Бухгалтера</option>
                                            
                                        </select>
                                    </div>
                                    
                                    
                                   
                                      <hr class='bg-dark'>
                                      <div class=\"form-group form-check\">
                                        <input type=\"radio\" class=\"form-check-input\" name='count' id=\"CheckCount1\" value='30' required>
                                        <label class=\"form-check-label\" for=\"Check905\">30 вопросов</label>
                                      </div>
                                      <div class=\"form-group form-check\">
                                        <input type=\"radio\" class=\"form-check-input\" name='count' id=\"CheckCount2\" value='50' required>
                                        <label class=\"form-check-label\" for=\"Check905\">50 вопросов</label>
                                      </div>
                                      <button type=\"$typeIntoTest\" class=\"btn btn-primary\"  data-toggle=\"popover\" title=\"Внимание\" data-content=\"Перед нажатием заполните все поля\">Пройти тест</button>
                                  </div>
                             </div>
                </form>";

    }

    /**
     * @param $adminlink
     */

    public $adminlink = 'adminPage.php';
    public function printAdminIntoNotification($adminlink)
    {
        print "        <div class=\"jumbotron m-5\">
            <h1 class=\"display-4\">Приветствую в админке!</h1>
            <p class=\"lead\">Этот раздел программы предназначен для её администрирования. В данном разделе Вы сможете добавлять новые вопросы и ответы к ним.</p>
            <hr class=\"my-4\">
            <p>В настоящий момент ведется активная <!-- вялая --> разработка программы и некоторые функции могут быть изменены. Прошу Вас проявить
                <!-- фантазию --> участие в её разработке по вопросам добавления других возможностей.
            </p>
            <p class=\"lead\">
                <a class=\"btn btn-primary btn-lg\" href=\"$adminlink\" role=\"button\">Войти в Админку</a>
            </p>
        </div>";

    }

    /**
     * @param $testLink
     */


    public function printTestIntoNotification($testLink)
    {
    print "    <div class=\"jumbotron m-5\">
                    <h1 class=\"display-4\">Добро пожаловать!</h1>
                    <p class=\"lead\">Короткие правила для длинного прохождения.</p>
                    <hr class=\"my-2\">
                    <p class=\"m-0 p-0\">Вам будет предложено ответить на 30 вопросов. Учет времени прохождения теста не фиксируется<!-- (пока не придумал как это допилить) -->.</p>
                    <p class=\"m-0 p-0\">Для выбора вопроса нажимайте на соответствующий номер и выбирайте верный ответ.</p>
                    <p class=\"m-0 p-0\">Все результаты по каждому факту прохождения фиксируются в базе.</p>
                    <hr class=\"my-2\">
                    <p class=\"lead\">В настоящий момент ведется активная <!-- вялая --> разработка программы и некоторые функции могут быть изменены. Прошу Вас проявить
                        <!-- фантазию --> участие в её разработке по вопросам добавления других возможностей.
                    </p>
                    <p class=\"lead mt-4\">
                        <a class=\"btn btn-primary btn-lg\" href=\"$testLink\" role=\"button\">Начать тест</a>
                    </p>
                </div>";

    }


}