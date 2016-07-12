<?php
	header("Content-Type: text/html; charset=UTF-8");

	$link = mysql_connect("localhost","root","");
	mysql_query("SET NAMES utf8",$link);
	if (!$link) {
		die("接続できませんでした" .mysql_error());
	}

	$db = mysql_select_db("lesson" , $link);
	if (!$db) {
		die("データベース接続エラーです。" .mysql_error());
	}

	$result = mysql_query("SELECT * FROM kadai_kida_ziplist");
	if (!$result) {
		echo("SQL失敗");
	}

	 //検索結果の全体表示
	echo(" | 全国地方公共団体コード | 旧郵便番号 | 郵便番号 | 都道府県名(半角カタカナ) | 市区町村名(半角カタカナ)|町域名(半角カタカナ)| 都道府県名(漢字)| 市区町村名(漢字)| 町域名(漢字)| 一町域で複数の郵便番号か|小字毎に番地が起番されている町域か| 丁目を有する町域名か|一郵便番号で複数の町域か| 更新確認| 更新理由|<br>");
	while ($row = mysql_fetch_array($result)) {
		echo $row["public_group_code"] ;print("    ");
		echo $row["zip_code_old"] ;print("    ");
		echo $row["zip_code"] ;print("    ");
		echo $row["prefecture_kana"] ;print("    ");
		echo $row["city_kana"] ;print("    ");
		echo $row["town_kana"] ;print("    ");
		echo $row["prefecture"] ;print("    ");
		echo $row["city"] ;print("    ");
		echo $row["town"] ;print("    ");
		if ($row["town_double_zip_code"] = 1 ) {
			print("該当  ");print("    ");
		} else {
			print("該当せず  ");print("    ");
		}

		if ($row["town_multi_address"] = 1 ) {
			print("該当  ");print("    ");
		} else {
			print("該当せず  ");print("    ");
		}

		if ($row["town_attach_district"] = 1 ) {
			print("該当  ");print("    ");
		} else {
			print("該当せず  ");print("    ");
		}

		if ($row["zip_code_multi_town"] = 1 ) {
			print("該当  ");print("    ");
		} else {
			print("該当せず  ");print("    ");
		}

		if ($row["update_check"] = 0 ) {
			print("変更なし  ");print("    ");
		} elseif ($row["update_check"] = 1) {
			print("変更あり  ");print("    ");
		} else {
			print("廃止  ");print("    ");
		}

		if ($row["update_reason"] = 0 ) {
			print("変更なし  ");print("    ");
		} elseif ($row["update_reason"] = 1) {
			print("市政・区政・町政・分区・政令指定都市施行  ");print("    ");
		} elseif ($row["update_reason"] = 2) {
			print("住居表示の実施  ");print("    ");
		} elseif ($row["update_reason"] = 3) {
			print("区画整理  ");print("    ");
		} elseif ($row["update_reason"] = 4) {
			print("郵便区調整等  ");print("    ");
		} elseif ($row["update_reason"] = 5) {
			print("訂正  ");print("    ");
		} else {
			print("廃止  ");print("    ");
		}
		echo "<BR>" ;
			};

	//結果セットの開放
	mysql_free_result ($result) ;

	//データベースから切断
	mysql_close($result) ;






?>