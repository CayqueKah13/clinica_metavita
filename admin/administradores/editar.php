<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Controllers\AdminController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = AdminController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Admin não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/administradores/administradores");
  exit;
}

if ($id == 1) {
  Session::setErrorMessage("Não é possível editar o administrador #1");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/administradores/administradores");
  exit;
}

$statusList = AdminController::getStatusList();
$permissionsList = AdminController::getPermissionsList($id);


// Show Header
$currentTab = "admins";
$breadcrumbs = array('Administradores');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Administrador #<?= $id ?></h4>

<!-- First row -->
<div class="row">

  <div class="col-lg-8 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Informações Principais</h5>
        <form class="text-center" method="post" action="_edit">
          <input type="hidden" name="id" value="<?= $item['id'] ?>">
          <div class="md-form" style="margin-bottom:0px;">
            <input type="text" id="input-name" class="form-control" name="name" value="<?= $item['name'] ?>" required>
            <label for="input-name">Nome</label>
          </div>

          <div class="md-form"  style="margin-bottom:0px;">
            <input type="email" id="input-email" class="form-control" name="email" value="<?= $item['email'] ?>" required>
            <label for="input-email">Email</label>
          </div>

          <select class="mdb-select md-form" name="status" required>
            <option disabled selected>Status</option>
            <?php foreach ($statusList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <div class="row justify-content-center mb-4">
            <button class="btn btn-primary btn-rounded z-depth-0 waves-effect" type="submit">Atualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="col-lg-4 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Permissões</h5>
        <div class="table-responsive text-nowrap mt-4">
          <table class="table">
            <tbody>
              <?php foreach ($permissionsList as $key => $value): ?>
                <tr>
                  <td><?= $value['title'] ?></td>
                  <td style="width:50px;">
                    <div class="switch primary-switch">
                      <label>
                        <input type="checkbox" class="toggle-permission" type="checkbox" data-toggle="toggle" value="<?= $value['id'] ?>" <?php if ($value['active'] == 1) { echo "checked"; } ?>>
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



</div>
<!-- First row -->











<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Administrador? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Administrador') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Administrador</a>
</div>




<?php
require_once('../footer.php');
?>


<script type="text/javascript">
$('.toggle-permission').change(function() {
  var values = {'admin':<?= $id ?>, 'id':this.value};
  $.ajax({
    url: "_toggle_permission.php",
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
