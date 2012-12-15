<?

//--------------Данные--------------      
$db_host = "localhost"; 
$db_user = "root"; 
$db_pass = ""; 
$db_name = "port"; 
$PREFIX = "";

//---Подключаемся к базе данных-----                            
$connect = @ mysql_pconnect($db_host, $db_user, $db_pass) or die('cannot connect to server');
@ mysql_select_db($db_name) or die('cannot connect to db');
@ mysql_query("SET NAMES utf8");

//--------------Настройки-------------- 
	$ath = mysql_query("select * from settings;");	//Загружаем настройки
	$author = mysql_fetch_array($ath);
	$url = $author[url];							//Главная сайта
	$title = $author[title];						//Заголовок
	$email = $author[email];						//E-mail сайта
	$copyright = $author[copyright];				//Копирайт

//--------------Выбор темы-------------
if (isset($_COOKIE['stmod'])) $stmod = $_COOKIE['stmod'];
else $stmod  == "light";

?>