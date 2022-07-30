/*Tabla administrador*/
insert into administrador values (123456789,'Joel','Yapud','1111');
select * from administrador;

/*Tabla pelicula*/
insert into pelicula values (1,null,123456789,'Minions','Juan Montalvo','No idea',120,'Español','T','2022-07-20','aaa')
select * from pelicula

/*Sala*/
insert into sala values (1,1,10,10,100,'D')
select * from sala

/*Asiento*/
insert into asiento values (1,'A',1,'D');
insert into asiento values (2,'A',1,'O')
select * from asiento

/*Snack*/
insert into snack values (1,'Gaseosa-Pequeña',2.15,5,'aa')
insert into snack values (2,'Canguil-Pequeño',2.50,15,'aa')
select * from snack

/*combo*/
insert into combo values (1,'aa','combo 1')

/*Combo Snack*/
insert into combo_snack values (1,1);
insert into combo_snack values (1,2)
select * from combo_snack

/*cliente*/
insert into cliente values (123456789, 'Erick','Valdez','1999-10-19','email@email.com','1234')

/*modo de pago*/
insert into modo_pago values (1,1)

/*Promocion*/
insert into promocion values (1,1,'Combo Agrandado','aaa');
insert into promocion values (1,2,'2x1','aa')



