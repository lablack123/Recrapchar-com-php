<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Chave secreta do reCAPTCHA
    $secretKey = '6Lf1ONUqAAAAAFEhHXSREShJpzH8eD0Id_HFJC3-';
    // Resposta do reCAPTCHA

    $recaptchaResponse = $_POST['g-recaptcha-response'];
    // Verifica se o reCAPTCHA foi preenchido
    if (!$recaptchaResponse) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Por favor, complete o reCAPTCHA.']);
        exit;
    }


    // Faz a verificação da resposta do reCAPTCHA

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);
    if (!$responseKeys["success"]) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha na verificação do reCAPTCHA.']);
        exit;
    }


    // Se o reCAPTCHA for válido, prossiga com o processamento do formulário
   
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $assunto = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($email && $assunto && $mensagem) {
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mail.com'; // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'inicportal@gmail.com'; // Seu endereço de e-mail
            $mail->Password = 'uhnu poma fzkt opim'; // Sua senha de e-mail ou senha de aplicativo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remetente e destinatário
            $mail->setFrom($email);
            $mail->addAddress('site.inic@inic.gov.st'); // Endereço de e-mail do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;'>
                    <h2 style='color: #0056b3; text-align: center;'>Mensagem do Site Inic_Portal</h2>
                    <p style='font-size: 16px;'><strong>Email:</strong> $email</p>
                    <p style='font-size: 16px;'><strong>Assunto: $assunto</strong></p>
                    <div style='background: #fff; padding: 15px; border-left: 4px solid #0056b3; font-size: 15px;'>
                        $mensagem
                    </div>
                    <br>
                </div>
            ";

            // Enviar e-mail
            if ($mail->send()) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'E-mail enviado com sucesso.']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao enviar o e-mail.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => "Erro: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha todos os campos obrigatórios corretamente.']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Método de requisição inválido.']);
}
?>





