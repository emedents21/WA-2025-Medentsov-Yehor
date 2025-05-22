-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2025 at 10:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wa_2025_ym_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(26, 31, 'První den jako IT projektový manažer', 'Dnes jsem zjistil, že v Excelu můžeš mít tolik záložek, kolik máš problémů. Rada na začátek: když se něco rozbije, je dobré se tvářit, že to bylo v plánu. #ITLife', '2025-05-22 18:45:57', '2025-05-22 18:45:57'),
(27, 31, 'Agile – realita vs. očekávání', 'Všude se mluví o Agile, ale v praxi? Standup začíná v 9:00, končí v 10:30 a většinou se řeší, kdo neudělal včerejší úkol. Ale pocit flexibility máme všichni!!!', '2025-05-22 18:46:32', '2025-05-22 20:14:30'),
(28, 32, 'Jak (ne)plánovat release', 'Release měl být v pátek. V pátek byl deployment, v sobotu bugfix, v neděli rollback a v pondělí porada. Poučení? Vydávat v pátek může jen ten, kdo miluje dobrodružství!', '2025-05-22 18:47:40', '2025-05-22 18:47:40'),
(29, 32, 'Velký průvodce přežitím IT projektového manažera: Od chaosu k vítězství', 'Všichni máme představu, že řízení IT projektu je hlavně o plánování, Ganttových diagramech a správě úkolů v JIRA. Realita je ale mnohem zajímavější – a někdy i zábavnější. Dovolte mi podělit se o svůj zážitek z posledního půlroku, kdy jsme s týmem vyvíjeli nový informační systém pro velkou firmu.\r\n\r\nProjekt začal klasicky: všichni byli nadšení, padaly skvělé nápady, na první meeting dorazil i CTO osobně a slíbil plnou podporu. První dva týdny jsme plánovali, kreslili diagramy a přepisovali zadání. Pak přišla první změna požadavků – a další, a další. Najednou to, co jsme naplánovali na měsíc, bylo potřeba dodat za tři týdny.\r\n\r\nPo dvou měsících jsme pochopili, že bez pravidelných standupů skončíme v chaosu. Standupy v 9:00 ráno měly být krátké, ale často se z nich stal brainstorming plný vtípků a řešení problémů, které vůbec nesouvisely s projektem (\"Kdo rozlil kávu na router?\" bylo jedním z mých oblíbených témat).', '2025-05-22 18:49:16', '2025-05-22 18:49:16'),
(30, 33, 'Co opravdu znamená slovo ‘deadline’', 'Deadline v IT není čas, kdy je úkol hotový, ale čas, kdy všichni začnou panikařit a posílat status reporty.', '2025-05-22 18:50:47', '2025-05-22 18:50:47'),
(31, 33, 'Zápisky z daily standupu', 'Daily standup je jako ranní káva – někdy nakopne, někdy přebudí až moc. Jeden kolega dnes oznámil, že splnil „něco mezi plánem a snem“. To beru jako vítězství!', '2025-05-22 18:51:07', '2025-05-22 18:51:07'),
(32, 34, 'Nejčastější věta developera', '„U mě to funguje.“ Pokud máte tuto větu v týmu víc než třikrát denně, možná je čas přemýšlet o novém testovacím prostředí !!⭐️🧃', '2025-05-22 18:55:00', '2025-05-22 20:15:00'),
(33, 34, 'Když projekt nefunguje podle plánu', 'Znáte ten pocit, když všechno běží podle plánu... a pak přijde první email od zákazníka? Od té doby mám plány ve třech verzích: optimistická, realistická a „krizová“ (ta je nejdelší).😂🤣😅', '2025-05-22 18:55:50', '2025-05-22 18:55:50'),
(34, 31, 'Waterfall v IT? Ano, ale jen na obrázku', 'Kolega chtěl řídit projekt podle Waterfall metodiky. Na konci sprintu řekl, že jediný vodopád, co zažil, byly slzy jeho týmu. #ScrumRulez 😎🤓', '2025-05-22 18:58:49', '2025-05-22 18:58:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `blog_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
