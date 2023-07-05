<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\CustomerController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_CUSTOMERS)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = CustomerController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Paciente não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/clientes/clientes");
  exit;
}
$statusList = CustomerController::getStatusList();
$goalsList = CustomerController::getGoalsList();
$pronounList = CustomerController::getPronounList();



$link = Config::BASE_URL_ADMIN . "/clientes/editar?id=" . $id;

// Show Header
$currentTab = "customers";
$breadcrumbs = array('Pacientes');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Paciente #<?= $id ?></h4>

<!-- First row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Informações Principais</h5>
        <div class="row">

          <div class="col-md-4">
            <div class="card-body card-body-cascade">
              <img src="<?= Theme::imageUrlFromSufix($item['img']); ?>" style="width:100%;">
              <form action="<?= Config::BASE_URL ?>/arquivos/imagens/upload.php" class="dropzone text-center" id="my-awesome-dropzone">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="folder" value="clientes">
              </form>
            </div>
          </div>

          <div class="col-md-8">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="row">
                <div class="col-md-3">
                  <select class="mdb-select md-form" name="pronoun" required>
                    <option disabled selected>Título</option>
                    <?php foreach ($pronounList as $key => $value) { ?>
                      <option value="<?= $value ?>" <?php if ($value == $item['pronoun']) { echo "selected"; } ?>><?= $value ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-9">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-name" class="form-control" name="name" value="<?= $item['name'] ?>" required>
                    <label for="input-name">Nome</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="email" id="input-email" class="form-control" name="email" value="<?= $item['email'] ?>" required>
                    <label for="input-email">Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="text" id="input-phone" class="form-control phone_with_ddd" name="phone" value="<?= $item['phone'] ?>">
                    <label for="input-phone">Telefone</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="text" id="input-cpf" class="form-control cpf" name="cpf" value="<?= $item['cpf'] ?>">
                    <label for="input-cpf">CPF</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-date" class="form-control date" name="born" value="<?= Dates::brlDateFormat($item['born_at']) ?>">
                    <label for="input-date">Data de Nascimento</label>
                  </div>
                </div>
              </div>

              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-address" class="form-control" name="address" value="<?= $item['address'] ?>">
                <label for="input-address">Endereço</label>
              </div>

              <div class="row">
              <div class="col-md-6">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-complement" class="form-control" name="complement" value="<?= $item['complement'] ?>">
                    <label for="input-complement">Complemento</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="text" id="input-zipcode" class="form-control cep" name="zipcode" value="<?= $item['zipcode'] ?>">
                    <label for="input-zipcode">CEP</label>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-md-3">
                  <select class="mdb-select md-form" name="goal" required>
                    <option disabled selected>Meta</option>
                    <?php foreach ($goalsList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_goal']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-9">
                  <select class="mdb-select md-form" name="status" required>
                    <option disabled selected>Status</option>
                    <?php foreach ($statusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-secondary-message" class="form-control" name="secondary_message" value="<?= $item['secondary_message'] ?>">
                <label for="input-secondary-message">Como conheceu a Clínica MetaVita</label>
              </div>

              <div class="md-form">
                <textarea type="text" id="input-message" class="md-textarea form-control" name="message" rows="3"><?= $item['message'] ?></textarea>
                <label for="input-message">Observações</label>
              </div>

              <div class="row justify-content-center mb-4">
                <button class="btn btn-primary btn-rounded z-depth-0 waves-effect" type="submit">Atualizar</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- First row -->






<div class="row justify-content-between px-4 text-center">
  <?php if (Helper::safeString($item['phone']) != '') { ?>
  <a class="center mb-5" target="_blank" href="<?= Config::WHATSAPP_URL ?><?= Helper::numbersOnly($item['phone']); ?>" > <img src="<?= Config::BASE_URL ?>/arquivos/imagens/botao-whatsapp-lg.png" alt=""> </a>
  <?php } ?>
</div>



<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Paciente? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Paciente') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Paciente</a>
</div>




<?php
require_once('../footer.php');
?>




<script type="text/javascript">
var uploadCounter = 0;

function reloadPage() {
  if (uploadCounter == 0) {
    window.location.href = "<?= $link ?>";
  }
}

Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFiles: 1,
  parallelUploads: 1,
  clickable: true,
  acceptedFiles: "image/*",
  maxFilesize: 2, // MB
  dictDefaultMessage: "Arraste uma imagem até aqui para alterar",
  dictFileTooBig: "O arquivo enviado é muito grande. Limite: {{maxFilesize}} Mb",
  dictInvalidFileType: "Formato inválido",
  init: function() {
    this.on("addedfile", function(file) {
      uploadCounter += 1;
    });
    this.on("success", function(file) {
      uploadCounter -= 1;
    });
    this.on("queuecomplete", function(file) {
      setTimeout(reloadPage(), 2000);
      // reloadPage();
    });
  }
};
</script>
