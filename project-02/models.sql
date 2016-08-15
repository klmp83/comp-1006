DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS genres;

CREATE TABLE genres (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL, 
  PRIMARY KEY (id)
);

CREATE TABLE books (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  author_name varchar(100) NOT NULL,
  price decimal(10,2) NOT NULL,
  pub_date DATE NOT NULL,
  genre_id int (11) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_genres_id FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
);