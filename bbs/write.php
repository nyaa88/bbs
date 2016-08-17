<?php 
include ("common.php");
// フォームが送信された場合、入力内容をチェックして書き込みを行う
 $error=array(); // 配列として初期化が必要

if (isset($_POST["submit"])){
	// 名前の入力チェック
	if (!isset($_POST["name"])){ //変数がセットされているか確認
		$errors["name"] = "名前が入力されていません";
	} elseif (mb_strlen($_POST["name"]) == 0 ){ //文字数が0かどうか確認
		$errors["name"] = "名前が入力されていません" ;
	} elseif (mb_strlen($_POST["name"]) > 20 ){ //文字数が最大値以内か確認
		$errors["name"] = "名前は20文字以内で入力してください";
	}
	//コメントの入力チェック
	if (!isset($_POST["comment"])){ //変数がセットされているか確認
		$errors["comment"] = "コメントが入力されていません";
	} elseif (mb_strlen($_POST["comment"]) == 0 ){ //文字数が0かどうか確認
		$errors["comment"] = "コメントが入力されていません";
	} elseif (mb_strlen($_POST["comment"]) > 400 ){ //文字数が最大値以内か確認
		$errors["comment"] = "コメントは400文字以内で入力してください";
	}
} else {
	$errors["submit"] = "フォームが正しく送信されていません";
}

// エラーが無ければ書き込み処理に進む
if (count($errors) == 0) { 
  $result = Com::bbs_write($_POST);
  if (!$result) {
    $errors["result"] = " 書き込みに失敗しました";
  }
}
// エラーが無ければ index.php に戻す
if (count($errors) == 0) { 
  header("Location: index.php"); 
}



// 
// if (count($errors) == 0 ){ // エラーが0個かどうか確認
	// if(Com::bbs_write($_POST)){
	// // エラーが無ければ index.php に戻す
	// header("Location: index.php");
	// exit();	
	// }else{
		// $errors["result"] = "書き込みに失敗しました";
	// }
// }

// 以下エラーが発生した場合の HTMLページ
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>ひよこ掲示板 - 投稿エラー</title>
<style>ul.error{color:red;}</style>
</head>
<body>
	<h1>ひよこ掲示板 - 投稿エラー</h1>
	<h2>以下のエラーが発生しました再度入力してください。</h2>
	<ul class="error"><?php // 繰り返し処理でエラー表示
		foreach ($errors as $error) {
			?><li><?php print $error; ?></li><?php
		}	 ?></ul>
	<a href="index.php">簡易掲示板に戻る</a>
</body>
</html>