<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
class Kirimemail extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('MyPHPMailer'); // load library
    }
 
    function emailSend(){
        $fromEmail = "dev.mglgold@gmail.com"; //ganti dg alamat email kamu di sini
        $isiEmail = "Isi email tulis disini"; //ini isi emailnya
        $mail = new PHPMailer();
        $mail->IsHTML(true);    //ini agar email bisa mengirim dalam format HTML
        $mail->IsSMTP();   //kita akan menggunakan SMTP
        $mail->SMTPAuth   = true; //Autentikasi SMTP: enabled
        $mail->SMTPSecure = "ssl";  //jenis keamanan SMTP
        $mail->Host       = "smtp.gmail.com"; //setting GMail sebagai SMTP server
        $mail->Port       = 465; // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  
        $mail->Password   = "Milledev123"; //ganti dg password GMail kamu
        $mail->SetFrom('dev.mglgold@gmail.com', 'noreply');  //Siapa yg mengirim email
        $mail->Subject    = "Subjek email"; //ini subjek emailnya
        $mail->Body       = $isiEmail;
        $toEmail = "abdiweb.teknologi@gmail.com"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
       
        if(!$mail->Send()) {
            echo "Eror: ".$mail->ErrorInfo;
        } else {
            echo "Email berhasil dikirim";
        }
    }
}
?>