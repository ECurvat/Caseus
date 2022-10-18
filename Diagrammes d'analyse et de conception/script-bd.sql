/*==============================================================*/
/* Nom de SGBD :  ORACLE Version 11g                            */
/* Date de création :  18/10/2022 10:35:15                      */
/*==============================================================*/


alter table ASSISTANT_MANAGER
   drop constraint FK_ASSISTAN_PREMIER_N_EMPLOYE;

alter table COMPREND
   drop constraint FK_COMPREND_COMPREND_LIVRAISO;

alter table COMPREND
   drop constraint FK_COMPREND_COMPREND2_PRODUIT;

alter table CONGE
   drop constraint FK_CONGE_DEMANDE_EMPLOYE;

alter table CONGE
   drop constraint FK_CONGE_EST_QUALI_ETAT;

alter table DISPONIBILITE
   drop constraint FK_DISPONIB_DECLARE_EMPLOYE;

alter table DISPONIBILITE
   drop constraint FK_DISPONIB_EST_DEFIN_ETAT;

alter table ECHANGE_TRAVAIL
   drop constraint FK_ECHANGE__CONCERNE2_JOUR;

alter table ECHANGE_TRAVAIL
   drop constraint FK_ECHANGE__EST_PRECI_ETAT;

alter table ECHANGE_TRAVAIL
   drop constraint FK_ECHANGE__PROPOSE_EMPLOYE;

alter table ECHANGE_TRAVAIL
   drop constraint FK_ECHANGE__TRAITE_MANAGER;

alter table EQUIPIER_POLYVALENT
   drop constraint FK_EQUIPIER_PREMIER_N_EMPLOYE;

alter table JOUR
   drop constraint FK_JOUR_CONCERNE_ECHANGE_;

alter table JOUR
   drop constraint FK_JOUR_CONTIENT_PLANNING;

alter table MANAGER
   drop constraint FK_MANAGER_SECOND_NI_ASSISTAN;

alter table PLANNING
   drop constraint FK_PLANNING_EST_CARAC_ETAT;

alter table PLANNING
   drop constraint FK_PLANNING_POSSEDE_EMPLOYE;

alter table PRODUIT
   drop constraint FK_PRODUIT_EST_EN_UNITE;

alter table RECOIT
   drop constraint FK_RECOIT_RECOIT_ECHANGE_;

alter table RECOIT
   drop constraint FK_RECOIT_RECOIT2_EMPLOYE;

alter table SUPERVISE
   drop constraint FK_SUPERVIS_SUPERVISE_ASSISTAN;

alter table SUPERVISE
   drop constraint FK_SUPERVIS_SUPERVISE_LIVRAISO;

drop table ASSISTANT_MANAGER cascade constraints;

drop index COMPREND2_FK;

drop index COMPREND_FK;

drop table COMPREND cascade constraints;

drop index EST_QUALIFIE_PAR_FK;

drop index DEMANDE_FK;

drop table CONGE cascade constraints;

drop index EST_DEFINIE_PAR_FK;

drop index DECLARE_FK;

drop table DISPONIBILITE cascade constraints;

drop index TRAITE_FK;

drop index EST_PRECISE_PAR_FK;

drop index CONCERNE2_FK;

drop index PROPOSE_FK;

drop table ECHANGE_TRAVAIL cascade constraints;

drop table EMPLOYE cascade constraints;

drop table EQUIPIER_POLYVALENT cascade constraints;

drop table ETAT cascade constraints;

drop index CONCERNE_FK;

drop index CONTIENT_FK;

drop table JOUR cascade constraints;

drop table LIVRAISON cascade constraints;

drop table MANAGER cascade constraints;

drop index EST_CARACTERISE_PAR_FK;

drop index POSSEDE_FK;

drop table PLANNING cascade constraints;

drop index EST_EN_FK;

drop table PRODUIT cascade constraints;

drop index RECOIT2_FK;

drop index RECOIT_FK;

drop table RECOIT cascade constraints;

drop index SUPERVISE2_FK;

drop index SUPERVISE_FK;

drop table SUPERVISE cascade constraints;

drop table UNITE cascade constraints;

drop sequence S_CONGE;

drop sequence S_DISPONIBILITE;

drop sequence S_ECHANGE_TRAVAIL;

drop sequence S_EMPLOYE;

drop sequence S_ETAT;

drop sequence S_JOUR;

drop sequence S_LIVRAISON;

drop sequence S_PLANNING;

drop sequence S_PRODUIT;

