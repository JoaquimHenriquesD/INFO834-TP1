

CREATE TABLE Utilisateur (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
password VARCHAR(50)
);

INSERT INTO `utilisateur`(`firstname`, `lastname`, `email`, `password`) VALUES ('Bocuse','Paul','bestcook@gmail.com','burguer');
