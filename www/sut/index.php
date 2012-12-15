<?

include ('../style/header.php');

$act = htmlspecialchars($_GET['act']); //Получаем значение case

switch ($act)
{
    //-------------------------Управление---------------------------------------
    case 'upr':
        echo '<div class="text">';
        echo '<h1>Управление</h1>';
        $ath = mysql_query("SELECT * FROM `photos` ORDER BY `id_photo`;");
        while ($author = mysql_fetch_array($ath))
        {
            $id_photo = $author[id_photo];
            echo '<div class="ind"><li>' . $author[name_photo] . '</li></div> 
				  <div class="ind">
					<a href=edit.php?id_photo=' . $author[id_photo] . '>[ред]</a>&nbsp;
					<a href=index.php?act=com&amp;id_photo=' . $author[id_photo] . '>[комм]</a>
					<a href=del.php?id_photo=' . $author[id_photo] . '><b>[x]</b></a>&nbsp;					
				  </div>';
        }
        echo '</div>';
        break;

    //-------------------------Управление комментариями-------------------------
    case 'com':
        echo '<div class="text">';
        echo '<h1>Управление комментариями</h1>';
        $id_photo = htmlspecialchars($_GET['id_photo']); // ID фотографии
        $req = mysql_query("select * from `rabcom` where `id_photo`='" . $id_photo . "' ORDER BY id_com DESC;");
        while ($comm = mysql_fetch_array($req))
        {
            echo '<div class="border"><b>' . $comm[name] . '</b> ' . $comm[time_com] . '&nbsp;<a href=del.php?act=com&amp;id_com=' . $comm[id_com] . '>[Удалить]</a></div>';
            echo '' . $comm[text_com] . '';
        }
        echo '</div>';
        break;

    //-------------------------Управление цитатами------------------------------
    case 'quotes':
        echo '<h1>Управление цитатами</h1>';
        if (isset($_POST['submit']))
        {
            $tit = $_POST['textarea'];
            $res = mysql_query("INSERT INTO quotes (text) VALUES ('$tit');");
        }
        echo '<div class="text"><form name="form11" method="post" action=index.php?act=quotes enctype=multipart/form-data>
			<h4>Добавить цитату:</h4>                                
			<textarea name="textarea" cols="40" rows="5"></textarea> </p> 
			<input type=submit name="submit" value=Добавить>';
        echo '<div class="comm">';
        $result = mysql_query("select * from quotes  order by id desc limit 50 ;");
        while ($row = mysql_fetch_array($result))
            echo '<div class="com">' . $row[text] . '&nbsp<a href=del.php?act=quote&amp;id=' . $row[id] . '>[x]</a></div>';
        echo '</div></div>';

        break;

    //-------------------------Управление категориями---------------------------
    case 'themes':

        if (isset($_POST['submit']))
        {
            $name = $_POST['textfield'];
            $tit = $_POST['textarea'];
            $res = mysql_query("INSERT INTO themes (name_theme,description) VALUES ('$name','$tit');");
        }
        echo '<div class="ind"><div class="text"><form name="form11" method="post" action=index.php?act=themes enctype=multipart/form-data>
			<h1>Категории</h1><br/>
		<p><b>Имя:</b><br/><input type="text" name="textfield"></p>
		<p><b>Описание:</b><br/>                                 
		<textarea name="textarea" cols="25" rows="5"></textarea> </p> 
		<input type=submit name="submit" value=Добавить></div>';
        echo '</div><div class="ind"><div class="comm">';
        $result = mysql_query("select * from themes  order by id_theme desc limit 50 ;");
        while ($row = mysql_fetch_array($result))
            echo '<div class="com"><b>' . $row[name_theme] . '</b> <a href=del.php?act=theme&amp;id_theme=' . $row[id_theme] . '>[x]</a>&nbsp;<br/><small>' . $row[description] . '</small></div>';
        echo '</div></div>';
        break;
        
    //-------------------------Настройки-----------------------------------
    case 'set':
        echo '<div class="text">';
        if (!isset($_POST['submit']))
        {
            echo '<h1>Настройки</h1>';
            $ath = mysql_query("select * from settings;");
            while ($author = mysql_fetch_array($ath))
            {
                echo '<form name="form" method="post" action="index.php?act=set">
				<p><b>Главная без слеша:</b><br/>
				<input type="text" name="url" value="' . htmlentities($author[url], ENT_QUOTES, 'utf-8') . '"/> 
				<p><b>Заголовок:</b><br/> 
				<input type="text" name="title" value="' . htmlentities($author[title], ENT_QUOTES, 'utf-8') . '"/></p> 
				<p><b>E-mail сайта:</b><br/> 
				<input type="text" name="email" value="' . htmlentities($author[email], ENT_QUOTES, 'utf-8') . '"/></p> 
				<p><b>Копирайт:</b><br/> 
				<input type="text" name="copyright" value="' . htmlentities($author[copyright], ENT_QUOTES, 'utf-8') . '"/></p> 
				<input hidefocus="true" type=submit name="submit" value=Изменить>';
            }
        }
        else
        {
            $url = $_POST['url'];
            $title = $_POST['title'];
            $email = $_POST['email'];
            $copyright = $_POST['copyright'];
            mysql_query("UPDATE `settings` SET
				`url` = '" . $url . "',
				`title` = '" . $title . "',
                `email` = '" . $email . "',
                `copyright` = '" . $copyright . "'");
            echo 'Отредактированно<br/>';
            echo '<a href ="../sut/index.php?act=set">Вернуться</a>';
        }
        echo '</div>';
        break;

    //-------------------------Главный блок-------------------------------------
    default:
        echo '<div class="mainthumber">';
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="../sut/load.php"><img src="../style/cons/load.png" title="Click to enlarge"/></a><br/>Добавить работу</div></ins>';
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="index.php?act=upr"><img src="../style/cons/upr.png" title="Click to enlarge"/></a><br/>Управление</div></ins>';
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="index.php?act=themes"><img src="../style/cons/themes.png" title="Click to enlarge"/></a><br/>Категории</div></ins>';
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="index.php?act=quotes"><img src="../style/cons/quote.png" title="Click to enlarge"/></a><br/>Цитаты</div></ins>'; //<img src="../style/images/quote.png" alt="logo" title="logo" width="48" height="48"/>
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="../sut/upload.php"><img src="../style/cons/upload.png" title="Click to enlarge"/></a><br/>Обменник</div></ins>';
        echo '<ins class="thumbnailer"><div class="admblock "><a href ="index.php?act=set"><img src="../style/cons/settings.png" title="Click to enlarge"/></a><br/>Настройки</div></ins>';
        //echo '<ins class="thumbnailer"><div class="admblock "><a href ="../"><img src="../style/cons/time.png" title="Click to enlarge"/></a><br/>Временный блок</div></ins>';
        echo '</div>';
}

include ('../style/footer.php');

?>
