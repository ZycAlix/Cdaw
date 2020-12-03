<?php


Admin::addSqlQuery('ADMIN_BY_LOGIN',
    'SELECT * FROM Utilisateur WHERE user_login = :user_login');

Admin::addSqlQuery('ADMIN_BY_IP',
    'SELECT * FROM Utilisateur WHERE adress_ip = :adress_ip');

Admin::addSqlQuery('BLOCK_BY_LOGIN',
    'UPDATE Utilisateur SET STATUT = "BLOCKED"
    WHERE USER_LOGIN = :user_login');

Admin::addSqlQuery('UNBLOCK_BY_LOGIN',
    'UPDATE Utilisateur SET STATUT = "UNBLOCKED"
    WHERE USER_LOGIN = :user_login');

Admin::addSqlQuery('BLOCK_BY_IP',
    'UPDATE Utilisateur SET STATUT = "BLOCKED"
    WHERE ADRESS_IP = :adress_ip');

Admin::addSqlQuery('UNBLOCK_BY_IP',
    'UPDATE Utilisateur SET STATUT = "UNBLOCKED"
    WHERE ADRESS_IP = :adress_ip');

Admin::addSqlQuery('PROMOTE_BY_LOGIN',
    'UPDATE Utilisateur SET USER_ROLE = "1"
    WHERE USER_LOGIN = :user_login');

Admin::addSqlQuery('DELETE_ADMIN_BY_LOGIN',
    'UPDATE Utilisateur SET USER_ROLE = "0"
    WHERE USER_LOGIN = :user_login');
