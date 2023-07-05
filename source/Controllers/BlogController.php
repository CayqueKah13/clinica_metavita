<?php

namespace Source\Controllers;

use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Core\Helper;

class BlogController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";





  // List Customers
  static function getList($currentPage, $search, $status) {
    // conditions
    $where = "WHERE a.title LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND a.status = '".$status."' ";
    }
    // sorting
    $where .= 'ORDER BY a.id DESC';

    // pagination link prefix
    $paginationPrefix = "blog?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = BlogController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'b.title as category', 'a.title', 'a.status'], 'blog a LEFT JOIN blog_categories b ON b.id = a.id_category', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getListPreview($itemsPerPage = 4) {
    $search = "";
    $status = 1;
    $currentPage = 1;
    // conditions
    $where = "WHERE a.title LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND a.status = '".$status."' ";
    }
    // sorting
    $where .= 'ORDER BY a.id DESC';

    // pagination link prefix
    $paginationPrefix = "blog?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = 4;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'b.id as id_category','b.title as category', 'a.slug', 'a.title', 'a.subtitle', 'a.img'], 'blog a LEFT JOIN blog_categories b ON b.id = a.id_category', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info['items'];
  }




  // List Status
  static function getStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM blog_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getCategoriesList() {
    $database = new Database();
    $query = "SELECT id, title FROM blog_categories ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }






  // Toggle Status
  static function toggleStatus($itemID) {
    $database = new Database();
    $query = "SELECT status FROM blog WHERE id='".$itemID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) > 0) {
      $item = $items[0];
      $status = $item['status'];
      if ($status == 1) {
        $status = 2;
      } else {
        $status = 1;
      }
      $query = "UPDATE blog SET status='".$status."' WHERE id='".$itemID."' LIMIT 1;";
      $database->query($query);
      return $status;
    }
    return null;
  }





  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT id, id_category, title, slug, subtitle, img, body, cta_title, cta_link, pdf_link, video_link, status FROM blog WHERE id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'id_category' => $item['id_category'],
      'title' => $item['title'],
      'slug' => $item['slug'],
      'subtitle' => $item['subtitle'],
      'img' => $item['img'],
      'body' => $item['body'],
      'cta_title' => $item['cta_title'],
      'cta_link' => $item['cta_link'],
      'pdf_link' => $item['pdf_link'],
      'video_link' => $item['video_link'],
      'status' => $item['status']
    );
    return $info;
  }

  static function getItemIDFromSlug($slug) {
    $database = new Database();
    $query = "SELECT id FROM blog WHERE slug LIKE '".$slug."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    return $item['id'];
  }






  // Details
  function editDetails($id, $categoryID, $title, $subtitle, $body, $ctaTitle, $ctaLink, $videoLink, $status) {
    $database = new Database();

    $slug = Helper::slugFrom($title);
    $query = "SELECT id FROM blog WHERE slug LIKE '".$slug."' AND id != '".$id."';";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe um post com este título!";
      return false;
    }

    $query = "UPDATE blog SET id_category='".$categoryID."', slug='".$slug."', title='".$title."', subtitle='".$subtitle."', body='".$body."',
    cta_title='".$ctaTitle."', cta_link='".$ctaLink."', video_link='".$videoLink."', status='".$status."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }




  // Create
  function createNew($title) {
    $database = new Database();

    $slug = Helper::slugFrom($title);
    $query = "SELECT id FROM blog WHERE slug LIKE '".$slug."' ;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe um post com este título!";
      return null;
    }

    $status = 2;// Inativo
    $categoryID = 1;// Gratuito
    $now = Dates::now();
    $query = "INSERT INTO blog (`id_category`, `slug`, `title`, `status`, `created_at`) VALUES ('".$categoryID."', '".$slug."', '".$title."', '".$status."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $this->message = "Conteúdo criado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($itemID) {
    $database = new Database();
    $query = "DELETE FROM blog WHERE id='".$itemID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Conteúdo excluído com sucesso!";
    return true;
  }



  // UPLOAD PDF
  function uploadPDF($file, $target, $slug) {
  	// If file received is empty, returl NULL
  	$fileName = $file["name"];
  	if (empty($fileName)) {
  		return NULL;
  	}

  	// Target Folder
  	$folder = explode('/', $target);
  	$folder = end($folder);

  	// Get file extension
  	$extension = explode('.', $fileName);
  	$extension = end($extension);

  	// File name is (Number of files inside folder) + 1
  	$counter = (count(scandir($target)) - 1);;
  	$uploadedFileName = "";



  	// Handle Upload according to image extension
  	if ($extension == 'pdf') {
  		// If it is JPG, JPEG or PNG save as it is
  		// $uploadedFileName = $counter.".".$extension; // name based on counter
  		$uploadedFileName = $slug.".".$extension; // name based on slug

  		// Move file to target
  		$target = $target."/".$uploadedFileName;
  		$success = move_uploaded_file($file["tmp_name"], $target);
  		if (!$success) {
  			return NULL;
  		}

  	} else {
  		// Return NULL if it is not a JPG, JPEG or GIF file
  		return NULL;
  	}
  	// Return Folder + File Name to be saved on DataBase
  	return $folder."/".$uploadedFileName;
  }


  // Details
  function editCTA($id, $ctaTitle, $ctaLink) {
    $database = new Database();
    $query = "UPDATE blog SET cta_title='".$ctaTitle."', cta_link='".$ctaLink."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }






}
