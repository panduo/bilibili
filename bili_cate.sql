-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: myadmin.com
-- Generation Time: 2017-07-07 12:23:33
-- 服务器版本： 5.7.18
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bili`
--

-- --------------------------------------------------------

--
-- 表的结构 `bili_cate`
--

CREATE TABLE IF NOT EXISTS `bili_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `href` varchar(255) DEFAULT NULL,
  `b_cate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bili_cate`
--

INSERT INTO `bili_cate` (`id`, `name`, `pid`, `level`, `href`, `b_cate_id`) VALUES
(1, '首页', 0, 1, NULL, NULL),
(2, '动画', 0, 1, NULL, NULL),
(3, '番剧', 0, 1, NULL, NULL),
(4, '国创', 0, 1, NULL, NULL),
(5, '音乐', 0, 1, NULL, NULL),
(6, '舞蹈', 0, 1, NULL, NULL),
(7, '游戏', 0, 1, NULL, NULL),
(8, '科技', 0, 1, NULL, NULL),
(9, '生活', 0, 1, NULL, NULL),
(10, '鬼畜', 0, 1, NULL, NULL),
(11, '时尚', 0, 1, NULL, NULL),
(12, '广告', 0, 1, NULL, NULL),
(13, '娱乐', 0, 1, NULL, NULL),
(15, '连载动画', 3, 1, NULL, 33),
(16, '完结动画', 3, 1, NULL, 32),
(17, '资讯', 3, 1, NULL, 51),
(18, '官方延伸', 3, 1, NULL, 152),
(19, 'MAD·AMV', 2, 1, NULL, 24),
(20, 'MMD·3D', 2, 1, NULL, 25),
(21, '短片·手书·配音', 2, 1, NULL, 47),
(22, '综合', 2, 1, NULL, 27),
(23, '国产动画', 4, 1, NULL, 153),
(24, '国产原创相关', 4, 1, NULL, 168),
(25, '布袋戏', 4, 1, NULL, 169),
(26, '原创音乐', 5, 1, NULL, 28),
(27, '翻唱', 5, 1, NULL, 31),
(28, '美妆', 11, 1, NULL, 157),
(29, '服饰', 11, 1, NULL, 158),
(30, '鬼畜调教', 10, 1, NULL, 22),
(31, '音MAD', 10, 1, NULL, 26),
(32, '人力VOCALOID', 10, 1, NULL, 126),
(33, 'VOCALOID·UTAU', 5, 1, NULL, 30),
(34, '演奏', 5, 1, NULL, 59),
(35, '三次元音乐', 5, 1, NULL, 29),
(36, '健身', 11, 1, NULL, 164),
(37, '教程演示', 10, 1, NULL, 127),
(38, '综艺', 13, 1, NULL, 71),
(39, '明星', 13, 1, NULL, 137),
(40, 'Korea相关', 13, 1, NULL, 131),
(41, '搞笑', 9, 1, NULL, 138),
(42, '日常', 9, 1, NULL, 21),
(43, 'OP/ED/OST', 5, 1, NULL, 54),
(44, '音乐选集', 5, 1, NULL, 130),
(45, '美食圈', 9, 1, NULL, 76),
(46, '动物圈', 9, 1, NULL, 75),
(47, '手工', 9, 1, NULL, 161),
(48, '绘画', 9, 1, NULL, 162),
(49, '运动', 9, 1, NULL, 163),
(50, '其他', 9, 1, NULL, 174),
(51, '纪录片', 8, 1, NULL, 37),
(52, '趣味科普人文', 8, 1, NULL, 124),
(53, '野生技术协会', 8, 1, NULL, 122),
(54, '演讲•公开课', 8, 1, NULL, 39),
(55, '星海', 8, 1, NULL, 96),
(56, '数码', 8, 1, NULL, 95),
(57, '机械', 8, 1, NULL, 98),
(58, '单机游戏', 7, 1, NULL, 17),
(59, '电子竞技', 7, 1, NULL, 171),
(60, '手机游戏', 7, 1, NULL, 172),
(61, '网络游戏', 7, 1, NULL, 65),
(62, '桌游棋牌', 7, 1, NULL, 173),
(63, 'GMV', 7, 1, NULL, 121),
(64, '音游', 7, 1, NULL, 136),
(65, 'Mugen', 7, 1, NULL, 19),
(66, '宅舞', 6, 1, NULL, 20),
(67, '三次元舞蹈', 6, 1, NULL, 154),
(68, '舞蹈教程', 6, 1, NULL, 156),
(69, '电影', 0, 1, NULL, NULL),
(70, '电视剧', 0, 1, NULL, NULL),
(71, '电影相关', 69, 1, NULL, 82),
(72, '短片', 69, 1, NULL, 85),
(73, '欧美电影', 69, 1, NULL, 145),
(74, '日本电影', 69, 1, NULL, 146),
(75, '国产电影', 69, 1, NULL, 147),
(76, '其他国家', 69, 1, NULL, 83),
(77, '连载剧集', 70, 1, NULL, 15),
(78, '完结剧集', 70, 1, NULL, 34),
(79, '特摄', 70, 1, NULL, 86),
(80, '电视剧相关', 70, 1, NULL, 128);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bili_cate`
--
ALTER TABLE `bili_cate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `b_cate_id` (`b_cate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bili_cate`
--
ALTER TABLE `bili_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
