<?php 
    require_once __DIR__.'/vendor/autoload.php';

    use OTPHP\TOTP;

    // ex : BXCYJI72M2PSUJ3KZL2VQKDYLXVK6J4Y5RV2MUG7D2N5QIDR4ERBSMDIPNVHKD2A6VT6LGNNR2Z6VFIFKM3UNVPTOFYSBMFD3R22OWI
    $otp = TOTP::create('SECRET');

    /*
     *
     * On verifie si le code existe et si c'est le bon on redirige avec un message
     * de succès, sinon on redirige avec un message d'erreur.
     * 
     */
    if(!empty($_POST['code'])){
        if($otp->verify(htmlspecialchars($_POST['code']))){
            header('Location: index.php?verif=success');
            die();
        }else{
            header('Location:index.php?verif=err');
            die();
        }
    }else{header('Location: index.php'); die();}