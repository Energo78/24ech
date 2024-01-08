<?php
	//получаем персонал цеха по запросу из personal.html
	unset($personal_ceha);
	$personal_ceha = file("./$di/$ech/$ceh/pers.csv");
//	print_r ($personal_ceha);
	
	
	
//---------------------------------------------------------	
	//	выводим таблицу с персоналом сразу для редактироваия
	echo("<div id='tables'><table><div id='input_text'>
	<tr><form name='form_personals' method=post action='personal.html'>
	<td>ЦЕХ</td><td>Должность</td><td>Ф.И.О.</td><td>Фамилия Имя Отчество</td><td>Телефон</td><td>Таб.№</td><td></td></tr>
	");
		$n_pc = 0;
		foreach($personal_ceha as $p_c){
			$one_man = explode(";", "$p_c");
			echo("<tr><td>$one_man[0]<INPUT TYPE=hidden NAME='ceh$n_pc' VALUE='$one_man[0]'></td>");
				for($i_p=1; $i_p < 7; $i_p++){
					$size = strlen("$one_man[$i_p]") + 2;
					if($size < 10){$size=20;}elseif($size > 39){$size=40;}
					echo("<td>
						<input type='text' name='$n_pc$i_p' size='$size' value='$one_man[$i_p]'>
					</td>");
				}
			echo("</tr>");
			$n_pc++;
		}
		//добавляем пустое поле для нового работника
		echo("<tr><td>$one_man[0]<INPUT TYPE=hidden NAME='h0' VALUE='$one_man[0]'></td>
			<td><input type='text' NAME='h1' size='$size' value=''></td>
			<td><input type='text' NAME='h2' size='22' value=''></td>
			<td><input type='text' NAME='h3' size='$size' value=''></td>
			<td><input type='text' NAME='h4' size='30' value=''></td>
			<td><input type='text' NAME='h5' size='12' value=''></td>
			<td><input type='text' NAME='h6' size='40' value=''></td>
			</tr>
		");
		
		echo("<tr><td colspan=7 style='text-align: right;'>
		<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
		<INPUT TYPE=hidden NAME='dobav' VALUE='ok2'>
		<INPUT TYPE=submit VALUE='СОХРАНИТЬ'>
		</td></tr>");
	//	закрываем таблицу
	echo("</div></table></div>");
	echo("<div style='background-color:#afb632;
			text-align: left; float: left;
			margin-left: 10px;
			align: center;
			width: 600px;
			min-height: 50px;
			overflow: auto;'>
		<p style='margin-left: 10px; margin-top: 10px;'>
		<b>Для добавления сотрудника заполните пустую строку в нижней части таблицы.<br>
		Для удаления - сотрите строку.</b>
		</p>
	</div>");
//--------------------------------------------------------




	

?>