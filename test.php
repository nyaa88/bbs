<style>
	h1{
		font-size: 1em; /*コメント*/}
</style>

<h1>試しに作成</h1>
	<ul> <!-- コメント -->
<?php
 /*
 * 複数行コメントは
 * 入れ子にできないので
 * あまり使いません
 */	
 
	echo "<li>ここはPHP、埋込み型言語です。
	<li>タブや改行、半角スペースは無視されます。
	<li>echo はブラウザに書き出せという命令文。同義語にprintがある。";
	
	$a =12; //変数には必ず先頭に $をつける
	$b =3;
	echo "<li>" . $a + $b ; //文字連結はピリオド、演算とはくっつけられない
		echo "<br>";
	echo "$a + $b";//"  "で囲むと変数は文字列型にされる
		echo "<br>";
	echo '$a + $b';//'  'で囲むと純粋に文字になる
	
		echo "<br><br>";
	echo @$_POST['onamae']."様";//	これだけ追加
	//公開Web サーバーでは警告は一切出ません。php.iniで本番環境モードにしている
 ?>
	</ul>
<p>ここからは html</p>
	<form action="" method="POST">
		<!-- actionがデータの行き先ファイル、postは送信方法
		一つのformの中身がactionで書いたファイルへ送られる仕組み -->
		<input name="onamae">
		<input type="submit" value="送信してみな">
	</form>
	<pre>
	データベースとブラウザの橋渡しをするのがPHP
		PHPの中には膨大な関数があり、大抵のことは既存関数で出来ます。
			データベースとのやり取りには"PDO"というPHP組み込みの接続クラスを使います。
	</pre>

	<pre>
	ブラウザから値を受け取るにはformからPOSTしてもらいます。
		レストラン予約で送ってもらった内容をPHPで表示して、DBに登録してみます(あとで)
			PHPにはメールサーバーに値を送る関数もあるので、実際に送信できます。
	</pre>

<script>
	document.write("ここはJs");
</script>


	
	<?php
//Goto Matching Braket → Ctrl + Shift + P 
//コンテンツ・アシスト Ctrl + Space