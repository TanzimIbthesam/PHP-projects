-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2019 at 09:51 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms 4.2.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(2, 'Technology', 'Tanzim', 'July-28-19 16:35:24'),
(3, 'Sports', 'Tanzim', 'July-28-19 20:29:47'),
(4, 'Daily Affairs', 'Tanzim', 'July-29-19 14:42:44'),
(5, 'News', 'Tanzim', 'July-29-19 20:01:56'),
(6, 'Fashion', 'Tanzim', 'July-29-19 23:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(14, 'August-03-19 23:58:31', 'Tech Tips: How to save photos from Instagram', 'Daily Affairs', 'Tanzim', 'insta.jpg', 'Instagram is arguably one of the most popular photo-sharing app in the world. Today it is not only used for sharing memories in the form of images and videos but it is also used for dispensing news and shopping. The app is full of photos -- some we like, some we hate, some we laugh at and some we want to save. But Instagram comes with a fundamental limitation - you cannot save images (or videos) from Instagram natively from them.'),
(18, 'August-04-19 00:13:12', 'First Post updated', 'Technology', 'Tanzim', 'saikat.jpg', 'Hello World updated'),
(19, 'August-04-19 00:16:22', 'Berkshire Hathaway is sitting on a record pile of cash', 'Daily Affairs', 'Tanzim', 'berkey.jpg', 'Berkshire Hathaway Opens a New Window.  has more cash on hand than ever before, but nowhere to spend it.\r\n\r\nIn quarterly earnings Opens a New Window.  on Saturday, Warren Buffett Opens a New Window. â€™s sprawling conglomerate said it has a staggering $122 billion in cash and equivalents, a record amount, up from $112 billion in the first quarter.\r\n\r\nDespite holding so much cash â€” \"far beyond\" the level that Buffett and Vice Chairman Charlie Munger prefer â€” the company has struggled to make any major acquisitions since 2016, citing asking prices that are too high.'),
(20, 'August-04-19 00:19:03', 'Russia protests: Hundreds detained during unauthorised demonstration', 'Daily Affairs', 'Tanzim', 'russia.jpg', 'More than 600 people have been detained over an unauthorised protest in Moscow, amid reports of police violence.\r\n\r\nProtesters had gathered in the Russian capital after authorities disqualified a number of opposition candidates from standing in local elections.\r\n\r\nLeading activist Lyubov Sobol was arrested before she could reach the rally, attended by 1,500 people.\r\n\r\nVideo from the rally shows officers using their batons against demonstrators while making arrests.\r\n\r\nRussian officials initially said there had been just 30 arrests and 350 attendees.\r\n\r\nMonitoring group OVD-Info, which runs a hotline for reporting detentions, had been keeping a running toll, which rapidly jumped from a few dozen arrests to several hundred.'),
(21, 'August-04-19 00:20:55', 'Ashes first Test: Australia 124-3 and lead England by 34 runs â€“ as it happened', 'Technology', 'Tanzim', 'smith.jpg', 'Hereâ€™s Chris Woakes â€œWe are pleased to have taken three wickets, although we probably leaked a few too many runs. Youâ€™d probably say weâ€™re slightly ahead in the game. The fields werenâ€™t overly attacking. We probably didnâ€™t quite get our lengths right.â€œ[How are you gonna get Steve Smith out?] You got any ideas?! On a slow wicket like that, you need to build pressure, build pressure, build pressure and hope the batsman makes a mistake. But heâ€™s a world-class player and he makes very few mistakes. Itâ€™s a tricky one â€“ if you bowl well outside off stump, youâ€™re taking bowled and LBW out of the game. You want two guys having two plans for him so you can test him both sides of the wicket.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
