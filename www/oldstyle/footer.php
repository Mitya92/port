
	   </div><!-- #content-->
			</div><!-- #container-->
<div id="sideLeft">
	<div class="spun"><b>Категории</b></div>	
	<div class="sidemenu">
<?php
 //-------------------------Вывод категорий---------------------
 $ath = mysql_query("SELECT * FROM themes;");
 while($author = mysql_fetch_array($ath)){
 echo '<div><a href ="'.$url.'/theme/'. $author[id_theme] .'/">'. $author[name_theme] .'</a></div>';
 }
 ?> 
	</div>
		<div class="sidemenu">
		 <a href="<?'.$url.' ?>/upload.php">Файлообменник</a>
		 <b><a href="<?'.$url.' ?>/sut/">Админка</a></b>
	</div>
		<div class="spun"><b>Случайная цитата</b></div>
		<div class="sidemenu">			
			<?$result = mysql_query("select * from quotes order by rand() limit 1;");
			$row = mysql_fetch_array($result);
			echo ''.$row[text].''; ?> 
		</div>

<div class="sidemenu">

		 <a href="<?'.$url.' ?>/all/">Все работы &#8594;</a> 
	</div>
	
</div><!-- #sideLeft -->

        </div><!-- #middle-->
</div><!-- #wrapper -->

  <footer id="footer">
		<div class="fleft">
<?			echo'<b>Почта: </b>'.$email.'<br/>';	?>
			<b>ICQ:</b> 414854219<br/>
		</div>
<?		echo '<div class="fcenter"><br/><b>'.$copyright.'</b></div>';
		echo '<div class="fright">'; ?> 

		
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter7777435 = new Ya.Metrika({id:7777435, enableAll: true});
        }
        catch(e) { }
    });
})(window, 'yandex_metrika_callbacks');
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/7777435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?
if ($stmod=="noise") { echo '<a href ="' . $url . '/theme.php?mod=two">Светлее</a> | <a href ="' . $url . '/theme.php?mod=one">Темнее</a> | Шум'; } 
else {
		if ($stmod=="light") echo 'Светлая | <a href ="' . $url . '/theme.php?mod=one">Темнее</a> | <a href ="' . $url . '/theme.php?mod=noise">Шум</a>';
		else echo '<a href ="' . $url . '/theme.php?mod=two">Светлее</a> | Темная | <a href ="' . $url . '/theme.php?mod=noise">Шум</a>';
}
 ?> 

 </div>	
  </footer><!-- #footer -->
</body>
</html>