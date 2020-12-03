<?php

class Room extends Model {

   // ===========
   // = Statics =
   // ===========
    protected static $table_name = 'Partie';

    public static function addRoom($json){
        $values = array(
            ':id_utilisateur'=>$json->ID_UTILISATEUR,
            ':est_prive' =>"0",
            ':code'=>$json->CODE,
            ':vent_dominant'=>"Dong"
        );
        $stm = parent::exec('CREATE_ROOM',$values);
        //return $this->ID_PARTIE;
    }
}


