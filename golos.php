<?php header("Content-Type: text/html; charset=utf-8");
	$date=strpos(file_get_contents("qwe.txt"), "04.03.2016 18:56:46");
	if ($date)
		echo "Мы нашли его!";
	else
	{
		echo "ние ние ние нихера";
	}
?>