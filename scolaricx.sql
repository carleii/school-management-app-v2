-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 31 mai 2022 à 19:36
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `scolaricx`
--

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id` int(11) NOT NULL,
  `matricule_apprenant` varchar(250) NOT NULL,
  `code_classe` varchar(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_apprenant` varchar(250) NOT NULL,
  `prenom_apprenant` varchar(250) NOT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `contact_parentale` varchar(250) DEFAULT NULL,
  `information_tierce` varchar(250) DEFAULT NULL,
  `pssw` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `id` int(11) NOT NULL,
  `code_classe` varchar(250) NOT NULL,
  `code_discipline` varchar(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `jour` varchar(250) NOT NULL,
  `horaire` varchar(250) NOT NULL,
  `week` varchar(250) NOT NULL,
  `lieu` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `code_classe` varchar(250) NOT NULL,
  `id_niveau` int(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `date_academique` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `nom_classe` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `scolarite` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `ini` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `pssw` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldallow`
--

CREATE TABLE `cldallow` (
  `CODE_FOLDER` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `CODE_FILE` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `CODE_ALLOW` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `READ_` smallint(6) NOT NULL,
  `WRITE_` smallint(6) NOT NULL,
  `CREATE_` smallint(6) NOT NULL,
  `DELETE_` smallint(6) NOT NULL,
  `SHARE_` smallint(1) NOT NULL,
  `DOWNLOAD_` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldchat`
--

CREATE TABLE `cldchat` (
  `ID_CHAT` int(11) NOT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `S_DATE` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CONTENT` text CHARACTER SET utf8mb4 NOT NULL,
  `FILE_PATH` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldcloud`
--

CREATE TABLE `cldcloud` (
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ID` int(11) NOT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `PSSW` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `C_DATE` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `TYPE` smallint(6) NOT NULL,
  `MATRICULE_ETABLISSEMENT` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clddelete_ff`
--

CREATE TABLE `clddelete_ff` (
  `CODE_FILE` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_FOLDER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `DATE` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldfile`
--

CREATE TABLE `cldfile` (
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_FOLDER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 DEFAULT 'null',
  `ID` int(11) NOT NULL,
  `CODE_FILE` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `SIZE` float NOT NULL,
  `STATUT` smallint(6) NOT NULL,
  `ICON` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `PATH_` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `VIEW` int(255) NOT NULL,
  `LAST_VIEW` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `LAST_WHO` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `C_DATE` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `DESCRIPTION` text CHARACTER SET utf8mb4 DEFAULT 'Any description '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldfolder`
--

CREATE TABLE `cldfolder` (
  `CODE_LIB` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_FOLDER_MANY_FOLDER_WITHIN` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `CODE_FOLDER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `NAME` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `C_DATE` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `DESCRIPTION` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `STATUT` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldlib`
--

CREATE TABLE `cldlib` (
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ID` int(11) NOT NULL,
  `CODE_LIB` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cldnotif`
--

CREATE TABLE `cldnotif` (
  `ID_NOTIF` int(11) NOT NULL,
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `LIBELLE` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `C_DATE` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `MSG` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `TYPE` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clduser_`
--

CREATE TABLE `clduser_` (
  `ID` int(11) NOT NULL,
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `F_NAME` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `L_NAME` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `PSSW` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `PSSW_R` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ROLE` int(11) NOT NULL,
  `MATRICULE_ETABLISSEMENT` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clduser_part_of_cloud`
--

CREATE TABLE `clduser_part_of_cloud` (
  `CODE_USER` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `CODE_CLOUD` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ROLE` int(1) NOT NULL,
  `BANNED` int(1) NOT NULL,
  `LAST_VIEW` varchar(128) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compta`
--

CREATE TABLE `compta` (
  `id` int(11) NOT NULL,
  `id_tranche` int(11) DEFAULT NULL,
  `matricule_apprenant` varchar(250) NOT NULL,
  `code_classe` varchar(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `montant` int(250) NOT NULL,
  `date_paiement` varchar(250) NOT NULL,
  `nom_validateur` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discipline`
--

CREATE TABLE `discipline` (
  `id` int(250) NOT NULL,
  `code_discipline` varchar(250) NOT NULL,
  `code_matiere` varchar(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_discipline` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discipline_classe`
--

CREATE TABLE `discipline_classe` (
  `id` int(11) NOT NULL,
  `code_discipline` varchar(250) DEFAULT NULL,
  `code_classe` varchar(250) DEFAULT NULL,
  `matricule_enseignant` varchar(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `heure` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `matricule_enseignant` varchar(250) NOT NULL,
  `nom_enseignant` varchar(250) NOT NULL,
  `prenom_enseignant` varchar(250) NOT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `disponibilite` varchar(250) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `pass` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `id` int(11) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_etablissement` varchar(250) NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `date_creation` varchar(250) NOT NULL,
  `statut` varchar(250) NOT NULL,
  `slogan` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(250) DEFAULT NULL,
  `director` varchar(250) NOT NULL,
  `web` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `code_examen` varchar(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_examen` varchar(250) NOT NULL,
  `periode` varchar(250) NOT NULL,
  `note_valid` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `code_matiere` varchar(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_matiere` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `nom_niveau` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `code_discipline` varchar(250) NOT NULL,
  `note` double NOT NULL DEFAULT 0,
  `code_examen` varchar(250) NOT NULL,
  `matricule_apprenant` varchar(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `matricule_utilisateur` varchar(250) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `libelle` varchar(250) NOT NULL,
  `date_operation` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom_salle` varchar(50) NOT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tranche_paiement`
--

CREATE TABLE `tranche_paiement` (
  `id` int(11) NOT NULL,
  `code_classe` varchar(50) DEFAULT NULL,
  `matricule_etablissement` varchar(250) NOT NULL,
  `date_academique` varchar(250) NOT NULL,
  `montant` varchar(250) NOT NULL,
  `echeance` varchar(250) DEFAULT NULL,
  `nom_tranche` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `matricule_utlisateur` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `nom_utilisateur` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `prenom_utilisateur` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `email_utilisateur` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `telephone_utilisateur` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `pssw` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `role` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `matricule_etablissement` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`matricule_apprenant`,`matricule_etablissement`,`date_academique`) USING BTREE,
  ADD UNIQUE KEY `unicity` (`nom_apprenant`,`prenom_apprenant`,`code_classe`) USING BTREE,
  ADD KEY `id` (`id`),
  ADD KEY `code_classe` (`code_classe`);

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_classe` (`code_classe`),
  ADD KEY `code_discipline` (`code_discipline`),
  ADD KEY `date_academique` (`date_academique`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`code_classe`) USING BTREE,
  ADD UNIQUE KEY `unicity` (`nom_classe`,`id_niveau`,`date_academique`,`matricule_etablissement`) USING BTREE,
  ADD KEY `id` (`id`) USING BTREE,
  ADD KEY `classe_ibfk_1` (`id_niveau`),
  ADD KEY `pssw` (`pssw`);

--
-- Index pour la table `cldallow`
--
ALTER TABLE `cldallow`
  ADD PRIMARY KEY (`CODE_ALLOW`),
  ADD UNIQUE KEY `CODE_FOLDER` (`CODE_FOLDER`),
  ADD UNIQUE KEY `CODE_FILE` (`CODE_FILE`),
  ADD UNIQUE KEY `CODE_CLOUD` (`CODE_CLOUD`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_all` (`ID`),
  ADD KEY `I_FK_ALLOW_FOLDER` (`CODE_FOLDER`),
  ADD KEY `I_FK_ALLOW_FILE` (`CODE_FILE`),
  ADD KEY `I_FK_ALLOW_CLOUD` (`CODE_CLOUD`);

--
-- Index pour la table `cldchat`
--
ALTER TABLE `cldchat`
  ADD PRIMARY KEY (`ID_CHAT`),
  ADD KEY `ID_CHAT` (`ID_CHAT`),
  ADD KEY `I_FK_CHAT_CLOUD` (`CODE_CLOUD`),
  ADD KEY `I_FK_CHAT_USER` (`CODE_USER`);

--
-- Index pour la table `cldcloud`
--
ALTER TABLE `cldcloud`
  ADD PRIMARY KEY (`CODE_CLOUD`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_cl` (`ID`),
  ADD KEY `I_FK_CLOUD_USER` (`CODE_USER`),
  ADD KEY `PSSW` (`PSSW`);

--
-- Index pour la table `clddelete_ff`
--
ALTER TABLE `clddelete_ff`
  ADD PRIMARY KEY (`CODE_FILE`,`CODE_USER`,`CODE_FOLDER`),
  ADD KEY `I_FK_DELETE_FF_FILE` (`CODE_FILE`),
  ADD KEY `I_FK_DELETE_FF_USER` (`CODE_USER`),
  ADD KEY `I_FK_DELETE_FF_FOLDER` (`CODE_FOLDER`);

--
-- Index pour la table `cldfile`
--
ALTER TABLE `cldfile`
  ADD PRIMARY KEY (`CODE_FILE`),
  ADD KEY `ID` (`ID`),
  ADD KEY `I_FK_FILE_USER` (`CODE_USER`),
  ADD KEY `I_FK_FILE_FOLDER` (`CODE_FOLDER`),
  ADD KEY `LAST_WHO` (`LAST_WHO`),
  ADD KEY `CODE_CLOUD` (`CODE_CLOUD`);

--
-- Index pour la table `cldfolder`
--
ALTER TABLE `cldfolder`
  ADD PRIMARY KEY (`CODE_FOLDER`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_f` (`ID`),
  ADD KEY `I_FK_FOLDER_LIB` (`CODE_LIB`),
  ADD KEY `I_FK_FOLDER_CLOUD` (`CODE_CLOUD`),
  ADD KEY `I_FK_FOLDER_USER` (`CODE_USER`),
  ADD KEY `CODE_FOLDER_MANY_FOLDER_WITHIN` (`CODE_FOLDER_MANY_FOLDER_WITHIN`);

--
-- Index pour la table `cldlib`
--
ALTER TABLE `cldlib`
  ADD PRIMARY KEY (`CODE_LIB`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_lib` (`ID`),
  ADD KEY `I_FK_LIB_USER` (`CODE_USER`);

--
-- Index pour la table `cldnotif`
--
ALTER TABLE `cldnotif`
  ADD PRIMARY KEY (`ID_NOTIF`),
  ADD KEY `ID_NOTIF` (`ID_NOTIF`),
  ADD KEY `I_FK_NOTIF_USER` (`CODE_USER`),
  ADD KEY `I_FK_NOTIF_CLOUD` (`CODE_CLOUD`);

--
-- Index pour la table `clduser_`
--
ALTER TABLE `clduser_`
  ADD PRIMARY KEY (`CODE_USER`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `clduser_part_of_cloud`
--
ALTER TABLE `clduser_part_of_cloud`
  ADD PRIMARY KEY (`CODE_USER`,`CODE_CLOUD`),
  ADD KEY `I_FK_USER_PART_OF_CLOUD_USER` (`CODE_USER`),
  ADD KEY `I_FK_USER_PART_OF_CLOUD_CLOUD` (`CODE_CLOUD`);

--
-- Index pour la table `compta`
--
ALTER TABLE `compta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricule_apprenant` (`matricule_apprenant`),
  ADD KEY `code_classe` (`code_classe`),
  ADD KEY `compta_ibfk_3` (`id_tranche`);

--
-- Index pour la table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`code_discipline`) USING BTREE,
  ADD KEY `id` (`id`),
  ADD KEY `code_matiere` (`code_matiere`);

--
-- Index pour la table `discipline_classe`
--
ALTER TABLE `discipline_classe`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `code_discipline` (`code_discipline`,`code_classe`),
  ADD KEY `code_classe` (`code_classe`),
  ADD KEY `matricule_enseignant` (`matricule_enseignant`),
  ADD KEY `matricule_etablissement` (`matricule_etablissement`,`date_academique`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`matricule_enseignant`,`matricule_etablissement`,`date_academique`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`matricule_etablissement`,`date_academique`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`code_examen`,`id`) USING BTREE,
  ADD KEY `id` (`id`),
  ADD KEY `date_academique` (`date_academique`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`code_matiere`,`matricule_etablissement`,`date_academique`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`,`matricule_etablissement`,`date_academique`) USING BTREE,
  ADD KEY `matricule_etablissement` (`matricule_etablissement`,`date_academique`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_academique` (`date_academique`),
  ADD KEY `note_ibfk_1` (`code_examen`),
  ADD KEY `note_ibfk_2` (`matricule_apprenant`),
  ADD KEY `code_discipline` (`code_discipline`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`nom_salle`),
  ADD KEY `index` (`id`),
  ADD KEY `matricule_etablissement` (`matricule_etablissement`),
  ADD KEY `date_academique` (`date_academique`);

--
-- Index pour la table `tranche_paiement`
--
ALTER TABLE `tranche_paiement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_classe` (`code_classe`),
  ADD KEY `date_academique` (`date_academique`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`matricule_utlisateur`(250),`pssw`(250)) USING BTREE,
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `email_utilisateur` (`email_utilisateur`) USING HASH;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldallow`
--
ALTER TABLE `cldallow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldchat`
--
ALTER TABLE `cldchat`
  MODIFY `ID_CHAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldcloud`
--
ALTER TABLE `cldcloud`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldfile`
--
ALTER TABLE `cldfile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldfolder`
--
ALTER TABLE `cldfolder`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldlib`
--
ALTER TABLE `cldlib`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cldnotif`
--
ALTER TABLE `cldnotif`
  MODIFY `ID_NOTIF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clduser_`
--
ALTER TABLE `clduser_`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compta`
--
ALTER TABLE `compta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `discipline_classe`
--
ALTER TABLE `discipline_classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tranche_paiement`
--
ALTER TABLE `tranche_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `apprenant_ibfk_1` FOREIGN KEY (`code_classe`) REFERENCES `classe` (`code_classe`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `calendrier_ibfk_1` FOREIGN KEY (`code_classe`) REFERENCES `classe` (`code_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendrier_ibfk_2` FOREIGN KEY (`code_discipline`) REFERENCES `discipline` (`code_discipline`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldallow`
--
ALTER TABLE `cldallow`
  ADD CONSTRAINT `FK_ALLOW_FILE` FOREIGN KEY (`CODE_FILE`) REFERENCES `cldfile` (`CODE_FILE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ALLOW_FOLDER` FOREIGN KEY (`CODE_FOLDER`) REFERENCES `cldfolder` (`CODE_FOLDER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldallow_ibfk_1` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldchat`
--
ALTER TABLE `cldchat`
  ADD CONSTRAINT `FK_CHAT_CLOUD` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldchat_ibfk_1` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldcloud`
--
ALTER TABLE `cldcloud`
  ADD CONSTRAINT `cldcloud_ibfk_1` FOREIGN KEY (`PSSW`) REFERENCES `classe` (`pssw`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `clddelete_ff`
--
ALTER TABLE `clddelete_ff`
  ADD CONSTRAINT `clddelete_ff_ibfk_1` FOREIGN KEY (`CODE_FILE`) REFERENCES `cldfile` (`CODE_FILE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clddelete_ff_ibfk_2` FOREIGN KEY (`CODE_FOLDER`) REFERENCES `cldfolder` (`CODE_FOLDER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clddelete_ff_ibfk_3` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldfile`
--
ALTER TABLE `cldfile`
  ADD CONSTRAINT `FK_FILE_FOLDER` FOREIGN KEY (`CODE_FOLDER`) REFERENCES `cldfolder` (`CODE_FOLDER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldfile_ibfk_1` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cldfile_ibfk_2` FOREIGN KEY (`LAST_WHO`) REFERENCES `clduser_` (`CODE_USER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cldfile_ibfk_3` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldfolder`
--
ALTER TABLE `cldfolder`
  ADD CONSTRAINT `FK_FOLDER_CLOUD` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FOLDER_LIB` FOREIGN KEY (`CODE_LIB`) REFERENCES `cldlib` (`CODE_LIB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldfolder_ibfk_2` FOREIGN KEY (`CODE_FOLDER_MANY_FOLDER_WITHIN`) REFERENCES `cldfolder` (`CODE_FOLDER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldfolder_ibfk_3` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldlib`
--
ALTER TABLE `cldlib`
  ADD CONSTRAINT `cldlib_ibfk_1` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cldnotif`
--
ALTER TABLE `cldnotif`
  ADD CONSTRAINT `FK_NOTIF_CLOUD` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cldnotif_ibfk_1` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `clduser_part_of_cloud`
--
ALTER TABLE `clduser_part_of_cloud`
  ADD CONSTRAINT `clduser_part_of_cloud_ibfk_1` FOREIGN KEY (`CODE_CLOUD`) REFERENCES `cldcloud` (`CODE_CLOUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clduser_part_of_cloud_ibfk_2` FOREIGN KEY (`CODE_USER`) REFERENCES `clduser_` (`CODE_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compta`
--
ALTER TABLE `compta`
  ADD CONSTRAINT `compta_ibfk_3` FOREIGN KEY (`id_tranche`) REFERENCES `tranche_paiement` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `compta_ibfk_4` FOREIGN KEY (`matricule_apprenant`) REFERENCES `apprenant` (`matricule_apprenant`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `compta_ibfk_5` FOREIGN KEY (`code_classe`) REFERENCES `classe` (`code_classe`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `discipline_ibfk_1` FOREIGN KEY (`code_matiere`) REFERENCES `matiere` (`code_matiere`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `discipline_classe`
--
ALTER TABLE `discipline_classe`
  ADD CONSTRAINT `discipline_classe_ibfk_1` FOREIGN KEY (`code_classe`) REFERENCES `classe` (`code_classe`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `discipline_classe_ibfk_2` FOREIGN KEY (`code_discipline`) REFERENCES `discipline` (`code_discipline`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `discipline_classe_ibfk_3` FOREIGN KEY (`matricule_enseignant`) REFERENCES `enseignant` (`matricule_enseignant`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`matricule_etablissement`,`date_academique`) REFERENCES `etablissement` (`matricule_etablissement`, `date_academique`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`code_examen`) REFERENCES `examen` (`code_examen`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_3` FOREIGN KEY (`code_discipline`) REFERENCES `discipline` (`code_discipline`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_4` FOREIGN KEY (`matricule_apprenant`) REFERENCES `apprenant` (`matricule_apprenant`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `tranche_paiement`
--
ALTER TABLE `tranche_paiement`
  ADD CONSTRAINT `tranche_paiement_ibfk_1` FOREIGN KEY (`code_classe`) REFERENCES `classe` (`code_classe`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
