<?php

//-------------------------Обработчик для текста из джонЦМС----------------------------------------
function check($str)
{
    $str = htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
    $str = nl2br($str);
    $str = strtr($str, array(chr(0) => '', chr(1) => '', chr(2) => '', chr(3) => '',
        chr(4) => '', chr(5) => '', chr(6) => '', chr(7) => '', chr(8) => '', chr(9) =>
        '', chr(10) => '', chr(11) => '', chr(12) => '', chr(13) => '', chr(14) => '',
        chr(15) => '', chr(16) => '', chr(17) => '', chr(18) => '', chr(19) => '', chr(20) =>
        '', chr(21) => '', chr(22) => '', chr(23) => '', chr(24) => '', chr(25) => '',
        chr(26) => '', chr(27) => '', chr(28) => '', chr(29) => '', chr(30) => '', chr(31) =>
        ''));
    $str = str_replace("\'", "&#39;", $str);
    $str = str_replace('\\', "&#92;", $str);
    $str = str_replace("|", "I", $str);
    $str = str_replace("||", "I", $str);
    $str = str_replace("/\\\$/", "&#36;", $str);
    $str = mysql_real_escape_string($str);
    return $str;
}


//-----------------------------------------Панелька------------------------------------------------
function auto_bb($form, $field)
    {
        $out = '<style>
            .bb_hide{background-color: rgba(178,178,178,0.5); padding: 5px; border-radius: 3px; border: 1px solid #708090; display: none; overflow: auto; max-width: 300px; max-height: 150px; position: absolute;}
            .bb_opt:hover .bb_hide{display: block;}
            .bb_color a {float:left;  width:9px; height:9px; margin:1px; border: 1px solid black;}
            </style>		

      <script language="JavaScript" type="text/javascript">
            function tag' . $field . '(text1, text2, text3) {
            if ((document.selection)) {
                document.' . $form . '.' . $field . '.focus();
                document.' . $form . '.document.selection.createRange().text = text3+text1+document.' . $form . '.document.selection.createRange().text+text2+text3;
            } else if(document.forms[\'' . $form . '\'].elements[\'' . $field . '\'].selectionStart!=undefined) {
                var element = document.forms[\'' . $form . '\'].elements[\'' . $field . '\'];
                var str = element.value;
                var start = element.selectionStart;
                var length = element.selectionEnd - element.selectionStart;
                element.value = str.substr(0, start) + text3 + text1 + str.substr(start, length) + text2 + text3 + str.substr(start + length);
            } else document.' . $form . '.' . $field . '.value += text3+text1+text2+text3;}</script>
			
            <a href="javascript:tag' . $field . '(\'<b>\', \'</b>\', \'\')"><img src="' . $url . '/style/formicons/bold.gif" alt="b" title="frg" border="0"/></a>
            <a href="javascript:tag' . $field . '(\'<em>\', \'</em>\', \'\')"><img src="' . $url . '/style/formicons/italics.gif" alt="i" title="" border="0"/></a>
            <a href="javascript:tag' . $field . '(\'<li>\', \'</li>\', \'\')"><img src="' . $url . '/style/formicons/list.gif" alt="s" title="" border="0"/></a>
            <a href="javascript:tag' . $field . '(\'&lt;a href=&quot;http://&quot;&gt;\', \'</a>\', \'\')"><img src="' . $url . '/style/formicons/link.gif" alt="url" title="" border="0"/></a>
			<a href="javascript:tag' . $field . '(\'&lt;img src=&quot;&quot; alt=&quot;image&quot; border=&quot;0&quot;&gt;\', \'</img>\', \'\')"><img src="' . $url . '/style/formicons/image.gif" alt="url" title="" border="0"/></a>
			<a href="javascript:tag' . $field . '(\'&lt;div class=&quot;selection&quot;&gt;\', \'</div>\', \'\')"><img src="' . $url . '/style/formicons/selection.gif" alt="url" title="" border="0"/></a>';				
        return $out . '<br />';
    }
	//
//-------------------------Простенький обработчик для текста---------------------------------------
function html($str)
{
    return strtr(htmlspecialchars(stripcslashes($str), ENT_QUOTES, 'UTF-8'), array('$' =>
        '&#36;', '%' => '&#37;', '_' => '&#95;'));
}

//------------------Декодирование htmlentities, PHP4совместимый режим  из джонЦМС------------------
function unhtmlentities($string) {
    $string = str_replace('&amp;', '&', $string);
    $string = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
    $string = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $string);
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
?>