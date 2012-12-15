<?
include ('../style/header.php'); 
include ('../sustem/functions.php');
echo'<div class="text">';
if (isset ($_POST['submit'])) {

// Каталог, в который мы будем принимать файл:
$uploaddir = '../files/preview/';
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
$uploadfilex = $_FILES['uploadfile']['name'];
 $nam = $_POST['textfield'];
 $tit = $_POST['leftcol'];
 $rcol = $_POST['rightcol'];
 $cat = $_POST['category'];
if (isset($_POST['showh'])) {$shw = '0';} else {$shw = '1';}

 $res=mysql_query("INSERT INTO photos (name_photo,small_photo,title_photo,id_theme,right_col) VALUES ('$nam','$uploadfilex','$tit','$cat','$rcol');");
// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
echo "<h3>Файл успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; }
echo ''.$uploadfilex.'';
}
?> 

<!---------------------------Форма------------------------------>
<h1>Добавить работу</h1><br/>

 <form name="form11" method="post" action=load.php enctype=multipart/form-data>
 <p><b>Имя: </b><input type="text" name="textfield"></p>
 <br/><b>Описание:</b> 
 <div class="textar"><? echo '' . auto_bb('form11', 'leftcol'); ?></div>
 <p><textarea name="leftcol" cols="100" rows="20"></textarea></p>
<b>Правая колонка:</b>
 <div class="textar"><? echo '' . auto_bb('form11', 'rightcol'); ?></div> 
 <p><textarea name="rightcol" cols="100" rows="10"></textarea></p>
 
<?php 
//--------------Список категорий-----------------
 
 echo '<p><b>Категория: </b><select name=category size=1>'; 
 $ath = mysql_query("SELECT * FROM themes;");
 while($author = mysql_fetch_array($ath)){
	echo '<option value='. $author[id_theme] .'>'. $author[name_theme] .'</option>';
 } 
?>
 </select> </p>
 <b>Загрузить: </b>
 <input type=file name=uploadfile><br/><br/>
 <input type=submit name="submit" value="Добавить работу"></form>
 
<br/><a href="../sut/">Вернуться</a>
</div>
<? include ('../style/footer.php'); ?>