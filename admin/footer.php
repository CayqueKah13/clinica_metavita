<?php
require_once __DIR__ . '/../source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Session;

?>

    </div>
  </main>
  <!-- Main layout -->

  <!-- Footer -->
  <footer class="page-footer pt-0 mt-5">
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © <?php echo date('Y'); ?> Desenvolvido por <a href="https://www.vianti.com.br" target="_blank"> Vianti </a>
      </div>
    </div>
  </footer>
  <!-- Footer -->



  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/bootstrap.js"></script>
  <!-- Dropzone -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/addons/dropzone.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/mdb.min.js"></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/addons/datatables.js"></script>
  <!-- Masks -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/jquery.mask.js"></script>
  <!-- Moment -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/fullcalendar-3.10.0/lib/moment.min.js"></script>
  <!-- Moment -->
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/fullcalendar-3.10.0/fullcalendar.min.js"></script>
  <script type="text/javascript" src="<?= Config::BASE_URL_ADMIN ?>/_theme/js/fullcalendar-3.10.0/locale/pt-br.js"></script>



<!-- Initializations -->
<script>
// SideNav Initialization
$(".button-collapse").sideNav();

var container = document.querySelector('.custom-scrollbar');
var ps = new PerfectScrollbar(container, {
  wheelSpeed: 2,
  wheelPropagation: true,
  minScrollbarLength: 20
});


// Data Picker Initialization
$('.datepicker').pickadate({
  monthsFull: [ 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ],
  monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
  weekdaysFull: [ 'domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado' ],
  weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
  today: 'hoje',
  clear: 'limpar',
  close: 'fechar',
  format: 'dd/mm/yyyy'
})

// Material Select Initialization
$(document).ready(function () {
  $('.mdb-select').material_select();
  <?php Session::toastMessages(); ?>
});

// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// MDB Lightbox Init
$(function () {
  $("#mdb-lightbox-ui").load("<?= Config::BASE_URL_ADMIN ?>/_theme/mdb-addons/mdb-lightbox-ui.html");
});

// Dropzone Initialization
Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  parallelUploads: 1,
  clickable: true,
  acceptedFiles: "image/*",
  maxFilesize: 2, // MB
  dictDefaultMessage: "Arraste as fotos até aqui para adicionar",
  dictFileTooBig: "O arquivo enviado é muito grande. Limite: {{maxFilesize}} Mb",
  dictInvalidFileType: "Formato inválido"
};

// Input Masks
$(document).ready(function(){
$('.date').mask('00/00/0000');
$('.time').mask('00:00:00');
$('.date_time').mask('00/00/0000 00:00:00');
$('.cep').mask('00000-000');
$('.phone').mask('0000-0000');
$('.phone_with_ddd').mask('(00) 00000-0000');
$('.phone_us').mask('(000) 000-0000');
$('.mixed').mask('AAA 000-S0S');
$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
$('.money').mask('000.000.000.000.000,00', {reverse: true});
$('.money2').mask("#.##0,00", {reverse: true});
$('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
  translation: {
    'Z': {
      pattern: /[0-9]/, optional: true
    }
  }
});
$('.ip_address').mask('099.099.099.099');
$('.percent').mask('##0,00%', {reverse: true});
$('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
$('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
$('.fallback').mask("00r00r0000", {
    translation: {
      'r': {
        pattern: /[\/]/,
        fallback: '/'
      },
      placeholder: "__/__/____"
    }
  });
$('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});
</script>

</body>

</html>
