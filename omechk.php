<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Опасные места";
include "head.html";
include "config.php";

echo "
<div id='om'>
	<a href='om/omechk1.pdf' class='red goodbutton'>Опасные Места ЭЧК-1</a>
	<br/><br/>
	<a href='om/omechk2.pdf' class='red goodbutton'>Опасные Места ЭЧК-2</a>
	<br/><br/>
	<a href='om/omechk3.pdf' class='red goodbutton'>Опасные Места ЭЧК-3</a>
	<br/><br/>
	<a href='om/omechk4.pdf' class='red goodbutton'>Опасные Места ЭЧК-4</a>
	<br/><br/>
	<a href='om/omechk5.pdf' class='red goodbutton'>Опасные Места ЭЧК-5</a>
	<br/><br/>
	<a href='om/omechk6.pdf' class='red goodbutton'>Опасные Места ЭЧК-6</a>
	<br/><br/>
	<a href='om/omechk7.pdf' class='red goodbutton'>Опасные Места ЭЧК-7</a>
	<br/><br/>
	<a href='om/omechk17.pdf' class='red goodbutton'>Опасные Места ЭЧК-17</a>
	<br/><br/>
	<a href='om/omechk24-25.pdf' class='red goodbutton'>Опасные Места ЭЧК-24/25</a>
</div>
<div id='om'>
	<a href='om/omecheall201701.pdf' class='red goodbutton'>Опасные Места ЭЧЭ (ВСЕ в ОДНОМ)</a>
	<br/><br/>
</div>
<div id='om'>
	<a href='om/omechs1-0.pdf' class='red goodbutton'>Опасные Места ЭЧС-1</a>
	<br/><br/>
	<a href='om/omechs1-1.pdf' class='red goodbutton'>Опасные Места ЭЧС-1 (Данилов)</a>
	<br/><br/>
	<a href='om/omechs2-1.pdf' class='red goodbutton'>Опасные Места ЭЧС-2 ч.1</a>
	<br/><br/>
	<a href='om/omechs2-2.pdf' class='red goodbutton'>Опасные Места ЭЧС-2 ч.2</a>
	<br/><br/>
		<a href='om/omechs3.pdf' class='red goodbutton'>Опасные Места ЭЧС-3</a>
	<br/><br/>
		<a href='om/omechk24.pdf' class='red goodbutton'>Опасные Места ЭЧК-24</a>
	<br/><br/>
		<a href='om/omechs4-1.pdf' class='red goodbutton'>Опасные Места ЭЧС-4 ч.1</a>
	<br/><br/>
	<a href='om/omechs4-2.pdf' class='red goodbutton'>Опасные Места ЭЧС-4 ч.2</a>
	<br/><br/>
	<a href='om/omechs4-3.pdf' class='red goodbutton'>Опасные Места ЭЧС-4 ч.3</a>
	<br/><br/>
	<a href='om/omechs4-R.pdf' class='red goodbutton'>Опасные Места ЭЧС-4 (Ростов)</a>
	<br/><br/>
</div>
";


?>