<?php
include ("common.php");
 ?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<link href="../../bts/css/bootstrap.min.css" rel="stylesheet">	
	<link href="style.css" rel="stylesheet">	

	<title>ひよこ掲示板</title>

</head>
<body>
	
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
	<nav  class="navbar navbar-default">
  <a class="navbar-brand" href="#">ひよこ掲示板</a>
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Features</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
  </ul>
  <form class="form-inline pull-xs-right">
    <input class="form-control" placeholder="Search" type="text">
    <button class="btn btn-success-outline" type="submit">Search</button>
  </form>
</nav>
</div>
	
	
	<div class="container">
	
	<div class="col-md-4">
		<div class="content panel panel-success">
		<div class="panel-heading">
			ひよこ掲示板
		</div>
		<div class="panel-body">
	<form action="write.php" method="post">
		<div  class="form-group">
		<p>名前</p>
		<input type="text" name="name" value="" size="24" class="form-control"></div>
		<div  class="form-group">
		<p>コメント</p>
		<textarea name="comment" cols="40" rows="3" class="form-control"></textarea>
		</div>
		<input type="submit" name="submit" value="書き込み" class="btn btn-success"><br>
	</form>
	</div>
	</div>
	<?php //値渡しと参照渡しのサンプル
		$a = 10;
		function add(&$c) {//変数に&をつけた場合とつけない場合の比較
			$c = 100;
		}

		add($a);
		echo $a;
		//つけない→10 つけた→100
		 ?>
	</div>
	<div class="col-md-8">
		
	<?php 
	//クラスComを変数に代入してから使う。$comはComの複製。インスタンス化 実体化します
//$com = new Com(); インスタンス化するなら Com::ではなく$com ->
	
		$records = Com:: bbs_read(); //コメント配列の取得 //$comの中のbbs_read
		
		krsort($records); //配列を降順に
		
		foreach ($records as $key => $record) { //配列に従って繰り返し
			?>
			<div class="content panel panel-success">
				<div class="panel-heading">
				<span class="caret"></span>
				<span class="id"> <?php print Com:: h($key + 1);
					//配列のキーを元にコメント番号を出力
				?></span> 
				<span class="name">名前: <strong><?php print Com:: h($record["name"]); ?></strong></span>	
				<span class="time"><?php print date(" Y年 m月 d日 H時 i分 s秒", intval($record["time"]));
					//フォーマットに従って日付を出力
 ?></span>
				  <?php // 最初だけNEWをつける
	if ($record === reset($records)) {// ループの最初
		echo '<span class="label label-warning"> NEW</span>';
		$first_key = $key;
		//$keyは上書きされるので、代入して預けておく。
	}
 ?> 
				<?php
				$one = strtotime('-1 day', time());
				if ($record["time"] > $one) {
					echo '<span class="label label-success">NEW</span>';
				}
					?>
					</div>
				<div class="comment panel-body">
				<p class="comment"><?php print nl2br(Com:: h($record["comment"]));
					//改行を<br>タグに変換して出力
 ?></p></div>
			</div>
			<?php
			}
 ?>
		
		</div>
		<button class="btn btn-success tokokensu" type="button">
  投稿件数 <span class="badge"><?=$first_key + 1 ?></span>
</button>
  </div>
		
		
		
		</div>
</body>
</html>