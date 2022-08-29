<?php

class Email {
    public static function email_registrar(array $array_formdata) {
        $email = $array_formdata["email"];
        $asunto = "Confirmación de registro";
        $mensaje = "Bienvenido, ya estás dentro :)";
        $headers = "From: sender\'s email";

        $resultado = mail($email, $asunto, $mensaje, $headers);
        if($resultado){
            return $resultado = '<p class="ok-form">Tienes que haber recibido un correo en: '.$email.'</p>';
        }else{
            return $resultado = '<p class="ok-form">Ha habido un problema al enviar un correo a: '.$email.'
                , pero la cuenta has sido registrada correctamente.</b></p>';
        }

    }
}