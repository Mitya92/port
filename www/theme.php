<?php
require_once ("sut/conf.php");
$mod = $_GET['mod'];
switch ($mod)
{
    case "one":
		$stmod = "main";
        setcookie("stmod", $stmod, time() + 3600 * 24 * 365);
        header("location: index.php");
        break;
    case "two":
		$stmod = "light";
        setcookie("stmod", $stmod, time() + 3600 * 24 * 365);
        header("location: index.php");
        break;
    case "noise":
		$stmod = "noise";
        setcookie("stmod", $stmod, time() + 3600 * 24 * 365);
        header("location: index.php");
        break;
    default:
        header("location: index.php");
        break;
}

?>