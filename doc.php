<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);


$titl = "DOCUMENT";
include "$id_pc/head.html";
include "$id_pc/config.php";


//получаем список файлов каталога (data)

                $n_doc=0;
                $dir = opendir ("./doc/docum");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										sort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><p><span style='color:green;'><h4>ДОКУМЕНТАЦИЯ</h4></span></p><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/docum/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/docum/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";

				unset ($fils_doc);

				

//получаем список файлов каталога (doc/perechni)

                $n_doc=0;
                $dir = opendir ("./doc/perechni");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										sort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><span style='color:green;'><h4>ПЕРЕЧНИ</h4></span><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/perechni/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/perechni/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";
				unset ($fils_doc);
				

//получаем список файлов каталога опасных мест

                $n_doc=0;
                $dir = opendir ("./om");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										sort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><span style='color:red;'><h4>ПЕРЕЧНИ ОПАСНЫХ МЕСТ:</h4></span><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='om/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='om/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";
				unset ($fils_doc);


//получаем список файлов каталога TPP

                $n_doc=0;
                $dir = opendir ("./doc/tpp");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										sort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><span style='color:green;'><h4>Типовые Программы Переключений</h4></span><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/tpp/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/tpp/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";
				unset ($fils_doc);



//получаем список файлов каталога ppr

                $n_doc=0;
                $dir = opendir ("./doc/ppr");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils_doc[] = $file;
                                        $n_doc=$n_doc+1;
										sort ($fils_doc);
                                }
                };
                closedir ($dir);
				$n_doc2 = $n_doc/2;
				echo "<div id='content'><span style='color:green;'><h4>ППР:</h4></span><table><tr><td>";
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='doc/ppr/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='doc/ppr/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";
				unset ($fils_doc);
				
				
				
				
echo "</div></body></html>"
?>