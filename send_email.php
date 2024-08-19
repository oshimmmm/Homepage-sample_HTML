<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // サーバー設定
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // GmailのSMTPサーバー
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Gmailのユーザー名
        $mail->Password = 'your-email-password'; // Gmailのパスワード
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 暗号化方式
        $mail->Port = 587; // ポート番号

        // 送信者と受信者の設定
        $mail->setFrom('your-email@gmail.com', 'Your Name');
        $mail->addAddress('recipient@example.com', 'Recipient Name');

        // メール内容の設定
        $mail->isHTML(true); // HTML形式のメール
        $mail->Subject = 'お問い合わせフォームからのメッセージ';
        $mail->Body    = "お名前: $name<br>メールアドレス: $email<br>メッセージ:<br>$message";
        $mail->AltBody = "お名前: $name\nメールアドレス: $email\nメッセージ:\n$message";

        // メール送信
        $mail->send();
        echo 'メッセージが送信されました。ありがとうございます！';
    } catch (Exception $e) {
        echo "メッセージの送信に失敗しました。エラー: {$mail->ErrorInfo}";
    }
}
?>

