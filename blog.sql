-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 27 2018 г., 18:56
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `text`) VALUES
(1, 1, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc sed id semper risus in hendrerit. Eget mauris pharetra et ultrices neque ornare aenean euismod elementum. Vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique. Adipiscing elit duis tristique sollicitudin nibh sit amet commodo nulla. Scelerisque felis imperdiet proin fermentum leo vel orci. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Quisque sagittis purus sit amet volutpat consequat mauris nunc. Nunc sed blandit libero volutpat sed cras ornare arcu dui. Tristique et egestas quis ipsum suspendisse ultrices gravida. Duis at tellus at urna condimentum mattis pellentesque id. Est velit egestas dui id ornare arcu odio. Egestas fringilla phasellus faucibus scelerisque eleifend donec. Elit ullamcorper dignissim cras tincidunt. Nec tincidunt praesent semper feugiat nibh. Amet venenatis urna cursus eget nunc scelerisque viverra mauris in. Tortor id aliquet lectus proin.\r\n\r\nTortor aliquam nulla facilisi cras fermentum. Condimentum lacinia quis vel eros donec ac odio tempor orci. Sed elementum tempus egestas sed sed risus pretium quam. Turpis egestas integer eget aliquet nibh praesent tristique. Massa sed elementum tempus egestas. Dictum at tempor commodo ullamcorper. Proin sagittis nisl rhoncus mattis rhoncus urna. Erat velit scelerisque in dictum non consectetur. Tellus in hac habitasse platea dictumst vestibulum rhoncus est. Enim ut tellus elementum sagittis.\r\n\r\nTortor id aliquet lectus proin. Integer vitae justo eget magna fermentum iaculis eu non diam. Vitae ultricies leo integer malesuada nunc vel risus commodo viverra. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Feugiat in ante metus dictum at tempor commodo. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas. Urna molestie at elementum eu facilisis sed. Sit amet consectetur adipiscing elit ut aliquam purus sit. Egestas sed tempus urna et pharetra. Varius quam quisque id diam vel quam elementum pulvinar. Nulla pellentesque dignissim enim sit amet venenatis urna. Sollicitudin aliquam ultrices sagittis orci. Urna duis convallis convallis tellus id interdum velit.\r\n\r\nUltrices sagittis orci a scelerisque purus semper eget. Tempus quam pellentesque nec nam aliquam sem et tortor consequat. At varius vel pharetra vel turpis nunc eget. Natoque penatibus et magnis dis parturient montes. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Accumsan lacus vel facilisis volutpat. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Eu augue ut lectus arcu bibendum at varius vel. Morbi tempus iaculis urna id volutpat lacus laoreet non curabitur. Quis varius quam quisque id diam vel quam. Morbi quis commodo odio aenean sed. Vitae justo eget magna fermentum iaculis eu non diam. Dignissim enim sit amet venenatis urna cursus eget nunc scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis. Fermentum odio eu feugiat pretium nibh ipsum consequat. Senectus et netus et malesuada fames ac turpis.\r\n\r\nSit amet porttitor eget dolor morbi. Blandit libero volutpat sed cras ornare arcu dui. Amet luctus venenatis lectus magna. Diam volutpat commodo sed egestas. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Aliquam malesuada bibendum arcu vitae elementum. Tempus iaculis urna id volutpat lacus laoreet non. Tincidunt tortor aliquam nulla facilisi cras fermentum odio. Posuere ac ut consequat semper. Erat nam at lectus urna. Id nibh tortor id aliquet lectus proin nibh nisl condimentum. Leo vel orci porta non. Egestas quis ipsum suspendisse ultrices gravida dictum fusce. Gravida neque convallis a cras semper auctor neque vitae. Eget lorem dolor sed viverra ipsum. Sed blandit libero volutpat sed cras ornare arcu.'),
(2, 2, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc sed id semper risus in hendrerit. Eget mauris pharetra et ultrices neque ornare aenean euismod elementum. Vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique. Adipiscing elit duis tristique sollicitudin nibh sit amet commodo nulla. Scelerisque felis imperdiet proin fermentum leo vel orci. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Quisque sagittis purus sit amet volutpat consequat mauris nunc. Nunc sed blandit libero volutpat sed cras ornare arcu dui. Tristique et egestas quis ipsum suspendisse ultrices gravida. Duis at tellus at urna condimentum mattis pellentesque id. Est velit egestas dui id ornare arcu odio. Egestas fringilla phasellus faucibus scelerisque eleifend donec. Elit ullamcorper dignissim cras tincidunt. Nec tincidunt praesent semper feugiat nibh. Amet venenatis urna cursus eget nunc scelerisque viverra mauris in. Tortor id aliquet lectus proin.\r\n\r\nTortor aliquam nulla facilisi cras fermentum. Condimentum lacinia quis vel eros donec ac odio tempor orci. Sed elementum tempus egestas sed sed risus pretium quam. Turpis egestas integer eget aliquet nibh praesent tristique. Massa sed elementum tempus egestas. Dictum at tempor commodo ullamcorper. Proin sagittis nisl rhoncus mattis rhoncus urna. Erat velit scelerisque in dictum non consectetur. Tellus in hac habitasse platea dictumst vestibulum rhoncus est. Enim ut tellus elementum sagittis.\r\n\r\nTortor id aliquet lectus proin. Integer vitae justo eget magna fermentum iaculis eu non diam. Vitae ultricies leo integer malesuada nunc vel risus commodo viverra. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Feugiat in ante metus dictum at tempor commodo. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas. Urna molestie at elementum eu facilisis sed. Sit amet consectetur adipiscing elit ut aliquam purus sit. Egestas sed tempus urna et pharetra. Varius quam quisque id diam vel quam elementum pulvinar. Nulla pellentesque dignissim enim sit amet venenatis urna. Sollicitudin aliquam ultrices sagittis orci. Urna duis convallis convallis tellus id interdum velit.\r\n\r\nUltrices sagittis orci a scelerisque purus semper eget. Tempus quam pellentesque nec nam aliquam sem et tortor consequat. At varius vel pharetra vel turpis nunc eget. Natoque penatibus et magnis dis parturient montes. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Accumsan lacus vel facilisis volutpat. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Eu augue ut lectus arcu bibendum at varius vel. Morbi tempus iaculis urna id volutpat lacus laoreet non curabitur. Quis varius quam quisque id diam vel quam. Morbi quis commodo odio aenean sed. Vitae justo eget magna fermentum iaculis eu non diam. Dignissim enim sit amet venenatis urna cursus eget nunc scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis. Fermentum odio eu feugiat pretium nibh ipsum consequat. Senectus et netus et malesuada fames ac turpis.\r\n\r\nSit amet porttitor eget dolor morbi. Blandit libero volutpat sed cras ornare arcu dui. Amet luctus venenatis lectus magna. Diam volutpat commodo sed egestas. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Aliquam malesuada bibendum arcu vitae elementum. Tempus iaculis urna id volutpat lacus laoreet non. Tincidunt tortor aliquam nulla facilisi cras fermentum odio. Posuere ac ut consequat semper. Erat nam at lectus urna. Id nibh tortor id aliquet lectus proin nibh nisl condimentum. Leo vel orci porta non. Egestas quis ipsum suspendisse ultrices gravida dictum fusce. Gravida neque convallis a cras semper auctor neque vitae. Eget lorem dolor sed viverra ipsum. Sed blandit libero volutpat sed cras ornare arcu.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'user1', '$2y$10$6ThO6qdHolRT0vpxa8t2Aev0.AO/hSSto2xl2Wa/KBlzTpepObatK'),
(2, 'user2', '$2y$10$cI04EKiZaRNRzd3SAajmNeAQXTLI1.svpbzWdrhmcc9yNgKR8R5ei');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
