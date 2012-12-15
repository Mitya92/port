<?php  
include ('../style/header.php');
include ('../sustem/functions.php');
echo'<div class="text">';
$id_photo = htmlspecialchars($_GET['id_photo']); // ID фотографии 
if (isset ($_POST['submit'])) {
 
 $nam  = $_POST['textfield'];
 $tit  = $_POST['leftcol'];
 $cat  = $_POST['category'];
 $rcol = $_POST['rightcol'];
 if (!isset($_POST['show'])) {$shw = '0';} else {$shw = '1';}
 mysql_query("UPDATE `photos` SET
                `name_photo` = '" . $nam . "',
                `title_photo` = '" . $tit . "',
				`id_theme` = '" . $cat . "',
                `show` = '" . $shw . "',
				`right_col` = '" . $rcol . "'
                WHERE `id_photo` = '" . $id_photo . "'");
 echo '<div class="selection">Отредактированно</div>';
}
?> 


<?
//---------------------------Форма------------------------------>

 
 $ath = mysql_query("SELECT * FROM photos where id_photo = '".$id_photo."';");
 $author = mysql_fetch_array($ath);
echo '<h1>Изменить</h1><br>
	<form name="form11" method="post" action="edit.php?id_photo='. $id_photo .'">
 <p><b>Имя: </b>
 <input type="text" name="textfield" value="' . htmlentities($author['name_photo'], ENT_QUOTES, 'utf-8') . '"/> 
 </p>

  <br/><b>Описание:</b> 
 <div class="textar">' . auto_bb('form11', 'leftcol') . '</div>
 <p><textarea name="leftcol" cols="100" rows="20">' . htmlentities($author['title_photo'], ENT_QUOTES, 'utf-8') . '</textarea></p>
<b>Правая колонка:</b>
 <div class="textar">' . auto_bb('form11', 'rightcol'). '</div> 
 <p><textarea name="rightcol" cols="100" rows="10">' . htmlentities($author['right_col'], ENT_QUOTES, 'utf-8') . '</textarea></p>
 <p><b>Показывать на главной </b><input name="show" type="checkbox" value="1" ' . (  $author['show'] ? 'checked="checked"' : '') . '></p> 

';
//-------------------------Список категорий---------------------
 
 echo '<p><b>Категория:</b> <select name="category" size=1>'; 
 $athl = mysql_query("SELECT * FROM themes;");
 while($authorl = mysql_fetch_array($athl)){
 echo '<option value="'. $authorl[id_theme] .'" ' . ($authorl['id_theme'] == $author['id_theme'] ? ' selected="selected"' : '') . '>'. $authorl[name_theme] .'</option>';
 } 
echo ' </select> </p>
 <input type=submit name="submit" value=Изменить></form>';
echo '<br/><a href="../sut/">Вернуться</a>';

echo'</div>';
include ('../style/footer.php'); 
?>