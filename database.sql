CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;

CREATE TABLE users(
    id              int(255) auto_increment not null,
    role            varchar(20),
    name            varchar(100),
    surname         varchar(200),
    nick            varchar(100),
    email           varchar(255),
    password        varchar(255),
    image           varchar(255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),
    constraint pk_users primary key(id)
)ENGINE=InnoDb;


CREATE TABLE images(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_path      varchar(255),
    description     text,
    created_at      datetime,
    updated_at      datetime,
    constraint pk_images primary key(id),
    constraint fk_image_user foreign key (user_id) references users(id)
)ENGINE=InnoDb;

CREATE TABLE comments(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_id        int(255),
    content         text,
    created_at      datetime,
    updated_at      datetime,
    constraint pk_comments primary key(id),
    constraint fk_comment_user foreign key(user_id) references users(id),
    constraint fk_comment_image foreign key(image_id) references images(id)
)ENGINE=InnoDb;

CREATE TABLE likes(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_id        int(255),
    created_at      datetime,
    updated_at      datetime,
    constraint pk_likes primary key(id),
    constraint fk_like_user foreign key(user_id) references users(id),
    constraint fk_like_image foreign key(image_id) references images(id)
)ENGINE=InnoDb;
