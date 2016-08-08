<html>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link rel="stylesheet" href="css/main.css">			
			<title>RoM Siberia PvP</title>
		</head>
</html>
<?php
header("Content-Type: text/html; charset=utf-8");
if ($_POST['trick']!= $_POST['password'])
{
	echo "<center><p>Пароли не совпадают!</p>"; 
	exit();
} 
else
{
	$recaptcha = $_REQUEST['g-recaptcha-response'];
	$secret = '6Ld5nhcTAAAAAJtLLdMIYwpsRxLesovr4of7U7Lh';
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret ."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
$status = 1;
if(!empty($recaptcha)) 
{
    $curl = curl_init();
    if(!$curl) {
       $status = 2;    
    } else {
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_TIMEOUT, 10);
      curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      $curlData = curl_exec($curl);
      curl_close($curl);    
      $curlData = json_decode($curlData, true);
      if($curlData['success']) 
	  {
        $status = 0; 
		$cookie_name = 'dfdweff';
		  
				if(!isset($_COOKIE[$cookie_name])) 
				{
					if (isset($_POST['login'])) 
					{ 
						$login = $_POST['login'];
						if ($login == '')
						{ unset($login);} 
					
				}
					if (isset($_POST['password']))
					{ 
						$password=$_POST['password']; 
						if ($password =='') 
							{ unset($password);} 
								
					}
						if (empty($login) or empty($password))
						{
						 ?>
							<html>
							<head>
							<p>
							<center><img src="../img/no-data.png" style="margin-top:30px" >;
							</p>
							</head>
							</html>
							<?php
						}
						$login = stripslashes($login);
						$login = htmlspecialchars($login);
						$login = strip_tags(trim($login));
						$password = stripslashes($password);
						$password = htmlspecialchars($password);
						$password = strip_tags(trim($password));
						$login = trim($login);
						$password = trim($password);			
						
						
						$serverName = "31.42.44.9"; //serverName\instanceName
						$connectionInfo = array( "Database"=>"ROM_Account", "UID"=>"admin_registr", "PWD"=>"@_-_KoKs_-_@LiLa");
						$conn = sqlsrv_connect( $serverName, $connectionInfo);
						if( $conn ) {
     						echo "Connection established.<br />";
						}else{
     						echo "Connection could not be established.<br />";
     						die( print_r( sqlsrv_errors(), true));
						}
					
					
					$sql = "SELECT (Account_ID) FROM dbo.PlayerAccount WHERE (Account_ID)='$login'";
					$result = sqlsrv_query($conn,$sql);
					$myrow = sqlsrv_fetch_array($result);
					print_r ($myrow);
    				if ($myrow==array("0" => "$login","Account_ID" => "$login" )) 
					{
						?>
							<html>
							<head>
							<p>
							<center><img src="../img/get_another.png" style="margin-top:30px" >;
							</p>
							</head>
								<div id="preloader">
								<div id="status">&nbsp;
								</div>		
								<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js?ver=1.8.2'></script>
								<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/gameplorers-wpcolorbox/colorbox/colorbox/jquery.colorbox-min.js?ver=1.3.17'></script>
								<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.25.0-2013.01.18'></script>
								<script type="text/javascript">	
								$(window).load(function() { 
								$("#status").fadeOut();
								$("#preloader").delay(350).fadeOut("slow");
								})
							</script>
							</html>
							<?php
    						exit ();
    				}
					else {
						$tsql= "INSERT INTO dbo.PlayerAccount (Account_ID, Password, IsMd5Password,IsAutoConvertMd5) VALUES (?, ?, ?, ?)";
            			$var = array("$login","$password",0,1);
            			if (!sqlsrv_query($conn, $tsql, $var))
                 		{
            				die('Error: ' . sqlsrv_errors());
							?>							
							<html>
							<head>
							<p>
							<center><img src="../img/err.png" style="margin-top:30px" >;
							</p>
							</head>
							</html>
							<?php
                 		}
           				echo "1 record added"; 
						$cookie_name = 'dfdweff';
						$cookie_value = 'dfdweff';
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30	), '/');
						?>
						<html>
						<head>
						<p>
						<center><img src="../img/welcome.png" style="margin-top:30px" >;
						</p>
						</head>
						</html>
						<?php
					}
				}
				else 
				{	
							?>
							<html>
							<head>
							<p>
							<center><img src="../img/not_now.png" style="margin-top:30px" >;
							</p>
							</head>
								<div id="preloader">
								<div id="status">&nbsp;
								</div>		
								<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js?ver=1.8.2'></script>
								<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/gameplorers-wpcolorbox/colorbox/colorbox/jquery.colorbox-min.js?ver=1.3.17'></script>
								<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.25.0-2013.01.18'></script>
								<script type="text/javascript">	
								$(window).load(function() { 
								$("#status").fadeOut();
								$("#preloader").delay(350).fadeOut("slow");
								})
							</script>
							</html>
							<?php
							exit();
				}
		}
      }
    }
	else if($status === 1) 
	{
		?>
							<html>
							<head>
							<p>
							<center><img src="../img/err2.png" style="margin-top:30px" >;
							</p>
							</head>
							</html>
							<?php
	}
	else if($status === 2) {  
    ?>
							<html>
							<head>
							<p>
							<center><img src="../img/err2.png" style="margin-top:30px" >;
							</p>
							</head>
							</html>
							<?php
}
}
?>
<html>
		<div id="preloader">
			<div id="status">&nbsp;
		</div>		
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js?ver=1.8.2'></script>
		<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/gameplorers-wpcolorbox/colorbox/colorbox/jquery.colorbox-min.js?ver=1.3.17'></script>
		<script type='text/javascript' src='http://akuloff.com.ua/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.25.0-2013.01.18'></script>
		<script type="text/javascript">	
		$(window).load(function() { 
		$("#status").fadeOut();
		$("#preloader").delay(350).fadeOut("slow");
	})
		</script>
			</html>
			
