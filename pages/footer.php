<?php

use \Source\Core\Config;
use \Source\Core\Helper;

?>
<!-- Footer Area -->
<!DOCTYPE html>
<html>
<head>
	<!-- CSS and JavaScript files -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?v=2" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-style.css" />
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/velocity.ui.min.js"></script>
	<script src="js/jquery.fancybox.min.js"></script>
	<script src="js/custom.js"></script>
</head>


<footer class="footerbg fixed-footer">
  <div class="container">
    <div class="row footer-content copyright a">
      <div class="col-12 d-none d-md-block text-center pix-white">
        <div class="flexbox">
          <div class="flexdiv">
            <div class="footer-text1 pix-white">
              <p>Rua Vilela, 652 - 24º andar</p>
              <p>Tatuapé, São Paulo - SP</p>
              <p>CEP: 03314-000</p>
              <a href="https://maps.google.com/?q=Rua Vilela, 652 - Tatuapé, São Paulo - SP" target="_blank" class="pix-white">Ver no Google Maps</a>
            </div>
            <a href="<?= Config::BASE_URL ?>"><img src="<?= $themePath ?>/assets/logo-white.png" alt=""></a>
            <div class="footer-text2 pix-white">
              <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp; contato@seusite.com.br</p>
              <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp; (11) 0000-0000</p>
              <p><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp; <a class="pix-white" target="_blank" href="<?= Config::WHATSAPP_URL ?><?= Helper::numbersOnly(Config::WHATSAPP_NUMBER); ?>&text=<?= urlencode(Config::WHATSAPP_MESSAGE) ?>"><?= Config::WHATSAPP_NUMBER ?></a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 d-sm-block d-md-none text-center">
        <a href="<?= Config::BASE_URL ?>"><img src="<?= $themePath ?>/assets/logo-white.png" alt=""></a>
        <div class="my-2">
          <p>Rua Endereço vai aqui</p>
          <p>Bairro, Cidade - Estado</p>
          <p>CEP: 00000-000</p>
          <a class="pix-white" href="https://maps.google.com/?q=Rua Vilela, 652 - Tatuapé, São Paulo - SP"  target="_blank"><strong>Ver no Google Maps</strong></a>
        </div>
        <div class="mb-2">
          <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp; contato@seusite.com.br</p>
          <p><i class="fa fa-phone pix-white" aria-hidden="true"></i>&nbsp;&nbsp; <strong>(11) 0000-0000</strong></p>
           <p><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp; <a class="pix-white" target="_blank" href="<?= Config::WHATSAPP_URL ?><?= Helper::numbersOnly(Config::WHATSAPP_NUMBER); ?>&text=<?= urlencode(Config::WHATSAPP_MESSAGE) ?>"><?= Config::WHATSAPP_NUMBER ?></a></p>
        </div>
      </div>
      <div class="col-12 text-center">
        <p class="mt-1 copyright">© 2022. Todos os direitos reservados.</p>
        <!-- <p class="copyright"><a href="#">Termos de Uso</a> ¤ <a href="#">Política de Privacidade</a></p> -->
      </div>
    </div>
  </div>
</footer>

</body>

<script type="text/javascript" src="<?= $themePath ?>/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<script type="text/javascript" src="<?= $themePath ?>/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/js/jcarousel.responsive.js"></script>


<script type="text/javascript">
$(window).scroll(function(){
var scroll = $(window).scrollTop();
if(scroll < 50){
  $('.fixed-top').css('background', 'none');
} else{
  $('.fixed-top').css('background', '#F3F2F0');
}
});
</script>

<script type="text/javascript">
$(window).scroll(function(){
var scroll = $(window).scrollTop(); {
if(scroll < 50){
if(window.innerWidth > 767){
  $('.fixed-top').css('background', 'none');
} else{
  $('.fixed-top').css('background', '#F3F2F0');
}
}
}
});
</script>

</html>
