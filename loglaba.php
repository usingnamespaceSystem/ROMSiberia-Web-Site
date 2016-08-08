<!doctype html>
<html>
<head>
<title>Лог</title>
<meta charset="utf8">
<style>
p {font-size: 1.3em;}
.error {color: red; font-size: 1.5em;}
form>label {display: block; margin: 5px 10px}
input {padding: 2px;}
fieldset {width: 150px; margin: 5px 10px}
input[type="submit"] {border: 1px solid #a32500; background: #efe4bd; margin:
5px 10px; padding: 4px;}
</style>
</head>
<body>
<?php
$file = 'test_strings.txt';
define("divider", "|");
$logdate = date("d.m.y G:i:s");
$serviceNumber = 898820;
$person = "John Smith";
$log = "<p>".$logdate . divider . $serviceNumber . divider . $person . "</p>";
if ($bytes = file_put_contents($file, $log, FILE_APPEND | LOCK_EX)) 
echo "<p>Успешная запись $bytes байт</p>";
$fullname = realpath($file);
echo "<p>Файл $fullname содержит данные</p>";
if ($b = file_get_contents($file)) 
echo "$b";
?>
</body>
</html>
