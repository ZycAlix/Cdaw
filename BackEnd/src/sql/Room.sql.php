<?php


Room::addSqlQuery('CREATE_ROOM',
    'INSERT INTO Partie SET ID_UTILISATEUR = :id_utilisateur,
    EST_PRIVE = :est_prive,
    CODE = :code,
    VENT_DOMINANT = :vent_dominant');
