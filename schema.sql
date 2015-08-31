drop database lascazuelitas2;
create database lascazuelitas2;
use lascazuelitas2;

create table user(
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50) not null,
	username varchar(50),
	email varchar(255) not null,
	password varchar(60) not null,
	image varchar(255),
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	is_mesero boolean not null default 0,
	is_cajero boolean not null default 0,
	created_at datetime not null
);

insert into user(name,lastname,email,password,is_admin,created_at) value ("Administrador", "","admin","90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad",1,NOW());

create table category(
	id int not null auto_increment primary key,
	name varchar(50) not null,
	is_active boolean not null default 1
);

insert into category (name) value ("Tacos");
insert into category (name) value ("Caldos");

create table product(
	id int not null auto_increment primary key,
	name varchar(50) not null,
	price_in float not null,
	price_out float,
	unit varchar(255) not null,
	presentation varchar(255) not null,
	is_active boolean not null default 1,
	user_id int not null,
	category_id int not null,
	foreign key (user_id) references user(id),
	foreign key (category_id) references category(id)
);


create table operation_type(
	id int not null auto_increment primary key,
	name varchar(50) not null
);

insert into operation_type (name) value ("salida");

create table sell(
	id int not null auto_increment primary key,
	mesa varchar(10),
	is_applied boolean not null default 0,
	mesero_id int not null,
	cajero_id int,
	foreign key (mesero_id) references user(id),	
	foreign key (cajero_id) references user(id),	
	created_at datetime not null
);

create table operation(
	id int not null auto_increment primary key,
	product_id int not null,
	q float not null,
	operation_type_id int not null,
	sell_id int,
	is_oficial boolean not null default 0,
	created_at datetime not null,
	foreign key (product_id) references product(id),
	foreign key (operation_type_id) references operation_type(id),
	foreign key (sell_id) references sell(id)
);

create table spent(
	id int not null auto_increment primary key,
	q int not null,
	concept varchar(255) not null,
	unit varchar(255) not null,
	price float not null,
	category_id int not null,
	created_at datetime not null,
	foreign key (category_id) references category(id)
);

create table permision(
	id int not null auto_increment primary key,
	name varchar(100) not null,
	description varchar(500)
);

insert into permision(name,description) value ("all","Acceso Total");
insert into permision(name,description) value ("post1","Crear y Modificar Todos los Posts");
insert into permision(name,description) value ("post2","Crear y Modificar Los Propios Posts");
insert into permision(name,description) value ("event1","Crear y Modificar Todos los Eventos");
insert into permision(name,description) value ("event2","Crear y Modificar Los Propios Eventos");


create table user_permision(
	user_id int not null,
	permision_id int not null,
	foreign key (user_id) references user(id),
	foreign key (permision_id) references permision(id)
);


create table post(
	id int not null auto_increment primary key,
	title varchar(150) not null,
	content varchar(5000) not null,
	image varchar(100),
	user_id int not null,
	is_slide boolean not null default 0,
	is_public boolean not null default 1,
	created_at datetime not null,
	foreign key (user_id) references user(id)
);

