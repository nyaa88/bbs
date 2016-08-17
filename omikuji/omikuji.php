<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="omikuji.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">
	<title>Document</title>
</head>
<body>
<div id="Container">
<h1>おみくじ</h1>
<h2>結果</h2>

 
	
<?php 
	//include 'common.php';//ここにファイルが読み込まれる。
// require 'common.php';//関数の場合はこっちがいい。


 //配列の作り方その他いろいろ
 $uranai = array('大吉','中吉','小吉','吉','末吉','凶','大凶');
 $min = 0;
 $max = count($uranai) - 1 ; //配列に含まれている値の数
 $key = mt_rand($min, $max); //.PHP_EOL;OSごとに最適な改行コードを出力
 
 echo "<img src ='img/$key.png' alt='$uranai[$key]' class='kek_img'>" ;//$uranai[$key] //関数omikuji()へ $uranai配列を引数渡し
 
?>
<div class="kek">
<?php
 
$syosai_0[] = "大吉です。全体的な金運は非常に良く勝負運もあります。謙虚な姿勢が成功のカギ。";
$syosai_0[] = "大吉です。ラッキースポットは大勢の人が集まる場所。笑顔であいさつをすると運気上昇。";
$syosai_0[] = "大吉です。握手やハグなどまめなスキンシップを心がけよう！自然と運気も上昇。";
$syosai_1[] = "中吉です。海外旅行が開運ポイントです。高級ホテルを利用するのも吉金運も好調です。";
$syosai_1[] = "中吉です。ラッキーカラーはシルバー。芸術的な趣味を始めると全体運がアップしそう。";
$syosai_2[] = "小吉です。今日はまったり過ごしてみては。";
$syosai_2[] = "小吉です。";
$syosai_3[] = "吉です。自分よりも弱い者の世話や面倒を見ることで全体運が大幅にアップします。";
$syosai_4[] = "末吉です。PHPの勉強をするといいことがあるでしょう。";
$syosai_5[] = "凶です。";
$syosai_6[] = "大凶です。今日は自宅でゆっくり過ごしてください。";
 
// var_dump($key);
	

	if ($key == 0){
	echo "<p>".$syosai_0[mt_rand(0, 2)];
	}elseif ($key == 1){
	echo "<p>".$syosai_1[mt_rand(0, 1)];
	}elseif ($key == 2){
	echo "<p>".$syosai_2[mt_rand(0, 1)];
	}elseif ($key == 3){
	echo "<p>".$syosai_3[mt_rand(0, 0)];
	}elseif ($key == 4){
	echo "<p>".$syosai_4[mt_rand(0, 0)];
	}elseif ($key == 5){
	echo "<p>".$syosai_5[mt_rand(0, 0)];
	}else {
	echo "<p>".$syosai_6[mt_rand(0, 0)];
	}

 	?>
</div>
<p class="kekk">結果はどうでしたか?<br>今日も1日頑張りましょう!</p>

</div>
 
 </body>
</html>
