<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('send_mailer')) {

    // lokal
    function send_mailer2($data = "")
    {
        $rtrn = [
            'is_sent' => TRUE,
            'error' =>  'Email tidak terkirim, hanya test.',
            'pesan' => 'Email tidak terkirim, hanya test.'
        ];
        return $rtrn;
    }

    function send_mailer($data = "")
    {
        if ($data != "") {

            $ci = &get_instance();

            //DATA
            $email_penerima = $data['email'];
            $subjek = $data['subjek'];
            $pesan = $data['pesan'];

            // $email_penerima = "andifasaya@gmail.com";
            // $subjek = "Test email lokal";
            // $pesan = "test";

            // Load PHPMailer library
            $ci->load->library('phpmailer_lib');

            // PHPMailer object
            $mail = $ci->phpmailer_lib->load();

            // $mail->SMTPDebug  = 2;

            // Attach image
            // $mail->AddEmbeddedImage(filename, cid, name);
            $mail->AddEmbeddedImage('assets/hyper/images/black.png', 'logo', 'black.png');

           	// SMTP configuration
            $mail->isSMTP();
            $mail->Host     = 'mail.tfx.co.id';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@tfx.co.id';
            $mail->Password = 'supp0rt@tifia2022';
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = 465; // 465/587

			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

            $mail->setFrom('support@tfx.co.id', 'PT. Teknologi Finansial Berjangka');
            $mail->addReplyTo('manager@tfx.co.id');

            // Add a recipient
            $mail->addAddress($email_penerima);

            // Add cc or bcc 
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Email subject
            $mail->Subject = $subjek;

            // Set email format to HTML
            $mail->isHTML(true);

            // Email body content
            $mail->Body = $pesan;

            $log_email = [
                'subject' => $subjek,
                'content' => $pesan,
                'email_from' => 'support@tfx.co.id',
                'email_to' => $email_penerima,
                'date' => new_date()
            ];

            // Send email
            if (!$mail->send()) {
                $log_email['status'] = 0;
                $log_email['error_message'] = $mail->ErrorInfo;
                $rtrn = [
                    'is_sent' => FALSE, // FALSE, TRUE hanya untuk testing
                    'error' =>  $mail->ErrorInfo,
                    'pesan' => 'Failed to send email.'
                ];
            } else {
                $log_email['status'] = 1;
                $log_email['error_message'] = $mail->ErrorInfo;
                $rtrn = [
                    'is_sent' => TRUE,
                    'error' =>  'Email sent.',
                    'pesan' => 'Email sent.'
                ];
            }
            $ci->db->insert('log_email', $log_email);
          
            return $rtrn;
        }
    }
}
