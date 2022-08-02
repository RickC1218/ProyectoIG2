/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     1/8/2022 0:09:51                             */
/*==============================================================*/


drop table if exists ADMINISTRADOR;

drop table if exists ASIENTO;

drop table if exists CLIENTE;

drop table if exists COMBO;

drop table if exists COMBOS_SNACK;

drop table if exists DETALLES_COMBO;

drop table if exists DETALLE_PELICULA;

drop table if exists DETALLE_SNACK;

drop table if exists FACTURA;

drop table if exists MODO_PAGO;

drop table if exists PELICULA;

drop table if exists PROMOCION;

drop table if exists SALA;

drop table if exists SNACK;

/*==============================================================*/
/* Table: ADMINISTRADOR                                         */
/*==============================================================*/
create table ADMINISTRADOR
(
   NUMCED_ADMIN         int not null,
   NOMBRE_ADMIN         varchar(50) not null,
   APELLIDOS_ADMIN      varchar(50) not null,
   CONTRASENA_ADMIN     varchar(50) not null,
   primary key (NUMCED_ADMIN)
);

/*==============================================================*/
/* Table: ASIENTO                                               */
/*==============================================================*/
create table ASIENTO
(
   X_COL_ASIENTO        int not null,
   Y_FIL_ASIENTO        char(1) not null,
   ID_SALA              int not null,
   ESTADO_ASIENTO       char(1) not null,
   primary key (X_COL_ASIENTO, Y_FIL_ASIENTO)
);

/*==============================================================*/
/* Table: CLIENTE                                               */
/*==============================================================*/
create table CLIENTE
(
   NUMCED_CLI           int not null,
   NOMBRE_CLI           varchar(50) not null,
   APELLIDO_CLI         varchar(50) not null,
   FECHANACIMIENTO_CLI  date not null,
   EMAIL_CLI            varchar(100) not null,
   CONTRASENA_CLI       varchar(100) not null,
   primary key (NUMCED_CLI)
);

/*==============================================================*/
/* Table: COMBO                                                 */
/*==============================================================*/
create table COMBO
(
   ID_COMBO             int not null,
   ID_PROMO             int,
   IMG_COMBO            longblob not null,
   DESCRIPCION_COMBO    varchar(100) not null,
   PRECIO_COMBO         float not null,
   primary key (ID_COMBO)
);

/*==============================================================*/
/* Table: COMBOS_SNACK                                          */
/*==============================================================*/
create table COMBOS_SNACK
(
   ID_COMBO             int not null,
   ID_SNACK             int not null,
   primary key (ID_COMBO, ID_SNACK)
);

/*==============================================================*/
/* Table: DETALLES_COMBO                                        */
/*==============================================================*/
create table DETALLES_COMBO
(
   ID_DETCOMBO          int not null,
   ID_FACTURA           int not null,
   ID_COMBO             int not null,
   PREC_COMBO           float not null,
   CANT_COMBO           int not null,
   primary key (ID_DETCOMBO)
);

/*==============================================================*/
/* Table: DETALLE_PELICULA                                      */
/*==============================================================*/
create table DETALLE_PELICULA
(
   ID_DETPEL            int not null,
   ID_SALA              int,
   ID_FACTURA           int not null,
   ID_PELICULA          int,
   X_COL_ASIENTO        int,
   Y_FIL_ASIENTO        char(1),
   COSTUNITARIO_DETPEL  float not null,
   CANTBOLETOS_DETPEL   int not null,
   primary key (ID_DETPEL)
);

/*==============================================================*/
/* Table: DETALLE_SNACK                                         */
/*==============================================================*/
create table DETALLE_SNACK
(
   ID_DETSNACK          int not null,
   ID_FACTURA           int not null,
   ID_SNACK             int not null,
   CANT_DETSNACK        int not null,
   COSTUNITARIO_DETSNACK float not null,
   primary key (ID_DETSNACK)
);

/*==============================================================*/
/* Table: FACTURA                                               */
/*==============================================================*/
create table FACTURA
(
   ID_FACTURA           int not null,
   ID_PAGO              int not null,
   NUMCED_CLI           int not null,
   FECHACOMPRA_FACTURA  date not null,
   VALTOTAL_FACTURA     float not null,
   primary key (ID_FACTURA)
);

/*==============================================================*/
/* Table: MODO_PAGO                                             */
/*==============================================================*/
create table MODO_PAGO
(
   ID_PAGO              int not null,
   MODO_PAGO            int not null,
   primary key (ID_PAGO)
);

