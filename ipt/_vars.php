<?
/*
Source: ipt/_vars.php
Cr�er le: 2013-06-21
Par: Mathieu Tremblay

Tous droits r�serv�s. 


Description
------------------------------------------------------
Liste des constantes qui servent � simplifier la
conversion des types de champs entre la cr�ation de  
formulaires HTML, les pr�-traitement via PHP 
et leur enregistrement dans la base de donn�es

Notes suppl�mentaires
------------------------------------------------------
Une version .js de ce fichier devrait �tre r�alis�e


Historique des modifications
------------------------------------------------------
1.0.1   2013-06-26  Ajout de IPT_DB_TYPE_*
1.0.0   2013-06-21  Cr�ation du fichier

 
     Voir le tableau de r�f�rence ci-dessous
'-----------------------------------------------------. 
|                                                      `.
|                                                        `.
|                                                  //*****************************************************************************
|                                                  //  exemple    HTML       JScript       PHP                  MySQL
'--------------------------------------------------//****************************************************************************/                          
  define("IPT_FIELD_TYPE_TEXT",          0);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_FIELD_TYPE_DATE",          1);       //  20131123   TEXT       date.js       string('YYYYMMDD')   varchar(8) 
  define("IPT_FIELD_TYPE_FLOAT",         2);       //  12.45      TEXT       float.js      float                float
  define("IPT_FIELD_TYPE_INT",           3);       //  1262       TEXT       int.js        int                  int
  define("IPT_FIELD_TYPE_FILE",          4);       //  *          FILE       file.js       binary                              
  define("IPT_FIELD_TYPE_DATETIME",      5);
  define("IPT_FIELD_TYPE_PASSWORD" ,     6);  
  define("IPT_FIELD_TYPE_MULTILINE",     7);
  define("IPT_FIELD_TYPE_HIDDEN",       10);
  define("IPT_FIELD_TYPE_LABEL",        11);
  define("IPT_FIELD_TYPE_EMAIL",        12);
  define("IPT_FIELD_TYPE_USERNAME",     13);
  define("IPT_FIELD_TYPE_HTML",         14);
  define("IPT_FIELD_TYPE_CHECKBOX",     15);
  define("IPT_FIELD_TYPE_IMAGE",        16);
  define("IPT_FIELD_TYPE_MONEY",        17);

  define("IPT_FIELD_TYPE_SUPERLABEL", 7789);
  define("IPT_FIELD_TYPE_DATEPICKER", 9998);


  define("IPT_FIELD_TYPE_DATE_TMOIS", 50);  
  define("IPT_FIELD_TYPE_DATE_TJOUR", 51);  
  define("IPT_FIELD_TYPE_DATE_TANNEE", 52);  

  define("IPT_FIELD_TYPE_DATE_MOIS", 53);  
  define("IPT_FIELD_TYPE_DATE_JOUR", 54);  
  define("IPT_FIELD_TYPE_DATE_ANNEE", 55);  


  define("IPT_FIELD_TYPE_AUTOID",          99);       //  ""         INT                     int              int auto inc...




  define("IPT_DB_TYPE_MYSQL",          0);       //  ""         TEXT                     string(*)            varchar(255)



  define("IPT_USERAUTH_FIELDS_DEFAULT",          0);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_USERAUTH_FIELDS_ID",          1);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_USERAUTH_FIELDS_USERNAME",          2);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_USERAUTH_FIELDS_PASSWORD",          3);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_USERAUTH_FIELDS_EXTRA",          4);       //  ""         TEXT                     string(*)            varchar(255)
  define("IPT_USERAUTH_FIELDS_FILTER",         5);       //  ""         TEXT                     string(*)            varchar(255)
  



?>