<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\SuppliersController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = SuppliersController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Fornecedor não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/fornecedores/fornecedores");
  exit;
}


$link = Config::BASE_URL_ADMIN . "/fornecedores/editar?id=" . $id;

// Show Header
$currentTab = "suppliers";
$breadcrumbs = array('Fornecedores');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Fornecedor #<?= $id ?></h4>

<!-- First row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Informações Principais</h5>
        <div class="row">


          <div class="col-md-12">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-name" class="form-control" name="name" value="<?= $item['name'] ?>" required>
                <label for="input-name">Nome</label>
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

              <div class="md-form"  style="margin-bottom:0px;">
                <input type="text" id="input-cnpj" class="form-control cnpj" name="cnpj" value="<?= $item['cnpj'] ?>">
                <label for="input-cnpj">CNPJ</label>
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





<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Fornecedor? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Fornecedor') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Fornecedor</a>
</div>




<?php
require_once('../footer.php');
?>
