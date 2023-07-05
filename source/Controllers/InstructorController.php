<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Database;
use \Source\Core\Auth;
use \Source\Core\Dates;
use \Source\Support\Mailer;

class InstructorController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";


  // Instructor Recover Password
  function revoverPassword($email) {
    $database = new Database();
    $query = "SELECT id, name FROM instructors WHERE email='". $email ."' LIMIT 1";
    $items = $database->select($query);

    if (count($items) > 0) {
      $instructor = $items[0];
      $id = $instructor["id"];
      $name = $instructor["name"];

      $token = Auth::createSecurityToken(Auth::STR_INSTRUCTOR_NEW_PASSWORD, $id);

      // Send e-mail to recover
      $txt = 'Olá, '.$name.'!!<br /><br />Clique, <a href="'.Config::BASE_URL_INSTRUCTOR.'/login/nova-senha?t='.$token.'">aqui</a> e crie uma <b>nova senha</b> para acessar a Área do Profissional<br /><br />Por motivos de segurança, este Link é válido por apenas 24h';
      Mailer::addEmailToQueue($email, 'Esqueceu sua senha?', $txt);

      $this->message = "Pronto! Acesse o e-mail para recuperar sua senha.";
      return true;

    } else {
      $this->message = "E-mail não encontrado! Tente novamente mais tarde.";
      return false;
    }
  }




  // Instructor Change Password
  function createNewPasswordAndSignIn($id, $password1, $password2, $token) {
    if ($password1 != $password2) {
      $this->message = "Atenção! Você deve preencher os dois campos com a mesma senha";
      return false;
    }

    if (strlen($password1) < 6) {
      $this->message = "Atenção! Sua senha deve conter pelo menos 6 caracteres";
      return false;
    }

    $database = new Database();
    $securePassword = Auth::password_encryption($password1);
    $query = "UPDATE instructors SET password='".$securePassword."' WHERE id=".$id." LIMIT 1;";
    $database->query($query);

    // Save used time of token
    Auth::setSecurityTokenUsed($token, Auth::STR_INSTRUCTOR_NEW_PASSWORD);

    // Update Session data
    $query = "SELECT email, password FROM instructors WHERE id=".$id." LIMIT 1";
    $items = $database->select($query);
    $email = $items[0]['email'];
    $auth = new Auth();
    $auth->instructorSignIn($email, $password1);

    $this->message = "Pronto! Senha criada com sucesso! Guarde bem sua senha e não compartilhe com niguém.";
    return true;
  }









  // List Instructors
  static function getList($currentPage, $search, $status) {
    // conditions
    $where = "WHERE name LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND status = '".$status."' ";
    }
    // sorting
    $where .= 'ORDER BY id DESC';

    // pagination link prefix
    $paginationPrefix = "profissionais?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = InstructorController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['id', 'name', 'email', 'img', 'status'], 'instructors', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getSearchList() {
    $database = new Database();
    $query = "SELECT id, name, email, cpf FROM instructors WHERE status=1 ORDER BY name;";
    $items = $database->select($query);
    $info = array();
    foreach ($items as $key => $value) {
      $cpf = Helper::safeString($value['cpf']);
      if ($cpf == '') {
        $cpf = 'CPF não cadastrado';
      }
      $title = $value['name'] . ' (' . $cpf . ')';
      $item = array(
        'id' => $value['id'],
        'title' => $title
      );
      array_push($info, $item);
    }
    return $info;
  }



  // List Status
  static function getStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM instructors_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getPronounList() {
    $items = [
      'Sr.',
      'Sra.',
      'Dra.',
      'Dr.',
    ];
    return $items;
  }




  // Toggle Status
  static function toggleStatus($instructorID) {
    $database = new Database();
    $query = "SELECT status FROM instructors WHERE id='".$instructorID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) > 0) {
      $item = $items[0];
      $status = $item['status'];
      if ($status == 1) {
        $status = 2;
      } else {
        $status = 1;
      }
      $query = "UPDATE instructors SET status='".$status."' WHERE id='".$instructorID."' LIMIT 1;";
      $database->query($query);
      return $status;
    }
    return null;
  }





  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT id, name, email, img, phone, pronoun, cpf, doc_number, born_at, is_editor, status FROM instructors WHERE id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];

    $query = "SELECT c.id, c.title, x.price FROM instructors_x_categories x
    LEFT JOIN schedule_events_categories c ON c.id = x.id_category
    WHERE x.id_instructor = '".$id."'
    ORDER BY c.title;";
    $categories = $database->select($query);

    $query = "SELECT id, title FROM schedule_events_categories WHERE id NOT IN (SELECT id_category FROM instructors_x_categories WHERE id_instructor='".$id."') ORDER BY title;";
    $availableCategories = $database->select($query);


    $info = array(
      'id' => $item['id'],
      'name' => $item['name'],
      'email' => $item['email'],
      'img' => $item['img'],
      'phone' => $item['phone'],
      'pronoun' => $item['pronoun'],
      'cpf' => $item['cpf'],
      'doc_number' => $item['doc_number'],
      'born_at' => $item['born_at'],
      'status' => $item['status'],
      'is_editor' => $item['is_editor'],
      'categories' => $categories,
      'available_categories' => $availableCategories
    );
    return $info;
  }

  static function getInstructorID($email) {
    $database = new Database();
    $query = "SELECT id FROM instructors WHERE email='".$email."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    return $item['id'];
  }


  // List Categories
  static function getCategoriesList($instructorID) {
    $database = new Database();
    $query = "SELECT a.id, a.title, IF(b.created_at IS NULL, 0, 1) AS active FROM instructors_categories a
    LEFT JOIN instructors_x_categories b ON b.id_category = a.id AND id_instructor = '".$instructorID."'
    ORDER BY a.title;";
    $items = $database->select($query);
    return $items;
  }




  // Details
  static function editDetails($id, $name, $email, $phone, $pronoun, $cpf, $docNumber, $bornAt, $status, $isEditor) {
    $database = new Database();
    $query = "UPDATE instructors SET name='".$name."', email='".$email."', phone='".$phone."', pronoun='".$pronoun."', cpf='".$cpf."', doc_number='".$docNumber."', born_at='".$bornAt."', status='".$status."', is_editor='".$isEditor."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }



  // Toggle Categories
  static function toggleCategory($instructorID, $categoryID) {
    $database = new Database();
    $query = "SELECT id_instructor FROM instructors_x_categories WHERE id_instructor='".$instructorID."' AND id_category='".$categoryID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) == 0) {
      $now = Dates::now();
      $query = "INSERT INTO instructors_x_categories (id_instructor, id_category, created_at) VALUES ('".$instructorID."', '".$categoryID."', '".$now."');";
      $database->query($query);
      return true;
    } else {
      $query = "DELETE FROM instructors_x_categories WHERE id_instructor='".$instructorID."' AND id_category='".$categoryID."' LIMIT 1;";
      $database->query($query);
      return false;
    }
  }




  // Create
  function createNew($name, $email, $pronoun) {
    $database = new Database();

    $query = "SELECT id FROM instructors WHERE email LIKE '".$email."' ;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe um Profissional com este email!";
      return null;
    }

    $status = 1;// ativo
    $now = Dates::now();
    $password = '$2y$13$YzdjMDNlZjEzMTRkY2JiYOohyq1xnFzxzsK5zZ89NmrNGe.qKtlgi'; // @Metavita2020
    $query = "INSERT INTO instructors (`name`, `email`, `password`, `pronoun`, `status`, `created_at`) VALUES ('".$name."', '".$email."', '".$password."', '".$pronoun."', '".$status."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $token = Auth::createSecurityToken(Auth::STR_INSTRUCTOR_NEW_PASSWORD, $newID);
    // Send e-mail
    $txt = 'Olá, '.$name.'!!<br /><br />Clique, <a href="'.Config::BASE_URL_INSTRUCTOR.'/login/nova-senha?t='.$token.'">aqui</a> e crie uma <b>nova senha</b> para acessar a Área do Profissional<br /><br />Por motivos de segurança, este Link é válido por apenas 24h';
    Mailer::addEmailToQueue($email, 'Bem vindo à Área do Profissional!', $txt);
    $this->message = "Pronto! Acesse o e-mail cadastrado para criar uma nova senha.";

    $this->message = "Profissional criado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($instructorID) {
    $database = new Database();
    $query = "DELETE FROM instructors WHERE id='".$instructorID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Profissional excluído com sucesso!";
    return true;
  }



  static function addCategory($id, $category, $price) {
    $database = new Database();

    $price = Helper::brlMoneyToDecimal($price);

    $now = Dates::now();
    $query = "INSERT INTO instructors_x_categories (`id_instructor`, `id_category`, `price`, `created_at`) VALUES ('".$id."', '".$category."', '".$price."', '".$now."');";
    $database->query($query);

    return true;
  }



  static function removeCategory($id, $category) {
    $database = new Database();

    $now = Dates::now();
    $query = "DELETE FROM instructors_x_categories WHERE id_instructor='".$id."' AND id_category='".$category."' LIMIT 1;";
    $database->query($query);

    return true;
  }



  static function priceForScheduleCategory($instructorID, $categoryID) {
    $database = new Database();

    $query = "SELECT c.id, c.title, x.price FROM instructors_x_categories x
    LEFT JOIN schedule_events_categories c ON c.id = x.id_category
    WHERE x.id_instructor = '".$instructorID."' AND x.id_category = '".$categoryID."'
    ORDER BY c.title;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $item = $results[0];
      return $item['price'];
    } else {
      return 0;
    }
  }


}
