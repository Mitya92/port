<?php  
//---------------------Добавляем комментарий---------------------------------

$id_photo = htmlspecialchars($_GET['id_photo']); 			// ID фотографии 
if (isset ($_POST['submit'])) {
  include ('./sut/conf.php');
  include ('./sustem/functions.php');
  $nam = html($_POST['textfield']);
  if (!isset($_POST['sp1'])) echo 'Вы спамер!'; else {		//Антиспам
    if (isset($_POST['sp2'])) echo 'Вы спамер!'; else {
		if(empty($_POST['textfield']) or strlen($_POST['textfield']) < 3)  echo 'Не введено имя!'; else {   //Проверка имени на короткость
			if (strlen($_POST['textfield']) > 30) echo 'Слишком длинное имя!'; else {					    //Проверка имени на длинну
				$msg = check(trim($_POST['textarea']));  // Обрабатываем сообщение
				$msg = mb_substr($msg, 0, 500);         
				$res=mysql_query("INSERT INTO rabcom (name,id_photo,text_com) VALUES ('$nam','$id_photo','$msg');");
				header('location:index.php?act=full&id_photo='. $id_photo .'');
				include ('./style/header.php');
			}
		} 
	}
 }
}
include ('./style/header.php');
?> 
	<div class="text">
		<h1>Оставить комментарий</h1><br/>
<?		echo '<form name="form11" method="post" action="addcom.php?id_photo='. $id_photo .'"> '; ?>
		<p><b>Имя:</b><br/><input type="text" name="textfield"></p>
		<p><b>Комментарий:</b><br/><textarea name="textarea" cols="40" rows="10"></textarea></p> 
		<b>Внимательно расставьте галочки</b>
		<div class="border">
			<input name="sp1" type="checkbox" value="1"> <b>Я НЕ спамер</b> 
			<p><input name="sp2" type="checkbox" value="1"> <b>Я спамер</b></p> 
		</div>
		<input type=submit name="submit" value=Написать></form><br/>

<? 
		echo '<a href="./index.php?act=full&id_photo='. $id_photo .'">Вернуться</a>';
	echo '</div>';
 include ('./style/footer.php'); 
?>