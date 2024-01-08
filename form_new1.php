<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "Форма ввода работы";
include "head.html";
include "config.php";
include "ip2.php";
$d2 = date("d.m.Y");
// шапка таблицы:
 echo "<table $tab>
 <tr><td colspan=5>
                                <font size=3 color=blue><b>ФОРМА ВВОДА РАБОТЫ</b></font>
                                </td></tr>
        <tr><td colspan=5>
                                        <form method='post' action='dataput_new.php'>
                                        Дата:
                                        <INPUT type=text class=bg name='Date3' value=$d2 size='7'>
                                        <IMG id='DATE3Trigger' src='K.files/calend.gif' style='cursor:hand'>
                                        <SCRIPT type=text/javascript>
                                        Calendar.setup({
                                        inputField : 'Date3', // ID of the input field
                                        ifFormat   : '%d.%m.%Y', // the date format
                                        button     : 'DATE3Trigger', // ID of the button
                                        showsTime  : true,
                                        timeFormat :24
                                        });
                                        </SCRIPT><BR>
        </td></tr>
 <tr>
 <td $td>№ ЭЧК,Нар.,Расп.</td><td $td>Производитель</td>
 <td $td width=100>Время работы</td><td $td>Место работы</td><td $td>Работа</td></tr>";

 //тело таблицы:

        for ($u=1; $u <= 5; $u++)
                {
                        echo
                        "<tr>
                        <td $td valign='top'>
                        ЦЕХ:<SELECT NAME='1work$u'>        <OPTION>$ceha</select></span></font><br>
                        Наряд№<INPUT type=text name='2work$u' size='3'><br>
                        Расп№ <INPUT type=text name='3work$u' size='3'><br>
                        <p align=left>
                        <INPUT TYPE=checkbox NAME='26work$u'> в окно<br>
                        <INPUT TYPE=checkbox NAME='27work$u'> Совм.окно
                        </td>
                        <td $td valign='top'>
                        <SELECT NAME='4work$u'>
                        <OPTION>
                        $proizvoditeli</select><br>
                        <p align=left>
                        <INPUT TYPE=checkbox NAME='5work$u'> - Под U<br>
                        <INPUT TYPE=checkbox NAME='31work$u'> - на ВЛ АБ, ПЭ, ДПР<br>
                        <INPUT TYPE=checkbox NAME='16work$u'> - Обеспечение ПЧ-ПМС<br>
                        <INPUT TYPE=checkbox NAME='17work$u'> - Обеспечение ЭМП<br>
                        <INPUT TYPE=checkbox NAME='21work$u'> - Обеспечение ШЧ<br>
                        <INPUT TYPE=checkbox NAME='22work$u'> - Обеспечение РЦС<br>
                        <INPUT TYPE=checkbox NAME='29work$u'> - Обеспечение СМП<br>
                        <INPUT TYPE=checkbox NAME='30work$u'> - Обеспечение проч.<br>
                        </td>
                        <td $td valign='top'>
                        <INPUT type=text name='6work$u' size='2'>
                        <b>: </b>
                        <INPUT type=text name='7work$u' size='2'><br>
                        <INPUT type=text name='8work$u' size='2'>
                        <b>: </b>
                        <INPUT type=text name='9work$u' size='2'>
                        </td>
                        <td $td valign='top'>
                        <SELECT NAME='10work$u'>
                        <OPTION>
                        $peregons</select>
                        <INPUT type=text name='11work$u' size='2'><br>
                        <SELECT NAME='12work$u'>
                        <OPTION>
                        $stancii</select>
                        <INPUT type=text name='13work$u' size='2'><br>
                        <INPUT type=text name='14work$u' size='23'>
                        <p align=left>
                        <INPUT TYPE=checkbox NAME='23work$u'> - Обход с осмотром<br>
                        <INPUT TYPE=checkbox NAME='24work$u'> - Объезд с осмотром<br>
                        <INPUT TYPE=checkbox NAME='25work$u'> - Объезд с ВИКС
                        </td>
                        <td $td valign='top'><p align=left>
                        <textarea rows='4' name='15work$u' cols='30'></textarea><br>
                        <INPUT type=text name='18work$u' size='2'> - Проверено км.эксп.дл.<br>
                        <INPUT type=text name='19work$u' size='2'> - Выявлено Замечаний<br>
                        <INPUT type=text name='20work$u' size='2'> - Устранено Замечаний<br>
                        <INPUT type=text name='28work$u' size='2'> - Отремонтировано заземлений<br>
                        </td>
                        </tr>";
                };
                //{ прочитаем работы на подстанциях\проверенных бригад\собраний\инстуктажей
                $file = "./data/$d2-R/eche.csv";
                if (is_file($file))
                {
                        $file2 = fopen("./data/$d2-R/eche.csv","a+");
                        $eche = fgets ($file2);
                        $str_rab = explode("|", $eche);
                        fclose ($file2);
                };
        //}x
        echo "</table>
                        <table $tab2>
                        <tr><td>
                        Всего работ на подстанциях (по Всем кругам): <INPUT type=text name='eche1' size='2' value=$str_rab[1]>
                        <br>
                        Всего проверенных бригад (по Всем кругам): <INPUT type=text name='provereno1' size='2' value=$str_rab[2]>
                        <br>
                        Проведено совещаний/собраний (по Всем кругам): <INPUT type=text name='sobranie1' size='2' value=$str_rab[3]>
                        <br>
                        Всего проинструктировано работников (по Всем кругам): <INPUT type=text name='insruktagi1' size='2' value=$str_rab[4]>
                        </td></tr>
                        </table>
                        <table align=center>
                        <tr><td>
                        <INPUT TYPE=hidden NAME='u' VALUE='$u'>
                        <INPUT TYPE=submit NAME=button1 VALUE='Отправить!'></form></font>
                        </td></tr>
                        </table>
                        ";
?>