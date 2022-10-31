/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  18/10/2022 13:20:09                      */
/*==============================================================*/


drop table if exists ASSISTANT_MANAGER;

drop table if exists COMPREND;

drop table if exists CONGE;

drop table if exists DISPONIBILITE;

drop table if exists ECHANGE_TRAVAIL;

drop table if exists EMPLOYE;

drop table if exists EQUIPIER_POLYVALENT;

drop table if exists ETAT;

drop table if exists JOUR;

drop table if exists LIVRAISON;

drop table if exists MANAGER;

drop table if exists PLANNING;

drop table if exists PRODUIT;

drop table if exists RECOIT;

drop table if exists SUPERVISE;

drop table if exists UNITE;

/*==============================================================*/
/* Table : ASSISTANT_MANAGER                                    */
/*==============================================================*/
create table ASSISTANT_MANAGER
(
   ID_EMPLOYE           int not null,
   primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : COMPREND                                             */
/*==============================================================*/
create table COMPREND
(
   ID_LIVRAISON         int not null,
   ID_PRODUIT           int not null,
   QUANTITE_LIVREE      decimal,
   primary key (ID_LIVRAISON, ID_PRODUIT)
);

/*==============================================================*/
/* Table : CONGE                                                */
/*==============================================================*/
create table CONGE
(
   ID_DEMANDE           int not null auto_increment,
   ID_ETAT              int not null,
   ID_EMPLOYE           int not null,
   DEBUT_CONGE          date,
   FIN_CONGE            date,
   primary key (ID_DEMANDE)
);

/*==============================================================*/
/* Table : DISPONIBILITE                                        */
/*==============================================================*/
create table DISPONIBILITE
(
   ID_DISPO             int not null auto_increment,
   ID_ETAT              int not null,
   ID_EMPLOYE           int not null,
   DEBUT_DISPO          time,
   FIN_DISPO            time,
   primary key (ID_DISPO)
);

/*==============================================================*/
/* Table : ECHANGE_TRAVAIL                                      */
/*==============================================================*/
create table ECHANGE_TRAVAIL
(
   ID_ECHANGE           int not null auto_increment,
   ID_ETAT              int not null,
   ID_JOUR              int not null,
   ID_EMPLOYE           int not null,
   MAN_ID_EMPLOYE       int,
   DATE_PROPOSITION     date,
   primary key (ID_ECHANGE)
);

/*==============================================================*/
/* Table : EMPLOYE                                              */
/*==============================================================*/
create table EMPLOYE
(
   ID_EMPLOYE           int not null auto_increment,
   NOM                  varchar(255),
   PRENOM               varchar(255),
   ADRESSE_MAIL         varchar(255),
   DATE_EMBAUCHE        date,
   ADRESSE              varchar(255),
   CODE_POSTAL          int,
   VILLE                varchar(255),
   MDP                  varchar(255) NOT NULL
   primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : EQUIPIER_POLYVALENT                                  */
/*==============================================================*/
create table EQUIPIER_POLYVALENT
(
   ID_EMPLOYE           int not null,
   primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : ETAT                                                 */
/*==============================================================*/
create table ETAT
(
   ID_ETAT              int not null auto_increment,
   NOM_ETAT             varchar(255),
   primary key (ID_ETAT)
);

/*==============================================================*/
/* Table : JOUR                                                 */
/*==============================================================*/
create table JOUR
(
   ID_JOUR              int not null auto_increment,
   ID_PLANNING          int not null,
   ID_ECHANGE           int,
   N_JOUR               int not null,
   RETARD               bool,
   DEBUT_JOURNEE        time,
   FIN_JOURNEE          time,
   primary key (ID_JOUR)
);

/*==============================================================*/
/* Table : LIVRAISON                                            */
/*==============================================================*/
create table LIVRAISON
(
   ID_LIVRAISON         int not null auto_increment,
   DATE_LIVRAISON       date,
   primary key (ID_LIVRAISON)
);

/*==============================================================*/
/* Table : MANAGER                                              */
/*==============================================================*/
create table MANAGER
(
   ID_EMPLOYE           int not null,
   primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : PLANNING                                             */
/*==============================================================*/
create table PLANNING
(
   ID_PLANNING          int not null auto_increment,
   ID_EMPLOYE           int not null,
   ID_ETAT              int not null,
   N_SEMAINE            int,
   ANNEE_PLANNING       smallint,
   primary key (ID_PLANNING)
);

/*==============================================================*/
/* Table : PRODUIT                                              */
/*==============================================================*/
create table PRODUIT
(
   ID_PRODUIT           int not null auto_increment,
   ID_UNITE             int not null,
   DENOMINATION         varchar(255),
   DERNIERE_MODIF       datetime,
   QUANTITE_EN_STOCK    decimal,
   primary key (ID_PRODUIT)
);

/*==============================================================*/
/* Table : RECOIT                                               */
/*==============================================================*/
create table RECOIT
(
   ID_ECHANGE           int not null,
   ID_EMPLOYE           int not null,
   primary key (ID_ECHANGE, ID_EMPLOYE)
);

/*==============================================================*/
/* Table : SUPERVISE                                            */
/*==============================================================*/
create table SUPERVISE
(
   ID_EMPLOYE           int not null,
   ID_LIVRAISON         int not null,
   primary key (ID_EMPLOYE, ID_LIVRAISON)
);

/*==============================================================*/
/* Table : UNITE                                                */
/*==============================================================*/
create table UNITE
(
   ID_UNITE             int not null auto_increment,
   NOM_UNITE            varchar(255),
   primary key (ID_UNITE)
);

alter table ASSISTANT_MANAGER add constraint FK_PREMIER_NIVEAU foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table COMPREND add constraint FK_COMPREND foreign key (ID_LIVRAISON)
      references LIVRAISON (ID_LIVRAISON) on delete restrict on update restrict;

alter table COMPREND add constraint FK_COMPREND2 foreign key (ID_PRODUIT)
      references PRODUIT (ID_PRODUIT) on delete restrict on update restrict;

alter table CONGE add constraint FK_DEMANDE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table CONGE add constraint FK_EST_QUALIFIE_PAR foreign key (ID_ETAT)
      references ETAT (ID_ETAT) on delete restrict on update restrict;

alter table DISPONIBILITE add constraint FK_DECLARE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table DISPONIBILITE add constraint FK_EST_DEFINIE_PAR foreign key (ID_ETAT)
      references ETAT (ID_ETAT) on delete restrict on update restrict;

alter table ECHANGE_TRAVAIL add constraint FK_CONCERNE2 foreign key (ID_JOUR)
      references JOUR (ID_JOUR) on delete restrict on update restrict;

alter table ECHANGE_TRAVAIL add constraint FK_EST_PRECISE_PAR foreign key (ID_ETAT)
      references ETAT (ID_ETAT) on delete restrict on update restrict;

alter table ECHANGE_TRAVAIL add constraint FK_PROPOSE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table ECHANGE_TRAVAIL add constraint FK_TRAITE foreign key (MAN_ID_EMPLOYE)
      references MANAGER (ID_EMPLOYE) on delete restrict on update restrict;

alter table EQUIPIER_POLYVALENT add constraint FK_PREMIER_NIVEAU2 foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table JOUR add constraint FK_CONCERNE foreign key (ID_ECHANGE)
      references ECHANGE_TRAVAIL (ID_ECHANGE) on delete restrict on update restrict;

alter table JOUR add constraint FK_CONTIENT foreign key (ID_PLANNING)
      references PLANNING (ID_PLANNING) on delete restrict on update restrict;

alter table MANAGER add constraint FK_SECOND_NIVEAU foreign key (ID_EMPLOYE)
      references ASSISTANT_MANAGER (ID_EMPLOYE) on delete restrict on update restrict;

alter table PLANNING add constraint FK_EST_CARACTERISE_PAR foreign key (ID_ETAT)
      references ETAT (ID_ETAT) on delete restrict on update restrict;

alter table PLANNING add constraint FK_POSSEDE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table PRODUIT add constraint FK_EST_EN foreign key (ID_UNITE)
      references UNITE (ID_UNITE) on delete restrict on update restrict;

alter table RECOIT add constraint FK_RECOIT foreign key (ID_ECHANGE)
      references ECHANGE_TRAVAIL (ID_ECHANGE) on delete restrict on update restrict;

alter table RECOIT add constraint FK_RECOIT2 foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE) on delete restrict on update restrict;

alter table SUPERVISE add constraint FK_SUPERVISE foreign key (ID_EMPLOYE)
      references ASSISTANT_MANAGER (ID_EMPLOYE) on delete restrict on update restrict;

alter table SUPERVISE add constraint FK_SUPERVISE2 foreign key (ID_LIVRAISON)
      references LIVRAISON (ID_LIVRAISON) on delete restrict on update restrict;

