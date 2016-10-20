<?php
// 送信フラグ
$send_flg = false;
// エラーメッセージ
$err_msg = array();
// 送信ボタンを押した後の処理
if ($_POST["post_flg"]) {
	// エラー
	if ($_POST["name"] == "") {
		$err_msg[] = "「お名前」は必須です";
	}
	if ($_POST["email"] == "") {
		$err_msg[] = "「メールアドレス」は必須です";
	}
	// エラーが無ければ送信
	if (count($err_msg) == 0) {
		// 宛先
		$mail_to = "kurahara@downtownkumamoto.com";
		// 送信元アドレス
		$mail_from = "form@example.com";
		// 件名
		$mail_subject = "メールフォームから送信がありました";
		// 本文
		$mail_body = "";
		$mail_body.= "■お名前\n".$_POST["name"]."\n\n";
		$mail_body.= "■メールアドレス\n".$_POST["email"]."\n\n";
		$mail_body.= "■コメント\n".$_POST["comment"];
		// 送信処理
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		mb_send_mail($mail_to, $mail_subject, $mail_body, "From: <".$mail_from.">");
		$send_flg = true;
		$_POST = array();
	}
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>メールフォーム</title>
</head>

<body>
<?php
// 初期フォーム表示
if (!$send_flg) {
?>

<h1>メールフォーム</h1>

<?php
// エラーメッセージがある場合
if (count($err_msg) > 0) {
?>
<p style="color:red;">
<?php foreach ($err_msg as $val) { ?>
※<?php echo $val ?><br>
<?php } ?>
</p>
<?php } ?>

<form action="" method="post">

<p>
お名前<br>
<input type="text" name="name" value="<?php echo $_POST["name"] ?>"><br>
</p>

<p>
メールアドレス<br>
<input type="text" name="email" value="<?php echo $_POST["email"] ?>"><br>
</p>

<p>
コメント<br>
<textarea name="comment" rows="10"><?php echo $_POST["comment"] ?></textarea><br>
</p>

<input type="submit" name="post_flg" value="送信する"><br>
</form>

<?php
// メール送信後の表示
} else {
?>
メールを送信しました。<br>
<?php } ?>

</body>
</html>