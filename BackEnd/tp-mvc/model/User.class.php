<?php

class User extends Model {

   // ===========
   // = Statics =
   // ===========
   protected static $table_name = 'Utilisateur';

   // load all Utilisateur from Db
   public static function getList() {
      $stm = parent::exec('USER_LIST');
      return $stm->fetchAll();
   }

   public static function getUserById($id){

      $values = array(':id'=>$id);
      $stm = parent::exec('USER_BY_ID',$values);
      return $stm->fetchAll();
   }

   public static function updateUserInfoById($id,$json){

      $values = array(
         ':user_login' => $json->USER_LOGIN,
         ':user_password' => password_hash($json->USER_PASSWORD, PASSWORD_BCRYPT),
         ':user_firstname' => $json->USER_FIRSTNAME,
         ':user_lastname' => $json->USER_LASTNAME,
         ':user_role' => $json->USER_ROLE,
         ':nombre_partie_joue' => $json->NOMBRE_PARTIE_JOUE,
         ':nombre_parite_gagne' => $json->NOMBRE_PARTIE_GAGNE,
         ':statut' => $json->STATUT,
         ':adress_ip' => $json->ADRESS_IP,
         ':user_id' => $id,
      );
      $stm = parent::exec('UPDATE_BY_ID',$values);
   
   }

   public static function addUser($json){
      $values = array(
         ':user_login' => $json->USER_LOGIN,
         ':user_password' => password_hash($json->USER_PASSWORD, PASSWORD_BCRYPT),
         ':user_firstname' => $json->USER_FIRSTNAME,
         ':user_lastname' => $json->USER_LASTNAME,
         ':user_role' => $json->USER_ROLE,
         ':nombre_partie_joue' => $json->NOMBRE_PARTIE_JOUE,
         ':nombre_parite_gagne' => $json->NOMBRE_PARTIE_GAGNE,
         ':statut' => $json->STATUT,
         ':adress_ip' => $json->ADRESS_IP,
      );
      $stm = parent::exec('ADD_USER',$values);
   }

   public static function deleteUser($id){
      $values = array(':id'=>$id);
      $stm = parent::exec('DELETE_USER',$values);
   }

   public static function tryLogin($login){
      $values = array(':login'=>$login);
      $stm = parent::exec('USER_BY_LOGIN',$values);
      $res =  $stm->fetchAll();
      if(!empty($res)){
         return $res[0];
      } 
      return $res;
   }

   public static function tryRegister($json){
      $values = array(
         ':user_login' => $json->USER_LOGIN,
         ':user_password' => password_hash($json->USER_PASSWORD, PASSWORD_BCRYPT),
         ':user_firstname' => $json->USER_FIRSTNAME,
         ':user_lastname' => $json->USER_LASTNAME,
         ':user_role' => $json->USER_ROLE,
      );
      $stm = parent::exec('USER_REGISTER',$values);
      
   }
   public function id(){
      return $this->ID_UTILISATEUR;
   }

   public function password(){
      return $this->USER_PASSWORD;
   }

   public function email(){
      return $this->USER_EMAIL;
   }
}


