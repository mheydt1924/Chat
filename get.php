<?php
require('lib.php');

$result = [];

//-------------------------------------------------
//準備
//-------------------------------------------------
// 実行したいSQL
$sql = 'SELECT * FROM log';

//-------------------------------------------------
//SQLを実行
//-------------------------------------------------
$dbh = connectDB();						//接続
$sth = $dbh->prepare($sql);         	//SQL準備
$sth->execute();                    	//実行

//取得した内容を表示する
while(true){
    //ここで1レコード取得
    $buff = $sth->fetch(PDO::FETCH_ASSOC);
    if( $buff === false ){
        break;    //データがもう存在しない場合はループを抜ける
    }
    
    $result[] = [
    	  "name"    => $buff["name"]
		, "message" => $buff["message"]
		, "time"    => $buff["time"]
	];
};

/*
$fp = fopen("data.txt", "r");
while( ($buff=fgets($fp)) != false ){
	$line = explode("\t", $buff);
	$result[] = [
		  "name"    => $line[0]
		, "message" => $line[1]
		, "time"    => $line[2]
	];
}
fclose($fp);
*/

echo json_encode($result);
