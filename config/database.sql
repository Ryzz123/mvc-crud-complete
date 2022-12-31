CREATE DATABASE mvc_php_tailwind;

CREATE TABLE mahasiswa (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(50) NOT NULL ,
    title VARCHAR(120) NOT NULL ,
    description VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

ALTER TABLE mahasiswa
ADD created_at DATE DEFAULT CURRENT_TIMESTAMP;

DESC mahasiswa;

SELECT * FROM mahasiswa;

DROP TABLE mahasiswa;

INSERT INTO mahasiswa(name, title, description, img) VALUES ('Febri Ananda Lubis','developer','Seorang Fullstack developer','https://i.pinimg.com/564x/10/c2/c2/10c2c227f83c695cd4c08981e85a540b.jpg');