/*==============================================================*/
/* Table: PELICULA                                              */
/*==============================================================*/
create table PELICULA
(
   ID_PELICULA          int not null,
   ID_PROMO             int,
   NUMCED_ADMIN         int not null,
   TITULO_PELICULA      varchar(100) not null,
   ACTPRINCIPAL_PELICULA varchar(100) not null,
   ACTSECUNDARIOS_PELICULAS varchar(100) not null,
   DURACION_PELICULA    int not null,
   IDIOMAS_PELICULA     varchar(100) not null,
   ESTRENO_PELICULA     char(1) not null,
   TIEMPOCARTELERA_PELICULA date not null,
   IMAGEN_PELICULA      longblob not null,
   primary key (ID_PELICULA)
);

/*==============================================================*/
/* Table: PROMOCION                                             */
/*==============================================================*/
create table PROMOCION
(
   ID_PROMO             int not null,
   DES_PROMO            int not null,
   CATEGORIA_PROMOCION  varchar(100) not null,
   IMG_PROMO            longblob not null,
   primary key (ID_PROMO)
);

/*==============================================================*/
/* Table: SALA                                                  */
/*==============================================================*/
create table SALA
(
   ID_SALA              int not null,
   ID_PELICULA          int not null,
   NUMFILAS_SALA        int not null,
   NUMCOL_SALA          int not null,
   AFORO_SALA           int not null,
   ESTADO_SALA          char(1) not null,
   primary key (ID_SALA)
);

/*==============================================================*/
/* Table: SNACK                                                 */
/*==============================================================*/
create table SNACK
(
   ID_SNACK             int not null,
   NOMBRE_SNACK         varchar(100) not null,
   PRECIO_SNACK         float not null,
   STOCK_SNACK          int not null,
   IMG_SNACK            longblob not null,
   primary key (ID_SNACK)
);

alter table ASIENTO add constraint FK_RELATIONSHIP_11 foreign key (ID_SALA)
      references SALA (ID_SALA) on delete restrict on update restrict;

alter table COMBO add constraint FK_RELATIONSHIP_18 foreign key (ID_PROMO)
      references PROMOCION (ID_PROMO) on delete restrict on update restrict;

alter table COMBOS_SNACK add constraint FK_PERTENECER foreign key (ID_COMBO)
      references COMBO (ID_COMBO) on delete restrict on update restrict;

alter table COMBOS_SNACK add constraint FK_TENER foreign key (ID_SNACK)
      references SNACK (ID_SNACK) on delete restrict on update restrict;

alter table DETALLES_COMBO add constraint FK_RELATIONSHIP_16 foreign key (ID_FACTURA)
      references FACTURA (ID_FACTURA) on delete restrict on update restrict;

alter table DETALLES_COMBO add constraint FK_RELATIONSHIP_17 foreign key (ID_COMBO)
      references COMBO (ID_COMBO) on delete restrict on update restrict;

alter table DETALLE_PELICULA add constraint FK_RELATIONSHIP_3 foreign key (X_COL_ASIENTO, Y_FIL_ASIENTO)
      references ASIENTO (X_COL_ASIENTO, Y_FIL_ASIENTO) on delete restrict on update restrict;

alter table DETALLE_PELICULA add constraint FK_RELATIONSHIP_4 foreign key (ID_PELICULA)
      references PELICULA (ID_PELICULA) on delete restrict on update restrict;

alter table DETALLE_PELICULA add constraint FK_RELATIONSHIP_5 foreign key (ID_SALA)
      references SALA (ID_SALA) on delete restrict on update restrict;

alter table DETALLE_PELICULA add constraint FK_RELATIONSHIP_6 foreign key (ID_FACTURA)
      references FACTURA (ID_FACTURA) on delete restrict on update restrict;

alter table DETALLE_SNACK add constraint FK_RELATIONSHIP_12 foreign key (ID_FACTURA)
      references FACTURA (ID_FACTURA) on delete restrict on update restrict;

alter table DETALLE_SNACK add constraint FK_RELATIONSHIP_9 foreign key (ID_SNACK)
      references SNACK (ID_SNACK) on delete restrict on update restrict;

alter table FACTURA add constraint FK_RELATIONSHIP_1 foreign key (NUMCED_CLI)
      references CLIENTE (NUMCED_CLI) on delete restrict on update restrict;

alter table FACTURA add constraint FK_RELATIONSHIP_20 foreign key (ID_PAGO)
      references MODO_PAGO (ID_PAGO) on delete restrict on update restrict;

alter table PELICULA add constraint FK_RELATIONSHIP_13 foreign key (ID_PROMO)
      references PROMOCION (ID_PROMO) on delete restrict on update restrict;

alter table PELICULA add constraint FK_RELATIONSHIP_8 foreign key (NUMCED_ADMIN)
      references ADMINISTRADOR (NUMCED_ADMIN) on delete restrict on update restrict;

alter table SALA add constraint FK_RELATIONSHIP_10 foreign key (ID_PELICULA)
      references PELICULA (ID_PELICULA) on delete restrict on update restrict;

