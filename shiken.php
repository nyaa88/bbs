<pre> phpはファイル名もフォルダ名も半角文字以外はNGです。実行できません。
<?php //bool(false)と評価される式
var_dump('     0' == TRUE); //文字列は値だけあればtrue
var_dump('0 XYZ' == 0); 
var_dump('00' == TRUE); 
var_dump('0x1' === 1 ); //16進数

var_dump(0xf); //int(15)では16は?
var_dump(0x10); 
echo "<hr>";

//（TRUE)と評価される式を１つ次の記述の中から選択せよ。 
//式も評価できる var_dump trueかfalseの2つの値しか持たない型のことをboolブール値
	var_dump(NULL === 0); //演算子===は値も型も等しい場合にtrue
	//NULLは0ではない、""で表す空文字でもない。未定義の意味。無に近い。
	var_dump('' === 0); //空の文字列は0ではない
	var_dump('0  ABC' == 0); //先頭が数字の場合は、数字部分の値が数値と等価
	var_dump('' == TRUE);
	
 ?>
</pre>

<ol>
<?php 
$price = "$3.75"; 
	print "It's ($price)."; echo "<br>";
		// " "で囲った'().は文字列 変数は文字列型にキャスト(型変換)される
	print 'It\'s '.$price.'.'; echo "<br>";
		// ' が奇数 \はエスケープ文字=特殊記号をそのまま文字として扱いたい場合使う
	print "It\'s {$price}."; echo "<br>";
		// " "で囲むと中の記号は文字。{中括弧}は処理のくくりを表すので、文字扱いされない。
	print 'It\'s $price.';  echo "<br>";
		// 'シングルクォート'で囲むと変数はキャストされずに文字になる。
 ?>

<p>var_dump()関数はデバック用によく使います</p>
<ol>
<?php
//php技術者認定試験の 02 問1
	$price = '3' . '.75';
		echo "<li>文字として 4byte ";var_dump($price) ;
	$price = 3 + .75;
		echo "<li>数字の演算 0省略 ";var_dump($price) ;
	$price = '3' + '.75';
		echo "<li>数値(浮動小数型) ";var_dump($price) ;
	$price = '3' + '0.75yen'; 
		echo "<li>数字のの後ろについた場合は演算できる ";var_dump($price) ;
 ?>