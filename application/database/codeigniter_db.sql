
CREATE TABLE categorias_ci (
	id_categoria int auto_increment,
    categoria varchar(255),
    PRIMARY KEY (id_categoria)
);

CREATE TABLE subcategorias_ci (
	id_subcategoria int auto_increment,
    subcategoria varchar(255),
    id_categoria int,
    PRIMARY KEY (id_subcategoria),
    CONSTRAINT fk_CatSub FOREIGN KEY (id_categoria) REFERENCES categorias_ci (id_categoria) on delete cascade
);

CREATE TABLE user_ci(
	id_user int AUTO_INCREMENT,
	nome varchar(255) NOT NULL,
	email varchar(255),
	nascimento date,
	img varchar(100),
	id_subcategoria int,
	descricao mediumtext,
	PRIMARY KEY (id_user),
    CONSTRAINT fk_SubUser FOREIGN KEY (id_subcategoria) REFERENCES subcategorias_ci(id_subcategoria)  ON DELETE SET NULL
);