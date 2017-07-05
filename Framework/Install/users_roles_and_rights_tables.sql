SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE IF NOT EXISTS `rights` (
`id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL COMMENT 'Nom court de l''action qui necessite une verification de droits',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `rights` (`id`, `action`, `description`) VALUES
(6, 'CREATE POST', 'Can create post'),
(7, 'DELETE POST', 'Can delete post'),
(8, 'UPDATE POST', 'Can update post');

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'administrateur', 'High right level');

CREATE TABLE IF NOT EXISTS `roles_rights` (
`id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_right` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table de liens entre les roles et leurs droits' AUTO_INCREMENT=15 ;

INSERT INTO `roles_rights` (`id`, `id_role`, `id_right`) VALUES
(12, 1, 6),
(13, 1, 7),
(14, 1, 8);

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT '-1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role_id`) VALUES
(13, 'p.mar@lidem.eu', 'pierre', '5badcaf789d3d1d09794d8f021f40f0e', 1),
(14, 'manu@sfr.com', 'manu','f13bb1bed03db9d68a7d9a48aafeec78', 1);

ALTER TABLE `rights`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `action_2` (`action`), ADD KEY `action` (`action`);

ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `roles_rights`
 ADD PRIMARY KEY (`id`), ADD KEY `id_role` (`id_role`), ADD KEY `name_right` (`id_right`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`);

ALTER TABLE `rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;

ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

ALTER TABLE `roles_rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;

ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;

ALTER TABLE `roles_rights`
ADD CONSTRAINT `link_right` FOREIGN KEY (`id_right`) REFERENCES `rights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `link_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users`
ADD CONSTRAINT `user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;