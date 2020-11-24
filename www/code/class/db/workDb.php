<?php


namespace all;

class workDb
{


    /**
     * Функция проверки файла базы данных
     * @return bool если все ОК и файл есть
     */

    public function validFileDb(){
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/db.db')){
            $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'] . 'mydb.db');
            $sql = 'CREATE TABLE vus901 (
                    id INTEGER PRIMARY KEY,
                    text TEXT,
                    v1 TEXT,
                    v2 TEXT,
                    v3 TEXT,
                    v4 TEXT,
                    ans TEXT,)';
            $db->query($sql);
            return false;
        }else{
            return true;
        }

    }

    // считывание файла базы данных
    public function selIdTest($table){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sql = "SELECT id FROM " . $table . ";";
        $result = $db->query($sql);
        $data = array();
        while ($d = $result->fetchArray(SQLITE3_NUM)){
            foreach ($d as $row){
                $data[] = $row;
            }
        }
        return $data;
        $db->close();
    }

    //считывание по ИД
    public function selTestFromId($table, $id){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sql = "SELECT 
            id,
            text,
            v1,
            v2,
            v3,
            v4,
            ans  FROM " . $table . " WHERE id = " . $id . ";";
        $result = $db->query($sql);
        $data = array();
        while ($d = $result->fetchArray(SQLITE3_NUM)){
            foreach ($d as $row){
                $data[] = $row;
            }
        }
        return $data;
        $db->close();
    }

    /**
     * @param $table
     * @param $text
     * @param $v1
     * @param $v2
     * @param $v3
     * @param $v4
     * @param $ans
     */
    public function creatNewQ($table, $text, $v1, $v2, $v3, $v4, $ans){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sql = "INSERT INTO " . $table . " (
            id,
            text,
            v1,
            v2,
            v3,
            v4,
            ans
        ) VALUES (
                   NULL,
                   '". $text ."',
                   '". $v1 ."',
                   '". $v2 ."',
                   '". $v3 ."',
                   '". $v4 ."',
                   '". $ans ."'
                   )";
        $db->exec($sql);

    }

    /**
     * @param $table
     * @param $handle
     * @return array
     */
    public function selHandleSearch($table, $handle){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sql = "SELECT id,
       text,
       v1,
       v2,
       v3,
       v4,
       ans
  FROM " . $table . " WHERE text LIKE '%" . $handle . "%';";
        $result = $db->query($sql);
        $data = array();
        while ($d = $result->fetchArray(SQLITE3_ASSOC)){
            $data[] = $d;
        }
        return $data;
        $db->close();
    }


    /**
     * @param $tableDel
     * @param $tableUp
     * @param $id
     * @param $quest
     * @param $ans1
     * @param $ans2
     * @param $ans3
     * @param $ans4
     * @param $validAns
     */
    public function updateQuest($tableDel, $tableUp, $id, $quest, $ans1, $ans2, $ans3, $ans4, $validAns){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sqlDel = "DELETE FROM " . $tableDel . " WHERE id = " . $id . ";";
        $db->exec($sqlDel);
        $sqlUp = "INSERT INTO " . $tableUp . "(
               id,
               text,
               v1,
               v2,
               v3,
               v4,
               ans
           )
           VALUES (
               NULL,
               '" . $quest . "',
               '" . $ans1 . "',
               '" . $ans2 . "',
               '" . $ans3 . "',
               '" . $ans4 . "',
               '" . $validAns . "'
           );";
        $db->exec($sqlUp);
    }


    /**
     * @param $id
     * @param $table
     */
    public function delQuest( $table, $id){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/db.db');
        $sql = "DELETE FROM " . $table . " WHERE id = " . $id . ";";
        $db->exec($sql);
    }

    public function selMni($col, $id = '', $sn = false){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/dbmni.db');
        if ($col = 'all'){
            $sql = "SELECT id,
                           serialNumber,
                           regNumber,
                           typeMni
                      FROM mni;";
        $result = $db->query($sql);
        }elseif($col == '' and $id != ''){
            $sql = "SELECT id,
                           serialNumber,
                           regNumber,
                           typeMni
                      FROM mni
                      WHERE id = " . $id;
        $result = $db->query($sql);
        }
        if ($col = 'all' and $sn == true){
            $sql = "SELECT serialNumber,
                           regNumber
                      FROM mni";
            $result = $db->query($sql);
        }
        $data = array();
        $a = 0;
        while ($d = $result->fetchArray(SQLITE3_NUM)){
            $data[$a] = $d;
            ++$a;
        }
        return $data;
        $db->close();
    }

    public function addMni($sn, $regN, $division){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/dbmni.db');
        $sql = "INSERT INTO mni (
               id,
               serialNumber,
               regNumber,
               typeMni
           )
           VALUES (
               NULL,
               '" . $sn . "',
               '" . $regN . "',
               '" . $division . "'
           );";
        $db->exec($sql);
        $db->close();
    }

    public function delMni($id){
        $db = new \SQLite3($_SERVER['DOCUMENT_ROOT'].'/dbmni.db');
        $sqlDel = "DELETE FROM mni WHERE id = " . $id . ";";
        $db->exec($sqlDel);
        $db->close();
    }

    public function upMni($id, $sn, $regN, $division){
        $this->delMni($id);
        $this->addMni($sn, $regN, $division);
    }

}
