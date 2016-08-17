<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="denpyo.css" type="text/css"/>
	<title>Document</title>
</head>
<body>
	
<form action="" method="post"><!-- method 未指定だとget送信(urlパラメータ)になる -->
	<input type="text" name="denpyo_no" value=""/>
	<input type="submit" value="実行">
</form>



<?php 
//得意先cdを送信して、特定レコードを抽出できるように
if(!isset($_POST['denpyo_no'])) exit("伝票Noを入れてください"); //ここで中断
	$denpyo_no = $_POST['denpyo_no']; 

try{
$uid = "root" ;
$pwd = "wert3333";

$error = 'データベースに接続出来ません!';
	throw new Exception($error);

$pdo = new PDO("mysql:host=localhost;dbname=test;charset=utf8", $uid, $pwd);
	//データベースへの接続方法には決まったパターンが有ります。
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
	//連想配列だけで取得

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//何かあった時、詳しいエラーが出る
 
$strsql = 
"SELECT `denpyo_no`, d.tokui_cd, `date` , tokui_name , tokui_addr
FROM denpyo as d ,tokui as t
WHERE d.tokui_cd = t.tokui_cd
AND denpyo_no =" .$denpyo_no ;//得意先マスタから特定のレコードを抽出。数値型なので""不要

$sql = $pdo->prepare( $strsql ); //SQL文の実行準備、構文チェック

$sql->execute(); //SQL実行 。成功するとtrueが、失敗するとfalseがかえる
	//echo $strsql; //var_dumpはオブジェクト型を表示できない
	

//データが1件しか無い時の書き方。ループする必要がない。
	$assoc = $sql-> fetch(PDO::FETCH_ASSOC);
	//DBから取り出した内容をコードに読み込ませることを"フェッチ"する といいます。FETCH_ASSOCはテーブルのカラム名をキーにして配列にするモード。::スコープ演算子と言って、オブジェクトの中の変数に直接アクセスする オブジェクト名::オブジェクト変数(プロパティ)
?>
<div id="con">
<div class="tcd">
	<h1>受注伝票</h1>
	<dl>
		<dt>得意先コード</dt><dd><?=$assoc['tokui_cd']?></dd>
	</dl>
</div>

<div class="dno">
	<img src="ouin.png" alt"" id="ouin" class="element-ouin">
	<img src="shbn.gif" alt"" id="shbn" class="element-shbn">

	<dl>
		<dt>伝票番号</dt><dd><?=$assoc['denpyo_no']?></dd>
		<dt>受注年月日</dt><dd><?=$assoc['date']?></dd>
		<br>
		<dt>得意先名</dt><dd><?=$assoc['tokui_name']?></dd>
		<dt>得意先住所</dt><dd><?=$assoc['tokui_addr']?></dd>
	</dl>
</div>


<?php 
$strsql = 
"SELECT m.shohin_cd , s_name , s_tanka , num , (s.s_tanka * num) as kei
FROM  meisai as m, shohin as s
WHERE m.shohin_cd = s.shohin_cd 
AND denpyo_no = " .$denpyo_no ; //受注明細と商品マスタから伝票番号で抽出。複数件あるのでループさせる
$sql = $pdo->prepare( $strsql ); 
$sql->execute(); 
?>

<table>
	<tr>
		<th>商品ID</th>
		<th>商品名</th>
		<th>単価</th>
		<th>数量</th>
		<th>小計</th>
	</tr>
	
<?php
foreach ($sql as $key => $value) { //sqlはオブジェクト。テーブルの中身、行と列がある
	echo "<tr>"
	."<td>".$value['shohin_cd']."</td>"
	."<td>".$value["s_name"]."</td>"
	."<td>".$value["s_tanka"]."</td>"
	."<td>".$value["num"]."</td>"
	."<td>".number_format($value["kei"])."</td>"
	."</tr>";
}

}catch (Exception $e){
	echo "例外エラー:",$e->getMessage(),"\n";
}//安全に処理を中断するための文 try{}catch(){}
?>

<tr>
	<td colspan="4">合計金額</td>
	<td>
	<?php 
//	echo ;
	 ?>
	</td>
</tr>

</table>

</div>



</body>
</html>