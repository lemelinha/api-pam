create database if not exists db_pam;
use db_pam;

create table if not exists tb_produto(
    cd_produto int primary key AUTO_INCREMENT,
    nm_produto varchar(30) not null,
    qt_pote int not null,
    ds_produto text not null,
    url_imagem text not null,
    st_produto char(1) not null default 'A'
)DEFAULT CHARSET=utf8mb4;

insert into tb_produto values
(null, 'coxinha', 6, 'esse produto é uma cozinha de frango', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXqBmVy2mXVTtQCxfZg0G8ZcfA4FhiK4XBqQ&s',default),
(null, 'pastel', 6, 'esse produto é um pastel de carne', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXqBmVy2mXVTtQCxfZg0G8ZcfA4FhiK4XBqQ&s',default),
(null, 'pastel', 6, 'esse produto é um pastel de frango', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXqBmVy2mXVTtQCxfZg0G8ZcfA4FhiK4XBqQ&s',default),
(null, 'bolinha de queijo', 8, 'esse produto é uma bolinha de queijo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXqBmVy2mXVTtQCxfZg0G8ZcfA4FhiK4XBqQ&s',default),
(null, 'empada', 4, 'esse produto é uma empada de frango', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXqBmVy2mXVTtQCxfZg0G8ZcfA4FhiK4XBqQ&s',default);
