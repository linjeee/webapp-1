

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `bookmark` (
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(200) NOT NULL,
  `content_id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
CREATE TABLE `commentss` (
  `id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `comment` varchar(100000) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(100000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(200) NOT NULL,
  `content_id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `admin` (
  `id` int(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;



CREATE TABLE `post` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

