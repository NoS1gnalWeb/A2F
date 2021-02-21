<?php 
    require_once __DIR__.'/vendor/autoload.php';

    use OTPHP\TOTP;

    // ex : BXCYJI72M2PSUJ3KZL2VQKDYLXVK6J4Y5RV2MUG7D2N5QIDR4ERBSMDIPNVHKD2A6VT6LGNNR2Z6VFIFKM3UNVPTOFYSBMFD3R22OWI
    $otp = TOTP::create('SECRET');
   
    $otp->setLabel('CUSTOM_LABEL');
    $chl = $otp->getProvisioningUri();
    $link = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=".$chl;

?>
<!doctype html>
<html lang="en">
  <head>
    <title>2AF Google</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <div class="col-12">
            <div class="text-center">
                <h1>Double authentification avec Google Authenticator</h1>
                <br />
                <h2>Scannez le QR Code</h2>
                <img src="<?php echo $link; ?>"/>
                <br />
                <br />
                <?php 
                  if(!empty($_GET['verif'])){
                    $v = htmlspecialchars($_GET['verif']);
                    switch($v){
                      case 'success':
                        ?>
                          <div class="alert alert-success">
                            Authentification effectuée avec succès ! 
                          </div>
                        <?php 
                        break;
                        case 'err':
                          ?>
                            <div class="alert alert-danger">
                              Code non valide ... 
                            </div>
                          <?php 
                    }
                  }
                  ?>
                <form action="verify.php" method="POST">
                    <input type="text" name="code" class="form-control">
                    <br />
                    <button type="submit" class="btn btn-success">Verifier</button>
                </form>
            </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>