-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 28 2024 г., 08:31
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rhythmatize`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cover_url` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `description` text NOT NULL,
  `youtube_link` text NOT NULL,
  `spotify_link` text NOT NULL,
  `apple_music_link` text NOT NULL,
  `type` enum('Single','EP','Album') NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `albums`
--

INSERT INTO `albums` (`id`, `name`, `cover_url`, `release_date`, `description`, `youtube_link`, `spotify_link`, `apple_music_link`, `type`, `artist_id`) VALUES
(1, 'One More Light', 'https://upload.wikimedia.org/wikipedia/en/b/b2/Linkin_Park%2C_One_More_Light%2C_album_art_final.jpeg', '2017-05-19', '', 'https://music.youtube.com/playlist?list=OLAK5uy_lzoqSoDPX9PH9TC6_jUP3URbLJdQXzRPo', 'https://open.spotify.com/album/5Eevxp2BCbWq25ZdiXRwYd?si=Id_EtoLkRpSt5O54tV_bpw', 'https://music.apple.com/us/album/one-more-light/1204427627', 'Album', 1),
(2, 'Lockdown session', 'https://i.scdn.co/image/ab67616d0000b2739a19b95d39db4009fd258e57', '2022-03-02', '', 'https://music.youtube.com/playlist?list=OLAK5uy_kqx_2WHQx3dsiaP8tPFBJt6A6YLHVgiu8', 'https://open.spotify.com/album/38kBJGfjhkTGqBs5EqoaMN?si=6l18PwILR-a-5SVMPYlY9w', 'https://music.apple.com/us/album/roll-the-windows-up/1612385178?i=1612385181', 'Single', 2),
(3, 'METRO BOOMIN PRESENTS SPIDER-MAN: ACROSS THE SPIDER-VERSE (SOUNDTRACK FROM AND INSPIRED BY THE MOTION PICTURE) [METROVERSE INSTRUMENTAL EDITION]', 'https://is1-ssl.mzstatic.com/image/thumb/Music116/v4/c9/ca/6b/c9ca6b51-87a9-4a13-d37f-24535687023d/23UMGIM63882.rgb.jpg/1200x1200bb.jpg', '2023-06-02', '', 'https://www.youtube.com/playlist?list=OLAK5uy_m7fOf5CrUxKlQWFUTjcyHudazeMPrazMA', 'https://open.spotify.com/album/4ocB97o3gdrIYyIwYSSwVy?si=UPSzm7_QR2WMitBg6uXuEw', 'https://music.apple.com/us/album/metro-boomin-presents-spider-man-across-the-spider/1700520936', 'Album', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `album_genres`
--

CREATE TABLE `album_genres` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `album_genres`
--

INSERT INTO `album_genres` (`id`, `album_id`, `genre_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 2, 1),
(4, 2, 2),
(5, 1, 6),
(6, 1, 5),
(7, 1, 3),
(8, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture_url` text NOT NULL,
  `banner_url` int(11) NOT NULL,
  `description` text NOT NULL,
  `youtube_link` text NOT NULL,
  `spotify_link` text NOT NULL,
  `apple_music_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `artists`
--

INSERT INTO `artists` (`id`, `name`, `picture_url`, `banner_url`, `description`, `youtube_link`, `spotify_link`, `apple_music_link`) VALUES
(1, 'Linkin Park', 'https://townsquare.media/site/366/files/2014/12/Linkin-Park.jpg?w=980&q=75', 0, 'Linkin Park is an American rock band from Agoura Hills, California. The band\'s lineup comprises vocalist/rhythm guitarist/keyboardist Mike Shinoda, lead guitarist Brad Delson, bassist Dave Farrell, DJ/turntablist Joe Hahn and drummer Rob Bourdon, with vocalist Chester Bennington also part of the band until his death. Vocalist Mark Wakefield was an early member prior to Bennington\'s recruitment. Categorized as alternative rock, Linkin Park\'s earlier music spanned a fusion of heavy metal and hip hop, while their later music features more electronica and pop elements.\r\n\r\nFormed in 1996, Linkin Park rose to international fame with their debut studio album, Hybrid Theory (2000), which became certified Diamond by the Recording Industry Association of America (RIAA). Released during the peak of the nu metal scene, the album\'s singles\' heavy airplay on MTV led the singles \"One Step Closer\", \"Crawling\" and \"In the End\" all to chart highly on the US Mainstream Rock chart. The lattermost also crossed over to the nation\'s Billboard Hot 100. Their second album, Meteora (2003), continued the band\'s success. The band explored experimental sounds on their third album, Minutes to Midnight (2007). By the end of the decade, Linkin Park was among the most successful and popular rock acts.\r\n\r\nThe band continued to explore a wider variation of musical types on their fourth album, A Thousand Suns (2010), layering their music with more electronic sounds. The band\'s fifth album, Living Things (2012), combined musical elements from all of their previous records. Their sixth album, The Hunting Party (2014), returned to a heavier rock sound, and their seventh album, One More Light (2017), was a substantially more pop-oriented record. Linkin Park went on a hiatus when longtime lead vocalist Bennington died in July 2017. In April 2022, Shinoda revealed the band was neither working on new music nor planning on touring for the foreseeable future, and have only released 20th-anniversary editions of their first two studio albums since Bennington\'s death.\r\n\r\nLinkin Park is among the best-selling bands of the 21st century and the world\'s best-selling music artists, having sold over 100 million records worldwide. They have won two Grammy Awards, six American Music Awards, two Billboard Music Awards, four MTV Video Music Awards, 10 MTV Europe Music Awards and three World Music Awards. In 2003, MTV2 named Linkin Park the sixth-greatest band of the music video era and the third-best of the new millennium. Billboard ranked Linkin Park No. 19 on the Best Artists of the Decade list. In 2012, the band was voted as the greatest artist of the 2000s in a Bracket Madness poll on VH1. In 2014, the band was declared as \"The Biggest Rock Band in the World Right Now\" by Kerrang!.', 'https://www.youtube.com/channel/UCZU9T1ceaOgwfLRq7OKFU4Q', 'https://open.spotify.com/artist/6XyY86QOPPrYVGvF9ch6wz?si=fO_R2hOWTc2-WGEzk0T9sg', 'https://music.apple.com/us/artist/linkin-park/148662'),
(2, 'Machine Gun Kelly', 'https://upload.wikimedia.org/wikipedia/commons/d/dd/Machine_Gun_Kelly_-_Rock_im_Park_2023_20.jpg', 0, 'Colson Baker (born April 22, 1990), known professionally as Machine Gun Kelly (MGK), is an American rapper, singer, songwriter, musician, and actor. He is noted for his genre duality across alternative rock with hip hop.\n\nMachine Gun Kelly released four mixtapes between 2007 and 2010 before signing with Sean Combs\' record label, Bad Boy Records. He released his debut studio album, Lace Up, in 2012, which peaked at number four on the US Billboard 200 and contained his breakout single \"Wild Boy\" (featuring Waka Flocka Flame). His second and third albums, General Admission (2015) and Bloom (2017), achieved similar commercial success; the latter included the single \"Bad Things\" (with Camila Cabello), which peaked at number 4 on the Billboard Hot 100. His fourth album, Hotel Diablo (2019), included rap rock.\n\nMachine Gun Kelly released his fifth album, Tickets to My Downfall, in 2020; it marked a complete departure from hip-hop and entry into pop-punk. It debuted at number one on the Billboard 200, the only rock album to do so that year, and contained the single \"My Ex\'s Best Friend\" (featuring blackbear), which reached number 20 on the Hot 100. Its follow-up, Mainstream Sellout (2022) also peaked the Billboard 200 and achieved similar commercial success.\n\nMachine Gun Kelly had his first starring role in the romantic drama Beyond the Lights (2014), and since appeared in the techno-thriller Nerve (2016), the horror Bird Box (2018), the comedy Big Time Adolescence and portrayed Tommy Lee in the biopic The Dirt (both 2019).', 'https://www.youtube.com/@machinegunkelly', 'https://open.spotify.com/artist/6TIYQ3jFPwQSRmorSezPxX?si=CUM6ATT6QyKQ9QZ_GLOFDA', 'https://music.apple.com/us/artist/machine-gun-kelly/465954501'),
(3, 'Metro Boomin', 'https://media.gq.com/photos/583f0b11b4fb9e3e5600cc11/16:9/w_2560%2Cc_limit/1216-GQ-MARS01-01-metro-boomin.jpg', 0, 'Leland Tyler Wayne (born September 16, 1993), known professionally as Metro Boomin, is an American record producer, record executive, and DJ. He is known for his dark production style and its influence on modern hip hop and trap. He is also notable in the music industry for his producer tags \"If Young Metro don\'t trust you, I\'m gon\' shoot you\", “Metro!” and \"Metro Boomin want some more, n*gga\", respectively spoken by frequent collaborators Future and Young Thug; additional collaborators include The Weeknd, Travis Scott, Drake, 21 Savage, Nav, and Gucci Mane.\n\nRaised in St. Louis, Wayne began his music career as a producer in 2009, at age 16; he relocated to Atlanta to attend Morehouse College in 2011 and continued to work extensively with Atlanta-based artists Future, Young Thug, 21 Savage, Gucci Mane, and Migos. Wayne gained mainstream success after producing the song \"Tuesday\" by iLoveMakonnen and Drake, which reached number 12 on the U.S. Billboard Hot 100. Wayne subsequently produced the U.S. top-20 singles \"Jumpman\" by Drake and Future and \"Low Life\" by Future featuring The Weeknd before attaining his first number one with \"Bad and Boujee\" by Migos. He followed this with \"Congratulations\" by Post Malone, \"Tunnel Vision\" by Kodak Black, \"Mask Off\" by Future, \"Bank Account\" by 21 Savage, and his second U.S. number one \"Heartless\" by The Weeknd.\n\nWayne has released the collaborations Savage Mode (2016) and Savage Mode II (2020) with 21 Savage, DropTopWop (2017) with Gucci Mane, Perfect Timing (2017) with Nav, and Double or Nothing (2017) with Big Sean. Wayne\'s debut studio album Not All Heroes Wear Capes (2018), and its follow-up, Heroes & Villains (2022), both debuted at number one on the U.S. Billboard 200. The latter of which spawned the single \"Creepin\" alongside The Weeknd and 21 Savage, which reached the top ten in several countries, including the U.S., where it peaked at number 3 on the Billboard Hot 100, becoming Metro Boomin\'s highest charting U.S. single.', 'https://www.youtube.com/@metroboomin', 'https://open.spotify.com/artist/0iEtIxbK0KxaSlF7G42ZOp?si=Q6zitn77TTidOaa0BoMU4w', 'https://music.apple.com/us/artist/metro-boomin/670534462');

-- --------------------------------------------------------

--
-- Структура таблицы `comment_albums`
--

CREATE TABLE `comment_albums` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comment_albums`
--

INSERT INTO `comment_albums` (`id`, `user_id`, `album_id`, `content`) VALUES
(1, 3, 3, 'Good Album!!!'),
(2, 2, 1, 'Best album I\'ve ever listened to');

-- --------------------------------------------------------

--
-- Структура таблицы `comment_artists`
--

CREATE TABLE `comment_artists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comment_artists`
--

INSERT INTO `comment_artists` (`id`, `user_id`, `artist_id`, `content`) VALUES
(1, 3, 3, 'Best Artist'),
(2, 2, 3, 'Good Artist!!');

-- --------------------------------------------------------

--
-- Структура таблицы `comment_tracks`
--

CREATE TABLE `comment_tracks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comment_tracks`
--

INSERT INTO `comment_tracks` (`id`, `user_id`, `track_id`, `content`) VALUES
(1, 3, 29, 'Good track'),
(2, 2, 34, 'Not that good ');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'HIP-HOP'),
(2, 'RAP'),
(3, 'POP'),
(4, 'POP ROCK'),
(5, 'ELECTRO POP'),
(6, 'ELECTRONIC ROCK');

-- --------------------------------------------------------

--
-- Структура таблицы `like_albums`
--

CREATE TABLE `like_albums` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `like_albums`
--

INSERT INTO `like_albums` (`id`, `user_id`, `album_id`) VALUES
(1, 3, 3),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `like_artists`
--

CREATE TABLE `like_artists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `like_artists`
--

INSERT INTO `like_artists` (`id`, `user_id`, `artist_id`) VALUES
(1, 3, 3),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `like_tracks`
--

CREATE TABLE `like_tracks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `like_tracks`
--

INSERT INTO `like_tracks` (`id`, `user_id`, `track_id`) VALUES
(1, 3, 16),
(2, 3, 27),
(3, 3, 34),
(4, 3, 2),
(5, 3, 33),
(6, 2, 16),
(7, 2, 17),
(8, 2, 29),
(9, 3, 27),
(10, 2, 31);

-- --------------------------------------------------------

--
-- Структура таблицы `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` varchar(5) NOT NULL,
  `spotify_link` text NOT NULL,
  `youtube_link` text NOT NULL,
  `apple_music_link` text NOT NULL,
  `lyrics` text DEFAULT NULL,
  `Explicit` enum('YES','NO') NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tracks`
--

INSERT INTO `tracks` (`id`, `name`, `time`, `spotify_link`, `youtube_link`, `apple_music_link`, `lyrics`, `Explicit`, `album_id`) VALUES
(1, 'Nobody Can Save Me', '3:46', 'https://open.spotify.com/track/3dJj6o9o1fRgrojWjailuz?si=2620d72acd08464c', 'https://music.youtube.com/watch?v=Dpe4FgGDmcA&si=tg740aUr6fzaoa5T', 'https://music.apple.com/us/album/nobody-can-save-me/1204427627?i=1204427652', 'I\'m dancing with my demons\r\n\r\nI\'m hanging off the edge\r\n\r\nStorm clouds gather beneath me\r\nWaves break above my head\r\n\r\nHeadfirst hallucination\r\nI wanna fall wide awake now\r\nYou tell me it\'s alright\r\nTell me I\'m forgiven, tonight\r\n\r\nBut nobody can save me now\r\nI\'m holding up a light\r\nI\'m chasing out the darkness inside\r\n\'Cause nobody can save me\r\n\r\nStared into this illusion\r\nFor answers yet to come\r\nI chose a false solution\r\nBut nobody proved me wrong, no\r\n\r\nHeadfirst hallucination\r\nI wanna fall wide awake\r\nWatch the ground giving way now\r\nYou tell me it\'s alright\r\nTell me I\'m forgiven, tonight\r\n\r\nBut nobody can save me now\r\nI\'m holding up a light\r\nI\'m chasing out the darkness inside\r\n\'Cause nobody can save me\r\n\r\nBeen searching somewhere out there\r\nFor what\'s been missing right here\r\nI\'ve been searching somewhere out there\r\nFor what\'s been missing right here\r\n\r\nI wanna fall wide awake now\r\nSo tell me: it\'s alright\r\nTell me I\'m forgiven, tonight\r\nAnd only I can save me now\r\n\r\nI\'m holding up a light\r\nChasing out the darkness inside\r\nAnd I don\'t wanna let you down\r\nBut only I can save me\r\n\r\nBeen searching somewhere out there\r\nFor what\'s been missing right here', 'NO', 1),
(2, 'Good Goodbye (feat. Pusha T & Stormzy)', '3:31', 'https://open.spotify.com/track/650OeHTLxZAQmb4aEbGmaA?si=41c40bcbf1ba4caa', 'https://music.youtube.com/watch?v=LPrFRMIDNQ8&si=acZBZVYjedw2Z3xW', 'https://music.apple.com/us/album/good-goodbye-feat-pusha-t-stormzy/1204427627?i=1204427653', 'So say goodbye and hit the road\r\nPack it up and disappear\r\nYou better have some place to go\r\n\'Cause you can\'t come back around here\r\nGood goodbye\r\n(Don\'t you come back no more)\r\n\r\nLive from the rhythm, it\'s\r\nSomething wild, venomous\r\nEnemies trying to read me\r\nYou\'re all looking highly illiterate\r\nBlindly forgetting if I\'m in the mix\r\nYou won\'t find an equivalent\r\nI\'ve been here killing it\r\nLonger than you\'ve been alive, you idiot\r\n\r\nAnd it makes you so mad\r\nSomebody else could be stepping in front of you\r\nAnd it makes you so mad that you\'re not the only one\r\nThere\'s more than one of you\r\nAnd you can\'t understand the fact\r\nThat it\'s over and done, hope you had fun\r\nYou\'ve got a lot to discuss on the bus\r\nHeaded back where you\'re from\r\n\r\nSo say goodbye and hit the road\r\nPack it up and disappear\r\nYou better have some place to go\r\n\'Cause you can\'t come back around here\r\nGood goodbye\r\nGood goodbye\r\nGood goodbye\r\nGood goodbye (Woo!)\r\n\r\nGoodbye, good riddance\r\nA period is after every sentence\r\nDid my time with my cellmate\r\nMaxed out so now we finished\r\nEvery day was like a hail date\r\nEvery night was like a hailstorm\r\nTook her back to my tinted windows\r\nShowin\' out, she in rare form\r\n\r\nWings up, now I\'m airborne\r\nKing Push, they got a chair for him\r\nMake way for the new queen\r\nThe old lineup, where they cheer for \'em\r\nConsequence when you ain\'t there for him\r\nWere you there for him?\r\nDid you care for him?\r\nYou were dead wrong\r\n\r\nSo say goodbye and hit the road\r\nPack it up and disappear\r\nYou better have some place to go\r\n\'Cause you can\'t come back around here\r\nGood goodbye\r\nGood goodbye\r\n(Don\'t you come back no more)\r\nGood goodbye\r\nGood goodbye\r\n(Don\'t you come back no more)\r\n\r\nYo\r\nLet me say goodbye to my demons\r\nLet me say goodbye to my past life\r\nLet me say goodbye to the darkness\r\nTell \'em that I\'d rather be here in the starlight\r\nTell \'em that I\'d rather be here where they love me\r\nTell \'em that I\'m yours this is our life\r\nAnd I still keep raising the bar like\r\nNever seen a young black brother in the chart twice\r\n\r\nGoodbye to the stereotypes\r\nYou can\'t tell my kings we can\'t\r\nMandem we\'re linking tings in parks\r\nNow I gotta tune with Linkin Park\r\nLike goodbye to my old hoe\'s\r\nGoodbye to the cold roads\r\nI can\'t die for my postcode\r\nYoung little Mike from the Gold Coast\r\nAnd now I\'m inside with my bro bro\'s\r\n\r\nSo say goodbye and hit the road (Gang)\r\nPack it up and disappear\r\nYou better have some place to go\r\n\'Cause you can\'t come back around here\r\nGood goodbye\r\nGood goodbye\r\n(Don\'t you come back no more)\r\nGood goodbye\r\nGood goodbye\r\n(Don\'t you come back no more)', 'NO', 1),
(3, 'Talking To Myself', '3:51', 'https://open.spotify.com/track/7nAfXgeHfDO50upcOjJOaq?si=aeb8f831a8244bbb', 'https://music.youtube.com/playlist?list=OLAK5uy_lzoqSoDPX9PH9TC6_jUP3URbLJdQXzRPo&si=_c30ZfklsqoiBg-t', 'https://music.apple.com/us/album/talking-to-myself/1204427627?i=1204427654', 'Tell me what I\'ve gotta do\r\nThere\'s no getting through to you\r\nThe lights are on but nobody\'s home (nobody\'s home)\r\nYou say I can\'t understand\r\nBut you\'re not giving me a chance\r\nWhen you leave me, where do you go? (Where do you go?)\r\n\r\nAll the walls that you keep building\r\nAll this time that I spent chasing\r\nAll the ways that I keep losing you\r\n\r\nThe truth is, you turn into someone else\r\nYou keep running like the sky is falling\r\nI can whisper, I can yell\r\nBut I know, yeah I know, yeah I know\r\nI\'m just talking to myself\r\nTalking to myself\r\nTalking to myself\r\nBut I know, yeah I know, yeah I know\r\nI\'m just talking to myself\r\n\r\nI admit I made mistakes\r\nBut yours might cost you everything\r\nCan\'t you hear me calling you home?\r\n\r\nAll the walls that you keep building\r\nAll this time that I spent chasing\r\nAll the ways that I keep losing you\r\n\r\nThe truth is, you turn into someone else\r\nYou keep running like the sky is falling\r\nI can whisper, I can yell\r\nBut I know, yeah I know, yeah I know\r\nI\'m just talking to myself\r\nTalking to myself\r\nTalking to myself\r\nBut I know, yeah I know, yeah I know\r\nI\'m just talking to myself\r\n\r\nAll the walls that you keep building\r\nAll this time that I spent chasing\r\nAll the ways that I keep losing you\r\n\r\nThe truth is, you turn into someone else\r\nYou keep running like the sky is falling\r\nI can whisper, I can yell\r\nBut I know, yeah I know, yeah I know\r\nI\'m just talking to myself\r\nTalking to myself\r\nTalking to myself\r\nBut I know, yeah I know, yeah I know\r\nI\'m talking to myself', 'NO', 1),
(4, 'Battle Symphony', '3:36', 'https://open.spotify.com/track/3FQCJI2t5LTbsRPfYVBSVB?si=806c732737b04c23', 'https://music.youtube.com/watch?v=4XSyasr0w8k&si=sVpcH-mVXQKQrYiu', 'https://music.apple.com/us/album/battle-symphony/1204427627?i=1204427655', 'I got a long way to go\r\nAnd a long memory\r\nI\'ve been searching for an answer\r\nAlways just out of reach\r\nBlood on the floor\r\nSirens repeat\r\nI\'ve been searching for the courage\r\nTo face my enemies\r\n\r\nWhen they turn down the lights\r\n\r\nI hear my battle symphony\r\nAll the world in front of me\r\nIf my armor breaks\r\nI\'ll fuse it back together\r\nBattle symphony\r\nPlease just don\'t give up on me\r\nAnd my eyes are wide awake\r\n\r\nFor my battle symphony\r\nFor my battle symphony\r\n\r\nThey say that I don\'t belong\r\nSay that I should retreat\r\nThat I\'m marching to the rhythm\r\nOf a lonesome defeat\r\nBut the sound of your voice\r\nPuts the pain in reverse\r\nNo surrender, no illusions\r\nAnd for better or worse\r\n\r\nWhen they turn down the lights\r\nI hear my battle symphony\r\nAll the world in front of me\r\nIf my armor breaks\r\nI\'ll fuse it back together\r\nBattle symphony\r\nPlease just don\'t give up on me\r\nAnd my eyes are wide awake\r\n\r\nIf I fall, get knocked down\r\nPick myself up off the ground\r\nIf I fall, get knocked down\r\nPick myself up off the ground\r\n\r\nWhen they turn down the lights\r\n\r\nI hear my battle symphony\r\nAll the world in front of me\r\nIf my armor breaks\r\nI\'ll fuse it back together\r\nBattle symphony\r\nPlease just don\'t give up on me\r\nAnd my eyes are wide awake\r\n\r\nFor my battle symphony\r\nFor my battle symphony', 'NO', 1),
(5, 'Invisible', '3:34', 'https://open.spotify.com/track/6OocN63GLU7NF0wHdewhID?si=e722501be1dc4152', 'https://music.youtube.com/watch?v=SosBY8BQkCc&si=4VNK3CzUvBldxQMN', 'https://music.apple.com/us/album/invisible/1204427627?i=1204427656', 'I\'ve got an aching head\r\nEchoes and buzzing noises\r\nI know the words we said\r\nBut wish I could\'ve turned our voices down\r\nThis is not black and white\r\nOnly organized confusion\r\nI\'m just trying to get it right\r\nAnd in spite of all I should\'ve done\r\n\r\nI was not mad at you\r\nI was not trying to tear you down\r\nThe words that I could\'ve used\r\nI was too scared to say out loud\r\nIf I cannot break your fall\r\nI\'ll pick you up right off the ground\r\nIf you felt invisible\r\nI won\'t let you feel that now\r\n\r\nInvisible, invisible\r\nInvisible, invisible\r\n\r\nYou didn\'t get your way\r\nAnd it\'s an empty feeling\r\nYou\'ve got a lot to say\r\nAnd you just wanna know you\'re being heard\r\nBut this is not black and white\r\nThere are no clear solutions\r\nI\'m just trying to get it right\r\nAnd in spite of all I should\'ve done\r\n\r\nI was not mad at you\r\nI was not trying to tear you down\r\nThe words that I could\'ve used\r\nI was too scared to say out loud\r\nIf I cannot break your fall\r\nI\'ll pick you up right off the ground\r\nIf you felt invisible\r\nI won\'t let you feel that now\r\n\r\nInvisible, invisible\r\nInvisible, invisible\r\n\r\nThis is not black and white\r\nThere are no clear solutions\r\nI\'m just trying to get it right\r\nAnd in spite of all I should\'ve done\r\n\r\nI was not mad at you\r\nI was not trying to tear you down\r\nThe words that I could\'ve used\r\nI was too scared to say out loud\r\nIf I cannot break your fall\r\nI\'ll pick you up right off the ground\r\nIf you felt invisible\r\nI won\'t let you feel that now\r\n\r\nInvisible, invisible\r\nInvisible, invisible\r\nInvisible, invisible\r\nInvisible, invisible', 'NO', 1),
(6, 'Heavy (feat. Kiiara)', '2:49', 'https://open.spotify.com/track/104buTcnP2AsxqB7U1FIZ4?si=37aa71a635fd4af2', 'https://music.youtube.com/watch?v=uEITghr7Rxg&si=vYtOTfkaEIRL9fsQ', 'https://music.apple.com/us/album/heavy-feat-kiiara/1204427627?i=1204427657', 'I don\'t like my mind right now\r\nStacking up problems that are so unnecessary\r\nWish that I could slow things down\r\nI wanna let go, but there\'s comfort in the panic\r\n\r\nAnd I drive myself crazy\r\nThinking everything\'s about me\r\nYeah, I drive myself crazy\r\n\'Cause I can\'t escape the gravity\r\n\r\nI\'m holding on\r\nWhy is everything so heavy?\r\nHolding on\r\nTo so much more than I can carry\r\n\r\nI keep dragging around what\'s bringing me down\r\nIf I just let go, I\'d be set free\r\nHolding on\r\nWhy is everything so heavy?\r\n\r\nYou say that I\'m paranoid\r\nBut I\'m pretty sure the world is out to get me\r\nIt\'s not like I make the choice\r\nTo let my mind stay so f*cking messy\r\n\r\nI know I\'m not the center of the universe\r\nBut you keep spinning \'round me just the same\r\nI know I\'m not the center of the universe\r\nBut you keep spinning \'round me just the same\r\n\r\nI\'m holding on\r\nWhy is everything so heavy?\r\nHolding on\r\nTo so much more than I can carry\r\n\r\nI keep dragging around what\'s bringing me down\r\nIf I just let go, I\'d be set free\r\nHolding on\r\nWhy is everything so heavy?\r\n\r\nI know I\'m not the center of the universe\r\nYou keep spinning \'round me just the same\r\nI know I\'m not the center of the universe\r\nBut you keep spinning \'round me just the same\r\n\r\nAnd I drive myself crazy\r\nThinking everything\'s about me\r\n\r\nHolding on\r\nWhy is everything so heavy?\r\nHolding on\r\nTo so much more than I can carry\r\n\r\nI keep dragging around what\'s bringing me down\r\nIf I just let go, I\'d be set free\r\n\r\nHolding on\r\nWhy is everything so heavy?\r\nWhy is everything so heavy?\r\nWhy is everything so heavy?', 'YES', 1),
(7, 'Sorry for Now', '3:23', 'https://open.spotify.com/track/34isqXjbTstbYwl2MfdzDq?si=eb6946cde6814b65', 'https://music.youtube.com/watch?v=T09cCJUzxGA&si=WyQteKe2vhRAeIa7', 'https://music.apple.com/us/album/sorry-for-now/1204427627?i=1204427658', 'Watching the wings cut through the clouds\r\nWatching the raindrops blinking red and white\r\nThinking are you back on the ground\r\nThere with a fire burning in your eyes\r\nI only halfway apologize\r\n\r\nAnd I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nSometimes things refuse to go the way we planned\r\nOh I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere will be a day that you will understand\r\nYou will understand\r\n\r\nAfter a while you may forget\r\nBut just in case the memories cross your mind\r\nYou couldn\'t know this when I left\r\nUnder the fire of your angry eyes\r\nI never wanted to say goodbye\r\n\r\nSo I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nSometimes things refuse to go the way we planned\r\nOh I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere will be a day that you will understand\r\nYou will understand\r\n\r\nYeah, stop telling \'em to pump the bass up\r\nTried to call home but nobody would wake up\r\nSwitch your time zones can\'t pick the bass up\r\nI just passed out by the time you wake up\r\nBest things come to those who wait\r\nAnd it\'s time to get pumped on any road you take\r\nDon\'t ever have a problem make no mistake\r\nI can\'t wait to come back when I\'m going away\r\n\r\nI\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere are things we have to do that we can\'t stand\r\nOh I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere will be a day that you will understand\r\nOh I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere are things we have to do that we can\'t stand\r\nOh I\'ll be sorry for now\r\nThat I couldn\'t be around\r\nThere will be a day that you will understand\r\nYou will understand\r\nYou will understand\r\nYou will understand', 'NO', 1),
(8, 'Halfway Right', '3:37', 'https://open.spotify.com/track/1KvyBpAxgllKW7bQb0GYCR?si=79fd5b3c03fb4bfb', 'https://music.youtube.com/watch?v=sffJsD_G6I4&si=N0CUReAhxnE1LE9a', 'https://music.apple.com/us/album/halfway-right/1204427627?i=1204427659', 'I scream at myself when there\'s nobody else to fight\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right\r\n\r\nUsed to get high with the dead end kids\r\nAbandoned houses where the shadows lived\r\nI never been higher than I was that night\r\nI woke up driving my car\r\n\r\nI couldn\'t see then what I see right now\r\nThe road dissolving like an empty vow\r\nCouldn\'t remember where I\'d been that night\r\nI knew I took it too far\r\n\r\nAll you said to do was slow down\r\nI remember, now I remember\r\nAll you said to do was slow down\r\nBut I was already gone\r\n\r\nI scream at myself when there\'s nobody else to fight\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right\r\nI know what I want, but it feels like I\'m paralyzed\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right (Halafway right)\r\n\r\nTold me, kid, you\'re going way too fast\r\nYou burn too bright, you know you\'ll never last\r\nIt was bullshit then, I guess it makes sense now\r\nI woke up driving my car\r\n\r\nSaid I\'d lose you if I lost control\r\nI just laughed because what do they know?\r\nHere I am standing all alone\r\nBecause I took it too far\r\n\r\nAll you said to do was slow down\r\nI remember, now I remember\r\nAll you said to do was slow down\r\nBut I was already gone\r\n\r\nI scream at myself when there\'s nobody else to fight\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right\r\nI know what I want, but it feels like I\'m paralyzed\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right (Halfway right)\r\n\r\nNa, na-na, na-na na-na-na\r\nNa-na, na-na, na, na-na\r\nNa, na-na, na-na na-na-na\r\nBut I was already gone\r\n\r\nI scream at myself when there\'s nobody else to fight\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right\r\n\r\nNa, na-na, na-na na-na-na\r\nNa-na, na-na, na, na-na\r\nNa, na-na, na-na na-na-na\r\nBut I was already gone\r\n\r\nI scream at myself when there\'s nobody else to fight\r\nI don\'t lose, I don\'t win\r\nIf I\'m wrong, then I\'m halfway right', 'NO', 1),
(9, 'One More Light', '4:15', 'https://open.spotify.com/track/3xXBsjrbG1xQIm1xv1cKOt?si=207a819ce71544fe', 'https://music.youtube.com/watch?v=H1LdQntDnFY&si=Em6oUijw2A2ShMyP', 'https://music.apple.com/us/album/one-more-light/1204427627?i=1204427660', 'Should\'ve stayed, were there signs, I ignored?\r\nCan I help you, not to hurt, anymore?\r\nWe saw brilliance, when the world, was asleep\r\nThere are things that we can have, but can\'t keep\r\n\r\nIf they say\r\nWho cares if one more light goes out?\r\nIn the sky of a million stars\r\nIt flickers, flickers\r\nWho cares when someone\'s time runs out?\r\nIf a moment is all we are\r\nWe\'re quicker, quicker\r\nWho cares if one more light goes out?\r\nWell I do\r\n\r\nThe reminders pull the floor from your feet\r\nIn the kitchen, one more chair than you need oh\r\nAnd you\'re angry, and you should be, it\'s not fair\r\nJust \'cause you can\'t see it, doesn\'t mean it, isn\'t there\r\n\r\nIf they say\r\nWho cares if one more light goes out?\r\nIn the sky of a million stars\r\nIt flickers, flickers\r\nWho cares when someone\'s time runs out?\r\nIf a moment is all we are\r\nWe\'re quicker, quicker\r\nWho cares if one more light goes out?\r\nWell I do\r\n\r\nWho cares if one more light goes out?\r\nIn the sky of a million stars\r\nIt flickers, flickers\r\nWho cares when someone\'s time runs out?\r\nIf a moment is all we are\r\nWe\'re quicker, quicker\r\nWho cares if one more light goes out?\r\nWell I do\r\n\r\nWell I do', 'NO', 1),
(10, 'Sharp Edges', '2:58', 'https://open.spotify.com/track/6c0I7CfL9ziGZN8yYkLppP?si=4312260e72b54b7a', 'https://music.youtube.com/watch?v=DEJp2UUip7U&si=6Fl0C8-bcbeAuEob', 'https://music.apple.com/us/album/sharp-edges/1204427627?i=1204427661', 'Mama always told me don\'t you run\r\nDon\'t you run with scissors, son\r\nYou\'re gonna hurt someone\r\nMama told me look before you leap\r\nAlways think before you speak, and watch the friends you keep\r\n\r\nStay along the beaten path, never listened when she said\r\n\r\nSharp edges have consequences\r\nI guess that I had to find out for myself\r\nSharp edges have consequences\r\nNow every scar is a story I can tell\r\n\r\nShould\'ve played safer from the start\r\nLoved you like a house of cards\r\nLet it fall apart\r\nBut all the things I couldn\'t understand\r\nNever could\'ve planned\r\nThey made me who I am\r\n\r\nPut your nose on paperbacks\r\nInstead of smoking cigarettes\r\nThese years you\'re never getting back\r\n\r\nStay along the beaten path, never listened when she said\r\n\r\nSharp edges have consequences\r\nI guess that I had to find out for myself\r\nSharp edges have consequences\r\nNow every scar is a story I can tell\r\n\r\nWe all fall down\r\nWe live somehow\r\nWe learn what doesn\'t kill us makes us stronger\r\nWe all fall down\r\nWe live somehow\r\nWe learn what doesn\'t kill us makes us stronger\r\n\r\nOoh\r\nStay along the beaten path, never listened when she said\r\n\r\nSharp edges have consequences\r\nI guess that I had to find out for myself\r\nSharp edges have consequences\r\nNow every scar is a story I can tell\r\n\r\nWe all fall down\r\nWe live somehow\r\nWe learn what doesn\'t kill us makes us stronger\r\nWe all fall down\r\nWe live somehow\r\nWe learn what doesn\'t kill us makes us stronger, ooh', 'NO', 1),
(11, 'roll the windows up', '3:24', 'https://open.spotify.com/track/4C8BE3t81w312DkR750OnL?si=144f82dbbf214b46', 'https://music.youtube.com/watch?v=xaoFAhPDby4&si=2XjP7Sq_2nLvsXMd', 'https://music.apple.com/us/album/roll-the-windows-up/1612385178?i=1612385181', 'Right\r\nAyy, what my homie, Mike P, say?\r\n\r\nRoll the windows up when I get in the car and I\'mma light one up\r\nHit the gas station, go and buy a cigar\r\nAnd we can smoke this blunt\r\nSpeedin\' on the Sunset Strip in the nighttime\r\nYeah, tryna get f*cked up (aye, all my smokers, ayy, light something up)\r\nRoll the windows up (roll it up right now when I)\r\nWhen I smoke and drive\r\n\r\nUh, I\'m to the grave with this\r\nI learned how to roll a joint before I shaved and sh*t (sh*t, yeah)\r\nIn seventh grade and shit\r\nI was smoking OG kush and lemon haze and sh*t\r\nBad as f*ck, I had it tucked inside my backpack in the front\r\nMy dad had found it in a month\r\nHe kicked me out, he had enough so I got up\r\nI\'m in the kitchen, baking pizza with a crust\r\nFor a paycheck I can go and spend on hella drugs, yeah\r\nSpaceships see me when I\'m up, yeah\r\n\r\nI been a martian with no Elon Musk, yeah\r\nI\'m in a party with the screw-ups and the sluts, yeah\r\nI\'m rolling papers bigger than elephant tusks, yeah (yeah)\r\nI\'m in quarantine, but the weed man pulls up here\r\nI got a hundred packs of backwoods\r\nI can spend the next four months here\r\nI spent 10K cash, I might cough up both lungs here\r\nFilled up on gas and got high, but no stunts here\r\nMask on when I\'m outside, drive fast, don\'t waste time\r\n*ss on my face time, strap on my waistline\r\n\r\nGucci, Fendi, Prada belt, hold it up, no Kreayshawn\r\nGive a f*ck about these cops, put my hood on like Trayvon\r\nAll that I know is a W over my clan, I feel like Raekwon\r\nOnly time I get an L is when I be throwin\' one up for the gang sign\r\nI been a king with the bars but now I can play the guitar and the bassline\r\nI heard them saying they doing it first, I\'m doing this sh*t for the eighth time\r\nI used to want a pool, now I\'m waking up and I got one in the backyard\r\nI break a lotta rules, so you know I be drivin\' the whip like a NASCAR\r\nNever went Hollywood, got a house in the hills, I still smack y\'all\r\nNever say no to the blunt, I smoke it \'til it\'s all the way down to the ash, y\'all\r\n\r\nI just lit a spliff blew it in a cop\'s face\r\nI just hit a switch so they couldn\'t see the plates\r\nPull up to the crib, drove past four gates (yeah)\r\nGave her half my d*ck, that was all that she could take, ay\r\nUsed both hands like she tryna say grace (ay)\r\nSaid amen, then I blessed her face (Amen)\r\nI don\'t order by the bag, I order by the crate\r\nI\'mma smoke until the suns blocked, I don\'t use drapes\r\nI was really on Cleveland selling raps on tapes\r\nI had a couple of people with me that I watch turn fake (yeah)\r\n\r\nI still keep gorillas with me, I ain\'t talking \'bout Bape\r\nI\'m a wizard with the potions, I ain\'t talking \'bout Snape, ay\r\nI put a bag in my carryon luggage I walk through the airport I\'m holding the shit\r\nSomebody else put their coke in their ass and they walking through like they holdin\' their sh*t\r\nMy boy just snuck through the metal detector and he got a pole like he ready to fish\r\nWhenever I get a Grammy, I\'m poppin\' the top and I\'m pouring a four in the whip\r\nHoly sh*t, I\'m so high, I just high fived this holiness, damn\r\nEvery shot I take, I make, it\'s like I\'m Kobe\'s wrist (whoo!)\r\nThis how I feel after a decade of me makin\' hits\r\nSo if my name ain\'t on that b*tch, you shouldn\'t make a list\r\n\r\nRoll the windows up when I get inside the car (I mean)\r\nRoll the windows down when I open up the jar (see)\r\nI\'mma call the mayor, if they tryna press a charge\r\nI\'mma mob boss, I be pullin\' strings like my guitar, yeah (yeah)\r\n\r\nRoll the windows up when I get in the car and I\'mma light one up\r\nHit the gas station, go and buy a cigar\r\nAnd we can smoke this blunt\r\nSpeedin\' on the Sunset Strip in the nighttime\r\nYeah, tryna get f*cked up, (get f*cked up, ayy) ayy\r\nRoll the windows up (roll it up right now when I)\r\nWhen I smoke and drive', 'YES', 2),
(12, 'pretty toxic revolver', '2:46', 'https://open.spotify.com/track/28SCx38ziqfg3wwhnhFmvZ?si=7424bbbb0dc242f4', 'https://music.youtube.com/watch?v=prbsTtTGmIo&si=vU8kzw6z3szIWda7', 'https://music.youtube.com/watch?v=KzpQG3_YLiE&si=SNBXk1QokUh2pWld', 'Danger, one of us just lost our savior\r\nGotta maintain when you\'re going insane, so I say this prayer\r\nDear God, why do I need this medicine to control my anger?\r\nAnd do you even exist?\r\nI\'m starting to think it\'s a myth\r\nLotta things left unsaid, lotta things left unanswered\r\nMy aunt just passed from cancer\r\nDad just got out of rehab\r\nAnd mom\'s never gonna show up, gotta grow up\r\nRide with me through the memories inside of me\r\n\'Til the nights I was hooked on the ivory\r\nHead hurting all week \'cause of bad coke\r\nThen the same week Peep overdosed, that\'s f*cked up\r\nBut I guess I lucked up\r\nAnd I feel his pain because it probably won\'t be until\r\nThe day I die that they love us\r\nBut trust, every nomination I don\'t get\r\nEvery list that I ain\'t on\r\nIs a reminder of why I wrote songs in the first place\r\nAs a way to escape where I came from\r\n\r\nThis just my pretty toxic\r\nHeavy conscience weighing on my soul\r\nSix shots in my revolver\r\nWhen I\'m on my own\r\n\r\nPlay this song\r\nOn the first day I am gone, I do not want you to cry\r\nLegends never die, I hope our story\'s told\r\nAnd the year spent on that road\r\nBefore they came to our shows\r\nWe were creating our lane, I hope they pave it in gold\r\nTake me home, somewhere I belong\r\nSomewhere foreign, looks like Dali\'s drawing\r\nYeah, isn\'t it funny that whenever you got a vision\r\nA mission and a couple of plans to go with it\r\nSomebody gotta come along mad and damage it\r\nLike a cancer that inhabits never banishes\r\nI managed to smoke five grams of cannabis\r\nAnd still keep my stamina for the fans and the goddamn cameras\r\nThat attack my stance like evangelists\r\nI said truth and they couldn\'t handle it\r\nSo when it sinks you stand in it\r\nI guess this is my Titanic\r\nWith no James Cameron to direct this draft of it\r\nJust my\r\n\r\nPretty toxic heavy conscience\r\nWeighing on my soul\r\nSix shots in my revolver\r\nWhen I\'m on my own\r\n\r\nBack against the wall\r\nIt got me anxious\r\nHelpless, frigid, cold\r\nLate nights drinking on my own\r\nNow I\'m fearless, Al Capone\r\nTo my dearest, I ain\'t gone', 'YES', 2),
(13, 'in these walls (my house) [feat. PVRIS]', '2:48', 'https://open.spotify.com/track/70R3yxMofIQpUmLUFIzA6J?si=6bc7d84cd18a4d9b', 'https://music.youtube.com/watch?v=KzpQG3_YLiE&si=8VR9Mb0yL3As6-vZ', 'https://music.apple.com/us/album/in-these-walls-my-house-feat-pvris/1612385178?i=1612385185', 'I feel you in these walls\r\nYou\'re a cold air creeping in\r\nChill me to my bones and skin\r\nI heard you down the hall\r\nBut it\'s vacant when I\'m looking in\r\nOh, who let you in?\r\nYou walk around like you own the place\r\nBut you never say anything\r\nI caught you walking straight through my walls\r\nGuess it was all my fault\r\nI think I let you in\r\n\r\nLook\r\nYou said I never wrote a song for you\r\nSo I hope this one is haunting you\r\nYou said even if it took forever\r\nThat me and you would be together\r\nAnd I never thought that you would lie\r\nSo I\'ll admit I took advantage of your precious time\r\nI\'ll admit I took advantage of you every night that I was on the road\r\nEven at home, I wouldn\'t do you right\r\nI\'ll admit it, but don\'t think for a minute\r\nI\'ma let you convince me that what we started is finished\r\nOr for a second that I wouldn\'t take a bullet to the head for you\r\nPaint the bottom of my floor red for you\r\nKissed by an angel, touched by the devil\r\nBlood from a nose, red as a rose petal\r\nI think we\'re caught up in a power trip\r\nShe my Kate Moss, I\'m her Johnny Depp\r\n\r\nLife of a fast life in the fast lane\r\nFights in the cab, nights drinkin\' champagne\r\nIce make it last, ice for the back pain\r\nWith the knife on the dash, pipe with the ashtray\r\nAnd we f*ck with the lights on, break a lamp shade\r\nDid it twice in the room, once in the matinée, oh\r\nHide all the fresh wounds like a band-aid\r\nWith the stripes on the black suits for the campaign, oh\r\nWhat a damn shame\r\nKing of the underworld, what a damn name\r\n\'Cause he killed all the other girls in the damn frame\r\nFor a queen that he never realized had fangs\r\nDamn, do you feel what I\'m sayin\'?\r\nTake a knife in the back, wanna feel my pain\r\nMake a slice to the wrist to reveal those veins\r\nI could see your face, man I feel insane\r\n\r\nNever thought that I would feel like this (Yeah)\r\nSuch a mess when I\'m in your presence\r\nI\'ve had enough, think you\'ve been making me sick\r\nGotta get you out of my system, yeah\r\nIt\'s my house\r\nI think it\'s time to get out\r\nIt\'s my soul\r\nIt isn\'t yours anymore\r\nIt\'s my house\r\nI think it\'s time to get out\r\nYeah, I think it\'s time to get out\r\n\r\nYeah, yeah, ooh, oh-oh\r\nYeah, I think it\'s time to get out', 'YES', 2),
(14, 'Annihilate (Spider-Man: Across the Spider-Verse)', '3:52', 'https://open.spotify.com/track/6bRXONmpYZQOk8kj54FaRz?si=42013a15366b45e9', 'https://music.youtube.com/watch?v=oSnag8NKak8&si=moHI7Daw9nQ4dsb_', 'https://music.apple.com/us/album/annihilate-spider-man-across-the-spider-verse/1700520936?i=1700521040', 'I just came to my senses (yeah)\r\nI stay in another dimension\r\nFear is non-existent\r\nSuit up and swing through the city (ooh) (aye)\r\nAnnihilate, I\'m wide awake, be very afraid (afraid)\r\nI\'m in my own world, give me space\r\nI\'m in my own universe, give me space (yeah)\r\n\r\nWeezy Carter, I\'m \'bout to go Peter Parker\r\nI\'m Spider-Man, if he ain\'t me, he just a creepy crawler\r\nTunechi spark the lighter, pull up in a new Ferrari spider\r\nSpider web necklace with the diamonds\r\nShe\'ll turn to Spider-Woman if I bite her\r\n\r\nI will not go back and forth with you\r\nI see you got the black widow with you\r\nYou should\'ve had a black hero with you\r\nI get an opp-arachnophobia\r\nI\'ve been litty since I flicked the lighter\r\nSince I was an itsy bitsy spider\r\nThey\'ve been tryna wash the spider out\r\nI got spiders crawlin\' out your mouth, Spider-Verse\r\n\r\nI just came to my senses (yeah)\r\nI stay in another dimension\r\nFear is non-existent\r\nSuit up and swing through the city (ooh) (aye)\r\nAnnihilate, I\'m wide awake, be very afraid (afraid)\r\nI\'m in my own world, give me space\r\nI\'m in my own universe, give me space (yeah)\r\n\r\nI\'m focused, I\'m focused (focused)\r\nI\'m chosen, I\'m golden (golden)\r\nI\'m stronger, on missions, ain\'t no foldin\', a soldier (soldier)\r\nMy vision persistent, I took the game, it\'s over (it\'s over)\r\nI made a name, it\'s global (it\'s global), my enemy pass over (hey)\r\n\r\nI took the way to the top, I had to learn to be smart (smart)\r\nI had to move with my heart, keepin\' my eyes on the part\r\n\'Cause it get evil and dark (evil and dark)\r\nWhen it come to my opponents\r\nI know how to beat \'em, I know to defeat \'em (hey)\r\nLivin\' my life by the moment\r\nSomebody callin\', somebody gon\' need \'em\r\n\r\nI just came to my senses (yeah)\r\nI stay in another dimension\r\nFear is non-existent\r\nSuit up and swing through the city (ooh) (aye)\r\nAnnihilate, I\'m wide awake, be very afraid (afraid)\r\nI\'m in my own world, give me space\r\nI\'m in my own universe, give me space (yeah)\r\n\r\nOkay, we bounce and shake, we roll and rock\r\nI got to set it straight, the block is hot\r\nSomething\'s come over me, I hit unlock\r\nAnd tell my enemies \"I\'ll never stop\"\r\nNo, no, nothing can shake me now, aye\r\nTell the block I made it now\r\nYeah, the whole town is talking out\r\nI swear, nothing can stop me now\r\n\r\nAll this boosting all my senses\r\nI won\'t start, but I finished\r\nI shoot my shot, bet I won\'t miss it\r\nOnly way to go is go the distance\r\nNothing can shake me now\r\nNothing can break me down\r\nTell the whole town, we popping now\r\nNothing can shake me now\r\n\r\nM.W.A. Music\r\nThis is unbelievable\r\nThis is the lobby\r\nOh\r\nWelcome to Spider Society', 'NO', 3),
(15, 'Am I Dreaming', '4:16', 'https://open.spotify.com/track/46631VBdAu3LkySeMIHJtd?si=c3f7cbebac854268', 'https://music.youtube.com/watch?v=dxfO0EFzOe8&si=X3LDIWAqSmSNjBIq', 'https://music.apple.com/us/album/am-i-dreaming/1700520936?i=1700521307', 'Not done fightin\', I don\'t feel I\'ve lost\r\nAm I dreamin\', is there more like us?\r\nGot me feeling like it\'s all too much\r\nI feel beaten, but I can\'t give up\r\nI\'m still fightin\' (Metro), I don\'t feel I\'ve lost\r\nAm I dreamin\', is there more like us?\r\nGot me feelin\' like it\'s all too much\r\nI feel beaten, but I can\'t give up\r\n\r\nUh, wakin\' up, feelin\' like the thankful one\r\nCount up my ones, lacin\' up my favorite 1\'s\r\nOne of a kind, one of one, the only one\r\nGot one shot and one chance to take it once\r\nKiss my mama on the forehead, \'fore I get the code red\r\n\'Cause I was born, bred to go in, toast red\r\nAnd swing by four-ten, beef patty, cornbread\r\nIn the concrete jungle, where my home is (no way)\r\nAll get focused, all range of toast is\r\nThe nickname, Mr. Keen-To-Do-the-Mostest\r\nI was livin\' down bad in my folks crib\r\nNow I\'m laughin\' to the bank and the joke is (no way)\r\nDid more things than folks did or folks get\r\nWe\'ve been gettin\' this fly since some poor kids\r\nMy rich friends and my broke friends co-exist\r\nThey love to mix and we know what it is\r\n\r\nNot done fightin\' (no way), I don\'t fear I\'ve lost\r\nAm I dreamin\', is there more like us?\r\nGot me feeling (no way), like it\'s all too much\r\nI feel beaten, but I can\'t give up\r\nI\'m still fighting (no way), I don\'t fear I\'ve lost\r\nAm I dreamin\', is there more like us?\r\nGot me feelin\' (no way), like it\'s all too much\r\nI feel beaten (no way), but I can\'t give up\r\n\r\nI can\'t find it in myself to just walk away\r\nI can\'t find it in myself to lose everything\r\nFeel everyone\'s against me, don\'t want me to be great\r\nThings might look bad, I\'m afraid to look death in the face\r\nI\'m good now (now, now, no way), who\'s really bad?\r\nI choose me now (now, now) what\'s wrong with that?\r\nWish you could see me (no way)\r\nNow, now, mm, who had my back, baby?\r\nKnow no love lost, good always will win\r\n\r\nNot done fightin\' (no way, fightin\'), I don\'t fear I\'ve lost (feel I-)\r\nAm I dreamin\' (dreamin\'), is there more like us? (More like)\r\nGot me feeling (no way, feelin\'), like it\'s all too much\r\nI feel beaten (beaten), but I can\'t give up (can\'t give-)\r\nI\'m still fighting (no way), I don\'t fear I\'ve lost\r\nAm I dreamin\', is there more like us?\r\nGot me feelin\' (no way), like it\'s all too much\r\nI feel beaten (no way), but I can\'t give up\r\n\r\nCan\'t give up\r\nCan\'t give, can\'t give up\r\nCan\'t give, can\'t give up\r\nCan\'t give, can\'t give up\r\nCan\'t give up', 'NO', 3),
(16, 'All The Way Live (Spider-Man: Across the Spider-Verse)', '4:06', 'https://open.spotify.com/track/2JHMRT2gvjh6P7ejierydm?si=5298d0e253ae423c', 'https://music.youtube.com/watch?v=hPOuX1zjbCQ&si=NSNRfK8WDSt1YqXx', 'https://music.apple.com/us/album/all-the-way-live-spider-man-across-the-spider-verse/1700520936?i=1700521329', 'Type of time you on (Metro)\r\nChanel cover, it\'s on my mother\r\nHiding the mood\r\n\r\nType of time we on\r\n(All the way live, all the way live)\r\n(All the way live, all the way live)\r\n(All the way live, all the way live)\r\n(All the way live, all the way live)\r\n\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nSeven different days, yeah\r\n365, all the way live, yeah\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\n\r\nShave my back against the wall (wall), I can\'t find no flaw (flaw, flaw)\r\nIf I ever fall, I\'ma take the fall (yeah)\r\nI can soar so high, don\'t need webs to crawl (webs to crawl)\r\nI can soar so high, don\'t need webs to crawl (soar)\r\n\r\nThe world\'s in my hand, got powers my palm (in my palm)\r\nLook over the city, \'cause I\'m on my own (own)\r\nLife can be so tricky, got my mind just gone (just gone)\r\nGot my mind (go, go)\r\n\r\nGot no time for minglin\', my senses tingling (tingling)\r\nEvery time I save the world, I think about my friends\r\nI wish that I didn\'t have to pretend\r\nBut if I take my mask off, I blend in\r\n\r\nType of time we on, type of time we on (yeah)\r\nType of time we on, type of time we on (let\'s go)\r\nSeven different days, yeah\r\n365, all the way live, yeah\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\n(All the way live, all the way live)\r\n\r\nTrackhawk with low suspension\r\nJust so we can ride revengeful\r\nHigh-performance, so expensive\r\nMy gang, we The Avengers\r\nSolitaries, like Venom\r\nToo many racks stuck in my denim\r\n\r\nAll the way live, I swear we gon\' get fast, hey\r\nAll the way live, I\'m making you a habit\r\nAll the way live, 365\r\nSeven days a week, we catchin\' a vibe\r\n\r\nType of time we on, type of time we on (yeah)\r\nType of time we on, type of time we on (let\'s go)\r\nSeven different days, yeah\r\n365, all the way live, yeah\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\nType of time we on, type of time we on\r\n\r\nGot no time for minglin\', my senses tingling\r\nEvery time I save the world, I think about my friends\r\nI wish that I didn\'t have to pretend\r\nBut if I take my mask off, I blend in\r\n\r\nYou know we\'re supposed to catch the bad guys right?\r\nI always do, usually', 'NO', 3),
(17, 'Danger', '3:26', 'https://open.spotify.com/track/4eAmJ2vhKbzzhEDRYipSC6?si=c6b7462ad38243aa', 'https://music.youtube.com/watch?v=3yazmQArT60&si=IzrJHHH9CTMywsal', 'https://music.apple.com/us/album/danger-spider/1700520936?i=1700521655', 'Spider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\n\r\n\r\nLife\'s so dangerous (Dangerous), I was made for this (Hey)\r\nI fight atheists, I\'m sayin\', I\'m sayin\' (Uh)\r\nNeed my therapist, I wasn\'t prepared for this\r\n\r\nI protect the area, life can get a little scarier (Scary)\r\nLike, the boogeyman comin\' (Boogeyman)\r\nI got the boogeyman runnin\'\r\nI had the plot, I filled up my conscience (Hey), uh\r\nSwing like a monkey (Swing), through the battles, I\'m comin\' (Comin\')\r\nSave the day on Sunday, goin\' to school on Monday (Hey)\r\nCan\'t throw in the flag, no, you can\'t quit on the job (Can\'t quit the job)\r\nMaybe the bank get robbed (Maybe the)\r\nTurn it up, break the knot (Turn it up)\r\nI gotta turn to a beast (Beast)\r\nWhen I hit play, I can\'t pause (Pause)\r\nI had to crawl up the wall (Had to crawl)\r\nI had to bite like a dog (Hey)\r\n\r\n\r\n\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\n\r\n\r\n(She\'s webbed)\r\nLook at the city, it\'s in a blaze (Woah)\r\nTell all the people to get away\r\n\r\nHeard that they let the animals out of the cage (Woah, woah)\r\nIf you sit and just listen, you hear the snakes\r\nSend me the mission, I\'m on the case\r\nTell \'em, \"Drop me the pin, I\'ma penetrate\"\r\nMe and danger on a dinner date (Danger)\r\nOh, let me demonstrate\r\nWe need somebody to come back and save it today because nobody feelin\' safe\r\nVillain put a mask on his face so it\'s no identifyin\' or savin\'\r\nSomethin\' major, somethin\' more amazin\' is on the way, ain\'t no point in waitin\'\r\nNow we gon\' see more crazy, real loud bangin\', wakin\' up babies, um\r\nAnd we gon\' see more dangerous things untanglin\', but the MAC swangin\'\r\nNow we all speakin\' my language, gotta stay strong, press on through the pain, and\r\nMake it back home, back, won\'t ever change it\r\nSay the name if you know where I\'m bangin\'\r\n\r\n\r\n\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah, danger)\r\nSpider (Danger), spider (Danger)\r\nSpider (Danger), spider (Yeah)\r\n\r\n\r\nD-D-Dangerous, dangerous\r\nD-D-Dangerous, dangerous\r\n\r\nSpider (Danger), s-s-spider\r\nD-D-Dangerous, dangerous\r\nSpider (Danger), s-s-spider\r\nD-D-Dangerous, dangerous (Danger)\r\nMiles, Miles, you got a minute?\r\nWoah, what? Haha, how did you get—', 'NO', 3),
(18, 'Hummingbird', '5:19', 'https://open.spotify.com/track/0J1kF6VdorvmLjmRJObiV1?si=a71b9a966e0749e2', 'https://music.youtube.com/watch?v=oyvhljS44Kc&si=I8uCLWmjoJblHGDm', 'https://music.apple.com/us/album/hummingbird/1700520936?i=1700521940', 'Metro\r\nAyy, lil\' Metro on that beat\r\nHummingbird, summer sun, has it brought my life back?\r\nHangin\' in the balance, have you brought the light back?\r\nAnd how long\'s the night shift? She\'s sure I get away with\r\nRealizin\' she might be all I need in this life\r\n\r\nWhen I saw a cold snap, I wasn\'t with the season\r\nAttack was on the airport and outside there was a season\r\nIn here paper walls are pushing back on you like\r\nEventually you push through, the moment that you realize\r\n\r\nAnd hummingbird, I know that\'s our time (That\'s our time)\r\nBut stay on, stay on, stay on with me\r\nAnd hummingbird, I can never unsee\r\nWhat you\'ve shown me, stay on, stay on with me\r\n\r\n\r\nHummingbird, summer sun, has it brought my life back?\r\nHangin\' in the balance, have you brought the light back?\r\nAnd how long\'s the night shift? She\'s sure I get away with\r\nRealizin\' she might be all I need in this life\r\n\r\n\r\nThe moment when you realize there\'s someone there that needs you\r\n\r\nLight band all the feelings, I text them for no reason\r\nI added love \'cause love is unconditional\r\nI count on love, I count on love\r\nCause love is unconditional within reason\r\n\r\n\r\nAnd hummingbird (Hummingbird), I know that\'s our time (I know that\'s our time)\r\nBut stay on, stay on, stay on with me\r\nAnd hummingbird (Hummingbird), I can never unsee (Never)\r\nWhat you\'ve shown me, stay on, stay on\r\n\r\n\r\nWould I sign up again?\r\nWould I sign up again?\r\n\r\nAnd the night was so strong\r\nForget the time like life is long\r\nWings beating a thousand strong\r\nWould I sign up again?\r\nWould I sign up again?\r\nAnd the night was so strong\r\nForget the time like life is long\r\nUnconditional within reason\r\n\r\n\r\nAnd hummingbird (Hummingbird), I know that\'s our time (I know that\'s our time)\r\nBut stay on (Stay on), stay on, stay on with me (Stay on, stay on)\r\nAnd hummingbird (Hummingbird), I can never unsee (Never)\r\nWhat you\'ve shown me, stay on, stay on\r\n', 'NO', 3),
(19, 'Calling (Spider-Man: Across the Spider-Verse) (feat. A Boogie wit da Hoodie)', '3:40', 'https://open.spotify.com/track/4ltqVxCEyn8xyDDyI4shBm?si=f477bebc70de4e9f\r\n', 'https://music.youtube.com/watch?v=GXzcdNWn2yo&si=o6YjROW_zOtpnaxd', 'https://music.apple.com/us/album/calling-feat-a-boogie-wit-da-hoodie-spider-man/1700520936?i=1700522252', '(Metro) Just to save you. Ooh-ooh-ooh. Yo. I\'d give my all. Hey\r\n(Ooh) Just to save you, I\'d give all of me (All of me, yeah)\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\nIt\'s my fault, made you fall for me (Fall)\r\nSo, to save you, I\'d give my all (My all)\r\nJust to save you, I\'d give all of me (All of me)\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\nIt\'s my fault, made you fall for me (Fall for me)\r\nSo, to save you, I\'d give my all (My all)\r\n\r\nYou fell for me, I count on you when times are tough\r\nInstead of holdin\' you down, I should lift you up\r\n\r\nIt hurts me when you start to see my flaws (My flaws)\r\nBut just to save you, I\'d risk it all (All)\r\nShort on time for you, I\'d never have enough (Have enough)\r\nWhen I ran into you, I didn\'t plan on fallin\' in love\r\nAlways there to wipe your tears, I hate to see you cry\r\nIf you tell me to jump, I\'ll ask you, \"How high?\"\r\nI know sometimes it be hard for me to tell the truth (Tell the truth)\r\nBut I go through any obstacle to get to you (To you)\r\nI\'m not materialistic, but I got a thing for you\r\nTreat the world like my guitar, I\'m pullin\' strings for you\r\n\r\n(Ooh) Just to save you, I\'d give all of me (All of me, yeah)\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\n\r\nIt\'s my fault, made you fall for me (Fall)\r\nSo, to save you, I\'d give my all (My all)\r\nJust to save you, I\'d give all of me (All of me)\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\nIt\'s my fault, made you fall for me (Fall for me)\r\nSo, to save you, I\'d give my all (My all)\r\n\r\nLet me be your hero\r\nYou held me down, I was stuck at the bottom\r\nGet out of here, I\'ll get you lit, oh\r\nI know you can\'t stand me\r\nI am the one that bust down your rose gold, had your diamonds dancin\'\r\nI picked you up in that Bentley Mulsanne, when them sirens was glarin\'\r\n\r\nI gave you this number, it\'s nobody else that got it, you can call me\r\nThe way I let you come into my life and take my heart away, it\'s like a robbery\r\nEvery time you look up on the charts, now, you seein\' me, I hope you proud of me\r\nI got you bussed down, Patek Philippes, ain\'t no way you goin\' back to Cartis\r\nAnd I splurge on her, she like \"Saint Laurent me\"\r\nSee me out in a public, hardly\r\nLow-key with my mask, I\'m solo\r\nIf I don\'t speak to nobody, I\'m sorry\r\nAnd I\'ll save you if you can\'t save yourself\r\nHold on, let me catch my breath\r\nNeed a hero? I\'m the last one left\r\n\r\n(Ooh) Just to save you, I\'d give all of me (All of me, yeah)\r\n\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\nIt\'s my fault, made you fall for me (Fall)\r\nSo, to save you, I\'d give my all (My all)\r\nJust to save you, I\'d give all of me (All of me)\r\nI can hear you screamin\' out, callin\' me (Callin\' me)\r\nIt\'s my fault, made you fall for me (Fall for me)\r\nSo, to save you, I\'d give my all (My all)\r\n', 'NO', 3),
(20, 'Silk and Cologne (Spider-Verse Remix)', '3:39', 'https://open.spotify.com/track/0Sq3PQbGrEXXE1tNn0UqFW?si=dea4eb18ee174961', 'https://music.youtube.com/watch?v=oGhld97rDok&si=pEbSix2xYG2sHf98', 'https://music.apple.com/us/album/silk-and-cologne-spider-verse-remix/1700520936?i=1700522466', 'There\'s a party, oh\r\nHe call me shawty\r\nWhiff on me candy\r\nHe think he love me\r\nGot he on silk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\n\r\nSo you like sweet bread\r\nDally like dally, simme pon me telly, mmm\r\nSnow-cone, lemme dare\r\nHow you lookin at me? Mama let you down lucky, mmm\r\nStick around for a whole lotta ish\r\nWhole lotta ish, and the ish don\'t miss, yeah\r\nStick around with me and come kick\r\nGot my one a click a finger got a whole lotta it (Oh, oh)\r\n\r\nTo go America\r\nTell driver send my card (Oh, oh)\r\nI show them how it done\r\nThey take it how it come (Oh, oh)\r\nTreat daddy in the club\r\nSat that up on my glove (Oh, oh)\r\nSaid you my Margiela\r\nMy Margiela\r\n\r\nThere\'s a party, oh\r\nHe call me shawty\r\nWhiff on me candy\r\nHe think he love me\r\nGot he on silk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\n\r\nI could be a fronter, I could give a lot of money\r\nI could be an umbrella when the storm comin\'\r\nStamps on your passport, country after country\r\nBack then I would have to grind it out the dungeon\r\nI turned nothing into somethin\'\r\nVisions of me winning, man, I knew that they were comin\'\r\nFelt it in my stomach, it was always in my conscious\r\nI could see my future when nobody seen it coming\r\nI don\'t eat for nothin\'\r\nRide wit\' me, slide wit\' me\r\nMan, I hope you don\'t get tired of me\r\nLookin\' in your eyes, they look like you a bride to me\r\nIt\'s a party, have you ever been in LaFerrari?\r\nShow me that it\'s real, you a part of me\r\nI need you close, don\'t go far from me\r\nAnd I feel better when you talk to me\r\nSo come and talk to me\r\n\r\nThere\'s a party, oh\r\nHe call me shawty\r\nWhiff on me candy\r\nHe think he love me\r\nGot he on silk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nThere\'s a party, oh\r\nHe call me shawty\r\nWhiff on me candy\r\nHe think he love me\r\nGot he on silk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\nSilk and cologne, silk and cologne\r\n\r\nHow are even cooler under your mask?\r\nI was this cool the whole time\r\n', 'NO', 3);
INSERT INTO `tracks` (`id`, `name`, `time`, `spotify_link`, `youtube_link`, `apple_music_link`, `lyrics`, `Explicit`, `album_id`) VALUES
(21, 'Link Up (Spider-Verse Remix)', '3:15', 'https://open.spotify.com/track/5jHsuxGiQ4Rtstf7OMYFmy?si=c292bcc17f8341aa', 'https://music.youtube.com/watch?v=1ffqQe4SzAM&si=iHCkXp8WNCtNzB_1', 'https://music.apple.com/us/album/link-up-feat-beam-toian-spider-verse-remix-spider-man/1700520936?i=1700522631', 'Link up, link up, link up, link up\r\nLink up, link up, link up, link up\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\n\r\nYou, you tell me off for a fool\r\nYou, you tell me off for a fool\r\nBig flex like a Rolex, no time for the romance\r\n\r\nDon\'t you catch no feelings\r\nDon\'t you catch no feelings\r\n\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up (Yuh)\r\n\r\nDem a style a\r\nYeah\r\n\r\nYeah, we gon\' link up\r\nLet\'s leave the romance\r\nI dey children\r\nI dey we love right\r\nMake me no talk about the worries\r\nLet\'s sync up\r\nBig flex like a Rolex\r\nNo time for the romance\r\nFeelings\r\nDon\'t you catch no feelings\r\nI go dere dey when you need me\r\n\r\nCome link up, sync up, link up, sync up\r\n\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\n\r\nPick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\nAh, pick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\n\r\nAh, pick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\nAh, pick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\nPick up, pick up\r\n\r\nCome link up, sync up, link up, sync up\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\nCome link up, sync up, link up, sync up\r\n\r\nYou want style no one think of\r\nWhen I call up, you no pick up\r\n\r\nBibidi bibidi bibidi bam ska\r\nYou know, you don\'t know\r\nHate labels, I\'m not a hero because calling yourself a hero makes you a self narcissistic—', 'NO', 3),
(22, 'Self Love (Spider-Man: Across the Spider-Verse)', '3:09', 'https://open.spotify.com/track/4D1Lmr5kezw09WYRLbwiZr?si=a02edfde35e643fd', 'https://music.youtube.com/watch?v=HvWaJGJA-TI&si=SluRxz5_ONXRQtaP', 'https://music.apple.com/us/album/self-love-spider-man-across-the-spider-verse/1700520936?i=1700522647', '(Metro) Yeah. Mmm. Oh my, she\'s a long way from suburban towns\r\nCame to the city for the love, got her hurtin\' now\r\nOh my, she\'s a long way from suburban town\r\nLong way, really long way from suburbia\r\n\r\nSmall town love, fall down love, not medicated\r\nDrink too much, think too much, thoughts drownin\' me\r\nI\'m too high, please don\'t cry, stop doubtin\' me\r\nYou don\'t know love, you just show love, stop downin\' me\r\n\r\nSelf-love, he don\'t love himself, tryna love me\r\n\r\nCuff me, told the truth to him, he don\'t trust me\r\nSelf-love, he don\'t love himself, tryna love me\r\nCuff me, told the truth to him, he don\'t trust me\r\n\r\nOh my, she\'s a long way from suburban towns\r\nCame to the city for the love, got her hurtin\' now\r\nOh my, she\'s a long way from suburban town\r\nLong way, really long way from suburbia\r\n\r\nBig dreams, yeah (Yo), big screams, yeah (Oh, yo)\r\nShe\'s impressionable\r\nHate to see, yeah (Woah), money scheme, yeah (Woah)\r\n\r\nLivin\' questionable\r\nMy friends drive (Yo) new beamers (Oh, yo)\r\nDrop top convertibles\r\nLove hangin\' out, say you hate it now\r\nFeelin\' introvertical\r\n\r\nSelf-love, he don\'t love himself, tryna love me\r\nCuff me, told the truth to him, he don\'t trust me\r\nSelf-love, he don\'t love himself, tryna love me\r\nCuff me, told the truth to him, he don\'t trust me\r\n\r\nOh my, she\'s a long way from suburban towns\r\n\r\nCame to the city for the love, got her hurtin\' now\r\nOh my, she\'s a long way from suburban town\r\nLong way, really long way from suburbia\r\n\r\nSelf-love, he don\'t love himself, tryna love me\r\nCuff me, told the truth to him, he don\'t trust me\r\nSelf-love, he don\'t love himself, tryna love me\r\nCuff me, told the truth to him, he don\'t trust me\r\n\r\nOh my, she\'s a long way from suburban towns\r\n\r\nCame to the city for the love, got her hurtin\' now\r\nOh my, she\'s a long way from suburban town\r\nLong way, really long way from suburbia\r\n\r\nIn every other universe Gwen Stacy falls for Spider-Man, and in every other universe it doesn\'t end well\r\nWell, it\'s a first time for everything, right?', 'NO', 3),
(23, 'Home', '3:16', 'https://open.spotify.com/track/3AAdudm9gOxL6RtJ6lvuKF?si=680ad100919342c8', 'https://music.youtube.com/watch?v=R-Tg3l_Qp0Y&si=oLgxocvu7cWuzxKJ', 'https://music.apple.com/us/album/home/1700520936?i=1700523027', 'Metro\r\nSee you back home, Spider-Man\r\nI let it go on and on and on\r\nOh, yes, I am (Yes, I am)\r\nI wanna go home, home, home\r\nOh, yes, I am (Yes, I am)\r\nDon\'t take it personal\r\nYou know who I am (Know who I am, I am)\r\nAin\'t nothin\' reversible, so I stay as I am (As I am)\r\n\r\nI guess I\'m off, and I’m leavin\'\r\nGuess I\'m alone in this evening\r\n\r\nFight all my battles on my own\r\nTryna make it home\r\nTryna make it home\r\n\r\nI let it go on and on and on\r\nOh, yes, I am (Yes, I am)\r\nI wanna go home, home, home\r\nOh yes I am (Yes, I am)\r\nDon\'t take it personal\r\nYou know who I am (Know who I am, I am)\r\nAin\'t nothin\' reversible, so I stay as I am (As I am)\r\n\r\nNothing\'s reversible so I just stay how I am (I am)\r\nThey do this to hurt my soul but I am stronger than them (Stronger)\r\nI have different technicalities\r\nShoot my web, swing from these buildings and I\'m finally free\r\nAnd I can\'t help that everyone looks like I\'m some kind of freak\r\nMy shadow\'s the only one that follows me\r\nI\'ve been fightin\' ground, hidin\' my identity\r\nI wish that I would wake up without an enemy\r\nI wish that I would wake up and this all is a dream\r\nI\'ve been tryin\' to find true love mixed with peace, yeah\r\n\r\nI let it go on and on and on\r\nOh, yes, I am (Yes, I am)\r\n\r\nI wanna go home, home, home\r\nOh yes I am (Yes, I am)\r\nDon\'t take it personal (Woah)\r\nYou know who I am (Know who I am, I am)\r\nAin\'t nothin\' reversible, so I stay as I am (As I am, as I am)\r\n\r\nI guess I\'m off, and I’m leavin\'\r\nGuess I\'m alone in this evening\r\nFight all my battles on my own\r\nTryna make it home\r\nTryna make it home\r\n\r\nSorry, man, I\'m goin\' home\r\nI made it, I\'m home', 'NO', 3),
(24, 'Nonviolent Communication', '3:30', 'https://open.spotify.com/track/2IhevZVmRkRSeA2gekFrMM?si=390a753ab099407d', 'https://music.youtube.com/watch?v=gQLRxgOEztg&si=lUxM2k4fOthuGwW4', 'https://music.apple.com/us/album/nonviolent-communication/1700520936?i=1700523287', 'You let me fall first, then you dream awake\r\nI\'d do anything to bring you to that other place\r\nWe speak so differently alone, love like Vincent we are low\r\nWatch for constellations, soft as cloud formations\r\nThat will never leave, much as duty calls\r\nIf I\'m in over my head, I\'ll swim Niagara Falls\r\n\r\nNonviolent communication, ah\r\nNonviolent communication\r\n\r\nUh, caught up in the whip, Mary Jane all up in my head\r\n\r\nUpside down when I took the mask off\r\nPull the mask back down, time to ride out right now\r\nYou was mine then (You was mine then)\r\nAnd you mine now (And you mine now)\r\nShow me where they hide (Show me where they hide)\r\nAnd let me find out (Let me find out)\r\nBall hog and I\'m balled out\r\nAnd we go all out, down to no doubt\r\nYeah, nose bleeds, sell the floors out\r\nCaught up in the web, tell \'em, \"Log out\" (Mwah)\r\nKisses, baby, I bossed up, go frisk us, baby\r\nWon\'t you be my missus, baby?\r\nVen aquí, I miss it, baby (Uh)\r\nGet liftin\', I can tell you gifted, baby\r\n\r\nNecklace like Saint Nicholas, baby\r\nWrap it up like Christmas, baby, uh\r\n\r\nNonviolent communication, ah\r\nNonviolent communication\r\n(21, 21)\r\nYeah, takin\' chances, takin\' risks for you (On God)\r\nYeah, I climb a mountain just to get to you (On God, 21)\r\nYou hungry, that plate, I\'ma split with you\r\nYou know I\'m a dog, on command, if you tell me, I sit for you (21)\r\nThey don\'t understand our bond (Nah)\r\n\r\nTook a G5 to Milan (On God)\r\nTreat me like a king, I\'m a Don (21)\r\nTreat me like a king, I\'m the one, baby (21)\r\nRolls Royce, you will never see a Hyundai (Never)\r\nSuitcase go straight to the runway (21)\r\nBig dawg, nah, I don\'t know TSA (On God)\r\nReal money, I don\'t never need a sweepstake (Straight up)\r\nBig Birkin, I ain\'t never been a cheapskate (21)\r\nI\'m the type to vacation on a weekday (21)\r\nGet American Express, no prepaid (21)\r\nI\'m avoidin\' all the, \"He say, she say\" (On God)\r\nI\'m the one that had you grabbin\' on the sheets, bae (Yeah)\r\nTattoos, yeah, I\'m straight up out the E-A (Okay)\r\nLookin\' in yo\' eyes everytime we speak, bae (21)\r\n\r\nWon\'t play you, no, I\'m not the DJ (21)\r\n\r\nNonviolent communication, ah\r\nNonviolent communication\r\nNonviolent communication, ah\r\n\r\nI\'m this dimension\'s one and only Spider-Man\r\nAt least I was\r\n', 'NO', 3),
(25, 'Givin\'Up (Not The One)', '3:54', 'https://open.spotify.com/track/4D0RrinXpQt16fZLVhmXWy?si=f8c32ca2018c4319', 'https://music.youtube.com/watch?v=detDWvWoS4k&si=xWksiV_nQ2sL1II7', 'https://music.apple.com/us/album/givin-up-not-the-one/1700520936?i=1700523312', 'But I\'m not like the others\r\nI don\'t always like what I have to do (Honorable C.N.O.T.E.)\r\nBut I know I have to be the one to do it\r\nI\'ve given up too much to stop now\r\n\r\nI can\'t be the one here givin\' up\r\nI\'m not the one here givin\' up (No)\r\nTime is up, but I can\'t feel what it was\r\nIf you were me, would you give up?\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\n\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\n\r\nWoah, woah\r\nEvery obstacle I overcame\r\nPushed throught it, I ain\'t point to blame\r\nKept my focus\r\nEvery time they tried to hold me back I broke up out they chains\r\nReached the top, still remain the same\r\nHit the bottom, get up, no complain\r\nWalk on the stage and they all yell my name\r\nThey doubt me, but I always do my thing\r\nCause they count on me (21)\r\nI got a family to feed (21)\r\n\r\nDuckin\' the envy and greed (On God)\r\nStreet smart, but I still read (On God)\r\nby the heroes I breathe (21)\r\nI smell a win and get tea (21)\r\nLet down the top for the Brish (Straight up)\r\nHow you gon\' give up on me? (On God)\r\nHow you just give up on we? (21)\r\nI never quit, though\r\nGot a house, not spotted with a brick, though (Facts)\r\nSay you hungry, all you wanna do is sit, though (Facts)\r\nI\'m a leader, I\'ll show you how to fish, though (21)\r\nIf you wanted, there\'s some things you gon\' miss, though (21)\r\nI got goals, everybody ain\'t built for (21)\r\nI ain\'t stoppin\' \'til I get what I\'m here for (On God)\r\n\r\nI can\'t be the one here givin\' up\r\nI\'m not the one here givin\' up (No)\r\nTime is up, but I can\'t feel what it was\r\nIf you were me, would you give up?\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up, yeah, 2 Chainz)\r\n\r\nLove me or love me, not leak it, the [?] from me, work\r\nThat was a hand-me-down, I wasn\'t stunned\r\n\r\nI\'ll make her stand around, I got a stick\r\nWould\'ve been, been around, never gave up on me\r\nI don\'t know your favorite OG\r\nMake your baby OD when she on me\r\nTold him in my time, just so you know, I\'m Atlanta\r\nBought my whole clique so new roll it\r\nAlone, never lonely, roll with the real, never pony\r\nDo 24 like I\'m Kobe\r\nMy superheroe, we goated\r\nIt be the street that have motive\r\nI got a car and new wheel (Wheel)\r\nI got new thoughts on the head\r\nMan with the flow and the beard\r\nYou know I heard what you said\r\n\r\nNo, I ain\'t droppin\' the towel\r\nDon\'t let that go over your head\r\n\r\nI can\'t be the one here givin\' up (Yeah)\r\nI\'m not the one here givin\' up (No)\r\nTime is up, but I can\'t feel what it was\r\nIf you were me, would you give up? (Mmm)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (True, I\'m not the one here givin\' up)\r\nI\'m not the one here givin\' up (I\'m not the one here givin\' up, tell \'em)\r\n\r\nFair enough\r\nIs part of your life (Is part of your life)\r\nI see you runnin\' and out of time\r\nIs part of your life (Is part of your life)\r\nBeing Spider-Man is a sacrifice\r\nThat\'s the job, that\'s what you sign up for', 'NO', 3),
(26, 'Nas Morales', '2:47', 'https://open.spotify.com/track/3n230gz4ZeTGPiC5NV5kTB?si=b7d0ca87c8de4b41', 'https://music.youtube.com/watch?v=PaSumxURwPk&si=C2PQIRaY9dmcYvOZ', 'https://music.apple.com/us/album/nas-morales/1700520936?i=1700523516', 'Shoot a web, glidin\' through the sky, through the air\r\nDancin\' through the buildings, Fred Astaire, bunch of skyscrapers everywhere\r\nI\'m just flexin\' my ability, sick and tired of humility\r\nCan\'t believe that they would hate on me\r\nFor being me, I face a penalty\r\nThey expect so much from me, it sucks for me\r\nLucky me, I\'m just flyin\' through the sky sucker-free\r\nI\'m just up above the city streets, climbin\' walls at a different speed\r\nMiles Morales, miles-per-hours\r\nTake a dive, surf the towers\r\nLate at night, scary hours\r\nSuperpowers, \'preciate the flowers\r\nShoot a web, glidin\' through the sky, through the air\r\n\r\nDancin\' through the buildings, Fred Astaire, bunch of skyscrapers everywhere\r\n\r\nNobody looks up no more, so it\'s easy to slide through, they can\'t tell if the sky\'s blue\r\nTrue, nobody looks up no more (Woo), I\'m confused why they choose to not see it the way I do\r\nI move with my mind different, nonsense is not stickin\'\r\nRhymes hittin\', knowledge, wisdom, Nas different\r\nSpidey-senses tinglin\', swingin\' from New England out to England (Woo)\r\nFlips and somersaults like the brothers from Ringling\r\nJump from a hundred feet and land on my feet, yeah\r\nTimbs\'ll make the cipher complete, a sight to see, ow\r\nNew Yorkin\' too often (Yeah), fools rushin\', we walkin\', I\'m done talkin\'\r\n\r\n(Nobody looks up no more)\r\n(Nobody looks up no more)', 'NO', 3),
(27, 'Annihilate (Spider-Man: Across the Spider-Verse - Instrumental)', '3:52', 'https://open.spotify.com/track/0rj3W147rXLe3bokOgWAW9?si=b9965ea5746e4bb6', 'https://music.youtube.com/watch?v=ZlTvYz-Gu_Q&si=3lF2yQjR6hIAGSkU', 'https://music.apple.com/us/album/annihilate-spider-man-across-the-spider-verse/1700520936?i=1700523771', NULL, 'NO', 3),
(28, 'Am I Dreaming (Instrumental)', '4:16', 'https://open.spotify.com/track/4CDFbpbGuat4UXwFvUVePG?si=deb23c05f84f4f8c', 'https://music.youtube.com/watch?v=fZzs5_uu-Yc&si=9JoPq88dWzddGgob', 'https://music.apple.com/us/album/am-i-dreaming-instrumental/1700520936?i=1700523775', NULL, 'NO', 3),
(29, 'All The Way Live (Spider-Man: Across the Spider-Verse - Instrumental)', '4:06', 'https://open.spotify.com/track/7xUFwoiHrj2BkMuUiguGhE?si=d935d6dcabfb499c', 'https://music.youtube.com/watch?v=64oPuFiMl0c&si=w0xpY7u1J8UYGlKD', 'https://music.apple.com/us/album/all-the-way-live-spider-man-across-the-spider/1700520936?i=1700523777', NULL, 'NO', 3),
(30, 'Hummingbird (Instrumental)', '5:20', 'https://open.spotify.com/track/0xWEe6RPABHV0GQSYxNOyX?si=5c1964fd824c45a4', 'https://music.youtube.com/watch?v=n15FaMy_CaY&si=Nm5smvS_gEkUOE1-', 'https://music.apple.com/us/album/hummingbird-instrumental/1700520936?i=1700523782', NULL, 'NO', 3),
(31, 'Calling (Spider-Man: Across the Spider-Verse - Instrumental)', '3:40', 'https://open.spotify.com/track/2Yse8cvkvPOSpUTgY6RzbK?si=70275b917fab4606', 'https://music.youtube.com/watch?v=CKODEyP__v8&si=b89_cdfNtaiSvkTW', 'https://music.apple.com/us/album/calling-spider-man-across-the-spider-verse-instrumental/1700520936?i=1700523786', NULL, 'NO', 3),
(32, 'Link Up (Spider-Verse Remix (Spider-Man: Across the Spider-Verse - Instrumental))', '3:16', 'https://open.spotify.com/track/1LAqyTGterNHVFTR2s8aEM?si=f0cbc1aedf3d4511', 'https://music.youtube.com/watch?v=nVQCY5IOocg&si=ThwWRJVAWz9swLfC', 'https://music.apple.com/us/album/link-up-spider-verse-remix-spider-man-across-the/1700520936?i=1700523787', NULL, 'NO', 3),
(33, 'Self Love (Spider-Man: Across the Spider-Verse - Instrumental)', '3:10', 'https://open.spotify.com/track/6xq4esa1dAf8ALJM3NAM6M?si=02c8580e88484f8f', 'https://music.youtube.com/watch?v=ctpnOLMIRS0&si=oCgUp30pbdzmCmMX', 'https://music.apple.com/us/album/self-love-spider-man-across-the-spider-verse-instrumental/1700520936?i=1700523791', NULL, 'NO', 3),
(34, 'Home (Instrumental)', '3:16', 'https://open.spotify.com/track/0rOBzr7k6TjXvToLqxUFom?si=f94cf77a68634a32', 'https://music.youtube.com/watch?v=6AcXGzNjLKs&si=dKbQd3Ueo8td8boX', 'https://music.apple.com/us/album/home-instrumental/1700520936?i=1700523983', NULL, 'NO', 3),
(35, 'Nonviolent Communication (Instrumental)', '3:29', 'https://open.spotify.com/track/0tS8zOzsD52WhFmCgaLIhG?si=39beddbf65294b44', 'https://music.youtube.com/watch?v=aOAAKsDZgDQ&si=75wt7VQ11hxxd6-y', 'https://music.apple.com/us/album/nonviolent-communication-instrumental/1700520936?i=1700523985', NULL, 'NO', 3),
(36, 'Nas Morales (Instrumental)', '2:47', 'https://open.spotify.com/track/6CfoQl50DhX1oypPrGmX1y?si=7c93197ac9db42f0', 'https://music.youtube.com/watch?v=Tnhv4fKg5LE&si=5twmncqPPh5mNyav', 'https://music.apple.com/us/album/nas-morales-instrumental/1700520936?i=1700523988', NULL, 'NO', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `avatar_url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `avatar_url`, `email`, `password`, `username`, `role`, `description`) VALUES
(1, '', 'admin@test.ee', '$2a$12$nQW8/raaLuNqqgvsS31oy.ixT1PlbS9EdvXcvRo9Ib4CV2vA3wYla', 'Admin', 'admin', ''),
(2, '', 'Daniel.Monjane@test.ee', '$2a$12$nQW8/raaLuNqqgvsS31oy.ixT1PlbS9EdvXcvRo9Ib4CV2vA3wYla', 'DanMon', 'user', ''),
(3, '', 'Daniel.Drivissenko@test.ee', '$2a$12$nQW8/raaLuNqqgvsS31oy.ixT1PlbS9EdvXcvRo9Ib4CV2vA3wYla', 'Derevo', 'user', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_FK` (`artist_id`);

--
-- Индексы таблицы `album_genres`
--
ALTER TABLE `album_genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_genre_FK` (`album_id`),
  ADD KEY `genre_album_FK` (`genre_id`);

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment_albums`
--
ALTER TABLE `comment_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_album_FK` (`user_id`),
  ADD KEY `album_user_FK` (`album_id`);

--
-- Индексы таблицы `comment_artists`
--
ALTER TABLE `comment_artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_artist_FK` (`user_id`),
  ADD KEY `artist_user_FK` (`artist_id`);

--
-- Индексы таблицы `comment_tracks`
--
ALTER TABLE `comment_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_track_FK` (`user_id`),
  ADD KEY `track_user_FK` (`track_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `like_albums`
--
ALTER TABLE `like_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_albums_FK` (`user_id`),
  ADD KEY `albums_users_FK` (`album_id`);

--
-- Индексы таблицы `like_artists`
--
ALTER TABLE `like_artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artists_users_FK` (`artist_id`),
  ADD KEY `users_artists_FK` (`user_id`);

--
-- Индексы таблицы `like_tracks`
--
ALTER TABLE `like_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_trackss_FK` (`user_id`),
  ADD KEY `tracks_users_FK` (`track_id`);

--
-- Индексы таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracks_FK` (`album_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `album_genres`
--
ALTER TABLE `album_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comment_albums`
--
ALTER TABLE `comment_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `comment_artists`
--
ALTER TABLE `comment_artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `comment_tracks`
--
ALTER TABLE `comment_tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `like_albums`
--
ALTER TABLE `like_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `like_artists`
--
ALTER TABLE `like_artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `like_tracks`
--
ALTER TABLE `like_tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_FK` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Ограничения внешнего ключа таблицы `album_genres`
--
ALTER TABLE `album_genres`
  ADD CONSTRAINT `album_genre_FK` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `genre_album_FK` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment_albums`
--
ALTER TABLE `comment_albums`
  ADD CONSTRAINT `album_user_FK` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `user_album_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment_artists`
--
ALTER TABLE `comment_artists`
  ADD CONSTRAINT `artist_user_FK` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `user_artist_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment_tracks`
--
ALTER TABLE `comment_tracks`
  ADD CONSTRAINT `track_user_FK` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`),
  ADD CONSTRAINT `user_track_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `like_albums`
--
ALTER TABLE `like_albums`
  ADD CONSTRAINT `albums_users_FK` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `users_albums_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `like_artists`
--
ALTER TABLE `like_artists`
  ADD CONSTRAINT `artists_users_FK` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `users_artists_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_tracks_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `like_tracks`
--
ALTER TABLE `like_tracks`
  ADD CONSTRAINT `tracks_users_FK` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`),
  ADD CONSTRAINT `users_trackss_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_FK` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
