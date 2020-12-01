/*==============================================================*/
/* Nom de SGBD :  SAP SQL Anywhere 17                           */
/* Date de cr¨¦ation :  2020/11/25 11:07:10                      */
/*==============================================================*/


drop table if exists Action;

drop table if exists Joueur;

drop table if exists Partie;

drop table if exists Tuile;

drop table if exists TuileDeLaPartie;

drop table if exists Utilisateur;

/*==============================================================*/
/* Table : Action                                               */
/*==============================================================*/
create table Action
(
   ID_JOUEUR            integer                        not null AUTO_INCREMENT,
   ID_TUILE_PARITE      integer                        not null,
   TYPE                 varchar(100)                   not null,
   constraint PK_ACTION primary key clustered (ID_JOUEUR, ID_TUILE_PARITE)
);

/*==============================================================*/
/* Table : Joueur                                               */
/*==============================================================*/
create table Joueur 
(
   ID_JOUEUR            integer                        not null AUTO_INCREMENT,
   ID_PARTIE            integer                        not null,
   ID_UTILISATEUR       integer                        not null,
   VENT                 char(10)                       not null,
   POINT                integer                        not null,
   STATUT               varchar(100)                   null,
   constraint PK_JOUEUR primary key clustered (ID_JOUEUR)
);

/*==============================================================*/
/* Table : Partie                                               */
/*==============================================================*/
create table Partie 
(
   ID_PARTIE            integer                        not null AUTO_INCREMENT,
   ID_UTILISATEUR       integer                        not null,
   EST_PRIVE            smallint                       not null,
   CODE                 integer                        not null,
   VENT_DOMINANT        char(10)                       not null,
   constraint PK_PARTIE primary key clustered (ID_PARTIE)
);

/*==============================================================*/
/* Table : Tuile                                                */
/*==============================================================*/
create table Tuile 
(
   ID_TUILE             integer                        not null AUTO_INCREMENT,
   NOM                  varchar(10)                    not null,
   constraint PK_TUILE primary key clustered (ID_TUILE)
);

/*==============================================================*/
/* Table : TuileDeLaPartie                                      */
/*==============================================================*/
create table TuileDeLaPartie 
(
   ID_TUILE_PARITE      integer                        not null AUTO_INCREMENT,
   ID_PARTIE            integer                        not null,
   ID_TUILE             integer                        not null,
   NOM                  varchar(10)                    not null,
   EST_DORA             smallint                       not null,
   STATUT               varchar(100)                   null,
   constraint PK_TUILEDELAPARTIE primary key clustered (ID_TUILE_PARITE)
);

/*==============================================================*/
/* Table : Utilisateur                                          */
/*==============================================================*/
create table Utilisateur 
(
   ID_UTILISATEUR             integer                        not null AUTO_INCREMENT,
   USER_LOGIN                 varchar(100)                   not null,
   USER_PASSWORD              varchar(100)                   not null,
   USER_FIRSTNAME             varchar(100)                   null,
   USER_LASTNAME              varchar(100)                   null,
   USER_ROLE                  smallint                       not null,
   NOMBRE_PARTIE_JOUE         integer                        null,
   NOMBRE_PARTIE_GAGNE        integer                        null,
   STATUT                     varchar(100)                   null,
   ADRESS_IP                  varchar(100)                   not null,
   constraint PK_UTILISATEUR primary key clustered (ID_UTILISATEUR)
);

alter table Action
   add constraint FK_ACTION_ACTION_JOUEUR foreign key (ID_JOUEUR)
      references Joueur (ID_JOUEUR)
      on update restrict
      on delete restrict;

alter table Action
   add constraint FK_ACTION_ACTION2_TUILEDEL foreign key (ID_TUILE_PARITE)
      references TuileDeLaPartie (ID_TUILE_PARITE)
      on update restrict
      on delete restrict;

alter table Joueur
   add constraint FK_JOUEUR_REJOINDRE_PARTIE foreign key (ID_PARTIE)
      references Partie (ID_PARTIE)
      on update restrict
      on delete restrict;

alter table Joueur
   add constraint FK_JOUEUR_JOUER_UTILISAT foreign key (ID_UTILISATEUR)
      references Utilisateur (ID_UTILISATEUR)
      on update restrict
      on delete restrict;

alter table Partie
   add constraint FK_PARTIE_CR¨¦ER_UTILISAT foreign key (ID_UTILISATEUR)
      references Utilisateur (ID_UTILISATEUR)
      on update restrict
      on delete restrict;

alter table TuileDeLaPartie
   add constraint FK_TUILEDEL_G¨¦N¨¦RER_PARTIE foreign key (ID_PARTIE)
      references Partie (ID_PARTIE)
      on update restrict
      on delete restrict;

alter table TuileDeLaPartie
   add constraint FK_TUILEDEL_R¨¦F¨¦RENCE_TUILE foreign key (ID_TUILE)
      references Tuile (ID_TUILE)
      on update restrict
      on delete restrict;

