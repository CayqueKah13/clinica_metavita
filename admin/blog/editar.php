<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\BlogController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_GALLERY)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = BlogController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Conteúdo não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/blog/blog");
  exit;
}
$statusList = BlogController::getStatusList();
$categoriesList = BlogController::getCategoriesList();



$link = Config::BASE_URL_ADMIN . "/blog/editar?id=" . $id;

// Show Header
$currentTab = "blog";
$breadcrumbs = array('Galeria');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Conteúdo #<?= $id ?></h4>
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
                <input type="hidden" name="folder" value="blog">
              </form>
            </div>
          </div>

          <div class="col-md-8">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="row">
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="category" required>
                    <option disabled selected>Tipo</option>
                    <?php foreach ($categoriesList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_category']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
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

              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-title" class="form-control" name="title" value="<?= $item['title'] ?>" required>
                <label for="input-title">Título</label>
              </div>

              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-subtitle" class="form-control" name="subtitle" value="<?= $item['subtitle'] ?>">
                <label for="input-subtitle">Subtítulo</label>
              </div>

              <div class="form-group mt-5">
                <textarea class="form-control" id="textarea" name="body" placeholder="Escreva o conteúdo aqui..." style="min-height:250px;" maxlength="5000"><?= $item['body'] ?></textarea>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-cta-title" class="form-control" name="cta-title" value="<?= $item['cta_title'] ?>">
                    <label for="input-cta-title">Título CTA</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-cta-link" class="form-control" name="cta-link" value="<?= $item['cta_link'] ?>">
                    <label for="input-cta-link">Link CTA</label>
                  </div>
                </div>
              </div>

              <div class="md-form"  style="margin-bottom:0px;">
                <input type="text" id="input-video" class="form-control" name="video-link" value="<?= $item['video_link'] ?>">
                <label for="input-video">Link do Youtube</label>
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











<h4 class="mt-5">Upload de E-book</h4>
<div class="row mb-5">
  <div class="col-md-12">
    <div class="card card-cascade narrower z-depth-1">

      <div class="card-body px-4">
        <form method="post" action="_upload_pdf" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id ?>">

          <p class="text-muted">Ao fazer o upload de um arquivo em PDF, o link do arquivo será utilizado como o link CTA. Caso o título do CTA esteja vazio, ele será atualizado automaticamente para "ABRIR PDF"</p>
          <input type="file" name="file" id="input-pdf">
          <div class="row justify-content-between my-4">
            <button class="btn btn-primary btn-rounded z-depth-0 waves-effect" type="submit">Enviar</button>
            <div></div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>












<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Conteúdo? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Conteúdo') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Conteúdo</a>
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







<!-- Text Editor -->
<!-- TEXT EDITOR -->
<script src="<?= Config::BASE_URL_ADMIN ?>/_theme/lib/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  // GENERAL SETTINGS
  selector: 'textarea',  // ID of your textarea
  language : "pt_BR",
  plugins: "image imagetools code textcolor",
  menubar: false,
  // Add | forecolor | to allow text color changes
  toolbar: 'insertfile undo redo | styleselect | bold italic | fontsizeselect | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
  branding: false,
  height : 300,
  // TEXT SETTINGS
  force_p_newlines : false,
  force_br_newlines : false,
  convert_newlines_to_brs : false,
  remove_linebreaks : false,
  forced_root_block : false,
  // IMAGES UPLOAD SETTINGS
  images_upload_url: "../_theme/lib/tinymce/uploadHandler?folder=blog/",
  automatic_uploads: false,
  // Make Sure to use absolute path, not relative one
  relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  image_dimensions: false
});
</script>
