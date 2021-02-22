<?php

// modificat C:/php-7.4.10/php.ini -> include_path = ".;c:\php\includes;C:\Users\a_rsc"

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// require 'vendor/autoload.php';
$mail = new PHPMailer();

try{
    $mail->IsSMTP();

    // Configuracion del servidor de correo
    // Modificar a 0 para eliminar el mensaje de error
    $mail->SMTPDebug = CONFIG['EMAIL_SMTPDEBUG'];
    $mail->SMTPAuth = CONFIG['EMAIL_SMTPAUTH'];
    $mail->SMTPSecure = CONFIG['EMAIL_SMSMTPSECURE'];
    $mail->Host = CONFIG['EMAIL_HOST'];
    $mail->Port = CONFIG['EMAIL_PORT'];

    // Credenciales de la cuenta de gmail
    $mail->Username = CONFIG['EMAIL_USERNAME'];
    $mail->Password = CONFIG['EMAIL_PASSWORD'];

    // Datos del email
    $mail->SetFrom(CONFIG['EMAIL_SETFROM'], CONFIG['APP_NAME']);
    $mail->Subject = "Cambios en su cuenta (" . CONFIG['APP_NAME'] . ')';

    $mail->IsHTML(true);

    require_once('../php/email/forgotPasswordHTML.php');

    // Body: Establece el cuerpo del mensaje.Puede ser texto simple o con formato HTMl. Si es con formato HTMl hay que ejecutar el metodo IsHTML(True)
    $mail->Body = sprintf($body, CONFIG['URL'], $data['resetPasswordCode'], $user['email'], CONFIG['URL'], CONFIG['URL'], CONFIG['URL']);

    // AltBody: Establece el cuerpo del mensaje como solo de texto
    // $mail->AltBody = "This paragraph is not bold.\n\nThis text is not italic.";
    // $mail->addAttachment("fitxer.pdf");

    // Destinatario
    $address = $user['email'];
    $mail->AddAddress($address, 'Email');

    // Envio
    $mail->send();

}catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}