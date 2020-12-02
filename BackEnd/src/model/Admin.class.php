<?php

class Admin extends Model {

   // ===========
   // = Statics =
   // ===========
   protected static $table_name = 'Utilisateur';

   public static function tryFindAdminByLogin($login){
        $values = array(':user_login'=>$login);
        $stm = parent::exec('ADMIN_BY_LOGIN',$values);
        $res =  $stm->fetchAll();
        if(!empty($res))
            return $res[0];
        return $res;
   }
   public static function tryFindAdminByIp($adressIp){
        $values = array(':adress_ip'=>$adressIp);
        $stm = parent::exec('ADMIN_BY_IP',$values);
        $res =  $stm->fetchAll();
        if(!empty($res))
            return $res[0];
        return $res;
    }

   public static function tryBlockUserByLogin($json){
        $values = array(
            ':user_login'=>$json->USER_LOGIN,
        );
        $stm = parent::exec('BLOCK_BY_LOGIN',$values);
   }

   public static function tryBlockUserByIp($json){
        $values = array(
            ':adress_ip'=>$json->ADRESS_IP,
        );
        $stm = parent::exec('BLOCK_BY_IP',$values);
    }

    public static function tryPromUser($json){
        $values = array(
            ':user_login'=>$json->USER_LOGIN,
        );
        $stm = parent::exec('PROMOTE_BY_LOGIN',$values);
    }

    public static function tryDeleteAdmin($json){
        $values = array(
            ':user_login'=>$json->USER_LOGIN,
        );
        $stm = parent::exec('DELETE_ADMIN_BY_LOGIN',$values);
    }
}


