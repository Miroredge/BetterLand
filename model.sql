--------------------------------------------------------------
--        Script MySQL.
--------------------------------------------------------------


--------------------------------------------------------------
-- Table: USR
--------------------------------------------------------------

CREATE TABLE USR(
        ROW_IDT Int  Auto_increment  NOT NULL ,
        FST_NAM Varchar (25) NOT NULL ,
        LST_NAM Varchar (25) NOT NULL ,
        SEX     Varchar (20) NOT NULL ,
        EML     Text ,
        ADR     Varchar (50) NOT NULL ,
        CTY     Varchar (20) NOT NULL ,
        PST_COD Int NOT NULL ,
        PHN_NBR Varchar (15) NOT NULL ,
        BTH_DAT Date NOT NULL ,
        PWD     Char (64) NOT NULL ,
        TMP_PWD Bool NOT NULL ,
        PSD     Varchar (20)
	,CONSTRAINT USR_AK UNIQUE (PSD)
	,CONSTRAINT USR_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: ROL
--------------------------------------------------------------

CREATE TABLE ROL(
        ROW_IDT Int  Auto_increment  NOT NULL ,
        RGT     Varchar (50) NOT NULL ,
        NAM     Varchar (15) NOT NULL
	,CONSTRAINT ROL_AK UNIQUE (NAM)
	,CONSTRAINT ROL_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB COMMENT "RGT ->  Utilisateur Admin Super_Admin " ;


--------------------------------------------------------------
-- Table: PRY_CAT
--------------------------------------------------------------

CREATE TABLE PRY_CAT(
        ROW_IDT Int  Auto_increment  NOT NULL ,
        NAM     Varchar (30) NOT NULL
	,CONSTRAINT PRY_CAT_AK UNIQUE (NAM)
	,CONSTRAINT PRY_CAT_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: CAT
--------------------------------------------------------------

CREATE TABLE CAT(
        ROW_IDT         Int  Auto_increment  NOT NULL ,
        NAM             Varchar (30) NOT NULL ,
        ROW_IDT_PRY_CAT Int NOT NULL
	,CONSTRAINT CAT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT CAT_PRY_CAT_FK FOREIGN KEY (ROW_IDT_PRY_CAT) REFERENCES PRY_CAT(ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: PDT
--------------------------------------------------------------

CREATE TABLE PDT(
        ROW_IDT     Int  Auto_increment  NOT NULL ,
        PCE         Real NOT NULL ,
        IMG         Text NOT NULL ,
        DSC         Text NOT NULL ,
        NAM         Varchar (50) NOT NULL ,
        ROW_IDT_CAT Int NOT NULL
	,CONSTRAINT PDT_AK UNIQUE (NAM)
	,CONSTRAINT PDT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT PDT_CAT_FK FOREIGN KEY (ROW_IDT_CAT) REFERENCES CAT(ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: CRT
--------------------------------------------------------------

CREATE TABLE CRT(
        ROW_IDT     Int  Auto_increment  NOT NULL ,
        QTY         Int NOT NULL ,
        ROW_IDT_USR Int NOT NULL
	,CONSTRAINT CRT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT CRT_USR_FK FOREIGN KEY (ROW_IDT_USR) REFERENCES USR(ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: ROL_USR_LNK
--------------------------------------------------------------

CREATE TABLE ROL_USR_LNK(
        ROW_IDT     Int NOT NULL ,
        ROW_IDT_USR Int NOT NULL
	,CONSTRAINT ROL_USR_LNK_PK PRIMARY KEY (ROW_IDT,ROW_IDT_USR)

	,CONSTRAINT ROL_USR_LNK_ROL_FK FOREIGN KEY (ROW_IDT) REFERENCES ROL(ROW_IDT)
	,CONSTRAINT ROL_USR_LNK_USR0_FK FOREIGN KEY (ROW_IDT_USR) REFERENCES USR(ROW_IDT)
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: CRT_PDT_LNK
--------------------------------------------------------------

CREATE TABLE CRT_PDT_LNK(
        ROW_IDT     Int NOT NULL ,
        ROW_IDT_PDT Int NOT NULL
	,CONSTRAINT CRT_PDT_LNK_PK PRIMARY KEY (ROW_IDT,ROW_IDT_PDT)

	,CONSTRAINT CRT_PDT_LNK_CRT_FK FOREIGN KEY (ROW_IDT) REFERENCES CRT(ROW_IDT)
	,CONSTRAINT CRT_PDT_LNK_PDT0_FK FOREIGN KEY (ROW_IDT_PDT) REFERENCES PDT(ROW_IDT)
)ENGINE=InnoDB;

