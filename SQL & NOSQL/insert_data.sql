-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 avr. 2024 à 17:04
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zooarcadia`
--

-- --------------------------------------------------------

INSERT INTO `animal` (`animal_id`, `habitat_id`, `prenom`, `race`, `image_url`) VALUES
(19, 7, 'Babar', 'Elephant', 'http://localhost:3000/Images/Animaux/Savane/Elephant.png'),
(20, 7, 'Gifi', 'Giraphe', NULL),
(21, 7, 'Scarface', 'Lion', 'http://localhost:3000/Images/Animaux/Savane/Lion.png'),
(22, 7, 'Rhinov', 'Rhinocéros', 'http://localhost:3000/Images/Animaux/Savane/Rhino.png'),
(23, 6, 'Kong', 'Gorille', NULL),
(24, 6, 'Léon', 'Léopard', 'http://localhost:3000/Images/Animaux/Jungle/L%C3%A9opard.png'),
(25, 6, 'Pageon', 'Pangolin', NULL),
(26, 6, 'Samson', 'Tigre', 'http://localhost:3000/Images/Animaux/Jungle/Tigre.png'),
(27, 8, 'Gator', 'Alligator', 'http://localhost:3000/Images/Animaux/Marais/Alligator.png'),
(28, 8, 'Pascal', 'Pélican', 'http://localhost:3000/Images/Animaux/Marais/P%C3%A9lican.png'),
(29, 8, 'Sheldon', 'Tortue de Floride', 'http://localhost:3000/Images/Animaux/Marais/Tortue%20de%20floride.png'),
(30, 8, 'Leonardo', 'Tortue Peinte', 'http://localhost:3000/Images/Animaux/Marais/TortuePeinte.png');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`avis_id`, `pseudo`, `avis`, `validation`) VALUES
(14, 'Margot', 'johanny', 0),
(22, 'VIKTOR', 'TROP COOL LE ZOO !', 1),
(23, 'Margot', 'Très bon souvenir !', 1),
(24, 'Patricia', 'Super !', 0),
(25, 'Jean marc', 'super balade !', 1);

-- --------------------------------------------------------
--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `nom`, `description`, `image_url`) VALUES
(6, 'JUNGLE', 'Explorez notre habitat jungle au zoo, une immersion captivante au cœur de la nature exotique. Cascades mystérieuses, végétation luxuriante et cris animaux vous transportent dans un univers authentique. Rencontrez les tigres majestueux, singes espiègles et perroquets colorés dans des enclos spacieux, offrant une expérience unique de la jungle. Plongez-vous dans cette aventure immersive où la magie tropicale prend vie, comme si vous y étiez.', 'http://localhost:3000/Images/Habitats/Expliquation/jungle.png'),
(7, 'SAVANE', 'Bienvenue dans notre habitat savane au zoo, une immersion authentique dans les vastes plaines africaines. Lions majestueux, éléphants imposants et girafes gracieuses cohabitent dans des enclos spacieux recréant leurs habitats naturels. Découvrez la beauté brute de la nature, participez à des activités éducatives et vivez une expérience inoubliable au cœur de notre coin de paradis africain.', 'http://localhost:3000/Images/Habitats/Expliquation/savane.png'),
(8, 'MARAIS', 'Bienvenue dans notre habitat marais au zoo, où environnement aquatique et la végétation luxuriante créent une atmosphère unique. Explorez des enclos conçus pour nos résidents, tels que les crocodiles majestueux, les tortues paisibles et les oiseaux aquatiques élégants. Plongez dans cette aventure immersive où la magie des zones humides prend vie, comme si vous y étiez. Bienvenue dans notre coin de paradis aquatique au cœur même de notre zoo.', 'http://localhost:3000/Images/Habitats/Expliquation/marais.png');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `passage_employe`
--

INSERT INTO `passage_employe` (`passage_id`, `animal_id`, `nourriture_apportee`, `grammage_de_la_nourriture`, `date_de_passage`, `heure_de_passage`) VALUES
(16, 19, 'string', 'string', '2024-02-06', 'string'),
(18, 20, 'test', 'test', '2024-02-13', '12:34'),
(19, 20, 'test', 'test', '2024-02-14', '12:34'),
(20, 20, 'ttttt', 'tttttttt', '2024-02-16', '11:11'),
(21, 20, 'test', 'test', '2024-02-15', '11:01'),
(22, 20, 'test', 'test', '2024-02-16', '11:01'),
(23, 20, 'test', 'test', '2024-02-15', '11:01'),
(24, 26, 'ZZZZ', 'ZZZZZZ', '2024-02-14', '11:11'),
(25, 24, 'POULET', '500G', '2024-04-09', '10:34');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`) VALUES
(4, 'Restauration', 'Dégustez des plaisirs culinaires uniques dans notre restaurant au cœur du zoo.'),
(5, 'Visite guidée', 'Visitez les habitats avec un guide (gratuit).'),
(6, 'Tour de train', 'Explorez le zoo avec style à bord de notre petit train, une aventure pittoresque en mouvement.');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `updated_at`, `api_token`) VALUES
(12, 'Employe_Arcadia@email.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$oAL6PjQmRNI2CgB9hEWtTegMCCgNSARvsB9q.nEKbIPPTabWrk.pm', '2024-02-04 19:30:17', NULL, '8780da1eaaff3ea9f88b147da3ae7d7eb44850d4'),
(13, 'Admin_Arcadia@email.com', '[\"ROLE_ADMIN\"]', '$2y$13$oe2QvK57Hu.5bCr9qO/kw.7DMKnolOi4nOcYnTtbnlhTMGwnm0HTS', '2024-02-04 19:30:38', NULL, 'd7362a4063fddc09c7178131c1c7675bbf119067'),
(14, 'Veterinaire_Arcadia@email.com', '[\"ROLE_VETERINAIRE\"]', '$2y$13$bDJZLMlODfxEEf.JhXkVEeh/2qqn7OvYDOCGT3B7jyqCVAWc61Fe.', '2024-02-04 19:30:58', NULL, '4d8727a794bafdb2891dfbe8ade7e0b8c96a5d98');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `visite_veterinaire`
--

