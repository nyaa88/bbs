<?php

class Com {
	// csvで利用するファイル名を指定
	const BBS_FILE = "bbs.csv";
	// エスケープを行うラップ関数を定義

	//コンストラクタ クラスの呼び出し時に自動で一回だけ実行される関数
	function __construct() {
		// 日本語の文字コード設定などを予め定義
		mb_internal_encoding("UTF-8");
		mb_language("ja");
		setlocale(LC_ALL, "ja_JP.UTF-8");
		//↓タイムゾーン
		date_default_timezone_set('Asia/Tokyo');
		//global $bbs_file;→//constでグローバル変数とする $不要 慣例的に大文字を使う
	}

	function h($str) {
		$str = htmlspecialchars($str, ENT_QUOTES, "UTF-8");
		$str = preg_replace('/(\n|\r|\r\n)+/us', "\n", $str);
		return nl2br($str);
	}

	// 掲示板のデータをファイルに書き込む関数を定義
	function bbs_write($date) {

		// ファイルを追記モードで開く   排他制御
		$handle = @fopen(BBS_FILE, "a") or exit("Excelを閉じてください");
		//ファイルポインタ取得
		// コメントの改行コードを統一する
		$date["comment"] = str_replace(array("\r\n", "\n", "\r"), PHP_EOL, $date["comment"]);
		//書き込みたい情報を配列にまとめる
		$csv[] = $date["name"];
		$csv[] = $date["comment"];
		$csv[] = time();
		//現在時刻を取得  ユニックスタイムスタンプ 1970年からの連番
		// ファイルに書き込みを行う
		$result = fputcsv($handle, $csv);
		//配列を元にファイルにCSV形式で書き込み
		// ファイルを閉じる
		fclose($handle);
		// 関数の実行結果を返す
		return $result;
	}

	// 掲示板のデータをファイルから読み込む関数を定義
	function bbs_read() {
		//global $bbs_file;
		//ファイルを読み込みモードで開く
		$handle = fopen(Com::BBS_FILE, "r"); //クラス名の変数、定数を使うときは クラス名::変数、または$this->変数
		//開いたポインタからデータを1行ずつ取得して配列に格納
		while ($csv = fgetcsv($handle)) {
			$record["name"] = $csv[0];
			$record["comment"] = $csv[1];
			$record["time"] = $csv[2];
			$records[] = $record;
			//$record配列に$recordを格納
		}
		// ファイルを閉じる
		fclose($handle);
		// 関数の実行結果を返す
		return $records;
	}

}


?>