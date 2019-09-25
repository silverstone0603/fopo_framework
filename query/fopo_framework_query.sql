-- phpMyAdmin SQL Dump
-- version 4.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- 생성 시간: 19-09-25 10:56
-- 서버 버전: 5.7.25
-- PHP 버전: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `fopo`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `article_like`
--

CREATE TABLE IF NOT EXISTS `article_like` (
  `mem_no` int(11) NOT NULL,
  `brd_no` int(11) NOT NULL,
  `like_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `event_article`
--

CREATE TABLE IF NOT EXISTS `event_article` (
  `eve_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `eve_title` varchar(100) NOT NULL,
  `eve_content` varchar(100) NOT NULL,
  `eve_file` varchar(100) NOT NULL,
  `eve_term` varchar(100) NOT NULL DEFAULT '',
  `eve_wridate` datetime NOT NULL,
  `eve_division` tinyint(1) NOT NULL,
  `eve_posting` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `event_article`
--

INSERT INTO `event_article` (`eve_no`, `mem_no`, `eve_title`, `eve_content`, `eve_file`, `eve_term`, `eve_wridate`, `eve_division`, `eve_posting`) VALUES
(1, 4, '공지사항입니다.', '첫번째 공지사항 내용 부분', '2.jpg', '', '2019-08-09 07:42:40', 1, 1),
(2, 4, '첫번째 이벤트입니다.', '첫번째 이벤트 내용 부분', 'image-5.png', '2019.08.08 ~ 2019.08.15', '2019-08-09 05:47:03', 0, 1),
(5, 4, '두번째 이벤트 입니다.', '내용 들어갈 부분 입니다.', 'C:fakepathimage-5.png', '2019.08.09 ~ 2019.08.15', '2019-08-09 05:22:05', 0, 1),
(6, 4, '세번째 이벤트 입니다.', '내용입니다', 'C:fakepathimage-5.png', '', '2019-08-09 05:24:18', 0, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `filter_list`
--

CREATE TABLE IF NOT EXISTS `filter_list` (
  `fil_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `brd_no` int(11) DEFAULT NULL,
  `fil_bright` int(11) DEFAULT NULL,
  `fil_chroma` int(11) DEFAULT NULL,
  `fil_r` int(11) DEFAULT NULL,
  `fil_g` int(11) DEFAULT NULL,
  `fil_b` int(11) DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `friend_list`
--

CREATE TABLE IF NOT EXISTS `friend_list` (
  `fri_idx` int(11) NOT NULL,
  `mem_no` int(11) DEFAULT NULL,
  `fri_no` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `friend_list`
--

INSERT INTO `friend_list` (`fri_idx`, `mem_no`, `fri_no`) VALUES
(3, 9, 5),
(4, 9, 2),
(33, 5, 2),
(34, 3, 1),
(41, 3, 4),
(46, 19, 2),
(51, 4, 5),
(52, 4, 7),
(53, 4, 2),
(54, 4, 6),
(55, 4, 3),
(56, 3, 7),
(58, 5, 4),
(59, 5, 7);

-- --------------------------------------------------------

--
-- 테이블 구조 `mem_list`
--

CREATE TABLE IF NOT EXISTS `mem_list` (
  `mem_no` int(11) NOT NULL,
  `mem_id` varchar(100) DEFAULT NULL,
  `mem_pw` varchar(100) DEFAULT NULL,
  `mem_level` varchar(100) NOT NULL DEFAULT 'user',
  `mem_picfile` varchar(100) DEFAULT NULL COMMENT '사용자 프로필 사진',
  `mem_nick` varchar(100) DEFAULT NULL,
  `mem_email` varchar(100) DEFAULT NULL,
  `mem_phone` varchar(100) DEFAULT NULL,
  `mem_gender` int(11) DEFAULT NULL,
  `mem_regdate` datetime DEFAULT NULL,
  `mem_lastlogin` datetime DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `mem_list`
--

INSERT INTO `mem_list` (`mem_no`, `mem_id`, `mem_pw`, `mem_level`, `mem_picfile`, `mem_nick`, `mem_email`, `mem_phone`, `mem_gender`, `mem_regdate`, `mem_lastlogin`, `tmp`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '0', 'FOPO', 'admin@test.com', '010-1234-5678', 1, '2019-06-03 00:00:00', '2019-09-04 23:54:22', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `page_log`
--

CREATE TABLE IF NOT EXISTS `page_log` (
  `plog_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `plog_log` varchar(100) DEFAULT NULL,
  `plog_date` datetime DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `phozone_article`
--

CREATE TABLE IF NOT EXISTS `phozone_article` (
  `brd_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `zone_no` int(11) NOT NULL,
  `brd_content` varchar(100) DEFAULT NULL,
  `brd_view` int(11) DEFAULT '0',
  `brd_like` int(11) DEFAULT '0',
  `brd_date` datetime DEFAULT NULL,
  `brd_edate` datetime DEFAULT NULL,
  `brd_status` int(11) DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `phozone_article`
--

INSERT INTO `phozone_article` (`brd_no`, `mem_no`, `zone_no`, `brd_content`, `brd_view`, `brd_like`, `brd_date`, `brd_edate`, `brd_status`, `tmp`) VALUES
(118, 2, 3, '동촌유원지1', 0, 0, '2019-09-08 15:26:21', NULL, NULL, NULL),
(119, 2, 3, '동촌유원지2', 0, 0, '2019-09-08 15:26:21', NULL, NULL, NULL),
(120, 2, 3, '동촌유원지3', 0, 0, '2019-09-08 15:26:21', NULL, NULL, NULL),
(121, 2, 3, '동촌유원지4', 0, 0, '2019-09-08 15:26:21', NULL, NULL, NULL),
(122, 2, 3, '동촌유원지5', 0, 0, '2019-09-08 15:26:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `phozone_files`
--

CREATE TABLE IF NOT EXISTS `phozone_files` (
  `file_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `zone_no` int(11) NOT NULL,
  `brd_no` int(11) NOT NULL,
  `file_oriname` varchar(100) DEFAULT NULL,
  `file_savename` varchar(100) DEFAULT NULL,
  `file_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `phozone_files`
--

INSERT INTO `phozone_files` (`file_no`, `mem_no`, `zone_no`, `brd_no`, `file_oriname`, `file_savename`, `file_date`, `tmp`) VALUES
(27, 2, 3, 118, NULL, 'dc_test1.png', '2019-09-08 15:26:21', NULL),
(28, 2, 3, 119, NULL, 'dc_test2.png', '2019-09-08 15:26:21', NULL),
(29, 2, 3, 120, NULL, 'dc_test3.png', '2019-09-08 15:26:21', NULL),
(30, 2, 3, 121, NULL, 'dc_test4.png', '2019-09-08 15:26:21', NULL),
(31, 2, 3, 122, NULL, 'dc_test5.png', '2019-09-08 15:26:21', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `phozone_list`
--

CREATE TABLE IF NOT EXISTS `phozone_list` (
  `zone_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `zone_placename` varchar(30) DEFAULT NULL,
  `zone_regdate` datetime NOT NULL,
  `zone_x` float DEFAULT NULL,
  `zone_y` float DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `phozone_list`
--

INSERT INTO `phozone_list` (`zone_no`, `mem_no`, `zone_placename`, `zone_regdate`, `zone_x`, `zone_y`, `tmp`) VALUES
(1, 1, '수성못', '2019-06-21 20:06:51', 35.8276, 128.614, NULL),
(2, 1, '편의점', '2019-06-21 20:06:51', 35.8927, 128.622, NULL),
(3, 1, '동촌유원지', '2019-06-21 20:06:51', 35.8828, 128.651, NULL),
(4, 1, '아양교', '2019-06-21 20:06:51', 35.888, 128.639, NULL),
(5, 1, '강정보(디아크문화관)입구', '2019-06-21 20:06:51', 35.849, 128.449, NULL),
(6, 1, '이월드', '2019-06-21 20:06:51', 35.8491, 128.423, NULL),
(7, 1, '송해공원', '2019-06-21 20:06:51', 35.7688, 128.485, NULL),
(8, 1, '천지연폭포', '2019-06-21 20:06:51', 33.247, 126.546, NULL),
(9, 1, '산굼부리', '2019-06-21 20:06:51', 33.4315, 126.688, NULL),
(10, 1, '대전 오월드', '2019-06-21 20:06:51', 36.2799, 127.403, NULL),
(11, 1, '한강공원', '2019-06-23 05:35:11', 37.5284, 126.926, NULL),
(12, 1, '한국 민속촌', '2019-06-23 05:35:11', 37.2587, 127.117, NULL),
(13, 1, '보문단지', '2019-06-23 05:36:36', 35.8427, 129.284, NULL),
(14, 1, '수원화성', '2019-06-23 05:37:12', 37.2885, 127.012, NULL),
(15, 1, '전주한옥마을', '2019-06-23 05:38:19', 35.8156, 127.153, NULL),
(16, 1, '안동하회마을', '2019-06-23 05:39:06', 36.5396, 128.518, NULL),
(17, 1, '수성못_1', '2019-06-23 05:43:39', 35.8286, 128.618, NULL),
(18, 1, '수성못_2', '2019-06-23 05:44:07', 35.8265, 128.618, NULL),
(19, 1, '수성못_3', '2019-06-23 05:44:38', 35.827, 128.622, NULL),
(20, 1, '영진전문대학교', '2019-08-14 12:30:00', 35.8967, 128.621, NULL),
(21, 1, '신림동', '2019-08-14 12:30:00', 37.4844, 126.916, NULL),
(22, 1, '상원이집', '2019-08-14 12:30:00', 35.8619, 128.622, NULL),
(23, 3, '그랜드호텔', '2019-09-07 00:00:00', 35.8577, 128.625, NULL),
(24, 3, '한외빌딩', '2019-09-07 00:00:00', 37.5682, 126.982, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `phozone_reply`
--

CREATE TABLE IF NOT EXISTS `phozone_reply` (
  `re_no` int(11) NOT NULL,
  `zone_no` int(11) NOT NULL,
  `brd_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `rre_no` int(11) DEFAULT NULL,
  `re_comment` varchar(100) DEFAULT NULL,
  `re_date` datetime DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `phozone_reply`
--

INSERT INTO `phozone_reply` (`re_no`, `zone_no`, `brd_no`, `mem_no`, `rre_no`, `re_comment`, `re_date`, `tmp`) VALUES
(61, 3, 121, 4, NULL, '예뻐요', '2019-09-17 23:11:39', NULL),
(62, 3, 121, 4, 61, '감사합니다', '2019-09-17 23:11:47', NULL),
(67, 3, 137, 5, NULL, 'Test', '2019-09-19 11:55:28', NULL),
(68, 3, 137, 5, 67, 'Wow', '2019-09-19 11:55:34', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `pho_festival`
--

CREATE TABLE IF NOT EXISTS `pho_festival` (
  `fes_no` int(11) NOT NULL,
  `fes_filename` varchar(100) NOT NULL,
  `fes_weather` varchar(100) NOT NULL,
  `fes_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `pho_qa`
--

CREATE TABLE IF NOT EXISTS `pho_qa` (
  `qa_idx` int(11) NOT NULL,
  `qa_title` varchar(100) NOT NULL,
  `qa_content` varchar(100) NOT NULL,
  `qa_date` datetime DEFAULT NULL,
  `qa_edate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `pho_qa`
--

INSERT INTO `pho_qa` (`qa_idx`, `qa_title`, `qa_content`, `qa_date`, `qa_edate`) VALUES
(1, '비밀번호를 잊어버리셨나요?', '이메일로 문의 주시기 바랍니다.', '2019-07-17 00:00:00', '2019-08-21'),
(2, '글 업로드는 처음이신가요?', '카메라를 실행하시면 알려드립니다.', '2019-07-17 00:00:00', NULL),
(3, '아이폰(IOS)에서는 어플이 없나요?', '현재 IOS개발은 계획중에 있습니다.', '2019-07-17 00:00:00', NULL),
(4, 'FOPO AR카메라 어떻게 사용하나요?', '도착지에 도착하셔서 카메라를 켜고 주변을 스캔하시면 마커가 표시됩니다.', '2019-07-17 00:00:00', '2019-08-14'),
(5, '웹(WEB)에서 회원가입 안되나요?', '웹에서는 현재 회원가입이 불가능합니다.', '2019-07-17 00:00:00', NULL),
(6, '회원탈퇴는 어떻게 하나요?', '회원탈퇴는 어플에서 하시면 됩니다.', '2019-07-17 00:00:00', NULL),
(7, 'FOPO에서 제공하는 기능들은 모두 무료로 이용이 가능한가요?', 'FOPO에서 제공하는 기능은 현재 모두 무료입니다.', '2019-07-17 00:00:00', NULL),
(8, 'FOPO를 사용하기 위한 시스템 요구사항은 무엇인가요?', 'AR을 기반으로 하기 때문에 AR을 지원하는 기기에서 사용이 가능합니다.', '2019-07-17 00:00:00', '2019-08-14'),
(9, 'FOPO에서 어떤 광고를 볼 수 있나요?', '광고는 현재 사용하지 않고 있습니다.', '2019-07-17 00:00:00', NULL),
(10, '앱(APP)에 문제가 있는 경우 어떻게 해야하나요?', '개발팀 이메일로 문의주시면 감사하겠습니다.', '2019-07-17 00:00:00', NULL),
(11, '해외에는 언제 FOPO APP이 출시되나요?', '해외버전은 따로 준비하지 않고 있습니다.', '2019-07-17 00:00:00', '2019-08-14');

-- --------------------------------------------------------

--
-- 테이블 구조 `pho_question`
--

CREATE TABLE IF NOT EXISTS `pho_question` (
  `qu_idx` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `qu_content` varchar(100) NOT NULL,
  `qu_date` datetime NOT NULL,
  `qu_category` varchar(100) NOT NULL,
  `qu_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `pho_question`
--

INSERT INTO `pho_question` (`qu_idx`, `mem_no`, `qu_content`, `qu_date`, `qu_category`, `qu_status`) VALUES
(1, 9, '비밀번호를 까먹었어요', '2019-07-18 00:00:00', '1', 1),
(2, 9, '기타문의', '2019-07-12 00:00:00', '2', 1),
(3, 7, '사용법좀 자세히 알려주세요', '2019-07-12 00:00:00', '3', 1),
(4, 9, '광고좀 넣고 싶어요', '2019-07-13 00:00:00', '4', 1),
(5, 5, '웹에서 로그인은 어떻게 하나요?', '2019-07-14 00:00:00', '5', 1),
(6, 7, '셀카용으로는 없나요 ?', '2019-07-15 00:00:00', '3', 1),
(7, 2, '필터는 어떻게 하나요 ?', '2019-07-15 00:00:00', '7', 1),
(8, 3, '포즈 추가는 어떻게 하나요 ?', '2019-07-16 00:00:00', '6', 1),
(9, 4, '광고가 없는 버전은 없나요 ?', '2019-07-16 00:00:00', '2', 1),
(10, 5, 'ㅇㅇㅇ좀 추가해주세요', '2019-07-18 00:00:00', '2', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `pose_log`
--

CREATE TABLE IF NOT EXISTS `pose_log` (
  `pose_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `pose_date` datetime DEFAULT NULL,
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `qu_category`
--

CREATE TABLE IF NOT EXISTS `qu_category` (
  `qu_category` int(11) NOT NULL,
  `ca_title` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `qu_category`
--

INSERT INTO `qu_category` (`qu_category`, `ca_title`) VALUES
(1, '회원 문의'),
(2, '기타 문의'),
(3, '앱 문의'),
(4, '광고 문의'),
(5, '웹 문의'),
(6, '포즈 문의'),
(7, '필터 문의');

-- --------------------------------------------------------

--
-- 테이블 구조 `session_list`
--

CREATE TABLE IF NOT EXISTS `session_list` (
  `sess_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `sess_token` text NOT NULL,
  `sess_verify` int(11) NOT NULL,
  `sess_devicetype` int(11) DEFAULT NULL,
  `sess_orgdate` datetime DEFAULT NULL,
  `sess_lastdate` datetime DEFAULT NULL,
  `sess_ip` varchar(100) DEFAULT NULL,
  `sess_is` int(11) DEFAULT '0',
  `tmp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `session_list`
--

INSERT INTO `session_list` (`sess_no`, `mem_no`, `sess_token`, `sess_verify`, `sess_devicetype`, `sess_orgdate`, `sess_lastdate`, `sess_ip`, `sess_is`, `tmp`) VALUES
(325, 6, '5d81cdfab6eda', 0, 0, '2019-09-18 15:26:02', '2019-09-18 15:26:02', '39.7.59.187', 0, NULL),
(328, 6, '5d81d15dd30c4', 0, 1, '2019-09-18 15:40:29', '2019-09-18 15:40:29', '223.39.155.26', 1, NULL),
(344, 4, '5d83942d36eef', 0, 1, '2019-09-19 23:43:57', '2019-09-19 23:43:57', '218.237.225.233', 1, NULL),
(345, 5, '5d83946f68e86', 0, 0, '2019-09-19 23:45:03', '2019-09-19 23:45:03', '223.38.28.243', 0, NULL),
(346, 5, '5d839474acdd0', 0, 1, '2019-09-19 23:45:08', '2019-09-19 23:45:08', '218.237.225.233', 1, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `usrlogin_log`
--

CREATE TABLE IF NOT EXISTS `usrlogin_log` (
  `usrlog_no` int(11) NOT NULL,
  `mem_no` int(11) NOT NULL,
  `usrlog_os` varchar(100) DEFAULT NULL,
  `usrlog_browse` varchar(100) DEFAULT NULL,
  `usrlog_ip` varchar(100) DEFAULT NULL,
  `usrlog_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `weather`
--

CREATE TABLE IF NOT EXISTS `weather` (
  `wea_idx` int(11) NOT NULL,
  `wea_day` varchar(10) NOT NULL,
  `wea_min` int(11) NOT NULL,
  `wea_max` int(11) NOT NULL,
  `wea_status` varchar(50) NOT NULL,
  `wea_rain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `weather`
--

INSERT INTO `weather` (`wea_idx`, `wea_day`, `wea_min`, `wea_max`, `wea_status`, `wea_rain`) VALUES
(3, '목', 21, 26, '구름많음', 30),
(4, '금', 21, 28, '맑음', 10),
(5, '토', 21, 29, '구름많음', 30),
(6, '일', 21, 28, '구름많음', 30),
(7, '월', 20, 27, '구름많음', 30),
(8, '화', 18, 26, '구름많음', 30),
(9, '수', 17, 26, '구름많음', 30);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `article_like`
--
ALTER TABLE `article_like`
  ADD KEY `mem_no` (`mem_no`);

--
-- 테이블의 인덱스 `event_article`
--
ALTER TABLE `event_article`
  ADD PRIMARY KEY (`eve_no`);

--
-- 테이블의 인덱스 `filter_list`
--
ALTER TABLE `filter_list`
  ADD PRIMARY KEY (`fil_no`);

--
-- 테이블의 인덱스 `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`fri_idx`);

--
-- 테이블의 인덱스 `mem_list`
--
ALTER TABLE `mem_list`
  ADD PRIMARY KEY (`mem_no`);

--
-- 테이블의 인덱스 `page_log`
--
ALTER TABLE `page_log`
  ADD PRIMARY KEY (`plog_no`);

--
-- 테이블의 인덱스 `phozone_article`
--
ALTER TABLE `phozone_article`
  ADD PRIMARY KEY (`brd_no`),
  ADD KEY `FK_mem_list_TO_phozone_article` (`mem_no`),
  ADD KEY `FK_phozone_list_TO_phozone_article` (`zone_no`),
  ADD KEY `brd_no` (`brd_no`);

--
-- 테이블의 인덱스 `phozone_files`
--
ALTER TABLE `phozone_files`
  ADD PRIMARY KEY (`file_no`);

--
-- 테이블의 인덱스 `phozone_list`
--
ALTER TABLE `phozone_list`
  ADD PRIMARY KEY (`zone_no`);

--
-- 테이블의 인덱스 `phozone_reply`
--
ALTER TABLE `phozone_reply`
  ADD PRIMARY KEY (`re_no`);

--
-- 테이블의 인덱스 `pho_festival`
--
ALTER TABLE `pho_festival`
  ADD KEY `fes_no` (`fes_no`);

--
-- 테이블의 인덱스 `pho_qa`
--
ALTER TABLE `pho_qa`
  ADD KEY `qa_idx` (`qa_idx`);

--
-- 테이블의 인덱스 `pho_question`
--
ALTER TABLE `pho_question`
  ADD PRIMARY KEY (`qu_idx`);

--
-- 테이블의 인덱스 `pose_log`
--
ALTER TABLE `pose_log`
  ADD PRIMARY KEY (`pose_no`),
  ADD KEY `FK_mem_list_TO_pose_log` (`mem_no`);

--
-- 테이블의 인덱스 `qu_category`
--
ALTER TABLE `qu_category`
  ADD KEY `qu_category` (`qu_category`);

--
-- 테이블의 인덱스 `session_list`
--
ALTER TABLE `session_list`
  ADD PRIMARY KEY (`sess_no`),
  ADD KEY `FK_mem_list_TO_session_list` (`mem_no`);

--
-- 테이블의 인덱스 `usrlogin_log`
--
ALTER TABLE `usrlogin_log`
  ADD PRIMARY KEY (`usrlog_no`),
  ADD KEY `FK_mem_list_TO_usrlogin_log` (`mem_no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `article_like`
--
ALTER TABLE `article_like`
  MODIFY `mem_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `event_article`
--
ALTER TABLE `event_article`
  MODIFY `eve_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 테이블의 AUTO_INCREMENT `filter_list`
--
ALTER TABLE `filter_list`
  MODIFY `fil_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `fri_idx` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- 테이블의 AUTO_INCREMENT `mem_list`
--
ALTER TABLE `mem_list`
  MODIFY `mem_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- 테이블의 AUTO_INCREMENT `page_log`
--
ALTER TABLE `page_log`
  MODIFY `plog_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `phozone_article`
--
ALTER TABLE `phozone_article`
  MODIFY `brd_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- 테이블의 AUTO_INCREMENT `phozone_files`
--
ALTER TABLE `phozone_files`
  MODIFY `file_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- 테이블의 AUTO_INCREMENT `phozone_list`
--
ALTER TABLE `phozone_list`
  MODIFY `zone_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- 테이블의 AUTO_INCREMENT `phozone_reply`
--
ALTER TABLE `phozone_reply`
  MODIFY `re_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- 테이블의 AUTO_INCREMENT `pho_festival`
--
ALTER TABLE `pho_festival`
  MODIFY `fes_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `pho_qa`
--
ALTER TABLE `pho_qa`
  MODIFY `qa_idx` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- 테이블의 AUTO_INCREMENT `pho_question`
--
ALTER TABLE `pho_question`
  MODIFY `qu_idx` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- 테이블의 AUTO_INCREMENT `qu_category`
--
ALTER TABLE `qu_category`
  MODIFY `qu_category` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- 테이블의 AUTO_INCREMENT `session_list`
--
ALTER TABLE `session_list`
  MODIFY `sess_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=347;
--
-- 테이블의 AUTO_INCREMENT `usrlogin_log`
--
ALTER TABLE `usrlogin_log`
  MODIFY `usrlog_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=299;
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `phozone_article`
--
ALTER TABLE `phozone_article`
  ADD CONSTRAINT `FK_mem_list_TO_phozone_article` FOREIGN KEY (`mem_no`) REFERENCES `mem_list` (`mem_no`),
  ADD CONSTRAINT `FK_phozone_list_TO_phozone_article` FOREIGN KEY (`zone_no`) REFERENCES `phozone_list` (`zone_no`);

--
-- 테이블의 제약사항 `pose_log`
--
ALTER TABLE `pose_log`
  ADD CONSTRAINT `FK_mem_list_TO_pose_log` FOREIGN KEY (`mem_no`) REFERENCES `mem_list` (`mem_no`);

--
-- 테이블의 제약사항 `session_list`
--
ALTER TABLE `session_list`
  ADD CONSTRAINT `FK_mem_list_TO_session_list` FOREIGN KEY (`mem_no`) REFERENCES `mem_list` (`mem_no`);

--
-- 테이블의 제약사항 `usrlogin_log`
--
ALTER TABLE `usrlogin_log`
  ADD CONSTRAINT `FK_mem_list_TO_usrlogin_log` FOREIGN KEY (`mem_no`) REFERENCES `mem_list` (`mem_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
