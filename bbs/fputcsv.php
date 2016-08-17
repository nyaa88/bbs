<?php 
//掲示板のコメントを保持するファイルを指定
$bbs_file = "bbs.csv";
 
//ファイルを追記モードで開く
$handle = fopen($bbs_file, "a"); //ファイルポインタ取得

//書き込みたい情報を配列にまとめる
$csv[] = "ひよこ";
$csv[] = "ぴよぴよ";
$csv[] = time(); //現在時刻を取得

//ファイルに書き込みを行う
$result = fputcsv($handle, $csv); //配列を元にファイルにCSV形式で書き込み

//ファイルを閉じる
fclose($handle); 

 ?>