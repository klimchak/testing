<?php


namespace all;


class validDataQuestAdmin
{

    /*
     * Проверка на отметки галками варианта ответа
     * */
    public function validAnsOn(){
            if (isset($_POST['IQ1']) and !isset($_POST['IQ2']) and !isset($_POST['IQ3']) and !isset($_POST['IQ4'])){
                return true;
            }
            if (!isset($_POST['IQ1']) and isset($_POST['IQ2']) and !isset($_POST['IQ3']) and !isset($_POST['IQ4'])){
                return true;
            }
            if (!isset($_POST['IQ1']) and !isset($_POST['IQ2']) and isset($_POST['IQ3']) and !isset($_POST['IQ4'])){
                return true;
            }
            if (!isset($_POST['IQ1']) and !isset($_POST['IQ2']) and !isset($_POST['IQ3']) and isset($_POST['IQ4'])){
                return true;
            }
    }

    static $symbols = array("+", " ", "\r\n", "\n", "\r");
    static function exTextArea($item, $replaceSymbol = '+', $callback = false){
        if (strpbrk($item, "\r\n ") == false){
            if ($callback == true){
                return $item;
                exit();
            }
            return false;
        }else{
            $validSrt = str_replace(self::$symbols, $replaceSymbol, $item);
            return $validSrt;
        }
    }


    /**
     * @param $item
     * @return bool|string|string[]
     */

    public function validDataRN(){
        /*
         * Проверка данных при неправильно установленных галках
         * */
        if (isset($_POST['InputQestions'])){
            if ($this::exTextArea($_POST['InputQestions']) != false){
                $_SESSION["InputQestions"] = $this::exTextArea($_POST['InputQestions'], ' ');
            }else{
                $_SESSION["InputQestions"] = $_POST['InputQestions'];
            }
        }

        if (isset($_POST['InputQestionsAnswer1'])){
            if ($this::exTextArea($_POST['InputQestionsAnswer1']) != false){
                $_SESSION["InputQestionsAnswer1"] = $this::exTextArea($_POST['InputQestionsAnswer1'], ' ');
            }else{
                $_SESSION["InputQestionsAnswer1"] = $_POST['InputQestionsAnswer1'];
            }
        }

        if (isset($_POST['InputQestionsAnswer2'])){
            if ($this::exTextArea($_POST['InputQestionsAnswer2']) != false){
                $_SESSION["InputQestionsAnswer2"] = $this::exTextArea($_POST['InputQestionsAnswer2'], ' ');
            }else{
                $_SESSION["InputQestionsAnswer2"] = $_POST['InputQestionsAnswer2'];
            }
        }

        if (isset($_POST['InputQestionsAnswer3'])){
            if ($this::exTextArea($_POST['InputQestionsAnswer3']) != false){
                $_SESSION["InputQestionsAnswer3"] = $this::exTextArea($_POST['InputQestionsAnswer3'], ' ');
            }else{
                $_SESSION["InputQestionsAnswer3"] = $_POST['InputQestionsAnswer3'];
            }
        }

        if (isset($_POST['InputQestionsAnswer4'])){
            if ($this::exTextArea($_POST['InputQestionsAnswer4']) != false){
                $_SESSION["InputQestionsAnswer4"] = $this::exTextArea($_POST['InputQestionsAnswer4'], ' ');
            }else{
                $_SESSION["InputQestionsAnswer4"] = $_POST['InputQestionsAnswer4'];
            }
        }

    }
}