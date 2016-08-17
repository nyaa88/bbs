<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="bmi.css" type="text/css" />
	<title>あなたのBMIを調べましょう</title>
</head>
<body>
	<div id="Container">
		
		<h1>ＢＭＩと適正体重</h1>
		
		<div id="con">
	<form action="" method="post">
		<table>
		<tr>
			<td class="item1"><label>身長:</label></td>
			<td><input type="text" name="h" 
				value="<?=isset($_POST['h']) ? $_POST['h']: ''?>" size="3"> cm</td><!-- 一度送った値があれば表示 -->
			<td rowspan="2"><input type="submit" value="計算する"></td>
		</tr>
		<tr>
			<td class="item1"><label>体重:</label></td>
			<td><input type="text" name="w" 
				value="<?=isset($_POST['w']) ? $_POST['w']: ''?>" size="3"> kg</td>
		</tr>

		</table>
	</form>

	<p>→</p>
<?php //この 'w'は name='w'の w
	//ポストされているかどうかのチェックいろいろ
	$bmi = ""; //空文字で初期化
	$tkt = "";
	
	if(isset($_POST['submit'])) ;//ボタンが押されているかどうか
		if (is_numeric($_POST['w']) )//値が入っているとtrue
			$bmi = round($_POST['w'] / ($_POST['h'] /100 * $_POST['h'] /100),1)  ; 
		//$_POST アンダーバーがつくのはPHPのネイティブなスーパーグローバル[配列]変数。(どこからでも値を取得、どこまででも値を保持)	
	

	
	$bmik = "$bmi" *2/100*360;//角度を出すための計算式
	
	if (isset($_POST['w']) )
	$tkt = round((($_POST['h'])/100)*(($_POST['h'])/100)*22,1); // 適正体重　hの二乗×22、「,」のあとの 1はroundの小数点の位置
	
	
	if($bmik>=360)
	$bmik = 360; //BMIが100を超えていた場合に矢印を↑で止める。
	
		//試しに配列を回す foreach jsだとfor(var $i in $_POST)で添字を取得
//		foreach ($_POST as $k => $v){
//			var_dump($k); var_dump($v);}
		
		$_POST['h']=''; $_POST['w']=''; //使い終わったので初期化
	 ?>

	<table>
	<tr>
		<td class="item2"><label>BMI:</label></td>
		<td><input type="text" value="<?= $bmi ?> "   size="3" readonly></td>
	<!-- ↑のvalueは<?php echo $bmi ?>と等価 -->
	</tr>
	<tr>
		<td class="item2"><label>適正体重:</label></td>
		<td><input type="text" value="<?= $tkt ?> "   size="3" readonly> kg</td>
	</tr>
	</table>
	</div>


<div id="pig">
<img src="illust3042.png" alt="pig" />
	<div id="tx">
		<p style="font-weight: bold ;margin: 0;">計算式</p>
		<p style="margin: 0;">&nbsp; BMI＝ 体重kg ÷ (身長m)<sup>2</sup><br>
			&nbsp; 適正体重＝ (身長m)<sup>2</sup> ×22<br></p>
		<p>本計算は大人用です。<br>
			BMI指数は、22の時に最も病気になりにくくなります。<br>
			肥満度が高くなると、生活習慣病(糖尿病、高血圧、高脂血症等)の確率が高くなります。</p>
		<p>日本肥満学会では、統計的にもっとも病気にかかりにくいBMI指数22を標準体重として、25以上の場合を肥満、18.5未満を低体重としています。</p>
	</div>
</div>

<table class="bluetbl" cellspacing="0">
   <tr class="bluetr"><th>指標</th><th>判定</th></tr>
   <tr><td>18.5未満</td><td>低体重(痩せ型)　</td></tr>
   <tr><td>18.5～25未満　</td><td>普通体重</td></tr>
   <tr><td>25～30未満</td><td>肥満(1度)</td></tr>
   <tr><td>30～35未満</td><td>肥満(2度)</td></tr>
   <tr><td>35～40未満</td><td>肥満(3度)</td></tr>
   <tr><td>40以上</td><td>肥満(4度)</td></tr>
  </table>
	<div class="mator">
	<div class="helsemator" style=
	"-webkit-transform:rotate(<?= $bmik ?>deg);
	-moz-transform:rotate(<?= $bmik ?>deg);">↑
	</div>
	</div>
</div>
</body>
</html>