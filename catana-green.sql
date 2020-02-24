-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 24 2020 г., 16:50
-- Версия сервера: 5.5.64-MariaDB
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catana-green`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `admin` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'user',
  `img` varchar(150) NOT NULL,
  `sfx` varchar(3) NOT NULL DEFAULT 'on',
  `tpl` varchar(50) NOT NULL DEFAULT 'base'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `admin`, `email`, `pass`, `status`, `img`, `sfx`, `tpl`) VALUES
(1, 'Admin', '', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 'on', 'base');

-- --------------------------------------------------------

--
-- Структура таблицы `general`
--

CREATE TABLE `general` (
  `id` int(1) NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(500) NOT NULL,
  `descript` varchar(1500) NOT NULL,
  `copyright` varchar(500) NOT NULL,
  `offer` varchar(1500) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `country` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `addr` varchar(600) NOT NULL,
  `graph` varchar(150) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `social` text NOT NULL,
  `main_search` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `general`
--

INSERT INTO `general` (`id`, `admin_id`, `title`, `descript`, `copyright`, `offer`, `zip`, `country`, `city`, `addr`, `graph`, `tel`, `mail`, `social`, `main_search`) VALUES
(1, 1, 'Catana CMS', 'Короткое описание сайта', 'LeoCRAFT Digital', 'заточена чтобы созидать', '', 'Украина', 'Мариуполь', 'Арх.Нильсена, 26', 'График работы', 'arr:+38 067 747 09 47', 'arr:info@leocraft.com,info@leocraft.com,info@leocraft.com', 'obj:telegram=sdfsdf,facebook=https://www.facebook.com/LeoCraft.Studio/,instagram=https://www.instagram.com/treemindlc,behance=https://www.behance.net/genideas,linkedin=https://www.linkedin.com/in/dmitry-cherepanov-93175a83', 'news');

-- --------------------------------------------------------

--
-- Структура таблицы `langs`
--

CREATE TABLE `langs` (
  `id` int(1) NOT NULL,
  `main` tinyint(1) UNSIGNED NOT NULL,
  `translit` tinyint(1) NOT NULL,
  `num` tinyint(1) UNSIGNED NOT NULL,
  `public` tinyint(1) UNSIGNED NOT NULL,
  `edit` tinyint(1) UNSIGNED NOT NULL,
  `lang` varchar(2) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `langs`
--

INSERT INTO `langs` (`id`, `main`, `translit`, `num`, `public`, `edit`, `lang`, `domain`, `title`, `img`) VALUES
(1, 1, 1, 1, 1, 1, 'ru', '', 'Русский', ''),
(2, 0, 0, 2, 1, 1, 'uk', '', 'Українська', ''),
(3, 0, 0, 3, 1, 1, 'en', '', 'English', ''),
(4, 0, 0, 4, 0, 0, 'ch', '', '中国', ''),
(5, 0, 0, 5, 0, 0, 'ar', '', 'العربية', '');

-- --------------------------------------------------------

--
-- Структура таблицы `langs_words`
--

CREATE TABLE `langs_words` (
  `id` int(4) NOT NULL,
  `word_key` varchar(50) NOT NULL,
  `langs_word` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `langs_words`
--

INSERT INTO `langs_words` (`id`, `word_key`, `langs_word`) VALUES
(1, '01', '⊣key⊢янв⊣key⊢ciч⊣key⊢jan⊣key⊢⊣key⊢'),
(2, '02', '⊣key⊢фев⊣key⊢лют⊣key⊢feb⊣key⊢⊣key⊢'),
(3, '03', '⊣key⊢мар⊣key⊢бер⊣key⊢mar'),
(4, '04', '⊣key⊢апр⊣key⊢кві⊣key⊢apr'),
(6, '05', '⊣key⊢май⊣key⊢тра⊣key⊢may'),
(7, '06', '⊣key⊢июн⊣key⊢чер⊣key⊢jun'),
(8, '07', '⊣key⊢июл⊣key⊢лип⊣key⊢jul'),
(9, '08', '⊣key⊢авг⊣key⊢сер⊣key⊢aug'),
(10, '09', '⊣key⊢сен⊣key⊢вер⊣key⊢sep'),
(11, '10', '⊣key⊢окт⊣key⊢жов⊣key⊢oct'),
(12, '11', '⊣key⊢ноя⊣key⊢лис⊣key⊢nov'),
(13, '12', '⊣key⊢дек⊣key⊢гру⊣key⊢dec'),
(14, '404error', '⊣key⊢Ошибка 404!⊣key⊢Помилка 404!⊣key⊢Error 404!'),
(15, '404text', '⊣key⊢Вы запросили не существующую страницу!⊣key⊢Ви запросили неіснуючу сторінку!⊣key⊢You have requested an existing page!'),
(16, 'contacts', '⊣key⊢контакты⊣key⊢контакти⊣key⊢contacts'),
(17, 'pages', '⊣key⊢страницы⊣key⊢сторінки⊣key⊢pages'),
(18, 'writetous', '⊣key⊢напишите нам⊣key⊢напишіть нам⊣key⊢write to us'),
(19, 'name', '⊣key⊢имя⊣key⊢ім`я⊣key⊢name'),
(20, 'tel', '⊣key⊢телефон⊣key⊢телефон⊣key⊢phone:'),
(21, 'message', '⊣key⊢текст сообщения⊣key⊢текст повідомлення⊣key⊢message text'),
(22, 'send', '⊣key⊢отправить⊣key⊢відправити⊣key⊢send'),
(23, 'consultation', '⊣key⊢заказать расчёт⊣key⊢замовити розрахунок⊣key⊢order a calculation'),
(24, 'notappart', '⊣key⊢Пока нет доступных планировок!⊣key⊢Поки немає доступних планувань!⊣key⊢There are no available schedules yet!'),
(25, 'home', '⊣key⊢главная⊣key⊢головна⊣key⊢home'),
(26, 'read', '⊣key⊢читать ...⊣key⊢читати ...⊣key⊢read...'),
(27, 'callBack', '⊣key⊢заказать звонок⊣key⊢замовити дзвінок⊣key⊢order a call'),
(28, 'productsMenu', '⊣key⊢каталог товаров⊣key⊢каталог товарів⊣key⊢catalog'),
(29, 'callbackMe', '⊣key⊢перезвоните мне⊣key⊢передзвоніть мені⊣key⊢call me back'),
(30, 'itemtel', '⊣key⊢+38 [___] ___-__-__⊣key⊢+38 [___] ___-__-__⊣key⊢+38 [___] ___-__-__'),
(31, 'starttel', '⊣key⊢+38 [⊣key⊢+38 [⊣key⊢+38 ['),
(32, 'authorization', '⊣key⊢Авторизация пользователя⊣key⊢Авторизація користувача⊣key⊢User authorization'),
(33, 'login', '⊣key⊢вход⊣key⊢вхід⊣key⊢log in'),
(34, 'registration', '⊣key⊢регистрация⊣key⊢реєстрація⊣key⊢sign in'),
(35, 'incart', '⊣key⊢Ваш заказ⊣key⊢Ваше замовлення⊣key⊢Your order'),
(36, 'clear-up', '⊣key⊢очистить⊣key⊢очистити⊣key⊢clear'),
(37, 'to-make', '⊣key⊢оформить заказ⊣key⊢оформити замовлення⊣key⊢checkout'),
(38, 'amount', '⊣key⊢на сумму:⊣key⊢на суму:⊣key⊢amount:'),
(39, 'search', '⊣key⊢поиск по каталогу⊣key⊢пошук по каталогу⊣key⊢search in catalog'),
(40, 'there', '⊣key⊢в наличии⊣key⊢в наявності⊣key⊢in stock'),
(41, 'absent', '⊣key⊢под заказ⊣key⊢під замовлення⊣key⊢under the order'),
(42, 'order_comment', '⊣key⊢комментарий к заказу⊣key⊢коментар до замовлення⊣key⊢comment to the order'),
(43, 'fullname', '⊣key⊢Ф.И.О⊣key⊢П.І.Б⊣key⊢FULL NAME'),
(44, 'client_info', '⊣key⊢Данные клиента⊣key⊢Дані клієнта⊣key⊢Customer data'),
(45, 'delivery', '⊣key⊢Способ доставки⊣key⊢Спосіб доставки⊣key⊢Delivery method'),
(46, 'pay_method', '⊣key⊢Способ оплаты⊣key⊢Спосіб оплати⊣key⊢Payment method'),
(47, 'need_delivery', '⊣key⊢Выбрать доставку⊣key⊢Вибрати доставку⊣key⊢Choose delivery'),
(48, 'empty_cart', '⊣key⊢Ваша корзина пуста!⊣key⊢Ваш кошик порожній!⊣key⊢Your basket is empty!'),
(49, 'bicoin_cource', '⊣key⊢Актуальный курс биткоина⊣key⊢Життєвий цикл біткоіни⊣key⊢Current bitcoin rate'),
(51, 'hit', '⊣key⊢хит продаж⊣key⊢хіт продажу⊣key⊢bestseller'),
(52, 'new', '⊣key⊢новинка⊣key⊢новинка⊣key⊢novelty'),
(53, 'best', '⊣key⊢лучший выбор⊣key⊢кращий вибір⊣key⊢best choice'),
(54, 'price', '⊣key⊢лучшая цена⊣key⊢найкраща ціна⊣key⊢best price'),
(55, 'vip', '⊣key⊢выбор профессионала⊣key⊢вибір професіонала⊣key⊢profi choice'),
(56, 'top', '⊣key⊢топ новость⊣key⊢топ новина⊣key⊢top news'),
(57, 'flash', '⊣key⊢молния⊣key⊢блискавка⊣key⊢lightning'),
(58, 'quant', '⊣key⊢Доступное количество⊣key⊢Доступна кількість⊣key⊢Available quantity'),
(59, 'nextrecords', '⊣key⊢ещe⊣key⊢ще⊣key⊢next'),
(70, 'nextpage', '⊣key⊢вперед⊣key⊢вперед⊣key⊢next'),
(71, 'prevpage', '⊣key⊢назад⊣key⊢назад⊣key⊢prev'),
(72, 'CallBoardcategory', '⊣key⊢Категории объявлений⊣key⊢Категорії оголошень⊣key⊢Ad categories'),
(73, 'tomorrow', '⊣key⊢завтра⊣key⊢завтра⊣key⊢tomorrow'),
(74, 'paycard', '⊣key⊢Оплата картой⊣key⊢Оплата картою⊣key⊢Payment by card'),
(75, 'payshop', '⊣key⊢Наложенный платеж⊣key⊢Накладений платіж⊣key⊢C.O.D'),
(76, 'back', '⊣key⊢назад⊣key⊢назад⊣key⊢backward'),
(77, 'today', '⊣key⊢сегодня⊣key⊢сьогодні⊣key⊢today'),
(78, 'yesterday', '⊣key⊢вчера⊣key⊢вчора⊣key⊢yesterday'),
(79, 'breadstart', '⊣key⊢⊣key⊢⊣key⊢'),
(80, 'breadtitle', '⊣key⊢Главная⊣key⊢Головна⊣key⊢Home');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(2) NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT '1',
  `login` tinyint(1) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `del` tinyint(1) NOT NULL,
  `sys` tinyint(1) NOT NULL DEFAULT '0',
  `num` tinyint(3) UNSIGNED NOT NULL DEFAULT '255',
  `type` varchar(10) NOT NULL,
  `multitype` varchar(30) NOT NULL,
  `view` varchar(30) NOT NULL,
  `view_act` tinyint(1) NOT NULL DEFAULT '1',
  `menu` varchar(500) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `descript` text NOT NULL,
  `text` text NOT NULL,
  `seo_title` varchar(1500) NOT NULL,
  `seo_descript` text NOT NULL,
  `keywords` varchar(1500) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `altimg` varchar(255) NOT NULL,
  `gallery` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `stock` int(2) NOT NULL,
  `outlink` varchar(255) NOT NULL,
  `table_records` varchar(50) NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `admin_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `main`, `login`, `public`, `del`, `sys`, `num`, `type`, `multitype`, `view`, `view_act`, `menu`, `title`, `descript`, `text`, `seo_title`, `seo_descript`, `keywords`, `tags`, `img`, `altimg`, `gallery`, `video`, `icon`, `unit`, `stock`, `outlink`, `table_records`, `user_id`, `admin_id`) VALUES
(1, 0, 1, 0, 1, 0, 0, 1, '', '', '', 1, 'Главная', 'Демонстрационный сайт. Манифест', 'Этот сайт и логотип разработаны в студии LeoCRAFT Digital сайт является демонстрационным продуктом, который может быть передан Заказчику для использования в своих интересах, на условиях и в рамках договора Владельца.', '<h2>Этот сайт разработан в студии <b><a href=\"//leocraft.com\">LeoCRAFT Digital</a></b> и являются демонстрационным продуктом, который может быть передан Заказчику для использования в своих интересах, на условиях и в рамках договора Владельца.</h2><p><img src=\"userfiles/photo_2020-01-13_11-01-49.jpg\"><br></p>\n<p>Доменное имя также находится в ведомстве студии <b>LeoCRAFT Digital</b> как первого и единственного регистратора подавшего заявку.</p>\n<p>Данный сайт работает на платформе <b><a href=\"//trone.site\">TRONE Engine</a></b>, которая является собственностью студии <b>LeoCRAFT Digital</b> и обеспечивает работу сайта, а так же удобный и широкий спектр инструментов управления сайтом.</p>\n<p>Все вопросы и предложения по использованию сайта в Ваших интересах можно отправить через формы обратной связи либо на почту <a href=\"mailto:info@leocraft.com\">info@leocraft.com</a></p><p><br></p><p>С ув. <a href=\"//www.facebook.com/deshka.doshtabof\">Дмитрий Черепанов</a></p>', '', '', '', '', 'userfiles/gallery/Google-logo.jpg', '', 'userfiles/gallery/standart-mobile.gif,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/photo_2020-01-13_11-01-49.jpg,userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png,userfiles/photo_2020-01-13_11-01-49.jpg', '', '', '', 0, '', '', 0, 1),
(2, 0, 1, 0, 1, 0, 0, 2, '', '', 'about', 1, 'О нас', 'О компании', '', '@calendar', '', '', '', '', 'userfiles/photo_2020-01-13_11-01-49.jpg', 'userfiles/snimok-aekrana-2020-01-24-v-11.11.17.png', 'userfiles/photo_2020-01-13_11-01-49.jpg', '', '', '', 0, '', '', 0, 1),
(3, 0, 1, 0, 1, 0, 0, 8, 'multi', 'news', 'news', 1, 'Блог', 'Новости компании', '', '', '', '', '', '', 'userfiles/gallery/Google-logo.jpg', '', '', '', '', '', 0, '', '', 0, 1),
(4, 0, 1, 0, 1, 0, 0, 5, 'multi', 'shop', 'catalog', 1, 'Каталог', 'Каталог товаров', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1),
(5, 0, 1, 0, 1, 0, 0, 10, 'multi', 'short', 'services', 1, 'Услуги', 'Услуги компании', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1),
(6, 0, 1, 0, 1, 0, 0, 11, '', '', 'contacts', 1, 'Контакты', 'Контакты компании', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0),
(7, 2, 1, 0, 1, 0, 0, 4, 'multi', 'short', 'team', 1, 'Командa', 'Команда', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1),
(8, 2, 1, 0, 1, 0, 0, 3, 'multi', 'short', 'reviews', 1, 'Отзывы', 'Отзывы', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 0),
(10, 0, 1, 0, 1, 0, 0, 9, '', '', 'gallery', 1, 'Галерея', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1),
(11, 4, 1, 0, 1, 0, 0, 1, '', '', 'cat1', 1, 'Категория 1', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1),
(12, 4, 1, 0, 1, 0, 0, 2, '', '', 'cat2', 1, 'Категория 2', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE `records` (
  `id` int(9) UNSIGNED NOT NULL,
  `view_id` tinyint(3) UNSIGNED NOT NULL,
  `page_id` tinyint(3) UNSIGNED NOT NULL,
  `note_id` tinyint(4) UNSIGNED NOT NULL,
  `num` tinyint(3) UNSIGNED NOT NULL,
  `public` tinyint(1) NOT NULL,
  `del` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(1500) NOT NULL,
  `descript` text NOT NULL,
  `short` text NOT NULL,
  `text` text NOT NULL,
  `seo_title` varchar(1500) NOT NULL,
  `seo_descript` text NOT NULL,
  `keywords` varchar(1500) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fin_date` date NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `price_old` decimal(9,2) NOT NULL,
  `quant` smallint(5) UNSIGNED NOT NULL,
  `art` varchar(20) NOT NULL,
  `weight` decimal(5,3) NOT NULL,
  `param` varchar(500) NOT NULL,
  `video` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `spare` varchar(150) NOT NULL,
  `img` varchar(150) NOT NULL,
  `altimg` varchar(255) NOT NULL,
  `gallery` text NOT NULL,
  `likes` int(7) NOT NULL,
  `notlikes` int(7) NOT NULL,
  `views` int(9) NOT NULL,
  `takes` int(7) NOT NULL,
  `comments` int(9) NOT NULL,
  `comment_set` tinyint(1) NOT NULL,
  `user_id` int(7) NOT NULL,
  `admin_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `record_comments`
--

CREATE TABLE `record_comments` (
  `id` int(9) NOT NULL,
  `view_id` int(3) NOT NULL,
  `record_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `text` text NOT NULL,
  `img` varchar(150) NOT NULL,
  `up` int(5) NOT NULL,
  `down` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `record_views`
