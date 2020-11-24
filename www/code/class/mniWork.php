<?php


namespace all;


class mniWork
{

    public function getPathUsbDev(){
        /*
        * открытие текстового файла и его парсинг в массив
        * */
        $handle = fopen($_SERVER['DOCUMENT_ROOT'] . '\work_mni\programm\mnilog', 'r');
        $arr = file($_SERVER['DOCUMENT_ROOT'] . '\work_mni\programm\mnilog');
        $i = 1;
        $arr2 = [];
        foreach ($arr as $arr_line){
            if (strstr($arr_line, 'Description       :')){
                $arr_line = str_replace('Description       : ', '', $arr_line);
                $arr_line = trim($arr_line);
                $arr2[$i][1] = $arr_line;
            }
            if (strstr($arr_line, 'Device Type       :')){
                $arr_line = str_replace('Device Type       : ', '', $arr_line);
                $arr_line = trim($arr_line);
                $arr2[$i][2] = $arr_line;
            }
            if (strstr($arr_line, 'Serial Number     :')){
                $arr_line = str_replace('Serial Number     : ', '', $arr_line);
                $arr_line = trim($arr_line);
                $arr2[$i][3] =$arr_line;
            }
            if (strstr($arr_line, 'Registry Time 1   :')){
                $arr_line = str_replace('Registry Time 1   : ', '', $arr_line);
                $arr_line = trim($arr_line);
                $arr2[$i][4] = $arr_line;
            }
            if (strstr($arr_line, 'Registry Time 2   :')){
                $arr_line = str_replace('Registry Time 2   : ', '', $arr_line);
                $arr_line = trim($arr_line);
                $arr2[$i][5] = $arr_line;
            }
            if (strstr($arr_line, 'Disconnect Time   :')){
                ++$i;
            }
        }
        fclose($handle);
        return $arr2;
    }

    //получение всех МНИ из файла
    public function selAllMni($arr2){
        ?>
        <table class="table table-sm table-dark table-hover">
            <thead>
            <tr class="mb-2 mt-2">
                <th scope="col">#</th>
                <th scope="col" class="pb-2 pt-2 text-left">Описание</th>
                <th scope="col" class="pb-2 pt-2 text-left">Тип устр-ва</th>
                <th scope="col" class="pb-2 pt-2 text-left">Серийный номер</th>
                <th scope="col" class="pb-2 pt-2 text-left">Дата первого подкл.</th>
                <th scope="col" class="pb-2 pt-2 text-left">Дата крайнего подкл.</th>
                <th scope="col" class="pb-2 pt-2 text-left">Регистрац. номер</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?
                $a = 1;
                foreach ($arr2 as $arr_in){
                    if ($arr_in[3] != ''){
                        print "<tr>";
                        print "<th scope=\"row\">$a</th>";
                        foreach ($arr_in as $line){
                            print "<td class='text-danger'>$line</td>";
                        }
                    }else{
                        print "<tr>";
                        print "<th scope=\"row\">$a</th>";
                        foreach ($arr_in as $line){
                            print "<td>$line</td>";
                        }
                    }
                    print "</tr>";
                    ++$a;
                }
                ?>


            </tbody>
        </table>
        <?php
    }

    //получение всех МНИ из базы
    public function selRegMni($arr){
       print "<table class=\"table table-sm table-hover\">
            <thead>
            <tr class=\"mb-2 mt-2\">
                <th scope=\"col\">Id Flash по базе</th>
                <th scope=\"col\" class=\"pb-2 pt-2 text-left\">Серийный номер</th>
                <th scope=\"col\" class=\"pb-2 pt-2 text-left\">Регистрац. номер</th>
                <th scope=\"col\" class=\"pb-2 pt-2 text-left\">Отдел</th>
            </tr>
            </thead>
            <tbody class='text-left'>";
            $b = 1;
            $c = 1;
            foreach ($arr as $arr_in){
                if ($arr_in[3] == 's'){
                    print "<tr>";
                    foreach ($arr_in as $line){
                        if ($line == 's'){
                            print "<td class='text-primary' class='text-danger' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">Общие компьютеры</span></td>";
                            continue;
                        }
                        print "<td class='text-primary' class='text-danger' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">$line</span></td>";
                    }
                }elseif($arr_in[3] == 'ss'){
                    print "<tr>";
                    foreach ($arr_in as $line){
                        if ($line == 'ss'){
                            print "<td class='text-danger' class='text-danger' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">Техн. отдел</span></td>";
                            continue;
                        }
                        print "<td class='text-danger' class='text-danger' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">$line</span></td>";
                    }
                }else{
                    print "<tr>";
                    foreach ($arr_in as $line){
                        if ($line == 'd'){
                            print "<td  class='text-dark' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">Библитека и клуб</span></td>";
                            continue;
                        }
                        print "<td  class='text-dark' data-toggle=\"modal\" data-target=\"#searchRes$b\"><span class='' data-toggle=\"popover\" title=\"Подсказка\" data-content=\"Нажми для просмотра и изменения\">$line</span></td>";
                    }
                }

                print "</tr>";
                $this->printModalMni($arr_in[1], $arr_in[2], "searchRes$b", 'validDataMni.php', $arr_in[0]);

                ++$b;
            }

        print "    </tbody>
            </table>";

    }

    public function printFormAddMni($pageValidDataMni, $id = '', $sn = '', $reg = '', $sel = false){
        print"  <form action=\"$pageValidDataMni\" method=\"post\" class='px-4 py-3 form needs-validation name='validDataMni'>
                    <div class=\"input-group mb-2\">
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>Серийный номер:</span>
                        </div>
                        <input type=\"text\" class=\"form-control\" id=\"inputSerialMni\" name=\"serialN\" aria-describedby=\"inputSerialHelp\" value=\"$sn\" required>
                    </div>
                    <div class=\"input-group mb-2\">
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>Регистрационный номер:</span>
                        </div>
                        <input type=\"text\" class=\"form-control\" id=\"inputRegNumberMni\" name=\"RegNumber\" aria-describedby=\"inputSerialHelp\" value=\"$reg\" required>
                    </div>
                    <div class=\"input-group mb-2\">
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>За каким отделом числится:</span>
                        </div>
                        <select name='division' class=\"form-control\"  id='division'>
                            <option value='d'>Библитека и клуб</option>
                            <option value='s'>Общие компьютеры</option>
                            <option value='ss'>Техн. отдел</option>
                        </select>
                    </div>";
                    if ($sel == false){
                        print "<button class=\"btn btn-secondary\" type=\"submit\">Добавить</button>";
                    }

                    if ($sel == true){
                        print "<div class=\"input-group mb-2\">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Id Flash по базе:</span>
                                    </div>
                                    <input type=\"text\" class=\"form-control\" id=\"inputIdNumberMni\" name=\"IdNumber\" aria-describedby=\"inputSerialHelp\" value=\"$id\" required aria-disabled='true'>
                                </div>";
                        print "<button class=\"btn btn-secondary\" type=\"submit\" name='sel' value='edit'>Изменить</button>";
                        print "<button class=\"btn btn-secondary\" type=\"submit\" name='sel' value='del'>Удалить</button>";
                    }
                    print "</form>";


    }

    public function printModalMni($sn, $reg, $idModal, $validPage, $id){

        print " <div class=\"modal fade\" id=\"$idModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\" role=\"document\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <h5 class=\"modal-title\" id=\"exampleModalLabel\">Выбранный Flash</h5>
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>
                            <div class=\"modal-body\">";
                            $this->printFormAddMni($validPage, $id, $sn, $reg, true);
                    print "</div>
                            <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>";

    }

}