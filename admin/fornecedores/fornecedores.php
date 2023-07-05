<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Controllers\SuppliersController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$page = Helper::safeInt($_GET['page']);
$search = Helper::safeString($_GET['search']);
$info = SuppliersController::getList($page, $search);
// var_dump($info);
// exit;

// Show Header
$currentTab = "suppliers";
$breadcrumbs = array('Fornecedores');
require_once('../header.php');

?>


<!-- Modal Form -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Cadastrar Fornecedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_register">
          <div class="md-form">
            <input type="text" id="input-name" class="form-control" name="name" required>
            <label for="input-name">Nome</label>
          </div>
          <button class="btn btn-dark-green btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Form -->







<!-- First row -->
<div class="row my-5 pb-3">

  <!-- First column -->
  <div class="col-lg-3 mx-auto mb-4">
    <div class="card-body pt-0">
      <button type="button" class="btn btn-dark-green btn-lg btn-block px-0" data-toggle="modal" data-target="#modal-register"><i class="fas fa-plus left"></i> Cadastrar</button>
      <div class="mt-5">
        <small>Filtrar Resultados:</small>
        <form action="fornecedores" method="get" class="md-form">
          <input type="hidden" name="page" value="1">
          <input class="form-control" type="text" placeholder="Buscar..." aria-label="Buscar" name="search" value="<?= $search ?>">
          <button type="submit" class="btn btn-primary btn-block btn-sm px-0">Filtrar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- First column -->

  <!-- Second column -->
  <div class="col-lg-8 mx-auto white z-depth-1">
    <h4 class="h4-responsive mt-4 mb-3"><?= $info['countTitle'] ?></h4>
    <div class="row">
      <div class="col-md-12 pb-3">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:32px;"></th>
                <th>Nome</th>
                <th style="width:100px;">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($info['items'] as $key => $value): ?>
                <tr>
                  <td class="pr-0"><?= AdminTheme::avatarThumb($value['img'], $value['name']) ?></td>
                  <td class="line-height-32"><?= $value['name'] ?></td>
                  <td>
                    <a href="editar?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= AdminTheme::pagination($info); ?>
      </div>
    </div>
  </div>
  <!-- Second column -->

</div>
<!-- First row -->


<?php
require_once('../footer.php');
?>
