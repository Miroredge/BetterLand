-- ----------------------------------------------------------
--        Script MySQL.
-- ----------------------------------------------------------


-- ----------------------------------------------------------
-- Table: USR
-- ----------------------------------------------------------

DROP TABLE IF EXISTS USR;

CREATE TABLE USR(
        ROW_IDT Integer  Auto_increment  NOT NULL ,
        FST_NAM Varchar (25) NOT NULL ,
        LST_NAM Varchar (25) NOT NULL ,
        SEX     Varchar (20) NOT NULL ,
        EML     Text ,
        ADR     Varchar (50) NOT NULL ,
        CTY     Varchar (20) NOT NULL ,
        PST_COD Integer NOT NULL ,
        PHN_NBR Varchar (15) NOT NULL ,
        BTH_DAT Date NOT NULL ,
        PWD     Char (64) NOT NULL ,
        TMP_PWD Boolean NOT NULL ,
        PSD     Varchar (20)
	,CONSTRAINT USR_AK UNIQUE (PSD)
	,CONSTRAINT USR_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: ROL
-- ----------------------------------------------------------

DROP TABLE IF EXISTS ROL;

CREATE TABLE ROL(
        ROW_IDT Integer  Auto_increment  NOT NULL ,
        RGT     Varchar (50) NOT NULL ,
        NAM     Varchar (15) NOT NULL
	,CONSTRAINT ROL_AK UNIQUE (NAM)
	,CONSTRAINT ROL_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB COMMENT "RGT ->  Utilisateur Admin Super_Admin " ;


-- ----------------------------------------------------------
-- Table: PRY_CAT
-- ----------------------------------------------------------

DROP TABLE IF EXISTS PRY_CAT;

CREATE TABLE PRY_CAT(
        ROW_IDT Integer  Auto_increment  NOT NULL ,
        NAM     Varchar (30) NOT NULL
	,CONSTRAINT PRY_CAT_AK UNIQUE (NAM)
	,CONSTRAINT PRY_CAT_PK PRIMARY KEY (ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: CAT
-- ----------------------------------------------------------

DROP TABLE IF EXISTS CAT;

CREATE TABLE CAT(
        ROW_IDT         Integer  Auto_increment  NOT NULL ,
        NAM             Varchar (30) NOT NULL ,
        ROW_IDT_PRY_CAT Integer NOT NULL
	,CONSTRAINT CAT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT CAT_PRY_CAT_FK FOREIGN KEY (ROW_IDT_PRY_CAT) REFERENCES PRY_CAT(ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: PDT
-- ----------------------------------------------------------

DROP TABLE IF EXISTS PDT;

CREATE TABLE PDT(
        ROW_IDT     Integer  Auto_increment  NOT NULL ,
        PCE         Real NOT NULL ,
        IMG         Text NOT NULL ,
        DSC         Text NOT NULL ,
        NAM         Varchar (50) NOT NULL ,
        ROW_IDT_CAT Integer NOT NULL
	,CONSTRAINT PDT_AK UNIQUE (NAM)
	,CONSTRAINT PDT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT PDT_CAT_FK FOREIGN KEY (ROW_IDT_CAT) REFERENCES CAT(ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: CRT
-- ----------------------------------------------------------

DROP TABLE IF EXISTS CRT;

CREATE TABLE CRT(
        ROW_IDT     Integer  Auto_increment  NOT NULL ,
        QTY         Integer NOT NULL ,
        ROW_IDT_USR Integer NOT NULL
	,CONSTRAINT CRT_PK PRIMARY KEY (ROW_IDT)

	,CONSTRAINT CRT_USR_FK FOREIGN KEY (ROW_IDT_USR) REFERENCES USR(ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: ROL_USR_LNK
-- ----------------------------------------------------------

DROP TABLE IF EXISTS ROL_USR_LNK;

CREATE TABLE ROL_USR_LNK(
        ROL_ROW_IDT     Integer NOT NULL ,
        USR_ROW_IDT Integer NOT NULL
	,CONSTRAINT ROL_USR_LNK_PK PRIMARY KEY (ROL_ROW_IDT,USR_ROW_IDT)

	,CONSTRAINT ROL_USR_LNK_ROL_FK FOREIGN KEY (ROL_ROW_IDT) REFERENCES ROL(ROW_IDT)
	,CONSTRAINT ROL_USR_LNK_USR0_FK FOREIGN KEY (USR_ROW_IDT) REFERENCES USR(ROW_IDT)
)ENGINE=InnoDB;


-- ----------------------------------------------------------
-- Table: CRT_PDT_LNK
-- ----------------------------------------------------------

DROP TABLE IF EXISTS CRT_PDT_LNK;

CREATE TABLE CRT_PDT_LNK(
        CRT_ROW_IDT     Integer NOT NULL ,
        PDT_ROW_IDT Integer NOT NULL
	,CONSTRAINT CRT_PDT_LNK_PK PRIMARY KEY (CRT_ROW_IDT,PDT_ROW_IDT)

	,CONSTRAINT CRT_PDT_LNK_CRT_FK FOREIGN KEY (CRT_ROW_IDT) REFERENCES CRT(ROW_IDT)
	,CONSTRAINT CRT_PDT_LNK_PDT0_FK FOREIGN KEY (PDT_ROW_IDT) REFERENCES PDT(ROW_IDT)
)ENGINE=InnoDB;

