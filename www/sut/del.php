<?php  
include ('../sut/conf.php');
$act = htmlspecialchars($_GET['act']);

switch ($act) {

//-----------------------Удаление комментария----------------------------------- 
case 'com': 
		$id_com = htmlspecialchars($_GET['id_com']); // ID комментария 
		$ath = mysql_query("select * from `rabcom` where `id_com`='" . $id_com . "';");
		mysql_query("delete from `rabcom` where `id_com`='" . $id_com . "';");
		$ms = mysql_fetch_array($ath);
		header('location:index.php?act=upr');
break;

//-----------------------Удаление категории----------------------------------- 
case 'theme': 
		$id_theme = htmlspecialchars($_GET['id_theme']); // ID категории
		$ath = mysql_query("select * from `themes` where `id_theme`='" . $id_theme. "';");
		mysql_query("delete from `themes` where `id_theme`='" .$id_theme. "';");
		$ms = mysql_fetch_array($ath);
		header('location:index.php?act=themes');
break;

//-----------------------Удаление цитаты----------------------------------- 
case 'quote': 
		$id = htmlspecialchars($_GET['id']); // ID категории
		$ath = mysql_query("select * from `quotes` where `id`='" . $id. "';");
		mysql_query("delete from `quotes` where `id`='" .$id. "';");
		$ms = mysql_fetch_array($ath);
		header('location:index.php?act=quotes');
break;

//-----------------------Удаление файла----------------------------------- 
case 'file': 
		$id = htmlspecialchars($_GET['id']); // ID файла 
		$ath = mysql_query("select * from `upload` where `id`='" . $id . "';");
		mysql_query("delete from `upload` where `id`='" . $id . "';");
		$ms = mysql_fetch_array($ath);
		if ($ms[types] == 0) {		unlink("../files/img/$ms[name]"); }
		else {	unlink("../files/upload/$ms[name]");  }
		header('location:upload.php');
break;

//-----------------------Удаление работы----------------------------------- 
default: 
		$id_photo = htmlspecialchars($_GET['id_photo']); // ID фотографии 
		$ath = mysql_query("select * from `photos` where `id_photo`='" . $id_photo . "';");
		mysql_query("delete from `photos` where `id_photo`='" . $id_photo . "';");
		$ms = mysql_fetch_array($ath);
		unlink("../files/preview/$ms[small_photo]");
		header('location:index.php?act=upr');
}
?>