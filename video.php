<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
include "config.php";
$titl = "VIDEO";
include "head.html";

//�������� ������ ������ �������� (video)

                $n_doc=0;
                $dir = opendir ("./video");
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
				
				echo "<div ><p><span style='color:green;'><h4>������:</h4></span></p><table><tr><td>
					<table><tr>
					<td>
					<br/>
					<a href='http://10.43.161.231/video/2023.01.26 ����� ����������� ����� ���������� ������������ 110 � 220 ��. 1�.mp4'>2023.01.26 ����� ����������� ����� ���������� ������������ 110 � 220 ��. 1�.mp4</a><br/><br/>
					<a href='http://10.43.161.231/video/2023.01.26 ����� ����������� ����� ���������� ������������ 110 � 220 ��. 2�.mp4'>2023.01.26 ����� ����������� ����� ���������� ������������ 110 � 220 ��. 2�.mp4</a><br/><br/>
					<a href='http://10.43.161.231/video/2023.01.18 �� ����������������� �����-27,5 ����� 1.mp4'>2023.01.18 �� ����������������� �����-27,5 ����� 1.mp4</a><br/><br/>
					<a href='http://10.43.161.231/video/2023.01.18 �� ����������������� �����-27,5 ����� 2.mp4'>2023.01.18 �� ����������������� �����-27,5 ����� 2.mp4</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.11.23 �� ����������� ����. ������������ �� ������������ � ������������ (��).mp4'>2022.11.23 �� ����������� ����. ������������ �� ������������ � ������������ (��).mp4</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.10.12 �� ������� ����������������� ���������� ����������� ���� 3,3 ��.mp4'>2022.10.12 �� ������� ����������������� ���������� ����������� ���� 3,3 ��</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.10.26 �� ������������ ��������������� ���������� ���������-1.mp4'>2022.10.26 �� ������������ ��������������� ���������� ���������-1</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.10.26 �� ������������ ��������������� ���������� ���������-2.mp4'>2022.10.26 �� ������������ ��������������� ���������� ���������-2</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.11.02 �� ����������������� ��� ������� ���������� - 1.mp4'>2022.11.02 �� ����������������� ��� ������� ���������� - 1</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.11.02 �� ����������������� ��� ������� ���������� - 2.mp4'>2022.11.02 �� ����������������� ��� ������� ���������� - 2</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.08.03 �� ������������ ������� ����������� ������� ����������.mp4'>2022.08.03 �� ������������ ������� ����������� ������� ����������</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.07.20 �� �����-3,3 (����� 1).mp4'>2022.07.20 �� �����-3,3 (����� 1)</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.07.20 �� �����-3,3 (����� 2).mp4'>2022.07.20 �� �����-3,3 (����� 2)</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.03.16 �� ���������� ������������ 110 � 220 ��.mp4'>2022.03.16 �� ���������� ������������ 110 � 220 ��</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.08.17 �� �� ����������� ����.mp4'>2022.08.17 �� �� ����������� ����</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.09.14 �� ���������������� ���������� ����������� ���� �1.mp4'>2022.09.14 �� ���������������� ���������� ����������� ���� �1</a><br/><br/>
					<a href='http://10.43.161.231/video/2022.09.14 �� ���������������� ���������� ����������� ���� �2.mp4'>2022.09.14 �� ���������������� ���������� ����������� ���� �2</a><br/><br/>
					";
					
					
				
				for($i=0; $i < $n_doc2; $i++)
				{
						echo "<a href='video/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
						
				}
				echo "</td>";
				echo "<td>";
				for($i=$i; $i < $n_doc; $i++)
				{
						echo "<a href='video/$fils_doc[$i]'>$fils_doc[$i]</a><br/><br/>";
				}
				echo "</td></tr></table>";
				unset ($fils_doc);

				
				
				
				
				
				
echo "</div></body></html>"
?>