<?php

include_once '../util/PHPMailer/PHPMailer.php';

function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

if($_POST) {
    $array = array();
    $email = ($_POST['email']);

    if(empty($email)){
        $array['valid'] = 0;
        $array['message'] =  "Por favor informe seu email";
    }else if(!isEmail($email)){
        $array['valid'] = 0;
        $array['message'] = 'Insira um e-mail válido!';
    }

    if(count($array) > 0){
         header("HTTP/1.0 406");
         header('Content-type: application/json');
         echo json_encode($array);
    }
    else {
        $array['valid'] = 1;
        $array['message'] = 'Obrigado por assinar nossa newsletter!';

        // Send email
        $subject = 'Novo Assinante!';
        $body = wordwrap("Você tem um novo assinante!\n\nEmail: " . $email);

        // uncomment this to set the From and Reply-To emails, then pass the $headers variable to the "mail" function below
        $headers = "From: ".$email." <" . $email . ">" . "\r\n" . "Reply-To: " . $email;

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host     = "mail.weblinia.com.br";
        $mail->SMTPAuth = true;
        $mail->Username = 'filipecoelho@weblinia.com.br';
        $mail->Password = '150679';
        $mail->Port     = 587;
        $mail->From     = 'news@weblinia.com.br';
        $mail->Sender   = "news@weblinia.com.br";
        $mail->FromName = 'WebliniaERP';

        $mail->AddAddress('sistemas@weblinia.com.br', '');

        $mail->IsHTML(true);

        $mail->Subject  = utf8_decode($subject);
        $mail->Body = utf8_decode($body);

        $enviado = $mail->Send();

        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        if($enviado){
            header('Content-type: application/json');
            echo json_encode($array);
        }
        else {
            header("HTTP/1.0 505");
            echo "Desculpe, no momento o e-mail não pode ser cadastrado! Tente novamente mais tarde.";
        }
    }
}
?>
