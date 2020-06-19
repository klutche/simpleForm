<?php
// 送信フラグ
$send_flg = false;
// エラーメッセージ
$err_msg = array();
// 送信ボタンを押した後の処理
if ($_POST['post_flg']) {
	// エラー
	if ($_POST['name'] == '') {
		$err_msg['name'] = '「お名前」は必須です';
	}
	if ($_POST['email'] == '') {
		$err_msg['email'] = '「メールアドレス」は必須です';
	}
	if ($_POST['comment'] == '') {
		$err_msg['comment'] = '「お問い合わせ内容」を入力してください';
	}
	// エラーが無ければ送信
	if (count( $err_msg) == 0) {
		// 宛先
		$mail_to = 'shekuhara@gmail.com';
		// 送信元アドレス
		$mail_from = 'form@example.com';
		// 件名
		$mail_subject = 'メールフォームから送信がありました';
		// 本文
		$mail_body = '';
		$mail_body .= '■お名前'."\n".$_POST['name']."\n\n";
		$mail_body .= '■メールアドレス'."\n".$_POST['email']."\n\n";
		if ($_POST['tel'] != '') {
			$mail_body .= '■お電話番号'."\n".$_POST['tel']."\n\n";
		}
		$mail_body .= '■お問い合わせ内容'."\n".$_POST['comment'];
		// 送信処理
		mb_language('Japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail($mail_to, $mail_subject, $mail_body, 'From: <' . $mail_from . '>');
		$send_flg = true;
		$_POST = array();
	}
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メールフォーム</title>
</head>
<body>
<h1>メールフォーム</h1>
<?php
// 初期フォーム表示
if (!$send_flg) {
?>
<form action="" method="post">
<p>お名前</p>
<input type="text" name="name" value="<?= @$_POST['name']; ?>"><br>
<?= $err_msg['name'] ? '<p style="color: #f00;">'.$err_msg['name'].'</p>' : ''; ?>
<p>メールアドレス</p>
<input type="email" name="email" value="<?= @$_POST['email']; ?>"><br>
<?= $err_msg['email'] ? '<p style="color: #f00;">'.$err_msg['email'].'</p>' : ''; ?>
<p>お電話番号</p>
<input type="text" name="tel" value="<?= @$_POST['tel']; ?>"><br>
<p>お問い合わせ内容</p>
<textarea name="comment" rows="10"><?= @$_POST['comment']; ?></textarea><br>
<input type="submit" name="post_flg" value="送信する"><br>
</form>
<?php
// メール送信後の表示
} else {
?>
<p>メールを送信いたしました。<br>
お問い合わせありがとうございます。</p>
<?php } ?>
</body>
</html>
