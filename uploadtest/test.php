<?php
	$count = count($_FILES['files']['tmp_name']);
	for($i = 0 ; $i < $count ; $i ++ ){
		if (is_uploaded_file($_FILES["files"]["tmp_name"][$i])){ //uploadされたファイルがあれば、
			if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], "sendfile" . $i . ".txt")){ //ファイルを"sendfile$i.txt"として移動
				echo "ok:" . $_FILES["files"]["name"][$i] . "\n";
			}else{
				echo "error:" . $_FILES["files"]["name"][$i] . "\n";
			}
		}else{
			echo "no file" . $i . "\n";
		}
	}
?>
<HTML>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(function(){
  /*================================================
    ファイルをドロップした時の処理
  =================================================*/
  $('#drag-area').bind('drop', function(e){
    // デフォルトの挙動を停止
    e.preventDefault();
 
    // ファイル情報を取得
    var files = e.originalEvent.dataTransfer.files;
 
    uploadFiles(files);
 
  }).bind('dragenter', function(){
    // デフォルトの挙動を停止
    return false;
  }).bind('dragover', function(){
    // デフォルトの挙動を停止
    return false;
  });
 
  /*================================================
    ダミーボタンを押した時の処理
  =================================================*/
  $('#btn').click(function() {
    // ダミーボタンとinput[type="file"]を連動
    $('input[type="file"]').click();
  });
 
  $('input[type="file"]').change(function(){
    // ファイル情報を取得
    var files = this.files;
 
    uploadFiles(files);
  });
 
});
 
/*================================================
  アップロード処理
=================================================*/
function uploadFiles(files) {
  // FormDataオブジェクトを用意
  var fd = new FormData();
 
  // ファイルの個数を取得
  var filesLength = files.length;
 
  // ファイル情報を追加
  for (var i = 0; i < filesLength; i++) {
    alert(files[i]["name"]);
    fd.append("files[]", files[i]);
  }
 
  // Ajaxでアップロード処理をするファイルへ内容渡す
  $.ajax({
    url: 'test.php',
    type: 'POST',
    data: fd,
    processData: false,
    contentType: false,
    success: function(data) {
      alert(data);
    }
  });
}
</script>
</head>
<body>
<div id="drag-area" style="border-style: dotted;background-color: #ffbbff;">
  <p>アップロードするファイルをドロップ</p>
  <p>または</p>
  <div class="btn-group">
    <input type="file" multiple="multiple" style="display:none;" name="files"/>
    <button id="btn">ファイルを選択</button>
  </div>
</div>
</body>
</html>