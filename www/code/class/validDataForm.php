<?php


namespace all;

/*
 * Валидация формы входа
 * */


class validDataForm
{
    private $arrErrorValidData = [
        'err1' => 'Не переданы никакие данные в форме входа',
        'err2' => 'Поле логина было пустое',
        'err3' => 'Поле пароля было пустое',
        'err4' => 'Логин ошибочный',
        'err5' => 'Пароль ошибочный',

    ];

    /**
     * Валидация формы входа
     * @param $post - передавется весь суперглобальный массив
     * @return bool|string - возвращает значение True если все ок
     */

    public function validDataFormEntree($login, $pass){
        $conf = new configFile();

        if ($login != ''){
            if ($pass != ''){
                if ($login == $conf->config['login']){
                    if ($pass == $conf->config['pass']){
                        session_start(['cookie_lifetime'=>86400,]);
                        $_SESSION['auth'] = 'ok';
                        return 'ok';
                    }else{
                        return $this->arrErrorValidData['err5'];
                    }
                }else{
                    return $this->arrErrorValidData['err4'];
                }
            }else{
                return $this->arrErrorValidData['err3'];
            }
        }else{
            return $this->arrErrorValidData['err2'];
        }
    }
}