<html>
			<title>Runes of Magic Siberia</title>
			<link rel="stylesheet" href="css/main.css">	
	<style>p{font-size:40;}</style>
</html>
<?php header("Content-Type: text/html; charset=utf-8");
// ----------------------------конфигурация-------------------------- // 
 
$adminemail="support@rom-siberia.ru";  // e-mail админа 
 
$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i"); // часы:минуты:секунды 
 
$backurl="http://rom-siberia.ru/index.html";  // На какую страничку переходит после отправки письма 
 
//---------------------------------------------------------------------- // 
 
  
 
// Принимаем данные с формы 
 
$name=$_POST['name']; 

$login=$_POST['login'];  

$email=$_POST['mail']; 
 
$mess=$_POST['message']; 

$headers = 'From: support@rom-siberia.ru' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
  
 
// Проверяем валидность e-mail 
 
if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", 
strtolower($email)))  
 { 
 
echo 
"<center>Вернитесь <a 
href='javascript:history.back(1)'><B>назад</B></a>. Вы 
указали неверные данные!"; 
 
  } 
 
 else 
 
 { 
 
 
$q="
Имя: $name
Логин: $login
E-mail: $email 
Сообщение: $mess
"; 
 // Отправляем письмо админу  
mail($adminemail, "$date $time 
SIBERIA: От: $name", $q, $headers);  
// Сохраняем в базу данных 
$f = fopen("message.txt", "a+"); 
 
fwrite($f," \n $date $time Сообщение от $name"); 
 
fwrite($f,"\n $q "); 
 
fwrite($f,"\n ---------------"); 
 
fclose($f);  
// Выводим сообщение пользователю 
print "<script language='Javascript'> <!--
function reload() {location = \"$backurl\"}; setTimeout('reload()', 2000); 
//--></script>  
$msg <center><p>Сообщение отправлено! Подождите, сейчас вы будете перенаправлены на главную страницу...</p>";  
exit;  
 }  
?>