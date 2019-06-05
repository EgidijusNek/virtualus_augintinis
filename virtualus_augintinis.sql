SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualus_augintinis`
--
USE `virtualus_augintinis`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `minigames`
--

DROP TABLE IF EXISTS `minigames`;
CREATE TABLE
IF NOT EXISTS `minigames`
(
  `idMinigame` int
(11) NOT NULL AUTO_INCREMENT,
  `nomeMinigame` varchar
(50) NOT NULL,
  `pontuacao` int
(11) DEFAULT NULL,
  `idPet` int
(11) NOT NULL,
  PRIMARY KEY
(`idMinigame`),
  KEY `idPet`
(`idPet`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `minigames`
--

INSERT INTO `minigames` (`
idMinigame`,
`nomeMinigame
`, `pontuacao`, `idPet`) VALUES
(1, 'Pedra - Papel - Tesoura', 0, 1),
(2, 'Pedra - Papel - Tesoura', 0, 2),
(3, 'Pedra - Papel - Tesoura', 0, 3),
(4, 'Pedra - Papel - Tesoura', 0, 4),
(5, 'Pedra - Papel - Tesoura', 0, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE
IF NOT EXISTS `pet`
(
  `idPet` int
(11) NOT NULL AUTO_INCREMENT,
  `namePet` varchar
(100) NOT NULL,
  `happyPet` int
(100) NOT NULL,
  `hungerPet` int
(100) NOT NULL,
  `healthPet` int
(100) NOT NULL,
  `sleepPet` int
(100) NOT NULL,
  `statePet` varchar
(100) NOT NULL,
  `imagem` varchar
(100) NOT NULL,
  `idUser` int
(11) NOT NULL,
  `age` int
(11) NOT NULL,
  `weight` int
(11) NOT NULL,
  PRIMARY KEY
(`idPet`),
  KEY `idUser`
(`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE
IF NOT EXISTS `user` (
  `idUser` int
(11) NOT NULL AUTO_INCREMENT,
  `user` varchar
(50) NOT NULL,
  `password` varchar
(50) NOT NULL,
  `time` bigint
(20) NOT NULL,
  PRIMARY KEY
(`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
