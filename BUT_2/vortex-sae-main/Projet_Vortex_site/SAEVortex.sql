create database SAEVortex;

DROP TABLE
IF
  EXISTS personne CASCADE;
  DROP TABLE
  IF
    EXISTS Secretaire CASCADE;
    DROP TABLE
    IF
      EXISTS Enseignant CASCADE;
      DROP TABLE
      IF
        EXISTS Discipline CASCADE;
        DROP TABLE
        IF
          EXISTS Categorie CASCADE;
          DROP TABLE
          IF
            EXISTS Annee CASCADE;
            DROP TABLE
            IF
              EXISTS Diplome CASCADE;/*pas fait */
              DROP TABLE
              IF
                EXISTS EquipeDirection CASCADE;
                DROP TABLE
                IF
                  EXISTS Semestre CASCADE;/*pas fait */
                  DROP TABLE
                  IF
                    EXISTS Niveau CASCADE;/*pas fait */
                    DROP TABLE
                    IF
                      EXISTS Directeur CASCADE;
                      DROP TABLE
                      IF
                        EXISTS Departement CASCADE;/*pas fait */
                        DROP TABLE
                        IF
                          EXISTS Formation CASCADE;/*pas fait */
                          DROP TABLE
                          IF
                            EXISTS Besoin CASCADE;
                            DROP TABLE
                            IF
                              EXISTS Assigner CASCADE;
                              DROP TABLE
                              IF
                                EXISTS Propose CASCADE;
                                DROP TABLE
                                IF
                                  EXISTS ConnaitAussi CASCADE;
                                  DROP TABLE
                                  IF
                                    EXISTS Enseigne CASCADE;
                                     DROP TABLE
                                    IF
                                      EXISTS logs CASCADE;
                                    -- SAE VORTEX

                                    CREATE TABLE Personne (
                                      id_personne INT
                                      , nom VARCHAR(50) NOT NULL
                                      , prenom VARCHAR(50) NOT NULL
                                      , email VARCHAR(50)
                                      , motDePasse VARCHAR(100)
                                      , PRIMARY KEY (id_personne)
                                    );

                                    CREATE TABLE Discipline (
                                      idDiscipline INT
                                      , libelleDisc VARCHAR(50) NOT NULL
                                      , PRIMARY KEY (idDiscipline)
                                    );

                                    CREATE TABLE Secretaire (
                                      id_personne INT
                                      , PRIMARY KEY (id_personne)
                                      , FOREIGN KEY (id_personne) REFERENCES Personne(id_personne)
                                    );

                                    CREATE TABLE Categorie (
                                      id_categorie SMALLINT
                                      , sigleCat VARCHAR(5) NOT NULL
                                      , libelleCat VARCHAR(50)
                                      , serviceStatutaire SMALLINT NOT NULL
                                      , serviceComplementaireReferentiel SMALLINT
                                      , -- Modification: PostgreSQL ne supporte pas le type BYTE
                                        serviceComplementaireEnseignement SMALLINT
                                      , PRIMARY KEY (id_categorie)
                                    );

                                    CREATE TABLE Annee (
                                      AA SMALLINT
                                      , -- PostgreSQL ne supporte pas le type BYTE
                                        PRIMARY KEY (AA)
                                    );


                                    CREATE TABLE Diplome (
                                      idDiplome INT
                                      , libelle VARCHAR(50)
                                      , PRIMARY KEY (idDiplome)
                                    );

                                    CREATE TABLE Enseignant (
                                      id_personne INT
                                      , idDiscipline INT NOT NULL
                                      , id_categorie SMALLINT NOT NULL
                                      , AA SMALLINT NOT NULL
                                      , -- Modification: PostgreSQL ne supporte pas le type BYTE
                                        PRIMARY KEY (id_personne)
                                      , FOREIGN KEY (id_personne) REFERENCES Personne(id_personne)
                                      , FOREIGN KEY (idDiscipline) REFERENCES Discipline(idDiscipline)
                                      , FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie)
                                      , FOREIGN KEY (AA) REFERENCES Annee(AA)
                                    );

                                    CREATE TABLE EquipeDirection (
                                      id_personne INT
                                      , PRIMARY KEY (id_personne)
                                      , FOREIGN KEY (id_personne) REFERENCES Enseignant(id_personne)
                                    );

                                    CREATE TABLE Semestre (
                                      AA SMALLINT
                                      , S SMALLINT CHECK (S IN (1, 2))
                                      , -- Modification: Correction de la syntaxe de CHECK
                                        PRIMARY KEY (AA, S)
                                      , FOREIGN KEY (AA) REFERENCES Annee(AA)
                                    );

                                    CREATE TABLE Niveau (
                                      idDiplome INT
                                      , idNiveau INT
                                      , Niveau SMALLINT
                                      , -- Modification: PostgreSQL ne supporte pas le type BYTE
                                        PRIMARY KEY (idDiplome, idNiveau)
                                      , FOREIGN KEY (idDiplome) REFERENCES Diplome(idDiplome)
                                    );

                                    CREATE TABLE Directeur (
                                      id_personne INT
                                      , PRIMARY KEY (id_personne)
                                      , FOREIGN KEY (id_personne) REFERENCES Enseignant(id_personne)
                                    );

                                    CREATE TABLE Departement (
                                      idDepartement INT
                                      , sigleDept VARCHAR(50) NOT NULL
                                      , libelleDept VARCHAR(50)
                                      , id_personne INT NOT NULL
                                      , PRIMARY KEY (idDepartement)
                                      , UNIQUE (id_personne)
                                      , FOREIGN KEY (id_personne) REFERENCES Enseignant(id_personne)
                                    );

                                    CREATE TABLE Formation (
                                      idFormation INT
                                      , nom VARCHAR(50) NOT NULL
                                      , idDiplome INT NOT NULL
                                      , idNiveau INT NOT NULL
                                      , PRIMARY KEY (idFormation)
                                      , FOREIGN KEY (idDiplome, idNiveau) REFERENCES Niveau(idDiplome, idNiveau)
                                    );

                                    CREATE TABLE Besoin (
                                      AA SMALLINT
                                      , S SMALLINT
                                      , idFormation INT
                                      , idDiscipline INT
                                      , idDepartement INT
                                      , besoin_heure float NOT NULL
                                      , PRIMARY KEY (AA, S, idFormation, idDiscipline, idDepartement)
                                      , FOREIGN KEY (AA, S) REFERENCES Semestre(AA, S)
                                      , FOREIGN KEY (idFormation) REFERENCES Formation(idFormation)
                                      , FOREIGN KEY (idDiscipline) REFERENCES Discipline(idDiscipline)
                                      , FOREIGN KEY (idDepartement) REFERENCES Departement(idDepartement)
                                    );

                                    CREATE TABLE Assigner (
                                      id_personne INT
                                      , idDepartement INT
                                      , AA SMALLINT
                                      , S SMALLINT
                                      , quotite DECIMAL(2, 2)
                                      , PRIMARY KEY (id_personne, idDepartement, AA, S)
                                      , FOREIGN KEY (id_personne) REFERENCES Personne(id_personne)
                                      , FOREIGN KEY (idDepartement) REFERENCES Departement(idDepartement)
                                      , FOREIGN KEY (AA, S) REFERENCES Semestre(AA, S)
                                    );

                                    CREATE TABLE Propose (
                                      idDepartement INT
                                      , idFormation INT
                                      , PRIMARY KEY (idDepartement, idFormation)
                                      , FOREIGN KEY (idDepartement) REFERENCES Departement(idDepartement)
                                      , FOREIGN KEY (idFormation) REFERENCES Formation(idFormation)
                                    );

                                    CREATE TABLE ConnaitAussi (
                                      id_personne INT
                                      , idDiscipline INT
                                      , PRIMARY KEY (id_personne, idDiscipline)
                                      , FOREIGN KEY (id_personne) REFERENCES Enseignant(id_personne)
                                      , FOREIGN KEY (idDiscipline) REFERENCES Discipline(idDiscipline)
                                    );

                                    CREATE TABLE Enseigne (
                                      id_personne INT
                                      , idDiscipline INT
                                      , AA SMALLINT
                                      , S SMALLINT
                                      , nbHeureEns SMALLINT
                                      , PRIMARY KEY (id_personne, idDiscipline, AA, S)
                                      , FOREIGN KEY (id_personne) REFERENCES Enseignant(id_personne)
                                      , FOREIGN KEY (idDiscipline) REFERENCES Discipline(idDiscipline)
                                      , FOREIGN KEY (AA, S) REFERENCES Semestre(AA, S)
                                    );


                                    CREATE TABLE logs (
                                      log_id SERIAL PRIMARY KEY
                                      , user_id INT
                                      , action_type VARCHAR(255)
                                      , action_description TEXT
                                      , timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                                    );
                                    


                                    INSERT INTO personne(
                                      id_personne, nom, prenom, email, motdepasse)
                                      VALUES (1111, 'Homère', 'Nkwawo', 'homerenkwawo@edu.univ-paris13.fr',  '$2y$10$LO0nSvtJKBbcQlReu6yOIeZi4U/L8KZ5KqnN5COizThPjkAeGLygO'),
                                      (1212, 'Hebert', 'David', 'hebert.iut@gmail.com', '$2y$10$CXY1tsLf31qCzyyWODTs3uPopLXl0Q3SW.6CPpZusy3EkG1LuKgqe'),
                                      (1113, 'Aomar', 'Osmani', 'aomar.iutv@univ-paris13.fr',  '$2y$10$rAl6cY.vx0vWLYngeTFpJ.473zIA4LwNXFjVXG/7e6nX05obF7Nz.'),
                                      (1313, 'Tandian', 'Binta', 'binta.tandian1@edu.univ-paris13.fr', '$2y$10$xFGvquPAINJGh8B4./FeDuApHJ5mfbVWIYGLqPUGgDe8O1RhdpGqS'),  
                                      (1112, 'Blanche', 'Cellier', 'blanchecellier@gmail.com', 'mdp_1112'),
                                      (1114, 'Marc', 'Delisle', 'marcdelisle@gmail.com', 'mdp_1114'),
                                      (1115, 'Darrell', 'Barrere', 'darrellbarrere@gmail.com', 'mdp_1115'),
                                      (1116, 'Fosette', 'Boulanger', 'fosetteboulanger@gmail.com', 'mdp_1116'),
                                      (1117, 'Duvall', 'Durand', 'duvalldurand@gmail.com', 'mdp_1117'),
                                      (1118, 'Ethan', 'Michael', 'ethanmichael@gmail.com', 'mdp_1118'),
                                      (1119, 'Marie', 'Boucher', 'marieboucher@gmail.com', 'mdp_1119'),
                                      (1110, 'Pierre', 'Lefevre', 'pierrelefevre@gmail.com', 'mdp_1110'),
                                      (1211, 'Sophie', 'Martin', 'sophiemartin@gmail.com', 'mdp_1211'),
                                      (1213, 'Laura', 'Garcia', 'lauragarcia@gmail.com', 'mdp_1213'),
                                      (1214, 'Luc', 'Dupuis', 'lucdupuis@gmail.com', 'mdp_1214'),
                                      (1215, 'Alice', 'Lemoine', 'alicelemoine@gmail.com', 'mdp_1215'),
                                      (1216, 'Martin', 'Leroux', 'martinleroux@gmail.com', 'mdp_1216'),
                                      (1217, 'Julie', 'Moreau', 'juliemoreau@gmail.com', 'mdp_1217'),
                                      (1218, 'Dominique', 'Robert', 'dominiquerobert@gmail.com', 'mdp_1218'),
                                      (1219, 'Caroline', 'Leroy', 'carolineleroy@gmail.com', 'mdp_1219'),
                                      (1220, 'Sylvain', 'Martin', 'sylvainmartin@gmail.com', 'mdp_1220'),
                                      (1000, 'Lician', 'Finta', 'Licianfinta@gmail.com', '1000');
                                    
                                    INSERT INTO
                                      discipline (idDiscipline, libelleDisc)
                                      VALUES
                                      (1, 'MATH')
                                      , (2, 'INFO-PROG')
                                      , (3, 'INFO-INDUSTRIEL')
                                      , (4, 'INFO-RESEAU')
                                      , (5, 'INFO-BUREAUTIQUE')
                                      , (6, 'ECOGESTION')
                                      , (7, 'ELECTRONIQUE')
                                      , (8, 'DROIT')
                                      , (9, 'ANGLAIS')
                                      , (10, 'COMMUNICATION')
                                      , (11, 'ESPAGNOL');

                                      INSERT INTO categorie (
                                        id_categorie, 
                                        sigleCat, 
                                        libelleCat, 
                                        serviceStatutaire, 
                                        serviceComplementaireReferentiel, 
                                        ServiceComplementaireEnseignement
                                      ) VALUES
                                        (1, 'PR', 'Professeur', 100, 20, 30),
                                        (2, 'MCF', 'Maître de Conférences', 80, 15, 25),
                                        (3, 'ESAS', 'Assistant', 50, 10, 15),
                                        (4, 'PAST', 'Personnel Administratif, Scientifique et Technique', 75, 10, 20),
                                        (5, 'ATER', 'Attaché Temporaire d''Enseignement et de Recherche', 60, 12, 18),
                                        (6, 'VAC', 'Vacataire', 0, 0, 0),
                                        (7, 'DOC', 'Doctorant', 50, 10, 15),
                                        (8, 'CDD', 'Contrat à Durée Déterminée', 70, 10, 20),
                                        (9, 'CDI', 'Contrat à Durée Indéterminée', 90, 15, 25);

                                      INSERT INTO
                                        Annee (AA)
                                      VALUES
                                        (2020)
                                        , (2021)
                                        , (2022)
                                        , (2023)
                                        , (2024);

                                      INSERT INTO
                                        Semestre (AA, S)
                                      VALUES
                                        (2020, 1)
                                        , (2020, 2)
                                        , (2021, 1)
                                        , (2021, 2)
                                        , (2022, 1)
                                        , (2022, 2)
                                        , (2023, 1)
                                        , (2023, 2)
                                        , (2024, 1)
                                        , (2024, 2);

                                      INSERT INTO enseignant(
	                                      id_personne, iddiscipline, id_categorie, aa)
	                                      VALUES (1212, 1, 2, 2024),
                                        (1113, 2, 3, 2024),
                                        (1213, 3, 2, 2024),
                                        (1111, 1, 1, 2023)
                                        , (1112, 2, 2, 2022)
                                        , (1211, 8, 2, 2022)
                                        , (1216, 9, 2, 2022)
                                        , (1214, 4, 2, 2022)
                                        , (1218, 6, 2, 2022)
                                        , (1219, 3, 2, 2022)
                                        , (1215, 2, 2, 2022)
                                        , (1220, 2, 2, 2024)
                                        , (1217, 10, 2, 2022)
                                        , (1114, 4, 4, 2021)
                                        , (1115, 5, 5, 2024)
                                        ,(1116, 2, 3, 2024)
                                        , (1117, 7, 7, 2021)
                                        , (1118, 8, 8, 2022)
                                        , (1119, 9, 9, 2024)
                                        , (1110, 10, 8, 2021)
                                        , (1000, 11, 7, 2024);

                                      INSERT INTO Departement (idDepartement, sigleDept, libelleDept, id_personne) VALUES
                                        (1, 'INFO', 'Informatique', 1217),
                                        (2, 'SD', 'Science des Donnees', 1117),
                                        (3, 'RT', 'Réseaux et Télécommunications', 1114),
                                        (4, 'GEII', 'Génie Électrique et Informatique Industrielle', 1119),
                                        (5, 'GEA', 'Gestion des Entreprises et des Administrations', 1110),
                                        (6, 'CJ', 'Carrières Juridiques', 1113);

                                    INSERT INTO
                                      Assigner (id_personne, idDepartement, AA, S, quotite)
                                    VALUES
                                      (1114, 1, 2023, 1, 0.8)
                                      , (1217, 4, 2024, 2, 0.3)
                                      , (1217, 5, 2024, 2, 0.7)
                                      , (1112, 2, 2024, 2, 0.3)
                                      , (1112, 5, 2021, 2, 0.7)
                                      , (1113, 1, 2024, 1, 0.5)
                                      , (1113, 5, 2024, 1, 0.5)
                                      , (1114, 4, 2024, 1, 0.2)
                                      , (1117, 1, 2024, 1, 0.5)
                                      , (1117, 5, 2024, 1, 0.5)
                                      , (1115, 5, 2024, 1, 0.5)
                                      , (1115, 1, 2024, 1, 0.5)
                                      , (1118, 6, 2024, 1, 0.5)
                                      , (1118, 1, 2024, 1, 0.5);

                                      INSERT INTO directeur(
                                        id_personne)
                                        VALUES (1111);

                                      INSERT INTO equipedirection(
                                        id_personne)
                                        VALUES (1213);

                                      INSERT INTO public.secretaire(
	                                      id_personne)
	                                      VALUES (1313);

                                      INSERT INTO 
                                      diplome(idDiplome, libelle)
                                      VALUES
                                      (1, 'BUT')
                                      , (2, 'LP');

                                    
                                    INSERT INTO
                                      Niveau (idDiplome, idNiveau, Niveau)
                                    VALUES
                                      (1, 1, 1)
                                      , (2, 4, 1)
                                      , (2, 5, 2)
                                      , (1, 2, 2)
                                      , (1, 3, 3)
                                      , (2, 6, 3);
                                    
                                    INSERT INTO
                                      Formation (idFormation, nom, idDiplome, idNiveau)
                                    VALUES
                                      (1, 'LP Informatique', 2, 4)
                                      , (3, 'BUT Informatique', 1, 1)
                                      , (6, 'BUT Carrières Juridiques', 1, 1)
                                       , (4, 'BUT Informatique', 1, 2)
                                        , (5, 'BUT Informatique', 1, 3)
                                        , (2, 'LP Informatique', 2, 6);

                                    -- Ajouter des besoins
                                    INSERT INTO
                                      Besoin (
                                        AA
                                        , S
                                        , idFormation
                                        , idDiscipline
                                        , idDepartement
                                        , besoin_heure
                                      )
                                    VALUES
                                      (2023, 1, 1, 1, 1, '10.00')
                                      , (2024, 2, 4, 2, 1, '15.30')
                                      , (2024, 1, 6, 8, 6, '15.30')
                                      , (2024, 1, 3, 1, 1, '15.30')
                                      , (2023, 2, 2, 3, 2, '20.30')
                                      , (2021, 1, 1, 3, 3, '19.00')
                                      , (2021, 2, 2, 3, 4, '21.00')
                                      , (2024, 2, 1, 2, 5, '12.45');


                                    -- Ajouter des enseignements
                                    INSERT INTO
                                      Enseigne (id_personne, idDiscipline, AA, S, nbHeureEns)
                                    VALUES
                                        (1112, 2, 2022, 2, 25)
                                      , (1220, 2, 2023, 2, 25)
                                      , (1212, 2, 2024, 2, 25)
                                      , (1115, 2, 2024, 2, 25)
                                      , (1116, 2, 2024, 2, 25)
                                      , (1117, 2, 2023, 2, 25)
                                      , (1112, 2, 2023, 1, 25)
                                      , (1211, 8, 2024, 2, 25)
                                      , (1216, 9, 2024, 1, 25)
                                      , (1214, 4, 2023, 1, 25)
                                      , (1218, 6, 2023, 1, 25)
                                      , (1219, 3, 2023, 2, 25)
                                      , (1215, 2, 2022, 2, 25)
                                      , (1113, 3, 2022, 1, 20);
