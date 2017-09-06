-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Ven 10 Mars 2017 à 17:13
-- Version du serveur :  5.5.41-log
-- Version de PHP :  5.6.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";

--
-- Base de données :  `ionic`
--

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
`id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL COMMENT 'Nom court de l''action qui necessite une verification de droits',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `rights`
--

INSERT INTO `rights` (`id`, `action`, `description`) VALUES
(1, 'CREATE POST', 'Can create post'),
(2, 'DELETE POST', 'Can delete post'),
(3, 'UPDATE POST', 'Can update post');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'administrateur', 'High right level');

-- --------------------------------------------------------

--
-- Structure de la table `roles_rights`
--

CREATE TABLE IF NOT EXISTS `roles_rights` (
`id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_right` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table de liens entre les roles et leurs droits' AUTO_INCREMENT=15 ;

--
-- Contenu de la table `roles_rights`
--

INSERT INTO `roles_rights` (`id`, `id_role`, `id_right`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT '-1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role_id`) VALUES
(1, 'admin@admin.com', 'admin','21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `rights`
--
ALTER TABLE `rights`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `action_2` (`action`), ADD KEY `action` (`action`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles_rights`
--
ALTER TABLE `roles_rights`
 ADD PRIMARY KEY (`id`), ADD KEY `id_role` (`id_role`), ADD KEY `name_right` (`id_right`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `rights`
--
ALTER TABLE `rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `roles_rights`
--
ALTER TABLE `roles_rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `roles_rights`
--
ALTER TABLE `roles_rights`
ADD CONSTRAINT `link_right` FOREIGN KEY (`id_right`) REFERENCES `rights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `link_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
