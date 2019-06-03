-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jun-2019 às 22:40
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rede_social`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `invites`
--

CREATE TABLE `invites` (
  `id_invite` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invites`
--

INSERT INTO `invites` (`id_invite`, `id_sender`, `id_receiver`, `id_status`) VALUES
(1, 1, 6, 1),
(2, 2, 6, 1),
(4, 6, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `invite_status`
--

CREATE TABLE `invite_status` (
  `id_status` int(11) NOT NULL,
  `description` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invite_status`
--

INSERT INTO `invite_status` (`id_status`, `description`) VALUES
(1, 'amigo'),
(3, 'cancelado'),
(2, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `post_image` text NOT NULL,
  `post_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `post_image`, `post_text`, `created_at`) VALUES
(1, 6, 'data:image/jpeg;base64,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', 'Arriba Muchachos', '2019-05-24 19:34:35'),
(2, 7, 'asdfafdasfd', 'asdadsdsSD', '2019-05-24 22:26:44'),
(3, 1, 'asdfdasfasfd', 'dsfasfafd', '2019-05-24 22:27:16'),
(4, 6, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPu6ajGKmB-697X6lA8trMn9gRPgfWsTUKioiBZgEEjxYG5hI3sA', 'asdad', '2019-06-01 19:30:00'),
(5, 6, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPu6ajGKmB-697X6lA8trMn9gRPgfWsTUKioiBZgEEjxYG5hI3sA', 'asdad', '2019-06-02 18:37:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_likes`
--

CREATE TABLE `post_likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `post_likes`
--

INSERT INTO `post_likes` (`id_like`, `id_user`, `id_post`) VALUES
(2, 6, 3),
(3, 6, 2),
(4, 6, 4),
(5, 9, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png',
  `phone` varchar(18) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `name`, `login`, `password`, `picture`, `phone`, `created_at`) VALUES
(1, 'Ed Costa', 'edsmc', '12346', 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png', '+5571992395921', '2019-05-20 00:09:01'),
(2, 'teste', 'teste', 'teste', 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png', 'teste', '2019-05-20 01:50:51'),
(6, 'ED SANTANA MARTINS COSTA', 'edsmcosta', 'e10adc3949ba59abbe56e057f20f883e', 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png', '71992395921', '2019-05-20 02:13:05'),
(7, 'TESTE2', 'teste2', '123456', 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png', '7863436258', '2019-05-24 22:20:51'),
(8, 'teste3', 'teste3', 'teste3', 'https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png', '7863436258', '2019-06-02 00:28:15'),
(9, 'Dr Strange ', 'edsmcista', '202cb962ac59075b964b07152d234b70', 'https://pbs.twimg.com/profile_images/817369685192605696/iWkgUdBf.jpg', '7863436258', '2019-06-02 18:58:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id_invite`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_receiver` (`id_receiver`);

--
-- Indexes for table `invite_status`
--
ALTER TABLE `invite_status`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id_invite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invite_status`
--
ALTER TABLE `invite_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limitadores para a tabela `invites`
--
ALTER TABLE `invites`
  ADD CONSTRAINT `invites_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `invites_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `users` (`id_user`);

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
