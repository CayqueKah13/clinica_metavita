<?php
header('HTTP/1.1 403 FORBIDDEN');

$root = "https://demo.clinicametavita.com.br";
$adminRoot = "https://demo.clinicametavita.com.br/admin";

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" lang="pt">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="robots" content="noindex" />
  <title>Clínica MetaVita</title>
  <link rel="shortcut icon" href="<?php echo($root); ?>/img/fav_icon.png"/>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo($adminRoot); ?>/_theme/css/bootstrap.min.css" rel="stylesheet">
  <style>
  html,
  body,
  header,
  .view {
    height: 100%;
  }
  @media (min-width: 560px) and (max-width: 740px) {
    html,
    body,
    header,
    .view {
      height: 650px;
    }
  }
  @media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .view  {
      height: 650px;
    }
  }
  </style>
</head>

<body class="login-page" style="background-color:#000000;">
  <header>
    <section class="view intro-2">
      <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">

              <h1 class="text-center" style="color:rgba(255,255,255,1.0);">403</h1>
              <h2 class="text-center" style="color:rgba(255,255,255,1.0);">Acesso Negado</h2>


            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
</body>

</html>
