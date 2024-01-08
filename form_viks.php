<?php

echo "<tr><td>$idzam</td>";
								for($y=1; $y < 17; $y++){
									if($y!=7 and $y!=8){
										echo "<td>$b1$zamas[$y]$b2</td>";
									}
								};
								$n_zamech = $n_zamech + 1;
								
								//---------------
								echo "<td>";
								if ($cehrus !="" and $viks_pravo_udaleniya == 1){
									echo "<input name='dateustr$idzam' type='text' value='";
								}
									
									//для сроков устранения начало -------
										$dat_u1 = explode(" ", "$zamas[1]"); //отделяем дату от времени
										
										if($zamas[15] =="4"){
											$sutok = 1;
										}elseif($zamas[15] =="3"){
										 	$sutok = 14;
										 }elseif($zamas[15] =="2"){
										  	$sutok = 90;
										  }elseif($zamas[15] =="1"){
										   	$sutok = 365;
										   };
										
										$dat_u2=strtotime($dat_u1[0])+ 86400*$sutok;
										$dat_u2=date('d.m.Y',$dat_u2);
										
																				
									//для сроков устранения конец --------
								if($zamas[19] !=""){
									echo "$zamas[19]";
								}else{
									echo "$dat_u2 $dat_u1[1]";
								}
								unset($dat_u1, $dat_u2);
								
								if ($cehrus !="" and $viks_pravo_udaleniya == 1){
									echo "' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>";
								}
								echo "</td>";
								//----------------
								
								
								echo "<td>";
								if ($cehrus !=""){
									echo "<input name='date$idzam' type='text' value='";
								}
								echo "$zamas[17]";
								
								if ($cehrus !=""){
									echo "' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>";
								}
								echo "</td><td>";
								if ($cehrus !=""){
									echo "<textarea rows='2' name='primech$idzam' cols='12'>";
								}	
									echo "$zamas[18]";
								if ($cehrus !=""){
									echo "</textarea>
									<INPUT TYPE=hidden NAME='redact$idzam' VALUE='$idzam'>
									<INPUT TYPE=hidden NAME='stepen$idzam' VALUE='$stepen'>
									";
								}
								
								
								echo "</td><td></td><td>";
								if ($cehrus !="" and $viks_pravo_udaleniya == 1){
									echo "
										<INPUT TYPE=checkbox NAME='del$idzam'>
									";
								}
								echo "<INPUT TYPE=hidden NAME='sluzebnsimb$idzam' VALUE='razdelitel'></td></tr>";




?>