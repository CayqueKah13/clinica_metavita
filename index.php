<?php
require_once __DIR__ . '/source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Controllers\BlogController;


$urlComponentsString = mb_strtolower(Helper::safeString($_GET['route']));
$urlComponents = explode("/", $urlComponentsString);
array_shift($urlComponents);

// Default paths
$sitePath = "pages/";

// homepage
if (empty($urlComponents)) {
  // require_once($sitePath.'home.php');
  require_once($sitePath.'home2.php');
  exit;
}




// SITE
if (count($urlComponents) == 1) {
  switch ($urlComponents[0]) {
    // Redirect index to home
    case 'index':
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /");
    exit;

    case 'adm':
    Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
    exit;

    case 'sobre':
    require_once($sitePath.'sobre.php');
    exit;

    // case 'servicos':
    // require_once($sitePath.'servicos.php');
    // exit;

    case 'galeria':
    require_once($sitePath.'galeria.php');
    exit;

    case 'enviar-mensagem':
    require_once($sitePath.'_enviar_mensagem.php');
    exit;

    case 'mensagem-enviada':
    require_once($sitePath.'mensagem-enviada.php');
    exit;


    case 'corredores':
    require_once($sitePath.'landing-corredores.php');
    exit;
    
    case 'lutas':
    require_once($sitePath.'landing-jiujitsu.php');
    exit;

    // case 'jiujitsu':
    // require_once($sitePath.'landing-jiujitsu.php');
    // exit;

    case 'perda-de-gordura-e-hipertrofia':
    require_once($sitePath.'landing-perda-de-gordura-e-hipertrofia.php');
    exit;

    // case 'qualidade-de-vida':
    // require_once($sitePath.'landing-qualidade-de-vida.php');
    // exit;
    
    case 'vegetarianismo':
    require_once($sitePath.'landing-vegetarianismo.php');
    exit;

    // case 'corrida-de-rua':
    // require_once($sitePath.'landing-corrida-de-rua.php');
    // exit;

    case 'esportes':
    require_once($sitePath.'landing-corrida-de-rua.php');
    exit;

    case 'servicos':
    require_once($sitePath.'landing-servicos.php');
    exit;


    case 'links':
    require_once($sitePath.'links.php');
    exit;

    default: break;
  }
} elseif (count($urlComponents) == 2) {
  switch ($urlComponents[0]) {
    // case 'pagamento':
    // $token = safeString($urlComponents[1]);
    // require_once('payments/Pagarme/page.php');
    // exit;

    // case 'album':
    // $albumSlug = safeString($urlComponents[1]);
    // $album = fetchAlbum($albumSlug);
    // if ($album != null) {
    //   require_once($sitePath.'album.php');
    //   exit;
    // }

    // case 'baixar-album':
    // $token = safeString($urlComponents[1]);
    // $album = fetchAlbum('', $token);
    // if ($album != null) {
    //   require_once($sitePath.'download-album.php');
    //   exit;
    // }

    // case 'conteudo':
    // // $blogSlug = Helper::safeString($urlComponents[1]);
    // $blogID = Helper::safeInt($urlComponents[1]);
    // if ($blogID > 0) {
    //   require_once($sitePath.'galeria-post.php');
    //   exit;
    // }
    case 'conteudo':
    $slug = Helper::safeString($urlComponents[1]);
    $blogID = Helper::safeInt(BlogController::getItemIDFromSlug($slug));
    if ($blogID > 0) {
      require_once($sitePath.'galeria-post.php');
      exit;
    }

    // case 'contrato':
    // $token = safeString($urlComponents[1]);
    // require_once($sitePath.'contract.php');
    // exit;

    default: break;
  }

} elseif (count($urlComponents) == 3) {
  switch ($urlComponents[0]) {
    case 'blog':
    echo "Galeria";
    exit;
    // case 'blog':
    // if ($urlComponents[1] == 'pagina') {
    //   $blogPage = safeInt($urlComponents[2]);
    //   require_once($sitePath.'blog.php');
    //   exit;
    // }

    default: break;
  }
}


// Page not Found
require_once('404.php');
exit;

?>
