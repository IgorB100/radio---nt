<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Кому надсилати лист
    $toEmail = "ТВОЯ_GMAIL_АДРЕСА@gmail.com";

    $mail = new PHPMailer(true);

    try {

        // ====== SMTP НАЛАШТУВАННЯ ======
        $mail->isSMTP();
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "jeck.nt@gmail.com"; // твоя адреса
        $mail->Password   = "krymteplica1999"; // пароль додатка
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Від кого (має бути Gmail!)
        $mail->setFrom("jeck.nt@gmail.com", "Повідомлення");

        // Кому
        $mail->addAddress($toEmail);

        // Щоб можна було відповісти користувачу
        $mail->addReplyTo($email, $name);

        // Тема і тіло
        $mail->Subject = $subject;
        $mail->Body =
            "Ім'я: $name\n" .
            "Email: $email\n" .
            "Тема: $subject\n\n" .
            "Повідомлення:\n$message\n";

        $mail->CharSet = "UTF-8";

        // Увімкнути детальну діагностику SMTP
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
        $mail->send();
        echo "Ваше повідомлення успішно відправлено!";

    } catch (Exception $e) {
        echo "Помилка при відправці: {$mail->ErrorInfo}";
    }
}
?>