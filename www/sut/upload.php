<?include ('../style/header.php'); ?>
<div class="ind"><div class="text"><h1>Загрузка файлов</h1>
<?php  
if (isset ($_POST['submit'])) {
	$nam = $_POST['textfield'];
 if (!isset($_POST['show'])) {$visible = '0';} else {$visible = '1';}
	if (preg_match("/[^a-z0-9.()+_-]/", $nam)) {  echo '<div class="selection">В названии изображения присутствуют недопустимые символы</div>';} else {
		$fname = $_FILES['uploadfile']['name'];
		$fname = explode('.',$fname);
		$name = $fname[0];
		$ras  = $fname[1];
		$arras = array("gif", "jpg", "png");
		$nam = $nam.".$ras";
		
		if (in_array($fname[1], $arras)) {
			$uploaddir = '../files/img/';													// Каталог, в который мы будем принимать файл:
			$uploadfile = $uploaddir.basename($nam);
			$res=mysql_query("INSERT INTO upload (name,types,visible) VALUES ('$nam','$types','$visible');");
			if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){ echo '<div class="selection"><h3>Файл успешно загружен на сервер</h3>'; 
			} else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3></div>"; }
			echo ''.$nam.'</div>';
		} else { 
		    if ((preg_match("/php/i", $fname[1])) or (preg_match("/.pl/i", $fname[1])) or ($nam == ".htaccess")) {
				echo '<div class="selection">Файл неправильного формата</div>'; 
			} else {
				$uploaddir = '../files/upload/';													// Каталог, в который мы будем принимать файл:
				$uploadfile = $uploaddir.basename($nam);
				$types = 1;
				$res=mysql_query("INSERT INTO upload (name,types,visible) VALUES ('$nam','$types','$visible');");
				if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){ echo '<div class="selection"><h3>Файл успешно загружен на сервер</h3>'; 
				} else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3></div>"; }
				echo ''.$nam.'</div>';
			}
		}
	}
}
?> 


	<form name="form11" method="post" action=upload.php enctype=multipart/form-data>
		<p><br/>Имя <small>[Только цифры и латинские символы]</small><br/><input type="text" name="textfield"></p>
		Загрузить:<br/><input type=file name=uploadfile><br/><br/>
		 <p><input name="show" type="checkbox" value="1" checked="checked"> Видимый</p> 
		<input type=submit name="submit" value=Загрузить><br/></div></div>
<?	
	echo '<div class="ind"><div class="comm">';
		echo '<b>Загруженные картинки:</b>';
		$result = mysql_query("select * from upload  where `types` = 0 order by id desc limit 50 ;");
		while ($row = mysql_fetch_array($result)) echo '<div class="com"><a href ="../files/img/'.$row[name].'">'.$row[name].'</a><a href=del.php?act=file&id='. $row[id] .'><b>[x]</b></a></div>';
		echo '<b>Остальные файлы:</b>';
		$result = mysql_query("select * from upload  where `types` = 1 order by id desc limit 50 ;");
		while ($row = mysql_fetch_array($result)) echo '<div class="com"><a href ="../files/upload/'.$row[name].'">'.$row[name].'</a><a href=del.php?act=file&id='. $row[id] .'><b>[x]</b></a></div>';
	echo '</div></div>';
include ('../style/footer.php'); ?>