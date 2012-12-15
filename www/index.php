<?

include ('style/header.php');
include ('sut/conf.php');
$act = htmlspecialchars($_GET['act']); //Получаем значение case
$id_theme = htmlspecialchars($_GET['id_theme']); //Получаем категорию
$page = htmlspecialchars($_REQUEST['page']); //Получаем номер страницы

//-------------------------ПОСТРАНИЧНАЯ НАВИГАЦИЯ-----------------------
$N = 12; //вывод работ на страницу по умолчанию
$sm = mysql_query("SELECT COUNT(*) FROM photos where `show` = '1' ");
$z = mysql_fetch_array($sm);
$all_z = $z[0]; // всего записей
if (!isset($page))
    $page = 0;
$all_str = $page * $N; // Всё что требуется вывести на монитор
//-------------------------ПОСТРАНИЧНАЯ НАВИГАЦИЯ-----------------------


switch ($act)
{
    //------------------------------ Категория
    case 'cat':
        echo '<div class="thumbnails">';
        $ath = mysql_query("SELECT * FROM photos  WHERE `id_theme` = '$id_theme' ORDER BY id_photo DESC;");
        while ($author = mysql_fetch_array($ath))
        {
            echo ' <ins class="thumbnail">';
            echo '<div class="r">';
            echo '<a href ="' . $url . '/full/' . $author[id_photo] . '/"><img src=' . $url . '/files/preview/' . $author[small_photo] . ' alt="' . $author[name_photo] . '" title="' . $author[name_photo] . '" width="180" height="180"/></a><br />';
            echo '' . $author[name_photo] . '';
            echo '  </div>';
            echo ' </ins>';
        }
        echo '</div>';
	break;
    //------------------------------ Подробно
    case 'full':
        echo '<div class="text">';
        // Описание работы
        $id_photo = htmlspecialchars($_GET['id_photo']); // ID фотографии
        $ath = mysql_query("select * from `photos` where `id_photo`='" . $id_photo . "';");
        $author = mysql_fetch_array($ath);
        echo '<h1>' . $author[name_photo] . '</h1>';
        echo '' . nl2br($author[title_photo]) . '';
        // Вывод комментариев
        echo '<div class="comm"><div class="commet"><div class="comfl"><p><b>Оставить комментарий</b></p>';
        echo ' <form name="form11" method="post" action="'.$url.'/addcom.php?id_photo='. $id_photo .'">';
		echo "<p><input type='text' name='textfield' value='Введите имя...' onFocus=\"if(this.value=='Введите имя...')this.value='';\" onBlur=\"if(this.value=='')this.value='Введите имя...';\"' /></p>";
		echo"<p><textarea name='textarea' cols='40' rows='3' value='Введите комментарий...' onFocus=\"if(this.value=='Введите комментарий...')this.value='';\" onBlur=\"if(this.value=='')this.value='Введите комментарий...';\"'>Введите комментарий...</textarea>";
				echo'</div>';
		echo'<div class="comfl"><br/><br/>
			<input name="sp1" type="checkbox" value="1"> <b>Я НЕ спамер</b> 
			<p><input name="sp2" type="checkbox" value="1"> <b>Я спамер</b></p> 
			<br/><input type=submit name="submit" value=Написать></form></div>';         
			echo '</div></div>';
		
        $req = mysql_query("select * from `rabcom` where `id_photo`='" . $id_photo . "' ORDER BY id_com DESC;");
        while ($comm = mysql_fetch_array($req))
        {
            echo '<div class="com"><b>' . $comm[name] . '</b> ' . $comm[time_com] . '<br/>';
            echo '' . $comm[text_com] . '</div>';
        }
        echo ' </div>';
        // Текст правой колонки
        echo ' <aside id="sideRight">';
        $ath = mysql_query("select * from `photos` where `id_photo`='" . $id_photo . "';");
        $author = mysql_fetch_array($ath);
        echo '' . nl2br($author[right_col]) . '';
        echo ' </aside><!-- #sideRight -->';
    break;

    //------------------------------ Все работы
    case 'all':
        echo '<div class="thumbnails">';
        $ath = mysql_query("SELECT * FROM photos ORDER BY id_photo DESC");
        while ($author = mysql_fetch_array($ath))
        {
            echo ' <ins class="thumbnail">';
            echo '<div class="r">';
            echo '<a href ="' . $url . '/full/' . $author[id_photo] . '/"><img src="../files/preview/' . $author[small_photo] . '" alt="' . $author[name_photo] . '" title="' . $author[name_photo] . '" width="180" height="180"/></a><br />';
            echo '' . $author[name_photo] . '';
            echo '  </div>';
            echo ' </ins>';
        }
        echo '</div>';
    break;
    //------------------------------ Главная 
    default:
        echo '<div class="mainthumb">';
        $ath = mysql_query("SELECT * FROM photos   where `show` = '1' ORDER BY id_photo DESC LIMIT $all_str, $N;");
        while ($author = mysql_fetch_array($ath))
        {
		//------------------------------ Проверка на пустоту 
		$filename = 'files/preview/' . $author[small_photo] . '';
		if ((!file_exists($filename)) || (empty($author[small_photo])))
		{ 
			$filename = 'files/preview/null.png';
		}
            echo ' <ins class="thumbnail">';
            echo '<div class="r">';
            echo '<a href ="' . $url . '/full/' . $author[id_photo] . '/"><img src="' . $filename . '" alt="' . $author[name_photo] . '" title="' . $author[name_photo] . '" width="180" height="180"/></a><br />';
            echo '' . $author[name_photo] . '';
            echo '  </div>';
            echo ' </ins>';
        }
        echo '</div>';
}
include ('style/footer.php');

?>
