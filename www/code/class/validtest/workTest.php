<?php


namespace all;


class workTest
{
    static function lenthArrId($arrIdVus, $count, $vus){
        //экз класса работы с базой
        $db = new workDb();
        if (count($arrIdVus) > $count){
            $arrIdVus901 = array_splice($arrIdVus901, 0, $count);
        }
        //получаем вопросы с ответами в порядке перемешанного массива
        foreach ($arrIdVus901 as $item) {
            $_SESSION["$vus"][] = $db->selTestFromId("$vus", $item);
        }
        $db->close();
    }
    public function selTestShifr901($countTest, $spec){
        //экз класса работы с базой
        $db = new workDb();
        //получаем id вопросов
        $arrIdVus901 = $db->selIdTest('vus901');
        //все перемешиваем в рандоме
        shuffle($arrIdVus901);
        //проверка на длину массива
        if ($countTest == 30){
            self::lenthArrId($arrIdVus901, 25, 'vus901');
        }elseif ($countTest == 50){
            self::lenthArrId($arrIdVus901, 25, 'vus901');
        }

        if ($spec == 1){
            //получаем id вопросов по 903му
            $arrIdVus903 = $db->selIdTest('vus903');
            //все перемешиваем в рандоме
            shuffle($arrIdVus901);
        }
    }

}