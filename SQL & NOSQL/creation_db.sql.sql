
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `habitat_id` int(11) DEFAULT NULL,
  `prenom` varchar(255) NOT NULL,
  `race` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `avis` (
  `avis_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `avis` longtext NOT NULL,
  `validation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `avis_habitats` (
  `id` int(11) NOT NULL,
  `nomveterinaire` varchar(255) NOT NULL,
  `nomhabitat` varchar(255) NOT NULL,
  `avis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `habitat` (
  `habitat_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `horraire_zoo` (
  `id` int(11) NOT NULL,
  `jour` varchar(70) NOT NULL,
  `heure_ouverture` varchar(70) NOT NULL,
  `heure_fermeture` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `pagecontact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `passage_employe` (
  `passage_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `nourriture_apportee` varchar(255) NOT NULL,
  `grammage_de_la_nourriture` varchar(255) NOT NULL,
  `date_de_passage` varchar(255) NOT NULL,
  `heure_de_passage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `api_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `visite_veterinaire` (
  `visite_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `etat_animal` varchar(255) DEFAULT NULL,
  `nourriture_proposee` varchar(255) DEFAULT NULL,
  `grammage_nourriture` varchar(255) DEFAULT NULL,
  `date_passage` date DEFAULT NULL,
  `detail_etat_animal` longtext DEFAULT NULL,
  `nom_veterinaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `IDX_6AAB231FAFFE2D26` (`habitat_id`);


ALTER TABLE `avis`
  ADD PRIMARY KEY (`avis_id`);


ALTER TABLE `avis_habitats`
  ADD PRIMARY KEY (`id`);





ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitat_id`);


ALTER TABLE `horraire_zoo`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `pagecontact`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `passage_employe`
  ADD PRIMARY KEY (`passage_id`),
  ADD KEY `IDX_C94C8BED8E962C16` (`animal_id`);


ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);


ALTER TABLE `visite_veterinaire`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `IDX_5C10220E8E962C16` (`animal_id`);


ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;


ALTER TABLE `avis`
  MODIFY `avis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `avis_habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `habitat`
  MODIFY `habitat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;


ALTER TABLE `horraire_zoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `pagecontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `passage_employe`
  MODIFY `passage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;


ALTER TABLE `visite_veterinaire`
  MODIFY `visite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;


ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6AAB231FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`);


ALTER TABLE `passage_employe`
  ADD CONSTRAINT `FK_C94C8BED8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);


ALTER TABLE `visite_veterinaire`
  ADD CONSTRAINT `FK_5C10220E8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

