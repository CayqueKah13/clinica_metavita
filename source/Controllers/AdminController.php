<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Database;
use \Source\Core\Auth;
use \Source\Core\Dates;
use \Source\Support\Mailer;

class AdminController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";


  // Admin Recover Password
  function revoverPassword($email) {
    $database = new Database();
    $query = "SELECT id, name FROM admins WHERE email='". $email ."' LIMIT 1";
    $items = $database->select($query);

    if (count($items) > 0) {
      $admin = $items[0];
      $id = $admin["id"];
      $name = $admin["name"];

      $token = Auth::createSecurityToken(Auth::STR_ADMIN_NEW_PASSWORD, $id);

      // Send e-mail to recover
      $txt = 'Olá, '.$name.'!!<br /><br />Clique, <a href="'.Config::BASE_URL_ADMIN.'/login/nova-senha?t='.$token.'">aqui</a> e crie uma <b>nova senha</b> para acessar o Painel de Controle<br /><br />Por motivos de segurança, este Link é válido por apenas 24h';
      Mailer::addEmailToQueue($email, 'Esqueceu sua senha?', $txt);

      $this->message = "Pronto! Acesse o e-mail para recuperar sua senha.";
      return true;

    } else {
      $this->message = "E-mail não encontrado! Tente novamente mais tarde.";
      return false;
    }
  }




  // Admin Change Password
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
    $query = "UPDATE admins SET password='".$securePassword."' WHERE id=".$id." LIMIT 1;";
    $database->query($query);

    // Save used time of token
    Auth::setSecurityTokenUsed($token, Auth::STR_ADMIN_NEW_PASSWORD);

    // Update Session data
    $query = "SELECT email, password FROM admins WHERE id=".$id." LIMIT 1";
    $items = $database->select($query);
    $email = $items[0]['email'];
    $auth = new Auth();
    $auth->adminSignIn($email, $password1);

    $this->message = "Pronto! Senha criada com sucesso! Guarde bem sua senha e não compartilhe com niguém.";
    return true;

  }









  // List Admins
  static function getList($currentPage, $search, $status) {
    // conditions
    $where = "WHERE name LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND status = '".$status."' ";
    }
    // sorting
    $where .= 'ORDER BY id DESC';

    // pagination link prefix
    $paginationPrefix = "administradores?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = AdminController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['id', 'name', 'email', 'status'], 'admins', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getAllListWithPermission($permissionID) {
    $database = new Database();
    $query = "SELECT a.id, a.name, a.email FROM admins a
    INNER JOIN admins_x_permissions b ON b.id_admin = a.id
    WHERE b.id_permission = '".$permissionID."';";
    $items = $database->select($query);
    return $items;
  }



  // List Status
  static function getStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM admins_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }




  // Toggle Status
  static function toggleStatus($adminID) {
    if ($adminID == 1) {
      return false; // nunca remove permissão do primeiro admin (Roberto Oliveira)
    }
    $database = new Database();
    $query = "SELECT status FROM admins WHERE id='".$adminID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) > 0) {
      $item = $items[0];
      $status = $item['status'];
      if ($status == 1) {
        $status = 2;
      } else {
        $status = 1;
      }
      $query = "UPDATE admins SET status='".$status."' WHERE id='".$adminID."' LIMIT 1;";
      $database->query($query);
      return $status;
    }
    return null;
  }





  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT id, name, email, status FROM admins WHERE id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'name' => $item['name'],
      'email' => $item['email'],
      'status' => $item['status']
    );
    return $info;
  }

  static function getAdminID($email) {
    $database = new Database();
    $query = "SELECT id FROM admins WHERE email='".$email."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    return $item['id'];
  }


  // List Permissions
  static function getPermissionsList($adminID) {
    $database = new Database();
    $query = "SELECT a.id, a.title, IF(b.created_at IS NULL, 0, 1) AS active FROM admins_permissions a
    LEFT JOIN admins_x_permissions b ON b.id_permission = a.id AND id_admin = '".$adminID."'
    ORDER BY a.title;";
    $items = $database->select($query);
    return $items;
  }




  // Details
  static function editDetails($id, $name, $email, $status) {
    $database = new Database();
    $query = "UPDATE admins SET name='".$name."', email='".$email."', status='".$status."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }



  // Toggle Permissions
  static function togglePermission($adminID, $permissionID) {
    $database = new Database();
    $query = "SELECT id_admin FROM admins_x_permissions WHERE id_admin='".$adminID."' AND id_permission='".$permissionID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) == 0) {
      $now = Dates::now();
      $query = "INSERT INTO admins_x_permissions (id_admin, id_permission, created_at) VALUES ('".$adminID."', '".$permissionID."', '".$now."');";
      $database->query($query);
      return true;
    } else {
      if ($adminID == 1) {
        return false; // nunca remove permissão do primeiro admin (Roberto Oliveira)
      }
      $query = "DELETE FROM admins_x_permissions WHERE id_admin='".$adminID."' AND id_permission='".$permissionID."' LIMIT 1;";
      $database->query($query);
      return false;
    }
  }




  // Create
  function createNew($name, $email) {
    $database = new Database();

    $query = "SELECT id FROM admins WHERE email LIKE '".$email."' ;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe um Administrador com este email!";
      return null;
    }

    $status = 1;// ativo
    $now = Dates::now();
    $password = '$2y$13$YzdjMDNlZjEzMTRkY2JiYOohyq1xnFzxzsK5zZ89NmrNGe.qKtlgi'; // @Metavita2020
    $query = "INSERT INTO admins (`name`, `email`, `password`, `status`, `created_at`) VALUES ('".$name."', '".$email."', '".$password."', '".$status."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $token = Auth::createSecurityToken(Auth::STR_ADMIN_NEW_PASSWORD, $newID);
    // Send e-mail
    $txt = 'Olá, '.$name.'!!<br /><br />Clique, <a href="'.Config::BASE_URL_ADMIN.'/login/nova-senha?t='.$token.'">aqui</a> e crie uma <b>nova senha</b> para acessar o Painel de Controle<br /><br />Por motivos de segurança, este Link é válido por apenas 24h';
    Mailer::addEmailToQueue($email, 'Bem vindo ao Painel de Controle!', $txt);

    $this->message = "Pronto! Acesse o e-mail cadastrado para criar uma nova senha.";
    return $newID;
  }



  // Delete
  function delete($adminID) {
    if ($adminID == 1) {
      $this->message = "Não é possível remover o administrador #1!.";
      return false;
    }
    $database = new Database();
    $query = "DELETE FROM admins WHERE id='".$adminID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Administrador excluído com sucesso!";
    return true;
  }


}
