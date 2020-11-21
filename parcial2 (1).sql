-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 03:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parcial2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `IDproducto` int(11) NOT NULL,
  `calificacion` int(1) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `IP` varchar(15) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `mail`, `descripcion`, `IDproducto`, `calificacion`, `fecha`, `estado`, `IP`, `enabled`) VALUES
(1, 'AY@AY.COM', 'AY@AY.COM', 7, 3, '2020-11-14 18:53:42', 0, '::1', 1),
(2, 'asda@asda.com', 'asda@asda.com', 5, 3, '2020-11-14 19:28:30', 1, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edades`
--

CREATE TABLE `edades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edades`
--

INSERT INTO `edades` (`id`, `nombre`, `estado`, `enabled`) VALUES
(1, 'PEGI 03 - Todas las edades ', 1, 1),
(2, 'PEGI 07 - Mayores de 7 años  ', 1, 1),
(3, 'PEGI 12 - Mayores de 12 años', 1, 1),
(4, 'PEGI 16 - Mayores de 16 años', 1, 1),
(5, 'PEGI 18 - Mayores de 18 años', 1, 1),
(6, 'sdasda s', 0, 1),
(7, 'asd', 0, 1),
(8, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`id`, `nombre`, `estado`, `enabled`) VALUES
(1, 'Acción', 1, 1),
(2, 'Aventura', 1, 1),
(3, 'Deporte', 1, 1),
(4, 'Horror', 1, 1),
(5, 'Lucha', 1, 1),
(6, 'Plataformas', 1, 1),
(7, 'RPG', 1, 1),
(8, 'Shooter', 1, 1),
(9, 'sdsdsdsd', 1, 1),
(10, 'a', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genero_edades`
--

CREATE TABLE `genero_edades` (
  `idedad` int(11) NOT NULL,
  `idgen` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genero_edades`
--

INSERT INTO `genero_edades` (`idedad`, `idgen`, `enabled`) VALUES
(1, 2, 1),
(1, 3, 1),
(1, 6, 1),
(2, 6, 1),
(2, 7, 1),
(3, 2, 1),
(3, 4, 1),
(3, 5, 1),
(3, 6, 1),
(3, 7, 1),
(3, 8, 1),
(4, 1, 1),
(4, 6, 1),
(4, 7, 1),
(4, 8, 1),
(5, 1, 1),
(5, 4, 1),
(5, 5, 1),
(5, 7, 1),
(5, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `enabled`, `estado`) VALUES
(1, 'Administrador', 1, 1),
(2, 'Ventas', 1, 0),
(3, 'Entregas', 1, 0),
(10, ' test2', 0, 0),
(11, 'sadasdasd', 0, 0),
(12, 'Administrador', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perfil_permisos`
--

CREATE TABLE `perfil_permisos` (
  `id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfil_permisos`
--

INSERT INTO `perfil_permisos` (`id`, `perfil_id`, `permiso_id`, `enabled`) VALUES
(1, 9, 2, 1),
(2, 9, 3, 1),
(3, 9, 4, 1),
(19, 10, 1, 0),
(20, 10, 4, 0),
(46, 1, 1, 1),
(47, 1, 2, 1),
(48, 1, 3, 1),
(49, 1, 4, 1),
(50, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cod` varchar(40) NOT NULL,
  `seccion` varchar(100) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `cod`, `seccion`, `enabled`) VALUES
(1, 'Agregar usuarios', 'user.add', 'user', 1),
(2, 'Modificar usuarios', 'user.edit', 'user', 1),
(3, 'Borrar Usuarios', 'user.del', 'user', 1),
(4, 'Ver Usuarios', 'user.see', 'user', 1),
(5, 'Agregar Noticias', 'news.add', 'news', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plataformas`
--

CREATE TABLE `plataformas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `enabled` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plataformas`
--

INSERT INTO `plataformas` (`id`, `nombre`, `estado`, `enabled`) VALUES
(1, 'Xbox', 1, 1),
(2, 'Nintendo Switch', 1, 1),
(3, 'PS4', 1, 1),
(4, 'PC', 1, 1),
(6, 'FUNCIONA', 0, 1),
(7, 'asdaaa', 0, 1),
(8, 'aaaaaaa', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `precio` float NOT NULL,
  `destacado` tinyint(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `desarrollador` varchar(50) NOT NULL,
  `fechadelanzamiento` date NOT NULL,
  `plataforma` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  `calificacion` double(3,1) NOT NULL,
  `edad` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `estado`, `precio`, `destacado`, `stock`, `desarrollador`, `fechadelanzamiento`, `plataforma`, `genero`, `calificacion`, `edad`, `enabled`) VALUES
(1, 'Watch Dogs 2', 'Usa el hackeo como arma en el gigantesco y dinámico mundo abierto de Watch Dogs 2. En 2016 fue implementado en varias ciudades de los Estados Unidos ctOS 2.0, un avanzado sistema operativo de redes e infraestructuras urbanas diseñado para crear metrópolis más seguras y eficientes. Encarna a Marcus Holloway, un joven y brillante hacker que vive justo en el lugar donde tuvo lugar la revolución tecnológica, la bahía de San Francisco. Haz equipo con DedSec, un conocido grupo de hackers, y saca a la luz pública los peligros ocultos del sistema ctOS 2.0, el cual está ya en manos de las corruptas corporaciones y está siendo utilizado para registrar y manipular las vidas de los ciudadanos a una escala masiva. Con la toda potencia de DedSec de tu lado, no dudes en realizar el hackeo del siglo, acabar con ctOS 2.0 y devolver la libertad a quien realmente le pertenece: a la gente.', 1, 5099.99, 0, 67, 'Ubisoft Montreal', '2017-10-13', 1, 1, 4.1, 5, 0),
(2, 'The Evil Within 2', 'De la mente maestra Shinji Mikami, The Evil Within 2 es la última evolución del horror de supervivencia. El detective Sebastian Castellanos lo ha perdido todo, incluida su hija, Lily. Para salvarla, debe descender al mundo de pesadilla de STEM. Amenazas horribles surgen de cada esquina, y debe confiar en su ingenio para sobrevivir. Para su única oportunidad de redención, la única salida es entrar una vez más al mundo de pesadilla de STEM. Horribles amenazas surgen de cada esquina a medida que el mundo gira y se deforma a su alrededor. Se enfrentará Sebastián a la adversidad de frente con armas y trampas, o se escabullirá entre las sombras para sobrevivir?', 0, 5025.99, 0, 30, 'Tango Gameworks', '2017-10-13', 1, 1, 3.8, 5, 0),
(3, 'Mortal Kombat 11', 'Mortal Kombat 11, la más reciente entrega de la aclamada franquicia, te ofrece una experiencia más profunda y personalizada que nunca. Con las nuevas variantes de personaje tendrás un control sin precedentes para personalizar a tus Luchadores y hacerlos únicos. Mortal Kombat 11 incluye el juego principal y los personajes complementarios jugables: Shang Tsung, Nightwolf, Terminator T-800, Sindel, el Guasón y Spawn.', 0, 8199.99, 0, 52, 'NetherRealm Studios', '2019-04-23', 1, 5, 4.3, 5, 0),
(4, 'FIFA 20', 'En la pelota: Disfruta de más control sobre los Momentos decisivos que determinan el resultado de cada partido en FIFA 20. Elige tu objetivo y cronometra desde el primer momento. Agregue efectos variados a los tiros libres. Una nueva mecánica de apuntado te da más creatividad con las bolas muertas. Muévete con más agilidad. Atrae al defensor. Derrótalos con velocidad o habilidad. El nuevo dribbling de strafe agrega nuevas dimensiones para atacar el juego en FIFA 20. Recupere la posesión con Active Touch Tackling y nuevas animaciones que lo recompensan por el juego defensivo oportuno. Más acabado clínico cuando uno a uno. Más riesgo con voleas y tiros largos. Los disparos revisados crean más realismo frente a la portería en FIFA 20. Fuera de la pelota: Más tiempo y espacio. Más énfasis en tus 5es en la pelota. Recupéralo con un mejor apoyo defensivo de los jugadores controlados por la IA a través de un sistema de posicionamiento y abordaje revisado. Experimenta un movimiento más natural y realista en todo el campo con innovaciones en el movimiento y posicionamiento del jugador. La pelota: En el aire. En el piso. En FIFA 20, la pelota se mueve más naturalmente que nunca. El movimiento realista de la pelota con giros y rebotes más auténticos crea una experiencia de partido real en FIFA 20. Tiros de curling. Inmersión de tiros libres. Knuckleballs. Golpes crecientes por primera vez. Todo hecho posible por el nuevo Ball Motion System en FIFA 20.', 1, 5043.99, 1, 19, 'Electronic Arts', '2019-09-10', 1, 3, 4.0, 1, 1),
(5, 'Battlefield V', 'Entra en el mayor conflicto de la humanidad con Battlefield V a medida que la serie vuelve a sus raíces en una representación nunca antes vista de la Segunda Guerra Mundial. Enfréntate al multijugador en todo el mundo, Historias de guerra para un solo jugador y Tormenta de fuego - Battle royale, reinventado para Battlefield.', 1, 1779.99, 0, 40, 'EA DICE', '2018-11-20', 1, 8, 3.9, 4, 1),
(6, 'Diablo III', 'Diablo III es un videojuego de rol de 5, desarrollado por Blizzard Entertainment. u00c9sta es la continuación de Diablo II y la tercera parte de la serie que fue creada por Blizzard. Con ambiente oscuro y siniestro del Diablo original y de lo adictiva que es la experiencia de obtención de objetos. Diablo II añadió más variedad de entornos y monstruos, unas clases más diversas y varios elementos únicos que con el tiempo se convirtieron en características emblemáticas de la saga como las gemas, las runas, los conjuntos, etc. Ambos juegos cuentan con los elementos distintivos de la serie: niveles generados aleatoriamente, masacre despiadada de monstruos y acontecimientos en un mundo siempre cambiante, búsquedas únicas, montones de objetos y una historia épica sobre el cielo, el infierno, y los indefensos y heroicos humanos que se ven atrapados entre ambos mundos. Diablo III es el heredero de este legado. Hemos añadido aún más elementos al juego para expandir nuestra visión del mundo de Santuario.', 1, 3379.99, 0, 34, 'Blizzard Entertainment', '2014-08-19', 1, 7, 4.2, 4, 1),
(7, 'Call of Duty: Modern Warfare', 'Call of Duty: Modern Warfare es un videojuego de disparos en primera persona. A cargo de Infinity Ward, el estudio ha apostado por una reimaginación de MW en pleno 2019, una guerra moderna que además recupera a alguno de los personajes del Modern Warfare original como el capitán John Price. El juego de Activision alterna su 5 entre el control de las fuerzas especiales Tier 1 y un grupo de rebeldes en Afganistán, que 9 contra los terroristas.', 1, 4299.99, 1, 45, 'Activision Blizzard', '2019-10-25', 1, 8, 4.5, 5, 1),
(8, 'Red Dead Redemption 2', 'Red Dead Redemption 2 es un videojuego de mundo abierto ambientado en el corazón de América en el año 1899 y desarrollado por Rockstar, creadores de GTA V y Red Dead Redemption entre otros premiados títulos de perfil sandbox. La historia de Arthur Morgan, (no Nate Harlow héroe de Red Dead Revolver, ni tampoco John Marston, el protagonista del Redemption original) es una 6 western con una extraordinaria atmósfera y ambientación muy cuidada y centrada en la naturaleza que, además de modo individual de juego, también presenta multijugador centrado en seguir la senda de GTA Online. RDR 2 es una epopeya de vaqueros o western sólo en su envoltorio, pues como en todo juego de Rockstar, en su interior nos cuenta una hermosa y triste historia sobre gente que intenta cambiar y no siempre puede. En esta ocasión el videojuego Red Dead Redemption 2 está protagonizado por un bandolero, el mencionado Morgan, que es la mano derecha de Dutch Van der Linde, el líder de la banda de atracadores del mismo nombre, quienes se abren camino por un vasto y abrupto territorio norteamericano robando y Luchando para sobrevivir. Siguiendo la estela de Grand Theft Auto 5, el título otorga una enorme importancia a los atracos a bancos, furgones blindados y trenes, con las típicas fases de planificación, ejecución y huida que se hicieron tan populares en la 6 de Trevor, Franklin y Michael. Excepcionales gráficos, música, 5, una historia adulta, un sentimiento muy cuidado de familia para la banda de forajidos, enormes posibilidades de inter5 y de definir cómo queremos que sea nuestra historia y un mimo exquisito en la representación de los caballos son vitales en este Red Dead Redemption 2 que tiene fijada su fecha de lanzamiento en 3 y 1 para el 26 de octubre de 2018. El juego de Rockstar tiene además una vertiente multijugador al estilo de GTA Online que recibe el nombre de Red Dead Online.', 1, 4899.99, 1, 83, 'RockStar Games', '2018-10-26', 1, 1, 5.0, 5, 1),
(9, 'NBA 2K20', '2K Sports presenta NBA 2K20, un título donde la compañía norteamericana tiene como reto mantener las altas cotas de calidad del simulador de baloncesto por excelencia sobre este deporte y la NBA. Lo hará buscando volver a redefinir los límites del género con la ayuda de mejores gráficos, mecánicas más realistas, modos de juego innovadores y un control y personalización del jugador sin igual. NBA 2K20 es un videojuego de simulación de baloncesto desarrollado por Visual Concepts y publicado por 2K Sports, basado en la Asociación Nacional de Baloncesto.', 1, 4699.99, 0, 80, '2K Sports', '2019-09-06', 1, 3, 4.2, 1, 1),
(10, 'Sea of Thieves', 'Con un colorista diseño artístico y un prometedor punto de partida jugable, Rare estrena nueva IP en varios años con este Sea of Thieves, un videojuego con temática pirata a la bandera y que está centrado en el multijugador. El videojuego es una obra en la que los personajes son peligrosos piratas, que tienen que enfrentarse tanto a otros jugadores como a distintos peligros en forma de esqueletos y otros desafíos en bonitas islas tropicales y peligrosos mares picados.  Con mecánicas tan atractivas como combates con mosquete, uso de espadas y exploración de entornos para dar con tesoros mediante la resolución de diferentes acertijos y rompecabezas, Sea of Thieves, exclusivo de 1 y 4 con Windows 10, brinda un agradable cóctel de mecánicas jugables bien diferenciadas y muchos entretenimientos de todo tipo.', 1, 3589.99, 0, 68, 'Rare', '2018-03-20', 1, 2, 3.9, 3, 1),
(11, 'Animal Crossing: New Horizons', 'Animal Crossing: New Horizons supone el estreno de la exitosa saga en 2, un colorido simulador de vida que invita a los jugadores a participar en el Plan de Asentamiento en Islas Desiertas de Nook Inc. y disfrutar de una vida placentera repleta de creatividad, encanto y libertad así como, por supuesto, numerosas actividades para poder prosperar. Como primer vecino de la isla, tu deber es levantar desde cero una comunidad de vecinos, haciendo que tu vecindario sea cada vez más atractivo. Necesitarás bayas para pagar la hipoteca, un clásico de Animal Crossing, pero esta vez se integra un sistema de millas que incrementa las posibilidades jugables. Además, hacen aparición una potente recolección de materiales y fabricación de objetos, lo cual dispara la personalización de nuestro personajes, y por supuesto de la propia isla. Esta nueva entrega para 2 recupera tareas como la jardinería, la pesca, la decoración, las conversaciones con personajes encantadores y un largo etcétera. También se integra la opción de visitar otras islas y de invitar a amigos a compartir la nuestra, con la posibilidad de jugar hasta 8 jugadores simultáneos tanto en local como online.', 1, 4199.99, 1, 39, 'Nintendo', '2020-03-20', 2, 2, 4.2, 1, 1),
(12, 'Fortnite', 'Fortnite es un videojuego de Epic Games que presenta una apariencia cartoon que nos transporta a un rico mundo sandbox en el que explorar, hurgar o construir y, por último, sobrevivir. De hecho... Quieres sobrevivir a los peligros de la noche? Construye durante el día y a toda prisa una fortaleza, aún usando para ello escombros, y reza para que sea resistente. Fortnite es, básicamente, un mundo de construcción de 5, donde equipos de hasta 4 jugadores pueden explorar su mundo destruíble, reunir recursos y colaborar para construir impresionantes fuertes y armas tan alocadas como eficaces para poder sobrevivir. En el juego de Epic puedes elegir el héroe que quieras entre sus más de 100 disponibles que se encuentran divididos en cuatro clases: Soldados, Constructores, Ninjas y Trotamundos. Entre sus herramientas tenemos ejes hidráulicos, fusiles de francotirador, 10 lanzamisiles, torretas de ametralladoras y muchas más que puedes subir de nivel e ir desbloqueando. Además el juego Fortnite cuenta con una divertida modalidad llamada Fortnite Battle royale, un modo multijugador competitivo de 100 jugadores completamente gratuito con un intenso combate jugador contra jugador. También pueden comprarse buenos packs de fundadores y contenidos, eso sin contar con los abundantes contenidos extra que llegan con las actualizaciones de Fortnite cada semana.', 1, 2935.99, 0, 80, 'Epic Games', '2018-06-12', 2, 8, 2.6, 3, 1),
(13, 'Pokémon Sword', 'Pokémon Sword es la nueva generación, la octava ya, de 6s de rol basadas en esta popular franquicia de Nintendo y Game Freak, siendo además el primer videojuego de la serie principal que se estrena en una plataforma de sobremesa. Los aficionados de 2 van a poder explorar una nueva región que responde al nombre de Galar con el lanzamiento del juego en 2019. El nuevo 11 de Pokémon para 2 respeta los fundamentos de la serie principal sin perder la oportunidad de introducir nuevas opciones y retos para sorprender a los jugadores. Así, se espera con este Pokémon Sword Pokémon Shield una propuesta más enfocada al público tradicional y exigente respecto al trabajo realizado en Pokémon Lets Go, Pikachu! Eevee!', 1, 4299.99, 0, 16, 'Game Freak', '2019-11-15', 2, 7, 4.0, 2, 1),
(14, 'Pokemon Shield', 'Pokémon Shield es la nueva generación, la octava ya, de 6s de rol basadas en esta popular franquicia de Nintendo y Game Freak, siendo además el primer videojuego de la serie principal que se estrena en una plataforma de sobremesa. Los aficionados de 2 van a poder explorar una nueva región que responde al nombre de Galar con el lanzamiento del juego en 2019. El nuevo 11 de Pokémon para 2 respeta los fundamentos de la serie principal sin perder la oportunidad de introducir nuevas opciones y retos para sorprender a los jugadores. Así, se espera con este Pokémon Sword Pokémon Shield una propuesta más enfocada al público tradicional y exigente respecto al trabajo realizado en Pokémon Lets Go, Pikachu! Eevee!', 1, 4299.99, 0, 20, 'Game Freak', '2019-11-15', 2, 7, 4.0, 2, 1),
(15, 'Super Mario Party', 'Super Mario Party es un videojuego de fiesta desarrollado por Nd Cube y publicado por Nintendo. Inspirado en el clásico Mario Party, Super Mario Party trae a 2 la trepidante diversión en familia y con amigos de la exitosa y veterana saga, permitiendo disfrutar de 6s con los dos Joy-Con así como juntando dos 10 con variados resultados para la competición social. Super Mario Party incluye funciones como los dados exclusivos de cada personaje, que añaden profundidad a la Estrategia de juego. El título tiene un modo Sala de recreo de Toad en el que se juega con dos 10 2 una al lado de la otra.', 0, 4239.99, 0, 33, 'Nintendo', '2018-10-05', 2, 6, 3.5, 1, 1),
(16, 'Mario Kart 8 Deluxe', '2 ofrece una versión corregida y aumentada del memorable videojuego de conducción arcade lanzado en mayo de 2014. Con una apuesta por permitir al usuario jugar donde quiera y cuando quiera, incluso en partidas multijugador local para ocho pilotos, Mario Kart 8 Deluxe recupera los populares circuitos y personajes de la versión de Wii U y todos sus contenidos descargables así como nuevos invitados: Inkling chico e Inkling chica, de Splatoon; el Rey Boo; Huesitos y Bowsy. Entre sus añadidos también se encuentran trazados inéditos en la saga como el Parque Viaducto o el Estadio de Batalla, y el regreso de clásicos como Mansión de Luigi (GCN) y el Circuito de Batalla 1 de Super Mario Kart. El modo batalla se renueva por completo con la batalla de globos y el Bob-ombardeo. Las carreras de velocidad de Nintendo permiten ahora llevar dos objetos de forma simultánea, y presenta como reclamo un apartado gráfico más fluido y espectacular.', 1, 4254.99, 0, 92, 'Nintendo', '2017-04-28', 2, 3, 4.7, 1, 1),
(17, 'The Legend of Zelda: Breath of the Wild', 'El videojuego más grande en la historia de Nintendo, esta es la carta de presentación de The Legend of Zelda: Breath of the Wild para Wii U y Switch, una épica 6 que lleva la 5 de esta veterana franquicia a un gigantesco mundo abierto que podemos explorar con total libertad. No hay límites! Link puede coger un caballo, o cualquier otra montura, y explorar la nueva Hyrule siguiendo el orden que desee el jugador, pues la historia ya no sigue un camino lineal. Puedes talar árboles y abrir camino donde antes no lo había, buscar materias primas y crear nuevos objetos, o buscar alimentos para sobrevivir a los peligros de este mundo de fantasía que, una vez más, está amenazado por las fuerzas del mal. Hay cien santuarios desperdigados por Hyrule, y otros tantos templos o mazmorras con retos más elaborados que requieren del uso de las nuevas habilidades y armas de un Link que, paso a paso, se vuelve un guerrero más poderoso en TLoZ: Breath of the Wild. Con un estilo audiovisual que recuerda a las películas de Hayao Miyazaki y su Studio Ghibli, Zelda: Breath of the Wild es también el primer episodio de la saga que incluye voces en español. El equipo de Nintendo comandado por Eiji Aonuma y Hidemaro Fujibayashi ha creado un juego que gracias a su colorido, y el vistoso diseño de héroes y villanos, parece una película de animación japonesa.', 1, 4869.99, 0, 57, 'Nintendo', '2017-03-03', 2, 2, 4.6, 3, 1),
(18, 'Just Dance 2020', 'Just Dance 2020 es la entrega de esta conocida saga de juegos de baile que, tras 10 años de vida, se estrena en noviembre de 2019. Multitud de temas Musicales y coreografías para un juego ya clásico en el catálogo de Ubisoft. Just Dance 2020 trae consigo 40 nuevas canciones como Con Calma de Daddy Yankee Ft. Snow o Kill This Love de BLACKPINK, entre otros, así como modo cooperativo, una experiencia más personalizada gracias al sistema de recomendación mejorado, o una colección digital de etiquetas icónicas para repasar los 10 años de la franquicia.', 1, 2879.99, 0, 14, 'Ubisoft', '2019-11-05', 2, 3, 3.2, 1, 1),
(19, 'Super Smash Bros. Ultimate', 'El reconocido director Masahiro Sakurai vuelve a la carga con una nuevo videojuego de la serie de 9 Super Smash Bros. con una premisa muy especial: Super Smash Bros. Ultimate incluye todos los personajes que alguna vez aparecieron en entregas pasadas, y también unos cuantos nuevos: Inkling (Splatoon) y Ridley (Metroid) entre otros. El Smash definitivo lleva a 2 la plantilla original del Smash de N64 (Mario, Link, Donkey Kong, Samus, Pikachuu2026) y luego añade todos los vistos posteriormente como personajes desbloqueables, incluyendo aquellos que aparecieron en una sola ocasión o como DLC en el pasado; como Pichu, Ryu, Bayonetta, Cloud o Wolf. Muchos de ellos reciben algún tipo de rediseño en su daño, arsenal de movimientos o meramente estético. En total, hablamos de una plantilla de 65 Luchadores en el momento de anunciarse, contando con los personajes Gamma; pero el querido brawler 2D también presume de albergar una enorme cantidad y variedad de personajes de apoyo y escenarios. Estos últimos cuentan con una versión Omega más ambiciosa de lo visto en los Smash de 3DS y WiiU.', 0, 5029.99, 1, 71, 'Nintendo', '2018-12-07', 2, 5, 4.6, 3, 0),
(20, 'Spyro Reignited Trilogy', 'Spyro Reignited Trilogy es una edición recopilatorio y de remasterización sobre la añorada franquicia de 5 y 10 protagonizada por un simpático dragón. Esta trilogía incluye Spyro the Dragon, Riptos Rage! y Year of the Dragon y su desarrollo corre a cargo de Toys For Bob, un estudio con experiencia en el desarrollo de los videojuegos de Activision Skylanders. Spyro Reignited Trilogy garantiza al jugador poder disfrutar de 100 niveles de la saga clásica adaptada los nuevos tiempos con grandes mejoras gráficas, controles optimizados, un sonido completamente rehecho y gran jugabilidad.', 0, 4999.99, 0, 55, 'Toys For Bob', '2019-09-03', 2, 6, 4.2, 2, 0),
(21, 'Final Fantasy VII Remake', 'FF VII Remake es un videojuego de rol desarrollado y publicado por la empresa Square para la plataforma PlayStation, basado en el título clásico de culto de 1997 de Square Enix. El jugador toma en sus manos el destino de Cloud y sus amigos, luchando contra el monopolio de Shinra, una megacorporación malvada, agotando la fuerza vital del planeta.', 1, 2599.99, 1, 39, 'Square Enix', '2020-04-10', 3, 7, 4.4, 4, 1),
(22, 'Marvel\'s Spider-Man', 'Spiderman protagoniza este videojuego de 5 desarrollado por Insomniac Games, los autores de Resistance y Ratchet & Clank entre otros, en exclusiva para 3. La historia de esta 6 es totalmente original y nos pone en el rol de un Peter Parker experimentado y maduro que debe lidiar con los problemas que suponen el tener que salvar Manhattan de los peores criminales o villanos y compatibilizarlo con su vida personal. De hecho, el trepamuros de Marvel se enfrenta a varios de sus peores enemigos, poniendo a pruebas las habilidades del alter-ego más acrobático de Parker. En el espectacular Marvel Spider-Man te esperan saltos, combos de combates, carreras y acrobacias aprovechando el uso de técnicas de Parkour y muchas, muchas telarañas gestionadas por un extenso y variado sistema de combos y habilidades que ofrecen gran libertad de movimientos y posibilidades. Spiderman en PlayStation 4 cuenta con intensa 5, pero también con mecánicas de sigilo y un apartado visual impactante y muy cinematográfico para crear unas cinemáticas de auténtico infarto. El lanzamiento del videojuego de Spiderman para 3 tuvo lugar el 7 de septiembre de 2018.', 1, 2871.99, 0, 77, 'Insomniac Games', '2018-09-07', 3, 1, 4.5, 4, 1),
(23, 'Kingdom Hearts III', 'Kingdom Hearts III es la tercera entrega de la serie de 6s Kingdom Hearts, que combina personajes y escenarios de Disney y Square Enix. Dirigido por el gran Tetsuya Nomura, Kingdom Hearts 3 está protagonizado por Sora y sus amigos, quienes deben combatir por mantener el poder de la luz en contra del oscuro, frío, despiadado y malvado Maestro Xehanort. Donald, Goofy, Mickey y Sora, entre otros, forman parte de un grupo encargado de localizar a los siete guardianes de la luz; mientras que en otro Mickey y Riku deben encontrar a los antiguos portadores de las Llaves Espada. Invocaciones, transformaciones, la nueva llave espada, mucho encanto, dirección artística maravillosa y poderosa experiencia jugable son las claves de este Kingdom Hearts III desarrollado con Unreal Engine 4, que además también cuenta con escenarios y personajes de las películas Big Hero 6 o Enredados y música o banda sonora del gran Yoko Shimomura. Quieres más? También la incorporación o regreso de Roxas, el incorpóreo de Sora y número 13 dentro de la Organización XIII. Kingdom Hearts 3 es un proyecto fantástico, enorme y en el que merece la pena todo el esfuerzo invertido en su largo tiempo de desarrollo.', 1, 3496.99, 0, 76, 'Square Enix', '2018-09-07', 3, 7, 4.0, 3, 1),
(24, 'One Piece: Pirate Warriors 4', 'Una vez más los héroes y villanos de One Piece se reúnen en el campo de batalla para Luchar y combatir sin descanso en este videojuego de 5 musou desarrollado por los autores de Dynasty Warriors. Con más de 40 personajes disponibles, One Piece: Pirate Warriors 4 mejora su sistema de combate con novedades tan interesantes como los combos aéreos o golpes especiales que emulan las habilidades únicas de Monkey D. Luffy, Sanji, Jinbei y muchos otros personajes salidos de las páginas del manga de Eiichiro Oda. Pirate Warrios 4 nos permite revivir grandes batallas de la historia de One Piece como el asedio de Alabasta, o los más recientes arcos argumentales de Whole Cake y el País de Wano con Big Mom y Kaido como grandes enemigos. Frente a ellos debes Luchar en solitario, o bien junto hasta cuatro amigos más gracias al cooperativo multijugador que incluye este videojuego de Omega Force y Bandai Namco para 4, 1, 3 y 2.', 0, 3554.99, 0, 51, 'Omega Force', '2020-03-27', 3, 5, 4.0, 3, 0),
(25, 'Persona 5 Royal', 'Persona 5: Royal es la nueva versión del JRPG de Atlus de 2016, una 6 que nos pone al mando de los Ladrones Fantasma de Corazones, un grupo de héroes inadaptados, que se adentran en el Metaverso para robar los deseos distorsionados de la gente, y curar a una sociedad moderna corrompida. Una edición definitiva cargada de contenido, con dos personajes nuevos y un capítulo adicional de la trama que amplían la 6 con más horas, así como nuevas mecánicas de juego, nuevas ubicaciones con actividades, y multitud de mejoras en aspectos como la exploración, el combate y el día a día de nuestro personaje.', 1, 2599.99, 1, 68, 'P-Studio', '2020-03-31', 3, 7, 4.8, 5, 1),
(26, 'Resident Evil 3', 'Resident Evil 3 Remake es, como su nombre indica, una adaptación a los tiempos actuales de la tercera entrega numérica de la saga survivall-8 de Capcom. Con un estilo estético y jugable muy similar al del remake del segundo Resident Evil, esta revisión de Resident Evil 3 Nemesis nos devuelve a las calles de Raccoon City 20 años después del videojuego original. Mucho más volcado hacia la 5 que su predecesor, el videojuego reduce la presencia de rompecabezas y se enfoca mucho más en los combates contra los enemigos no muertos. Jill muy volcada en Nemesis, que repite su fijación enfermiza con ella, y Carlos con mucha carga de munición y un sinfín de zombies a los que aniquilar. El videojuego de Capcom, con una duración de aproximadamente cinco horas, acompaña su modo historia de un multijugador en la forma de Resident Evil Resistance. Con un multiplayer asimétrico en el que un jugador ejerce de Cerebro y trata de hacer la vida imposible al resto de jugadores supervivientes.', 1, 2999.99, 0, 36, 'Capcom', '2020-04-03', 3, 4, 4.4, 5, 1),
(27, 'Monster Hunter: World', 'Monster Hunter World supone la llegada de la saga Monster Hunter a 10 de juego como 3, 1 y 4 con una estupenda caza de monstruos made-in Capcom que nunca había lucido tan bien hasta este juego que incluye todos los elementos que hicieron grande a la franquicia, solo que añadiendo importantes novedades como nuevas especies para cazar (por ejemplo Anjanath), nuevos objetos para recolectar, la posibilidad de que los monstruos puedan Luchar entre sí aleatoriamente, un mapa totalmente conectado entre sí que mantiene la identidad entre zonas o la posibilidad de formar equipo con hasta tres cazadores con un nuevo sistema multijugador online drop-in que permite juego cooperativo interregional entre Japón y Occidente, combinando la base de jugadores por primera vez en su historia. Igual que otros Monster Hunter, este MH World cuenta con un sistema de recompensas aleatorio claro en su experiencia jugable, evitando así las controvertidas Cajas de Botín. Resumiendo: Monster Hunter World tiene espadas, armaduras, recolección de elementos, feroces bestias a las que dar caza, un mundo rico y vivo.... puro Monster Hunter pero con menos introducciones tan largas y un sistema de control muy actualizado.', 1, 3479.99, 0, 99, 'Capcom', '2018-01-26', 3, 7, 4.5, 4, 1),
(28, 'Horizon Zero Dawn', 'Horizon: Zero Dawn es un videojuego de Guerrilla Games, los creadores de la saga Killzone, que presenta un cuidado universo de fantasía con un sugerente planteamiento argumental y jugable. El juego, exclusivo de PlayStation 4 y con mejoras para 3 Pro, se ambienta en un mundo abierto en el que la naturaleza ha reclamado las ruinas de una civilización olvidada y la humanidad ya no es la especie dominante, sino unas avanzadas maquinas de origen desconocido. Cómo ha podido pasar esto? Dentro de muchos, muchos siglos los seres humanos están al borde de la extinción por una catástrofe que se convierte en uno de los mayores misterios a desentrañar por parte del propio título, y eso lleva a que los hombres deban comenzar su andadura desde cero. En estas tierras el jugador será Aloy, una joven cazadora y arquera marginada por una sociedad tribal que la llama paria y trata de apestada por su pasado. Con ella nos embarcamos en un viaje fundamental para encontrar su destino entre los restos de un pasado antiguo cargado de mil y un sugerentes secretos. Ágil, astuta y con una puntería letal, la protagonista de Horizon Zero Dawn sabe cazar a las máquinas con armas, trampas e incluso hackearlas, relacionarse o defenderse de tribus rivales de bandidos, y sobrevivir a las inclemencias de la espesura. Pero... Logrará desentrañar todos los misterios del mundo que le rodea con sus actos y decisiones? Esa es una de las partes fundamentales de un juego que cuenta exclusivamente con campaña individual, pero de cerca de 30 horas sólo para las misiones principales. Con abundantes géneros a sus espaldas y con una experiencia jugable muy variada, en la parte más puramente relacionada con la 5 mezclamos enfrentamientos cuerpo a cuerpo con la lanza de la protagonista, distintos perfiles de arco para el combate a distancia, y también muchas herramientas como ondas, trampas y todo tipo de herramientas. Sin embargo, y por muy preparada que esté la aguerrida protagonista de Horizon Zero Dawn, el sigilo también es parte capital para salir airosos de un combate mucho más exigente de lo que el perfil Triple-A de este ya abanderado de Sony parecía augurar. Además hay elementos de carácter rolero, como las cosas clásicas que encontraríamos en un 11: fabricación de objetos, mejoras para el personaje y su equipo, niveles propios y en los enemigos y muchas cosas más que ayudan a consolidar uno de los sandbox más atractivos que se han estrenado en el año 2017.', 1, 1499.99, 0, 42, 'Guerrilla Games', '2017-03-01', 3, 7, 4.5, 4, 1),
(29, 'Crash Bandicoot N. Sane Trilogy', 'Crash vuelve! La trilogía original desarrollada por Naughty Dog para PlayStation se adapta a los tiempos actuales dos décadas después por Vicarious Visions (Skylanders) en 3 bajo el nombre de Crash Bandicoot N. Sane Trilogy. Compuesto por Crash Bandicoot (1996), Cortex Strikes Back (1997) y Warped (1998), el recopilatorio Crash Bandicoot N. Sane Trilogy está a medio camino entre el remake y la remasterización, con un planteamiento de respeto al videojuego original y añadiendo nuevas opciones, sobre todo visuales.', 1, 3399.99, 0, 73, 'Vicarious Visions', '2017-06-30', 3, 6, 4.2, 2, 1),
(30, 'The Last of Us', 'The Last of Us es un videojuego desarrollado por Naugthy Dog, los creadores de Uncharted. TLoU nos presenta un escenario en el que la población ha sido diezmada por una terrible plaga, y los supervivientes se están matando entre sí por la comida y las armas. Los protagonistas son Joel, y Ellie una valiente adolescente, que deberán colaborar para sobrevivir en su peligroso viaje a través de los EE.UU. El juego se caracteriza además por hacer partícipe al jugador de emociones fuertes, con decisiones difíciles que influyen en el desarrollo de su modo historia. The Last of Us cuenta también con modo multijugador y es un juego intenso y cargado de emociones fuertes, con alto componente rejugable y una historia que te mantiene en vilo con salvajes escenas de 5. The Last of Us: Remasterizado, la remasterización para 3 incluye todos los contenidos descargables lanzados y que pule las pequeñas imperfecciones técnicas del original en PS3, ofreciendo resolución a 1080p y 60 frames por segundo.', 1, 1699.99, 0, 20, 'Naughty Dog', '2013-06-14', 3, 4, 4.8, 5, 1),
(31, 'Grand Theft Auto V', 'Cuando un joven estafador callejero, un ladrón de bancos retirado y un psicópata aterrador se ven involucrados con lo peor y más desquiciado del mundo criminal, del gobierno de los EE. UU. y de la industria del espectáculo, tendrán que llevar a cabo una serie de peligrosos golpes para sobrevivir en una ciudad implacable en la que no pueden confiar en nadie. Y mucho menos los unos en los otros. Grand Theft Auto V para 4 ofrece a los jugadores la opción de explorar el galardonado mundo de Los Santos y Blaine County con una resolución de 4K y disfrutar del juego a 60 fotogramas por segundo. El juego cuenta con múltiples y variadas opciones de personalización específicas para 4, con más de 25 ajustes configurables distintos para la calidad de las texturas, shader, teselado, antialiasing y muchos otros elementos, además de opciones de personalización del mouse y el teclado. También es posible modificar la densidad de población para controlar el tráfico de vehículos y peatones, y es compatible con dos y tres monitores, 3D y controles ´plug-and-play´. Grand Theft Auto V para 4 también incluye Grand Theft Auto Online, compatible con 30 jugadores y dos espectadores. Grand Theft Auto Online para 4 incluirá todas las mejoras y contenidos creados por Rockstar desde la fecha de lanzamiento de Grand Theft Auto Online, incluidos los modos Golpes y Adversario. La versión para 4 de Grand Theft Auto V y Grand Theft Auto Online incluye la vista en primera persona, que ofrece a los jugadores la posibilidad de explorar todos los detalles del mundo de Los Santos y Blaine County de una forma totalmente nueva.', 1, 1999.99, 1, 26, 'RockStar Games', '2013-09-17', 4, 1, 4.8, 5, 1),
(32, 'Ori and the Blind Forest', 'El bosque de Nibel está muriendo. Después de que una tormenta poderosa pone en marcha una serie de eventos devastadores, Ori debe viajar para encontrar coraje y enfrentarse a un oscuro enemigo para salvar el bosque de Nibel. Ori and the Blind Forest cuenta la historia de un joven huérfano destinado a la heroicidad, a través de un juego de 10 de 5 visualmente impresionante creado por Moon Studios. Con obras de arte pintadas a mano, actuación de personajes meticulosamente animados y una partitura totalmente orquestada, Ori and the Blind Forest explora una historia profundamente emotiva sobre el amor y el sacrificio, y la esperanza que existe en todos nosotros.', 1, 1435.99, 0, 33, 'Moon Studios', '2015-03-11', 4, 6, 4.4, 2, 1),
(33, 'Cuphead', 'Cuphead es un juego de 5 clásico estilo dispara y corre que se centra en combates contra el jefe. Inspirado en los dibujos animados de los años 30, los aspectos visual y sonoro están diseñados con esmero empleando las mismas técnicas de la época, es decir, animación tradicional a mano, fondos de acuarela y grabaciones originales de jazz. Juega como Cuphead o Mugman (en modo de un jugador o cooperativo) y cruza mundos extraños, adquiere nuevas armas, aprende poderosos supermovimientos y descubre secretos ocultos mientras procuras saldar tu deuda con el diablo.', 1, 919.99, 0, 15, 'Studio MDHR', '2017-09-29', 4, 6, 4.4, 2, 1),
(34, 'The Witcher 3: Wild Hunt', 'The Witcher: Wild Hunt es un 11 de mundo abierto enfocado en la historia que se desarrolla en un impactante universo fantástico lleno de elecciones significativas y consecuencias impactantes. En The Witcher, juegas como el cazador de monstruos profesional Geralt de Rivia, quien tiene la tarea de encontrar a la Niña de la profecía en un vasto mundo abierto lleno de ciudades mercantiles, islas piratas, peligrosos pasos montañosos y cavernas olvidadas a la espera de un explorador.', 1, 2479.99, 1, 60, 'CD Projekt RED', '2015-05-19', 4, 7, 4.7, 5, 1),
(35, 'Portal 2', 'Portal 2 se basa en la fórmula galardonada de juego innovador, historia y música que le valió al Portal original más de 70 elogios de la industria y creó un seguimiento de culto. La parte para un jugador de Portal 2 presenta un elenco de nuevos personajes dinámicos, una serie de nuevos elementos de rompecabezas y un conjunto mucho más grande de cámaras de prueba tortuosas. Los jugadores explorarán áreas nunca antes vistas de Aperture Science Labs y se reunirán con GLaDOS, el compañero informático ocasionalmente asesino que los guió a través del juego original. El modo cooperativo para dos jugadores del juego presenta su propia campaña completamente separada con una historia única, cámaras de prueba y dos nuevos personajes jugadores. Este nuevo modo obliga a los jugadores a reconsiderar todo lo que creían saber sobre los portales. El éxito requerirá que no sólo actúen cooperativamente, sino que piensen cooperativamente.', 1, 829.99, 1, 21, 'Valve', '2011-04-18', 4, 6, 4.8, 3, 1),
(36, 'Hollow Knight', 'Debajo de la ciudad de Dirtmouth, que se desvanece, duerme un antiguo reino en ruinas. Muchos son arrastrados debajo de la superficie, buscando riquezas, gloria o respuestas a viejos secretos. Hollow Knight es una 6 de 5 2D de estilo clásico en un vasto mundo interconectado. Explora cavernas retorcidas, ciudades antiguas y desechos mortales; 9 contra criaturas contaminadas y hazte amigo de bichos extraños; y resuelve misterios antiguos en el corazón del reino. El mundo de Hollow Knight cobra vida con detalles vívidos, sus cavernas están llenas de criaturas extrañas y terroríficas, cada una animada a mano en un estilo 2D tradicional. Cada nueva área que descubrirás es maravillosamente única y extraña, repleta de nuevas criaturas y personajes. Contempla las vistas y descubre nuevas maravillas ocultas fuera de los caminos trillados. Si te gusta el juego clásico, los personajes lindos pero espeluznantes, la 6 épica y los hermosos mundos góticos, Hollow Knight te espera!', 1, 679.99, 0, 19, 'Team Cherry', '2017-02-24', 4, 6, 4.3, 2, 1),
(37, 'Star Wars Jedi: Fallen Order', 'Te espera una 6 por toda la galaxia en Star Wars Jedi: La Orden caída, un título de 5 en Tercera persona de Respawn Entertainment. Se trata de un juego de un solo jugador con una historia en la que te metes en la piel de un Padawan Jedi que logró escapar de milagro de la purga de la Orden 66 luego de los acontecimientos del Episodio 3: La venganza de los Sith. Tu misión es reconstruir la Orden Jedi y, para ello, tienes que recuperarte de tu tortuoso pasado para completar tu entrenamiento, desarrollar nuevas habilidades poderosas de la Fuerza y dominar el arte de la 9 con el legendario sable de luz. Y debes hacerlo manteniéndote siempre un paso adelante del Imperio y sus mortíferos Inquisidores. Mientras dominan sus habilidades, los jugadores se verán envueltos en combates de la Fuerza y sables de luz con un fuerte componente cinemático que busca transmitir la intensidad de las batallas con sable de luz de las películas de Star Wars. Tendrán que enfrentar al enemigo estratégicamente, evaluando sus fortalezas y debilidades, mientras utilizan con astucia su entrenamiento Jedi para superar a sus rivales y resolver los misterios que se les presentan en el camino. Los fanáticos de Star Wars reconocerán los legendarios enemigos, ubicaciones, armas y trajes y, al mismo tiempo, se encontrarán con un conjunto de personajes, ubicaciones, criaturas, droides y adversarios nuevos en el universo de Star Wars. Como parte de esta auténtica historia de Star Wars, los jugadores se adentrarán en una galaxia que ha sido recientemente ocupada por el Imperio. Como héroes Jedi devenidos en fugitivos, deberán Luchar para sobrevivir mientras exploran los misterios de una civilización extinta para intentar reconstruir la Orden Jedi a partir de sus vestigios, mientras el Imperio busca eliminar a los Jedi por completo.', 1, 2699.99, 0, 24, 'Respawn Entertainment', '2019-11-15', 4, 1, 4.0, 4, 1),
(38, 'Dragon Ball Z Kakarot', 'Prueba la historia de DRAGON BALL Z desde eventos épicos hasta misiones paralelas y tentadoras, los cuales incluyen momentos históricos nunca antes vistos que responden por primera vez a algunas preguntas candentes de la historia de DRAGON BALL! Juega a través de las icónicas peleas DRAGON BALL Z en una escala nunca antes vista. 9 en amplios campos de batalla con entornos destructibles y experimenta épicos combates de jefes contra los enemigos más emblemáticos (Raditz, Frieza, Cell, etc.). Aumenta tu nivel de potencia mediante la mecánica de los juegos de rol y acepta el desafío! No solo pelea como los guerreros Z. Vive como ellos! Pesca, vuela, come, entrena y ábrete camino a través de las sagas DRAGON BALL Z, haciendo amigos y construyendo relaciones con un elenco masivo de personajes de DRAGON BALL. ', 1, 1999.99, 0, 40, 'CyberConnect2', '2020-01-16', 4, 7, 3.7, 4, 1),
(39, 'Castle Crashers', 'Ábrete paso golpeando, acuchillando y machacando hasta la victoria en esta 6 arcade en 2D de The Behemoth! Castle Crashers Incluye personajes dibujados a mano e ilustraciones visuales de alta resolución jamás vistas hasta ahora. Pueden jugar cuatro amigos en casa u online para salvar a la princesa, defiende el reino y destruir varios castillos!', 1, 299.99, 0, 64, 'The Behemoth', '2008-08-27', 4, 6, 3.8, 4, 1),
(40, 'Don\'t Starve', 'Don\'t Starve es un implacable juego de supervivencia en la naturaleza repleto de ciencia y magia. Juegas como Wilson, un intrépido caballero científico que ha sido atrapado por un demonio y transportado a un misterioso mundo en estado salvaje. Wilson deberá aprender a explotar su entorno y a sus habitantes si quiere albergar alguna esperanza de escapar y encontrar la forma de regresar a casa. Entra en un mundo extraño e inexplorado repleto de misteriosas criaturas, peligros y sorpresas. Recolecta recursos para fabricar objetos y estructuras que se adapten a tu estilo de supervivencia. Juega a tu manera mientras desentrañas los misterios de esta inhóspita tierra.', 1, 829.99, 0, 25, 'Klei Entertainment', '2013-04-23', 4, 4, 4.0, 3, 1),
(41, 'FUNCIONA', 'FUNCIONA', 1, 0, 1, 54, 'FUNCIONA', '2020-11-10', 2, 6, 0.0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `salt` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `usuario`, `clave`, `email`, `activo`, `salt`, `enabled`) VALUES
(1, 'Admin', 'Sistema', 'admin', '207acd61a3c1bd506d7e9a4535359f8a', 'admin@carrito.com', 1, 'salt', 1),
(2, '', '', '', '21fcde4907c9733e1347cb7efb202035', '', 1, '5fb71d3602324', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_perfiles`
--

CREATE TABLE `usuarios_perfiles` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios_perfiles`
--

INSERT INTO `usuarios_perfiles` (`id`, `usuario_id`, `perfil_id`, `enabled`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edades`
--
ALTER TABLE `edades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genero_edades`
--
ALTER TABLE `genero_edades`
  ADD PRIMARY KEY (`idedad`,`idgen`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perfil_permisos`
--
ALTER TABLE `perfil_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `usuarios_perfiles`
--
ALTER TABLE `usuarios_perfiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `edades`
--
ALTER TABLE `edades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `perfil_permisos`
--
ALTER TABLE `perfil_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios_perfiles`
--
ALTER TABLE `usuarios_perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