INSERT INTO `visite_veterinaire` (`visite_id`, `animal_id`, `etat_animal`, `nourriture_proposee`, `grammage_nourriture`, `date_passage`, `detail_etat_animal`, `nom_veterinaire`) VALUES
(29, 19, 'Joueur', 'Salade', '10kg', '2024-02-19', NULL, 'John'),
(30, 20, 'Fatigué', 'Salade et légumes', '550g', '2024-02-19', NULL, 'John'),
(31, 21, 'En Forme', 'Poulet', '5kg', '2024-02-19', NULL, 'John'),
(32, 22, 'En bonne forme', 'Laitue', '15kg', '2024-02-17', 'Pas de commentaires particulier', 'John'),
(33, 23, 'Joueur', 'Bamboo', '1,5Kg', '2024-02-17', NULL, 'John'),
(34, 24, 'Se repose', 'Poulet', '5Kg', '2024-02-17', 'Coussinet avant-droit griffé (à vérifier dans quelques jours)', 'John'),
(35, 25, 'Calme', 'Insectes', '330g', '2024-02-17', NULL, 'John'),
(36, 26, 'Fatigué', 'Poulet', '5kg', '2024-02-17', NULL, 'John'),
(38, 27, 'Calme', 'Poulet', '3kg', '2024-02-18', NULL, 'John'),
(39, 28, 'Semble fatigué', 'Poisson', '500g', '2024-02-18', 'Potentiel blessure à aile gauche', 'John'),
(40, 29, 'Calme', 'Salade', '200g', '2024-02-18', NULL, 'John'),
(41, 30, 'Calme', 'Salade', '200g', '2024-02-18', 'Ne mange pas beaucoup', 'John'),
(42, 24, 'EN FORME', 'BOEUF', '1KG', '2024-04-08', 'Était joueur', 'Martin'),
(43, 23, 'Avait air fatigué', 'Bambou et salade', '10kg', '2024-04-14', 'Avait air fatigué, à vérifier dans une semaine', 'Martin');
