DROP DATABASE IF EXISTS MLR1;

CREATE DATABASE IF NOT EXISTS MLR1;
USE MLR1;
# -----------------------------------------------------------------------------
#       TABLE : USER_
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER_
 (
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_USER CHAR(32) NOT NULL  ,
   F_NAME CHAR(32) NULL  ,
   L_NAME CHAR(32) NULL  ,
   U_NAME CHAR(32) NULL  ,
   PSSW CHAR(32) NULL  ,
   PSSW_R CHAR(32) NULL  ,
   LAST_VIEW CHAR(32) NULL  
   , PRIMARY KEY (CODE_USER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : FILE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FILE
 (
   CODE_USER CHAR(32) NOT NULL  ,
   CODE_FOLDER CHAR(32) NOT NULL  ,
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_FILE CHAR(32) NOT NULL  ,
   NAME CHAR(32) NULL  ,
   SIZE CHAR(32) NULL  ,
   STATUT CHAR(32) NULL  ,
   ICON CHAR(32) NULL  ,
   PATH CHAR(32) NULL  ,
   VIEW CHAR(32) NULL  ,
   LAST_VIEW CHAR(32) NULL  ,
   LAST_WHO CHAR(32) NULL  ,
   C_DATE CHAR(32) NULL  ,
   DESCRIPTION TEXT NULL  
   , PRIMARY KEY (CODE_FILE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FILE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FILE_USER_
     ON FILE (CODE_USER ASC);

CREATE  INDEX I_FK_FILE_FOLDER
     ON FILE (CODE_FOLDER ASC);

# -----------------------------------------------------------------------------
#       TABLE : NOTIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NOTIF
 (
   ID_NOTIF INTEGER NOT NULL AUTO_INCREMENT ,
   CODE_USER CHAR(32) NOT NULL  ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   LIBELLE CHAR(255) NULL  ,
   C_DATE CHAR(32) NULL  ,
   MSG TEXT NULL  ,
   TYPE CHAR(32) NULL  ,
   STATUT CHAR(32) NULL  
   , PRIMARY KEY (ID_NOTIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE NOTIF
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_NOTIF_USER_
     ON NOTIF (CODE_USER ASC);

CREATE  INDEX I_FK_NOTIF_CLOUD
     ON NOTIF (CODE_CLOUD ASC);

# -----------------------------------------------------------------------------
#       TABLE : LIB
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LIB
 (
   CODE_USER CHAR(32) NOT NULL  ,
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_LIB CHAR(32) NOT NULL  ,
   NAME CHAR(32) NULL  
   , PRIMARY KEY (CODE_LIB) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LIB
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LIB_USER_
     ON LIB (CODE_USER ASC);

# -----------------------------------------------------------------------------
#       TABLE : FOLDER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FOLDER
 (
   CODE_LIB CHAR(32) NULL  ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   CODE_USER CHAR(32) NOT NULL  ,
   CODE_FOLDER_MANY_FOLDER_WITHIN CHAR(32) NULL  ,
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_FOLDER CHAR(32) NOT NULL  ,
   NAME CHAR(32) NULL  ,
   C_DATE CHAR(32) NULL  ,
   DESCRIPTION TEXT NULL  ,
   STATUT CHAR(32) NULL  
   , PRIMARY KEY (CODE_FOLDER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FOLDER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FOLDER_LIB
     ON FOLDER (CODE_LIB ASC);

CREATE  INDEX I_FK_FOLDER_CLOUD
     ON FOLDER (CODE_CLOUD ASC);

CREATE  INDEX I_FK_FOLDER_USER_
     ON FOLDER (CODE_USER ASC);

CREATE  INDEX I_FK_FOLDER_FOLDER
     ON FOLDER (CODE_FOLDER_MANY_FOLDER_WITHIN ASC);

# -----------------------------------------------------------------------------
#       TABLE : CLOUD
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLOUD
 (
   CODE_USER CHAR(32) NOT NULL  ,
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   NAME CHAR(32) NULL  ,
   PSSW CHAR(32) NULL  ,
   C_DATE CHAR(32) NULL  ,
   TYPE CHAR(32) NULL  ,
   CAPACITY CHAR(32) NULL  
   , PRIMARY KEY (CODE_CLOUD) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CLOUD
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CLOUD_USER_
     ON CLOUD (CODE_USER ASC);

# -----------------------------------------------------------------------------
#       TABLE : CHAT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CHAT
 (
   ID_CHAT INTEGER NOT NULL AUTO_INCREMENT ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   CODE_USER CHAR(32) NOT NULL  ,
   S_DATE CHAR(32) NULL  ,
   CONTENT TEXT NULL  ,
   FILE_PATH VARCHAR(128) NULL  
   , PRIMARY KEY (ID_CHAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CHAT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CHAT_CLOUD
     ON CHAT (CODE_CLOUD ASC);

CREATE  INDEX I_FK_CHAT_USER_
     ON CHAT (CODE_USER ASC);

# -----------------------------------------------------------------------------
#       TABLE : ALLOW
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ALLOW
 (
   CODE_FOLDER CHAR(32) NOT NULL  ,
   CODE_FILE CHAR(32) NOT NULL  ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   ID INTEGER NULL AUTO_INCREMENT ,
   CODE_ALLOW CHAR(32) NOT NULL  ,
   READ_ CHAR(32) NULL  ,
   WRITE_ CHAR(32) NULL  ,
   CREATE_ CHAR(32) NULL  ,
   DELETE_ CHAR(32) NULL  
   , PRIMARY KEY (CODE_ALLOW) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ALLOW
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ALLOW_FOLDER
     ON ALLOW (CODE_FOLDER ASC);

CREATE  INDEX I_FK_ALLOW_FILE
     ON ALLOW (CODE_FILE ASC);

CREATE  INDEX I_FK_ALLOW_CLOUD
     ON ALLOW (CODE_CLOUD ASC);

# -----------------------------------------------------------------------------
#       TABLE : DELETE_FF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DELETE_FF
 (
   CODE_FILE CHAR(32) NOT NULL  ,
   CODE_USER CHAR(32) NOT NULL  ,
   CODE_FOLDER CHAR(32) NOT NULL  ,
   DATE CHAR(32) NULL  
   , PRIMARY KEY (CODE_FILE,CODE_USER,CODE_FOLDER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE DELETE_FF
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_DELETE_FF_FILE
     ON DELETE_FF (CODE_FILE ASC);

CREATE  INDEX I_FK_DELETE_FF_USER_
     ON DELETE_FF (CODE_USER ASC);

CREATE  INDEX I_FK_DELETE_FF_FOLDER
     ON DELETE_FF (CODE_FOLDER ASC);

# -----------------------------------------------------------------------------
#       TABLE : USER_PART_OF_CLOUD
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER_PART_OF_CLOUD
 (
   CODE_USER CHAR(32) NOT NULL  ,
   CODE_CLOUD CHAR(32) NOT NULL  ,
   ROLE CHAR(32) NULL  ,
   BANNED CHAR(32) NULL  
   , PRIMARY KEY (CODE_USER,CODE_CLOUD) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE USER_PART_OF_CLOUD
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_USER_PART_OF_CLOUD_USER_
     ON USER_PART_OF_CLOUD (CODE_USER ASC);

CREATE  INDEX I_FK_USER_PART_OF_CLOUD_CLOUD
     ON USER_PART_OF_CLOUD (CODE_CLOUD ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE FILE 
  ADD FOREIGN KEY FK_FILE_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE FILE 
  ADD FOREIGN KEY FK_FILE_FOLDER (CODE_FOLDER)
      REFERENCES FOLDER (CODE_FOLDER) ;


ALTER TABLE NOTIF 
  ADD FOREIGN KEY FK_NOTIF_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE NOTIF 
  ADD FOREIGN KEY FK_NOTIF_CLOUD (CODE_CLOUD)
      REFERENCES CLOUD (CODE_CLOUD) ;


ALTER TABLE LIB 
  ADD FOREIGN KEY FK_LIB_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE FOLDER 
  ADD FOREIGN KEY FK_FOLDER_LIB (CODE_LIB)
      REFERENCES LIB (CODE_LIB) ;


ALTER TABLE FOLDER 
  ADD FOREIGN KEY FK_FOLDER_CLOUD (CODE_CLOUD)
      REFERENCES CLOUD (CODE_CLOUD) ;


ALTER TABLE FOLDER 
  ADD FOREIGN KEY FK_FOLDER_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE FOLDER 
  ADD FOREIGN KEY FK_FOLDER_FOLDER (CODE_FOLDER_MANY_FOLDER_WITHIN)
      REFERENCES FOLDER (CODE_FOLDER) ;


ALTER TABLE CLOUD 
  ADD FOREIGN KEY FK_CLOUD_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE CHAT 
  ADD FOREIGN KEY FK_CHAT_CLOUD (CODE_CLOUD)
      REFERENCES CLOUD (CODE_CLOUD) ;


ALTER TABLE CHAT 
  ADD FOREIGN KEY FK_CHAT_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE ALLOW 
  ADD FOREIGN KEY FK_ALLOW_FOLDER (CODE_FOLDER)
      REFERENCES FOLDER (CODE_FOLDER) ;


ALTER TABLE ALLOW 
  ADD FOREIGN KEY FK_ALLOW_FILE (CODE_FILE)
      REFERENCES FILE (CODE_FILE) ;


ALTER TABLE ALLOW 
  ADD FOREIGN KEY FK_ALLOW_CLOUD (CODE_CLOUD)
      REFERENCES CLOUD (CODE_CLOUD) ;


ALTER TABLE DELETE_FF 
  ADD FOREIGN KEY FK_DELETE_FF_FILE (CODE_FILE)
      REFERENCES FILE (CODE_FILE) ;


ALTER TABLE DELETE_FF 
  ADD FOREIGN KEY FK_DELETE_FF_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE DELETE_FF 
  ADD FOREIGN KEY FK_DELETE_FF_FOLDER (CODE_FOLDER)
      REFERENCES FOLDER (CODE_FOLDER) ;


ALTER TABLE USER_PART_OF_CLOUD 
  ADD FOREIGN KEY FK_USER_PART_OF_CLOUD_USER_ (CODE_USER)
      REFERENCES USER_ (CODE_USER) ;


ALTER TABLE USER_PART_OF_CLOUD 
  ADD FOREIGN KEY FK_USER_PART_OF_CLOUD_CLOUD (CODE_CLOUD)
      REFERENCES CLOUD (CODE_CLOUD) ;

