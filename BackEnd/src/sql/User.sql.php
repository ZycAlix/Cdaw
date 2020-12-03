<?php

User::addSqlQuery('USER_LIST',
    'SELECT USER_LOGIN,ID_UTILISATEUR,USER_ROLE,ADRESS_IP FROM  Utilisateur ORDER BY USER_LOGIN');

User::addSqlQuery('USER_BY_ID',
    'SELECT * FROM Utilisateur WHERE ID_UTILISATEUR = :id');

User::addSqlQuery('UPDATE_BY_LOGIN',
    'UPDATE Utilisateur SET USER_LOGIN = :user_login,
    USER_PASSWORD = :user_password,
    USER_FIRSTNAME = :user_firstname,
    USER_LASTNAME = :user_lastname,
    USER_ROLE = :user_role,
    NOMBRE_PARTIE_JOUE = :nombre_partie_joue,
    NOMBRE_PARTIE_GAGNE = :nombre_parite_gagne,
    STATUT = :statut,
    ADRESS_IP = :adress_ip
    WHERE USER_LOGIN = :user_login');

User::addSqlQuery('ADD_USER',
    'INSERT INTO Utilisateur SET USER_LOGIN = :user_login,
    USER_PASSWORD = :user_password,
    USER_FIRSTNAME = :user_firstname,
    USER_LASTNAME = :user_lastname,
    USER_ROLE = :user_role,
    NOMBRE_PARTIE_JOUE = :nombre_partie_joue,
    NOMBRE_PARTIE_GAGNE = :nombre_parite_gagne,
    STATUT = :statut,
    ADRESS_IP = :adress_ip');

User::addSqlQuery('DELETE_USER',
    'DELETE FROM Utilisateur WHERE ID_UTILISATEUR = :id');


User::addSqlQuery('USER_BY_LOGIN',
    'SELECT * FROM Utilisateur WHERE user_login = :login');


User::addSqlQuery('USER_REGISTER',
    'INSERT INTO Utilisateur SET USER_LOGIN = :user_login,
    USER_PASSWORD = :user_password,
    USER_FIRSTNAME = :user_firstname,
    USER_LASTNAME = :user_lastname,
    USER_ROLE = :user_role,
    ADRESS_IP = :adress_ip');
