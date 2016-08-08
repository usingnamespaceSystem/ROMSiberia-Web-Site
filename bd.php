<?php
$serverName = "31.42.44.9, 1433";
$connectionInfo = array( "Database"=>"ROM_Account", "UID"=>"user_admin", "PWD"=>"0n1c_d2");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {      
     echo "Good.<br />";
}else{
     echo "Error:";
     die( print_r( sqlsrv_errors(), true));
}
/*$alias="ROM_Account";
$user="gamemaster";
$Pass="i0n1c_D2R";
//Строка подключения к БД
$conect= odbc_connect($alias,$user,$Pass);
if(!($conect))  
{
  echo "Подключение к БД $alias нет"; 
  echo odbc_error($conect);
}else 
{  echo "БД-.$alias. подключена";}
$rs= odbc_exec($conect,"Select Account_ID from dbo.PlayerAccount where Account_ID='$login'");*/
?>