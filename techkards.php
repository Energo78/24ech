<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
//include "config.php";
$titl = "ТЕХКАРТЫ";
include "head.html";

//получаем список файлов каталога (data)

                $n_doc=0;
                $dir = opendir ("./doc/techkards");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										natsort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><p><span style='color:green;'><h4>ТЕХКАРТЫ</h4></span></p><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/techkards/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/techkards/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";

				unset ($fils_doc);
				
				
				
				
//получаем список файлов каталога (data)

               /* $n_doc=0;
                $dir = opendir ("./doc/techkards_old");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										natsort($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><p><span style='color:green;'><h4>ТЕХКАРТЫ СТАРЫЕ</h4></span></p><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/techkards_old/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/techkards_old/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";

				unset ($fils_doc);
				*/


echo "</div></body></html>";

?>