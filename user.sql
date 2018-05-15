CREATE TABLE `user` (
  `github_id` int(11) UNSIGNED NOT NULL,
  `github_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user`
  ADD PRIMARY KEY (`github_id`),
  ADD UNIQUE KEY `github_id` (`github_id`),
  ADD UNIQUE KEY `github_login` (`github_login`);
COMMIT;