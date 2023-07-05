<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_INSTRUCTORS)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = InstructorController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Profissional não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/profissionais/profissionais");
  exit;
}
$statusList = InstructorController::getStatusList();
$pronounList = InstructorController::getPronounList();
$categoriesList = InstructorController::getCategoriesList($id);

$categories = $item['categories'];
$availableCategories = $item['available_categories'];
// var_dump($categories);
// var_dump($availableCategories);
// exit;


$link = Config::BASE_URL_ADMIN . "/profissionais/editar?id=" . $id;

// Show Header
$currentTab = "instructors";
$breadcrumbs = array('Profissionais');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Profissional #<?= $id ?></h4>

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
                <input type="hidden" name="folder" value="profissionais">
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


              <div class="row">
                <div class="col-md-6">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-doc_number" class="form-control" name="doc_number" value="<?= $item['doc_number'] ?>">
                    <label for="input-doc_number">Inscrição Profissional</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="status" required>
                    <option disabled selected>Status</option>
                    <?php foreach ($statusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <select class="mdb-select md-form" name="is_editor" required>
                    <option disabled selected>Edição de Pacientes e Agendamentos</option>
                    <option value="1" <?php if ($item['is_editor'] == 1) { echo "selected"; } ?>>Permitir Edição de Pacientes e Agendamentos</option>
                    <option value="0" <?php if ($item['is_editor'] != 1) { echo "selected"; } ?>>Não Permitir Edição de Pacientes e Agendamentos</option>
                  </select>

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



<!-- Second Row -->
<!-- <div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Categorias</h5>
        <div class="table-responsive text-nowrap mt-4">
          <table class="table">
            <tbody>
              <?php foreach ($categoriesList as $key => $value): ?>
                <tr>
                  <td><?= $value['title'] ?></td>
                  <td style="width:50px;">
                    <div class="switch primary-switch">
                      <label>
                        <input type="checkbox" class="toggle-category" type="checkbox" data-toggle="toggle" value="<?= $value['id'] ?>" <?php if ($value['active'] == 1) { echo "checked"; } ?>>
                        <span class="lever"></span>
                      </label>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- Second Row -->
























<!-- Modal Form -->
<div class="modal fade" id="modal-create-category" tabindex="-1" role="dialog" aria-labelledby="create-category" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Adicionar Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_add_category">
          <input type="hidden" name="id" value="<?= $id ?>">
          <select class="mdb-select" searchable="Buscar..." name="category" required>
            <option value="0" selected disabled>Categoria</option>
            <?php foreach ($availableCategories as $key => $category) { ?>
              <option value="<?php echo($category['id']); ?>"><?php echo($category['title']); ?></option>
            <?php } ?>
          </select>

          <div class="md-form">
            <input type="text" id="input-price" class="form-control money" name="price" required>
            <label for="input-price">Valor Padrão R$</label>
          </div>

          <button class="btn btn-dark-green btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Adicionar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Form -->





<!-- Delete Modal Each Item -->
<?php foreach ($categories as $key => $category) {
echo  AdminTheme::dangerModal('delete-category-'.$category['id'], 'Tem certeza que deseja remover esta categoria?', Config::BASE_URL_ADMIN.'/profissionais/_remove_category?id='.$id.'&category='.$category['id'], 'Remover');
} ?>
<!-- Delete Modal Each Item -->


<div class="row mb-5 mt-5">
  <div class="col-md-12">


    <div class="row justify-content-between px-4">
      <!-- <h3>Categorias</h3> -->
      <h4 class="h4-responsive mt-1">Tabela de Preços</h4>
      <?php if (count($availableCategories) > 0) { ?>
        <a onclick="$('#modal-create-category').modal('show');" class="btn btn-rounded btn-sm btn-dark-green btn-icon" data-toggle="tooltip" data-placement="top" title="Adicionar Categoria">+</a>
      <?php } ?>
    </div>

    <div class="card card-cascade narrower z-depth-1 px-4 py-4">
      <?php if (count($categories) <= 0) { ?>
        <p class="text-muted text-center my-5">Nenhum resultado encontrado</p>
      <?php } else { ?>
            <div class="table-responsive text-nowrap">
            <table class="table table-hover table-sm">
              <thead>
                <tr>
                  <th>Categoria</th>
                  <th style="width:150px;">Valor Padrão</th>
                  <th style="width:100px;">Remover</th>
                </tr>
              </thead>
              <tbody>
                <!-- Each Item -->
                <?php foreach ($categories as $key => $category) { ?>
                  <tr>
                    <td><?php echo($category['title']); ?></td>
                    <td>R$ <?php echo(number_format($category['price'], 2, ',', '.')); ?></td>
                    <td>
                      <a onclick="return $('#delete-category-<?php echo($category['id']); ?>').modal('show');" class="btn-floating btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                <?php } ?>
                <!-- Each Item -->
              </tbody>
            </table>
            </div>
      <?php } ?>
    </div>
  </div>
</div>



















<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Profissional? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Profissional') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Profissional</a>
</div>




<?php
require_once('../footer.php');
?>


<script type="text/javascript">
$('.toggle-category').change(function() {
  var values = {'item':<?= $id ?>, 'id':this.value};
  $.ajax({
    url: "_toggle_category.php",
    type: "post",
    data: values ,
    success: function (response) {
      // ok
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // failed
    }
  });
})
</script>




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
      // setTimeout(reloadPage(), 5000);
      reloadPage();
    });
  }
};
</script>
