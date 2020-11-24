<?php


namespace all;

/*
 * Валидация важных файлов проекта
 * */

class validFileP
{
    public $alertError = '';
    public function validAllFiles(){
        $arrErrorProject = [
            'er1' => 'отсутствует файл конфигурации проекта',
            'er2' => 'отсутствует файл стилей Bootstrap',
            'er3' => 'отсутствует файл Js Bootstrap',
            'er4' => 'отсутствует файл Js jQuery',
            'er5' => 'отсутствует файл базы данных',
            'er6' => '',
            'er7' => '',
            'er8' => ''
        ];

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/config.php')){
            $this->alertError = $arrErrorProject['er1'];
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/node_modules/bootstrap/dist/css/bootstrap.css')){
            $this->alertError = $arrErrorProject['er2'];
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/node_modules/bootstrap/dist/js/bootstrap.js')){
            $this->alertError = $arrErrorProject['er3'];
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/node_modules/jquery/dist/jquery.js')){
            $this->alertError = $arrErrorProject['er4'];
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/db.db')){
            $this->alertError = $arrErrorProject['er5'];
        }
    }

}


