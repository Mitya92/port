<?header('Content-Type: text/html; charset=utf-8');?>
<!DOCTYPE html>
<? 
include $_SERVER['DOCUMENT_ROOT']. '/sut/conf.php';
$url = $author[url];
$title = $author[title];						
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?	echo'<title>' .$title. '</title>';	?>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="<?'.$url.'?>/favicon.png" />
	<link rel="stylesheet" href="<?'.$url.'?>/style/style.css" type="text/css" media="screen, projection" />
	
<?	
	if ($stmod=="light") {
		echo '<link rel="stylesheet" href="'.$url.'/style/main.css" type="text/css" media="screen, projection" />';
		echo '<link rel="stylesheet" href="'.$url.'/style/light.css" type="text/css" media="screen, projection" />';
	} else { 		echo '<link rel="stylesheet" href="'.$url.'/style/main.css" type="text/css" media="screen, projection" />'; }
	if ($stmod=="noise") echo '<link rel="stylesheet" href="'.$url.'/style/noise.css" type="text/css" media="screen, projection" />';

?>
	<!--[if lte IE 6]><link rel="stylesheet" href="../style/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<script type="text/javascript" src="<?'.$url.'?>/highslide/highslide-with-gallery.js"></script>
	<script type="text/javascript" src="<?'.$url.'?>/highslide/highslide.js"></script>
	<link rel="stylesheet" type="text/css" href="<?'.$url.'?>/highslide/highslide.css" />

</head>
<body>
<div id="wrapper">
	<header id="header">
		<div class="hleft"><a class="logo" href="<?'.$url.'?>/"></a></div>
		<div class="hright">		
			<a class="twitter" href="http://twitter.com/#!/VSCherr"></a>
			<a class="vkontakte" href="http://vk.com/vadicq"></a>	
			</div>	
	</header><!-- #header-->
				<div id="middle">
				     <div id="container">
					 	 <div id="content">					 