drop sequence S_UNITE;

create sequence S_CONGE;

create sequence S_DISPONIBILITE;

create sequence S_ECHANGE_TRAVAIL;

create sequence S_EMPLOYE;

create sequence S_ETAT;

create sequence S_JOUR;

create sequence S_LIVRAISON;

create sequence S_PLANNING;

create sequence S_PRODUIT;

create sequence S_UNITE;

/*==============================================================*/
/* Table : ASSISTANT_MANAGER                                    */
/*==============================================================*/
create table ASSISTANT_MANAGER 
(
   ID_EMPLOYE           NUMBER(6)            not null,
   constraint PK_ASSISTANT_MANAGER primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : COMPREND                                             */
/*==============================================================*/
create table COMPREND 
(
   ID_LIVRAISON         NUMBER(6)            not null,
   ID_PRODUIT           NUMBER(6)            not null,
   QUANTITE_LIVREE      NUMBER,
   constraint PK_COMPREND primary key (ID_LIVRAISON, ID_PRODUIT)
);

/*==============================================================*/
/* Index : COMPREND_FK                                          */
/*==============================================================*/
create index COMPREND_FK on COMPREND (
   ID_LIVRAISON ASC
);

/*==============================================================*/
/* Index : COMPREND2_FK                                         */
/*==============================================================*/
create index COMPREND2_FK on COMPREND (
   ID_PRODUIT ASC
);

/*==============================================================*/
/* Table : CONGE                                                */
/*==============================================================*/
create table CONGE 
(
   ID_DEMANDE           NUMBER(6)            not null,
   ID_ETAT              NUMBER(6)            not null,
   ID_EMPLOYE           NUMBER(6)            not null,
   DEBUT_CONGE          DATE,
   FIN_CONGE            DATE,
   constraint PK_CONGE primary key (ID_DEMANDE)
);

/*==============================================================*/
/* Index : DEMANDE_FK                                           */
/*==============================================================*/
create index DEMANDE_FK on CONGE (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Index : EST_QUALIFIE_PAR_FK                                  */
/*==============================================================*/
create index EST_QUALIFIE_PAR_FK on CONGE (
   ID_ETAT ASC
);

/*==============================================================*/
/* Table : DISPONIBILITE                                        */
/*==============================================================*/
create table DISPONIBILITE 
(
   ID_DISPO             NUMBER(6)            not null,
   ID_ETAT              NUMBER(6)            not null,
   ID_EMPLOYE           NUMBER(6)            not null,
   DEBUT_DISPO          DATE,
   FIN_DISPO            DATE,
   constraint PK_DISPONIBILITE primary key (ID_DISPO)
);

/*==============================================================*/
/* Index : DECLARE_FK                                           */
/*==============================================================*/
create index DECLARE_FK on DISPONIBILITE (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Index : EST_DEFINIE_PAR_FK                                   */
/*==============================================================*/
create index EST_DEFINIE_PAR_FK on DISPONIBILITE (
   ID_ETAT ASC
);

/*==============================================================*/
/* Table : ECHANGE_TRAVAIL                                      */
/*==============================================================*/
create table ECHANGE_TRAVAIL 
(
   ID_ECHANGE           NUMBER(6)            not null,
   ID_ETAT              NUMBER(6)            not null,
   ID_JOUR              NUMBER(6)            not null,
   ID_EMPLOYE           NUMBER(6)            not null,
   MAN_ID_EMPLOYE       NUMBER(6),
   DATE_PROPOSITION     DATE,
   constraint PK_ECHANGE_TRAVAIL primary key (ID_ECHANGE)
);

/*==============================================================*/
/* Index : PROPOSE_FK                                           */
/*==============================================================*/
create index PROPOSE_FK on ECHANGE_TRAVAIL (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Index : CONCERNE2_FK                                         */
/*==============================================================*/
create index CONCERNE2_FK on ECHANGE_TRAVAIL (
   ID_JOUR ASC
);

/*==============================================================*/
/* Index : EST_PRECISE_PAR_FK                                   */
/*==============================================================*/
create index EST_PRECISE_PAR_FK on ECHANGE_TRAVAIL (
   ID_ETAT ASC
);

/*==============================================================*/
/* Index : TRAITE_FK                                            */
/*==============================================================*/
create index TRAITE_FK on ECHANGE_TRAVAIL (
   MAN_ID_EMPLOYE ASC
);

/*==============================================================*/
/* Table : EMPLOYE                                              */
/*==============================================================*/
create table EMPLOYE 
(
   ID_EMPLOYE           NUMBER(6)            not null,
   NOM                  CLOB,
   PRENOM               CLOB,
   DATE_EMBAUCHE        DATE,
   ADRESSE              CLOB,
   CODE_POSTAL          INTEGER,
   VILLE                CLOB,
   constraint PK_EMPLOYE primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : EQUIPIER_POLYVALENT                                  */
/*==============================================================*/
create table EQUIPIER_POLYVALENT 
(
   ID_EMPLOYE           NUMBER(6)            not null,
   constraint PK_EQUIPIER_POLYVALENT primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : ETAT                                                 */
/*==============================================================*/
create table ETAT 
(
   ID_ETAT              NUMBER(6)            not null,
   NOM_ETAT             CLOB,
   constraint PK_ETAT primary key (ID_ETAT)
);

/*==============================================================*/
/* Table : JOUR                                                 */
/*==============================================================*/
create table JOUR 
(
   ID_JOUR              NUMBER(6)            not null,
   ID_PLANNING          NUMBER(6)            not null,
   ID_ECHANGE           NUMBER(6),
   N_JOUR               INTEGER              not null,
   RETARD               SMALLINT,
   DEBUT_JOURNEE        DATE,
   FIN_JOURNEE          DATE,
   constraint PK_JOUR primary key (ID_JOUR)
);

/*==============================================================*/
/* Index : CONTIENT_FK                                          */
/*==============================================================*/
create index CONTIENT_FK on JOUR (
   ID_PLANNING ASC
);

/*==============================================================*/
/* Index : CONCERNE_FK                                          */
/*==============================================================*/
create index CONCERNE_FK on JOUR (
   ID_ECHANGE ASC
);

/*==============================================================*/
/* Table : LIVRAISON                                            */
/*==============================================================*/
create table LIVRAISON 
(
   ID_LIVRAISON         NUMBER(6)            not null,
   DATE_LIVRAISON       DATE,
   constraint PK_LIVRAISON primary key (ID_LIVRAISON)
);

/*==============================================================*/
/* Table : MANAGER                                              */
/*==============================================================*/
create table MANAGER 
(
   ID_EMPLOYE           NUMBER(6)            not null,
   constraint PK_MANAGER primary key (ID_EMPLOYE)
);

/*==============================================================*/
/* Table : PLANNING                                             */
/*==============================================================*/
create table PLANNING 
(
   ID_PLANNING          NUMBER(6)            not null,
   ID_EMPLOYE           NUMBER(6)            not null,
   ID_ETAT              NUMBER(6)            not null,
   N_SEMAINE            INTEGER,
   ANNEE_PLANNING       SMALLINT,
   constraint PK_PLANNING primary key (ID_PLANNING)
);

/*==============================================================*/
/* Index : POSSEDE_FK                                           */
/*==============================================================*/
create index POSSEDE_FK on PLANNING (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Index : EST_CARACTERISE_PAR_FK                               */
/*==============================================================*/
create index EST_CARACTERISE_PAR_FK on PLANNING (
   ID_ETAT ASC
);

/*==============================================================*/
/* Table : PRODUIT                                              */
/*==============================================================*/
create table PRODUIT 
(
   ID_PRODUIT           NUMBER(6)            not null,
   ID_UNITE             NUMBER(6)            not null,
   DENOMINATION         CLOB,
   DERNIERE_MODIF       DATE,
   QUANTITE_EN_STOCK    NUMBER,
   constraint PK_PRODUIT primary key (ID_PRODUIT)
);

/*==============================================================*/
/* Index : EST_EN_FK                                            */
/*==============================================================*/
create index EST_EN_FK on PRODUIT (
   ID_UNITE ASC
);

/*==============================================================*/
/* Table : RECOIT                                               */
/*==============================================================*/
create table RECOIT 
(
   ID_ECHANGE           NUMBER(6)            not null,
   ID_EMPLOYE           NUMBER(6)            not null,
   constraint PK_RECOIT primary key (ID_ECHANGE, ID_EMPLOYE)
);

/*==============================================================*/
/* Index : RECOIT_FK                                            */
/*==============================================================*/
create index RECOIT_FK on RECOIT (
   ID_ECHANGE ASC
);

/*==============================================================*/
/* Index : RECOIT2_FK                                           */
/*==============================================================*/
create index RECOIT2_FK on RECOIT (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Table : SUPERVISE                                            */
/*==============================================================*/
create table SUPERVISE 
(
   ID_EMPLOYE           NUMBER(6)            not null,
   ID_LIVRAISON         NUMBER(6)            not null,
   constraint PK_SUPERVISE primary key (ID_EMPLOYE, ID_LIVRAISON)
);

/*==============================================================*/
/* Index : SUPERVISE_FK                                         */
/*==============================================================*/
create index SUPERVISE_FK on SUPERVISE (
   ID_EMPLOYE ASC
);

/*==============================================================*/
/* Index : SUPERVISE2_FK                                        */
/*==============================================================*/
create index SUPERVISE2_FK on SUPERVISE (
   ID_LIVRAISON ASC
);

/*==============================================================*/
/* Table : UNITE                                                */
/*==============================================================*/
create table UNITE 
(
   ID_UNITE             NUMBER(6)            not null,
   NOM_UNITE            CLOB,
   constraint PK_UNITE primary key (ID_UNITE)
);

alter table ASSISTANT_MANAGER
   add constraint FK_ASSISTAN_PREMIER_N_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table COMPREND
   add constraint FK_COMPREND_COMPREND_LIVRAISO foreign key (ID_LIVRAISON)
      references LIVRAISON (ID_LIVRAISON);

alter table COMPREND
   add constraint FK_COMPREND_COMPREND2_PRODUIT foreign key (ID_PRODUIT)
      references PRODUIT (ID_PRODUIT);

alter table CONGE
   add constraint FK_CONGE_DEMANDE_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table CONGE
   add constraint FK_CONGE_EST_QUALI_ETAT foreign key (ID_ETAT)
      references ETAT (ID_ETAT);

alter table DISPONIBILITE
   add constraint FK_DISPONIB_DECLARE_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table DISPONIBILITE
   add constraint FK_DISPONIB_EST_DEFIN_ETAT foreign key (ID_ETAT)
      references ETAT (ID_ETAT);

alter table ECHANGE_TRAVAIL
   add constraint FK_ECHANGE__CONCERNE2_JOUR foreign key (ID_JOUR)
      references JOUR (ID_JOUR);

alter table ECHANGE_TRAVAIL
   add constraint FK_ECHANGE__EST_PRECI_ETAT foreign key (ID_ETAT)
      references ETAT (ID_ETAT);

alter table ECHANGE_TRAVAIL
   add constraint FK_ECHANGE__PROPOSE_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table ECHANGE_TRAVAIL
   add constraint FK_ECHANGE__TRAITE_MANAGER foreign key (MAN_ID_EMPLOYE)
      references MANAGER (ID_EMPLOYE);

alter table EQUIPIER_POLYVALENT
   add constraint FK_EQUIPIER_PREMIER_N_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table JOUR
   add constraint FK_JOUR_CONCERNE_ECHANGE_ foreign key (ID_ECHANGE)
      references ECHANGE_TRAVAIL (ID_ECHANGE);

alter table JOUR
   add constraint FK_JOUR_CONTIENT_PLANNING foreign key (ID_PLANNING)
      references PLANNING (ID_PLANNING);

alter table MANAGER
   add constraint FK_MANAGER_SECOND_NI_ASSISTAN foreign key (ID_EMPLOYE)
      references ASSISTANT_MANAGER (ID_EMPLOYE);

alter table PLANNING
   add constraint FK_PLANNING_EST_CARAC_ETAT foreign key (ID_ETAT)
      references ETAT (ID_ETAT);

alter table PLANNING
   add constraint FK_PLANNING_POSSEDE_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table PRODUIT
   add constraint FK_PRODUIT_EST_EN_UNITE foreign key (ID_UNITE)
      references UNITE (ID_UNITE);

alter table RECOIT
   add constraint FK_RECOIT_RECOIT_ECHANGE_ foreign key (ID_ECHANGE)
      references ECHANGE_TRAVAIL (ID_ECHANGE);

alter table RECOIT
   add constraint FK_RECOIT_RECOIT2_EMPLOYE foreign key (ID_EMPLOYE)
      references EMPLOYE (ID_EMPLOYE);

alter table SUPERVISE
   add constraint FK_SUPERVIS_SUPERVISE_ASSISTAN foreign key (ID_EMPLOYE)
      references ASSISTANT_MANAGER (ID_EMPLOYE);

alter table SUPERVISE
   add constraint FK_SUPERVIS_SUPERVISE_LIVRAISO foreign key (ID_LIVRAISON)
      references LIVRAISON (ID_LIVRAISON);

