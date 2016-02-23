-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 20 Février 2016 à 13:33
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contenu` text CHARACTER SET utf8 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date`) VALUES
(1, 'Un mot pour le monde...', 'Je me sens tellement honorÃ© d''Ãªtre le premier commentaire. Tout mon travail acharnÃ© ainsi que mon dÃ©vouement ont portÃ© leurs fruits. Etre le tout premier commentaire a toujours Ã©tÃ© mon rÃªve, et je tiens Ã  remercier tous ceux qui mont aidÃ© en cours de route. Tout dabord, je tiens Ã  remercier Dieu de mavoir donnÃ© cette opportunitÃ©. Ensuite, je tiens Ã  remercier mes parents. Je tiens Ã  remercier mon chien,Kiki, qui a toujours Ã©tÃ© lÃ  pour moi, remercier aussi lÃ©cureuil qui vit dans mon jardin pour grimper aux arbres, car cela me donne linspiration dont jâ€™ai besoin tout au long de la journÃ©e. Cest un moment trÃ¨s spÃ©cial dans ma vie et je tiens Ã©galement Ã  remercier tous mes amis et ma famille qui ne sont pas mentionnÃ©s ici et qui mont Ã©galement aidÃ© durant mon parcours. Ce moment, je ne lâ€™oublierai jamais. Je viens de me rappeler quelques autres personnes ; je tiens Ã  remercier Facebook, la lumiÃ¨re de ma chambre car je ne serais pas en mesure de voir le clavier sans elle. Je remercie aussi internet pour me permettre dâ€™aller sur Facebook, ma maison parce que sans elle je serais sans-abri, et sans oublier, je tiens Ã  remercier tous les gens ici qui ont pris un moment de leur journÃ©e pour lire ce post. Je ne peux pas vous dire Ã  quel point cela me tenait Ã  coeur. Jai essayÃ© dÃªtre le premier commentaire depuis des annÃ©es, mais cela ma Ã©tÃ© impossible jusquÃ  ce jour incroyable. JespÃ¨re que ma chance va continuer, mÃªme si je nâ€™y crois pas trop. Si vous me demandez comment jâ€™ai fais, je vous rÃ©pondrai que vous pouvez tout rÃ©ussir Ã  partir du moment oÃ¹ vous y mettez toute votre Ã¢me. Pour tous les enfants qui lisent ceci, je voudrais leur dire de toujours suivre leurs rÃªves. ÃŠtre le premier commentaire, le Â« first Â» est incroyable, vraiment, merci Ã  tous. ', 0),
(16, 'Premier texte de 2016', 'Oui, beaucoup c''est bien bravo !', 1452517769),
(17, 'Avec mon chien', 'Petit tatouage pour rendre mon chien beau.', 1453811129),
(18, 'Il Ã©tait long le temps Ã  l''Ã©poque', 'Super, depuis 1970 je suis heureuse, mon blog marche du feu de dieu ! Owi ! C''est gÃ©nial ! Et pour faire djeunz je vais faire du touitteur. Hachtaguelolmdrbeaucoupderire', 1453811912);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
