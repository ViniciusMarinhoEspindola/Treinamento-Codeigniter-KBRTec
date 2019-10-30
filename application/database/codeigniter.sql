create database codeigniter_db;
use codeigniter_db;

create table categorias_ci(
	id_categoria int auto_increment not null primary key,
    categoria varchar(255)
);

create table subcategorias_ci(
	id_subcategoria int auto_increment not null primary key,
    subcategoria varchar(255),
    id_categoria int,
    constraint fk_CatSub foreign key (id_categoria) references categorias_ci (id_categoria) on delete cascade
);

create table user_ci(
	id_user int auto_increment not null primary key,
    nome varchar(255),
    email varchar(255) unique,
    nascimento date,
    img varchar(255),
    id_subcategoria int,
    descricao varchar(255),
    constraint fk_UserSub foreign key (id_subcategoria) references subcategorias_ci (id_subcategoria) on delete set null
);