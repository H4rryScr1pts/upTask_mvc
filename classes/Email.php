<?php 
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
  protected $email;
  protected $nombre;
  protected $token;

  public function __construct($email, $nombre, $token) {
    $this->email = $email;
    $this->nombre = $nombre;
    $this->token = $token;
  }

  public function enviarConfirmacion() {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $_ENV["EMAIL_HOST"];
    $mail->Port = $_ENV["EMAIL_PORT"];
    $mail->Username = $_ENV["EMAIL_USER"];
    $mail->Password = $_ENV["EMAIL_PASS"];

    $mail->setFrom("cuentas@uptask.com");
    $mail->addAddress("cuentas@uptask.com", "uptask.com");
    $mail->Subject = "Confirma tu Cuenta";
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";

    $contenido = "<html>";
    $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>, Has creado tu cuenta en UpTask, solo debes confirmarla siguiendo el siguiente enlace</p>";
    $contenido .= "<p>Preciona aqui: <a href='". $_ENV["APP_URL"]."/confirmar?token=". $this->token . "'>Confirmar Cuenta</a></p>";
    $contenido .= "<p>Si tu no creaste esta cuenta puedes ignorar el mensaje</p>";
    $contenido .= "</html>";

    $mail->Body = $contenido;

    $mail->send();
  }

  public function enviarInstrucciones() {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $_ENV["EMAIL_HOST"];
    $mail->Port = $_ENV["EMAIL_PORT"];
    $mail->Username = $_ENV["EMAIL_USER"];
    $mail->Password = $_ENV["EMAIL_PASS"];

    $mail->setFrom("cuentas@uptask.com");
    $mail->addAddress("cuentas@uptask.com", "uptask.com");
    $mail->Subject = "Reestablece tu Password";
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";

    $contenido = "<html>";
    $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>, Has solicitado reestablecer tu password en UpTask, siguie el siguiente enlace realizar el proceso</p>";
    $contenido .= "<p>Preciona aqui: <a href='". $_ENV["APP_URL"]."/reestablecer?token=". $this->token . "'>Reestablecer Password</a></p>";
    $contenido .= "<p>Si tu no solicitaste este proceso puedes ignorar el mensaje</p>";
    $contenido .= "</html>";

    $mail->Body = $contenido;

    $mail->send();
  }
}
?>