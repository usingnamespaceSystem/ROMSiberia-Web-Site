<?php

// DB Connection
$DBHost = "31.42.44.9";  // localhost or your IP
$DBUser = "mmotop";  // Database user
$DBPassword = "@_-_KoKs_-_@LiLa";  // Database password
$DBName = "ROM_ImportDB";  // Database name

//messages not working in this script version
//$welcome = "Welcome";
//$desc = "Something about eqipment";
//$system= "System";

// Ссылка на ммотоп со списком голосующих
$fcontent=file("https://mmotop.ru/votes/b814b9c87cd3e09d5e760354c702bd34a9d552c1.txt");

//  Простой голос с $sitem_id - это id предмета и $scount колличество сколько выдавать игроку (этот параметр прописывается в
// бд на по этому не работает там где нельзя использовать для предметов где count не может быть больше 1,
// а ты хочешь добавить больше предметов)
$sitem_id = '12000020';
$scount = '1';

//  Для тех кто проголосовал через СМС аналогично $smsitem_id - ид итема и $smscount колличество
$smsitem_id = '12000022';
$smscount = '1';


//КОД
$content = @file_get_contents($linkstat);
$massive=explode("\n", $content);
for($j=0;$j<sizeof($fcontent);$j++)
{
    $temp=explode("\t",$fcontent[$j]);
    $vote_id   = (int)trim($temp[0]);
    $vote_time = trim($temp[1]);

    $vote_time = explode(" ",$vote_time);
    $temp1 = explode(".",$vote_time[0]);
    $vote_time = $temp1[2]."-".$temp1[1]."-".$temp1[0]." ".$vote_time[1];

    $vote_ip   = trim($temp[2]);
    $vote_char_name = trim($temp[3]);
    $vote_count     = (int)trim($temp[4]);

    if(strlen($vote_char_name) <= 0)
        continue;

    $conn = dbconnect();
    $sql = "SELECT * FROM dbo.MmotopLogs;";
    $optimise_array = array();
    $result = sqlsrv_query($conn,$sql);
    while($myrow = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $optimise_array[$myrow['char']][$myrow['time']] = "yep ;)";
    }

    if(!array_key_exists($vote_time, $optimise_array[$vote_char_name])) {
        $tsql= "INSERT INTO dbo.MmotopLogs (char, date, time, ip, type) VALUES (?, ?, ?, ?, ?)";
        $var = array($vote_char_name,time(),$vote_time,$vote_ip, $vote_count);
        if (!sqlsrv_query($conn, $tsql, $var))
        {
            sqlsrv_errors();
        }
        if($vote_count == 1){
            add_plushku($vote_char_name, $sitem_id, $scount, $conn);
        }else{
            add_plushku($vote_char_name, $smsitem_id,$smscount,$conn);

        }

    }
    //debug
//    if($j>3)die('ok');
}

function dbconnect ()
{
    global $DBHost,$DBUser,$DBPassword,$DBName;
    ///////Start Open MySQL-connection///////////////////
    $connectionInfo = array( "Database"=>$DBName, "UID"=>$DBUser, "PWD"=>$DBPassword);
    $conn = sqlsrv_connect( $DBHost, $connectionInfo);
    if( $conn ) {
        return $conn;
    }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
    /////////End Open MySQL-connection/////////////////////
    return false;
}

function add_plushku($char, $item_id, $count, $conn){
    global $welcome, $desc, $system;
    $tsql= "USE [ROM_ImportDB]
DECLARE @EQMainDura     int; SET @EQMainDura  = 100;
DECLARE @EQDurable      int; SET @EQDurable   = @EQMainDura * 100;

declare @intvalue int;
set     @intvalue = @EQMainDura;

declare @vsresult1 varchar ( 8 );
declare @inti      int;
select  @inti      = 8, @vsresult1 = '';
while   @inti > 0
        begin
                select @vsresult1 = convert ( char ( 1 ), @intvalue % 2 ) + @vsresult1;
                select @intvalue  = convert ( int, ( @intvalue / 2 ) ), @inti = @inti - 1;
        end



DECLARE @CreateTime INT;
SET @CreateTime = DATEDIFF ( s, '1970-01-01 00:00:00', GETUTCDATE ( ) );

Insert [dbo].[AccountBag]
([WorldID],[Account_ID],[PlayerDBID],[OrgObjID],[Serial],[CreateTime],[Count],[Durable],[Mode],[ExValue],[ImageObjectID]) VALUES
(1       ,?           ,-1        ,?   ,12345235,@CreateTime ,?      ,@EQDurable,0,0,?);
";
    $var = array($char,$item_id, $count, $item_id);
    if (!sqlsrv_query($conn, $tsql, $var))
    {
        sqlsrv_errors();
    }

}
// Uragan4ik 2010,SamPW.ru