--

CREATE TABLE `record_views` (
  `id` int(15) NOT NULL,
  `view_id` int(3) NOT NULL,
  `record_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sess_id` varchar(32) CHARACTER SET utf8 NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `referal` varchar(500) NOT NULL,
  `target` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `record_views`
--

INSERT INTO `record_views` (`id`, `view_id`, `record_id`, `user_id`, `date`, `time`, `sess_id`, `user_ip`, `referal`, `target`) VALUES
(1, 3, 1, 0, '2020-02-07', '22:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news', ''),
(2, 3, 2, 0, '2020-02-07', '22:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news', ''),
(3, 3, 11, 0, '2020-02-10', '00:02:00', '', '141.8.132.32', '', ''),
(4, 3, 7, 0, '2020-02-10', '03:02:00', '', '141.8.132.32', '', ''),
(5, 3, 8, 0, '2020-02-10', '04:02:00', '', '141.8.132.32', '', ''),
(6, 3, 12, 0, '2020-02-10', '04:02:00', '', '141.8.132.32', '', ''),
(7, 3, 6, 0, '2020-02-10', '09:02:00', '', '141.8.132.32', '', ''),
(8, 3, 9, 0, '2020-02-10', '13:02:00', '', '141.8.132.32', '', ''),
(9, 3, 10, 0, '2020-02-10', '14:02:00', '', '141.8.132.32', '', ''),
(10, 3, 3, 0, '2020-02-10', '20:02:00', '', '37.9.113.48', '', ''),
(11, 3, 1, 0, '2020-02-10', '20:02:00', '', '141.8.132.32', '', ''),
(12, 3, 5, 0, '2020-02-10', '21:02:00', '', '141.8.132.32', '', ''),
(13, 3, 14, 0, '2020-02-10', '22:02:00', '', '141.8.132.32', '', ''),
(14, 3, 2, 0, '2020-02-10', '23:02:00', '', '141.8.132.32', '', ''),
(15, 3, 4, 0, '2020-02-11', '00:02:00', '', '141.8.132.32', '', ''),
(16, 3, 5, 0, '2020-02-11', '22:02:00', '', '141.8.132.32', '', ''),
(17, 3, 14, 0, '2020-02-13', '05:02:00', '', '141.8.132.32', '', ''),
(18, 3, 3, 0, '2020-02-14', '12:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news', ''),
(19, 3, 1, 0, '2020-02-14', '12:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news', ''),
(20, 3, 4, 0, '2020-02-14', '20:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.250', 'https://enginx.tech/news', ''),
(21, 3, 4, 0, '2020-02-17', '11:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news', ''),
(22, 3, 8, 0, '2020-02-18', '08:02:00', '', '213.180.203.9', '', ''),
(23, 3, 1, 0, '2020-02-18', '13:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page=4', ''),
(24, 3, 3, 0, '2020-02-18', '15:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page=6', ''),
(25, 3, 6, 0, '2020-02-18', '15:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page=1', ''),
(26, 3, 9, 0, '2020-02-18', '16:02:00', '', '141.8.132.32', '', ''),
(27, 3, 7, 0, '2020-02-18', '18:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/7', ''),
(28, 3, 4, 0, '2020-02-18', '18:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/8', ''),
(29, 3, 12, 0, '2020-02-18', '18:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/5', ''),
(30, 3, 1, 0, '2020-02-18', '18:02:00', '', '37.9.113.48', '', ''),
(31, 3, 6, 0, '2020-02-18', '18:02:00', '', '141.8.132.32', '', ''),
(32, 3, 10, 0, '2020-02-18', '19:02:00', '', '141.8.132.32', '', ''),
(33, 3, 7, 0, '2020-02-18', '21:02:00', '', '37.9.113.48', '', ''),
(34, 3, 4, 0, '2020-02-18', '23:02:00', '', '141.8.132.32', '', ''),
(35, 3, 3, 0, '2020-02-19', '01:02:00', '', '141.8.132.32', '', ''),
(36, 3, 12, 0, '2020-02-19', '06:02:00', '', '141.8.132.32', '', ''),
(37, 3, 7, 0, '2020-02-19', '16:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/7', ''),
(38, 3, 7, 0, '2020-02-19', '16:02:00', '', '66.249.83.105', '', ''),
(39, 3, 1, 0, '2020-02-19', '17:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/2', ''),
(40, 3, 1, 0, '2020-02-19', '17:02:00', '', '31.13.127.4', '', ''),
(41, 3, 4, 0, '2020-02-19', '17:02:00', '', '87.250.224.215', '', ''),
(42, 3, 8, 0, '2020-02-19', '17:02:00', '', '37.9.113.48', '', ''),
(43, 3, 5, 0, '2020-02-19', '19:02:00', '', '141.8.132.32', '', ''),
(44, 3, 14, 0, '2020-02-19', '20:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.250', 'https://enginx.tech/news/page/3', ''),
(45, 3, 14, 0, '2020-02-19', '20:02:00', '', '173.252.111.14', '', ''),
(46, 3, 12, 0, '2020-02-19', '21:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.250', 'https://enginx.tech/news/page/5', ''),
(47, 3, 6, 0, '2020-02-19', '21:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.250', 'https://enginx.tech/news', ''),
(48, 3, 6, 0, '2020-02-19', '21:02:00', '', '108.174.2.216', '', ''),
(49, 3, 5, 0, '2020-02-19', '23:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.250', 'https://enginx.tech/news/page/4', ''),
(50, 3, 3, 0, '2020-02-20', '11:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/page/6', ''),
(51, 3, 3, 0, '2020-02-20', '11:02:00', '', '31.13.127.20', '', ''),
(52, 3, 14, 0, '2020-02-21', '04:02:00', '', '141.8.132.32', '', ''),
(53, 3, 1, 0, '2020-02-21', '16:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/find=%D0%BF%D0%B5%D1%80%D0%B2%D0%B0%D1%8F', ''),
(54, 3, 1, 0, '2020-02-21', '16:02:00', '', '31.13.127.1', '', ''),
(55, 3, 12, 0, '2020-02-21', '16:02:00', 'cft60h7m4qiso7kso9kolk99u2', '5.105.0.179', 'https://enginx.tech/news/date=2020-01-08', ''),
(56, 3, 1, 0, '2020-02-23', '13:02:00', '', '173.252.111.8', '', ''),
(57, 3, 14, 0, '2020-02-23', '21:02:00', '', '141.8.132.32', '', ''),
(58, 3, 7, 0, '2020-02-24', '12:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news', ''),
(59, 3, 1, 0, '2020-02-24', '12:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news', ''),
(60, 3, 6, 0, '2020-02-24', '12:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news', ''),
(61, 3, 6, 0, '2020-02-24', '12:02:00', '', '31.13.127.16', '', ''),
(62, 3, 1, 0, '2020-02-24', '14:02:00', '', '31.13.127.30', '', ''),
(63, 3, 9, 0, '2020-02-24', '16:02:00', 'jkfgiv1983nm4qkl511c4gv8g1', '5.105.0.179', 'https://enginx.site/news/find=%D1%82%D0%B5%D1%81%D1%82', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `country_id` int(5) NOT NULL,
  `region_id` int(5) NOT NULL,
  `city_id` int(7) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(5) NOT NULL,
  `street` varchar(100) NOT NULL,
  `home` varchar(5) NOT NULL,
  `room` varchar(5) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(19) NOT NULL,
  `img` varchar(100) NOT NULL,
  `confirm` tinyint(4) NOT NULL,
  `status_id` int(1) NOT NULL,
  `datereg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `langs`
--
ALTER TABLE `langs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `langs_words`
--
ALTER TABLE `langs_words`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `view` (`view`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `cat_id` (`page_id`),
  ADD KEY `podcat_id` (`note_id`),
  ADD KEY `page_id` (`view_id`);

--
-- Индексы таблицы `record_comments`
--
ALTER TABLE `record_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `page_id` (`view_id`);

--
-- Индексы таблицы `record_views`
--
ALTER TABLE `record_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `page_id` (`view_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `general`
--
ALTER TABLE `general`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `langs`
--
ALTER TABLE `langs`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `langs_words`
--
ALTER TABLE `langs_words`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `records`
--
ALTER TABLE `records`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `record_comments`
--
ALTER TABLE `record_comments`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `record_views`
--
ALTER TABLE `record_views`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
