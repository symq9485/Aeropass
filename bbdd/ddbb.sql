DROP DATABASE IF EXISTS Aerolinea;
CREATE DATABASE Aerolinea;

USE Aerolinea;

CREATE TABLE Usuarios(
  idUser VARCHAR(8) NOT NULL,
  claveUser VARCHAR(40) NOT NULL,
  nombreUser VARCHAR(15) NOT NULL,
  apellidoUser VARCHAR(15) NOT NULL,
  ciUser INT(8) NOT NULL,
  telfUser VARCHAR(12) NOT NULL,
  lvlUser INT(1) UNSIGNED NOT NULL,
  UNIQUE(idUser, ciUser),
  PRIMARY KEY(idUser)
) ENGINE = InnoDB CHARSET = latin1;

CREATE TABLE Destinos(
  codDestino VARCHAR(3) NOT NULL,
  nombreDestino VARCHAR (15) NOT NULL,
  idUser VARCHAR(8) NOT NULL,
  UNIQUE(codDestino),
  PRIMARY KEY(codDestino),
  INDEX num_FK1(idUser),
  FOREIGN KEY(idUser)
    REFERENCES Usuarios(idUser)
) ENGINE = InnoDB CHARSET = latin1;

CREATE TABLE Vuelos(
  numVuelo INT UNSIGNED NOT NULL AUTO_INCREMENT,
  placaVuelo VARCHAR(8) NOT NULL,
  horaVuelo TIME NOT NULL,
  codDestino VARCHAR(3) NOT NULL,
  UNIQUE(numVuelo),
  PRIMARY KEY(numVuelo),
  INDEX ci_FK1(codDestino),
  FOREIGN KEY(codDestino)
    REFERENCES Destinos(codDestino)
) ENGINE = InnoDB CHARSET = latin1;

CREATE TABLE Pasajeros(
  ciPasajero INT(8) NOT NULL,
  nombrePasajero VARCHAR(15) NOT NULL,
  apellidoPasajero VARCHAR(15) NOT NULL,
  telfPasajero VARCHAR(12) NOT NULL,
  numVuelo INT UNSIGNED NOT NULL,
  UNIQUE(ciPasajero),
  PRIMARY KEY(ciPasajero),
  INDEX num_FK1(numVuelo),
  FOREIGN KEY(numVuelo)
    REFERENCES Vuelos(numVuelo)
) ENGINE = InnoDB CHARSET = latin1;

INSERT INTO Usuarios(idUser, claveUser, nombreUser, apellidoUser, ciUser, telfUser, lvlUser)
VALUES('admin1', '202cb962ac59075b964b07152d234b70', 'Juan', 'Perez', 12345678, '042412345678', 1);

INSERT INTO Usuarios(idUser, claveUser, nombreUser, apellidoUser, ciUser, telfUser, lvlUser)
VALUES('user1', 'caf1a3dfb505ffed0d024130f58c5cfa', 'Maria', 'Lopez', 87654321, '042487654321', 2);

INSERT INTO Destinos(codDestino, nombreDestino, idUser)
VALUES ('CCS', 'Caracas', 'admin1');

INSERT INTO Destinos(codDestino, nombreDestino, idUser)
VALUES ('VLN', 'Valencia', 'user1');

INSERT INTO Vuelos(placaVuelo, horaVuelo, codDestino)
VALUES ('A0000000', 070000, 'CCS');

INSERT INTO Vuelos(placaVuelo, horaVuelo, codDestino)
VALUES ('A0000001', 080000, 'VLN');

INSERT INTO Pasajeros(ciPasajero, nombrePasajero, apellidoPasajero, telfPasajero, numVuelo)
VALUES (23456789, 'Pedro', 'Marcano', '029512345678', 1);

INSERT INTO Pasajeros(ciPasajero, nombrePasajero, apellidoPasajero, telfPasajero, numVuelo)
VALUES (98765432, 'Jorge', 'Quiroga', '029587654321', 2);