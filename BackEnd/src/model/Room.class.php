<?php

class Room extends Model {

   // ===========
   // = Statics =
   // ===========
    protected static $table_name = 'Partie';
    private $arrayUsers;

    public static function addRoom($json){
        $values = array(
            ':id_utilisateur'=>$json->ID_UTILISATEUR,
            ':est_prive' =>$json->EST_PRIVE,
            ':code'=>$json->CODE,
            ':vent_dominant'=>$json->VENT_DOMINANT,
        );
        $stm = parent::exec('CREATE_ROOM',$values);
    }
}


