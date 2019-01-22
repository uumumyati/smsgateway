-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Jan 2019 pada 10.46
-- Versi Server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cisms306`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `berat_badan` int(3) NOT NULL,
  `tinggi_badan` int(3) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`ID`, `no_anggota`, `nama`, `tanggal_lahir`, `berat_badan`, `tinggi_badan`) VALUES
(1, '1025', 'agus hariyanto', '1990-04-12', 45, 167),
(2, '1050', 'dodit mulyanto', '1992-09-13', 52, 165),
(3, '1075', 'indra herlambang', '1982-02-06', 44, 168);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data untuk tabel `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2016-08-24 19:20:17', '2016-08-03 12:44:13', '0074006500730020006400610072006900200074006900770069', '+6285655466927', 'Default_No_Compression', '', '+62816124', -1, 'Mohon informasi pelaksanaan rapat Dewan Guru', 2, '', 'false'),
('2016-08-24 19:24:13', '2016-08-24 19:24:01', '004F00700065007200610074006F007200200053006D0073002000470061007400650077006100790020004D006F0068006F006E0020004B00650020005200750061006E006700200047007500720075', '+6285785466352', 'Default_No_Compression', '', '+62816124', -1, 'Operator Sms Gateway Mohon Ke Ruang Guru', 29, '', 'false'),
('2016-08-24 19:27:19', '2016-08-24 19:24:01', '004F00700065007200610074006F007200200053006D0073002000470061007400650077006100790020004D006F0068006F006E0020004B00650020005200750061006E006700200047007500720075', '+6289646587092', 'Default_No_Compression', '', '+62816124', -1, 'Mohon ijin tidak mengajar, karena sakit. Terima kasih.', 30, '', 'false'),
('2016-08-24 19:27:19', '2016-08-24 19:24:01', '004F00700065007200610074006F007200200053006D0073002000470061007400650077006100790020004D006F0068006F006E0020004B00650020005200750061006E006700200047007500720075', '+6281276879383', 'Default_No_Compression', '', '+62816124', -1, 'Minta tolong kepada Guru Piket untuk memberikan tugas Sejarah pada kelas X-1 pada jam ke-6.', 31, '', 'false'),
('2016-08-24 19:31:36', '2016-08-24 19:24:01', '004F00700065007200610074006F007200200053006D0073002000470061007400650077006100790020004D006F0068006F006E0020004B00650020005200750061006E006700200047007500720075', '+6281895689093', 'Default_No_Compression', '', '+62816124', -1, 'Mohon ijin untuk anak kami Rahma Widyasari kelas XI IPA - 3 untuk tidak hadir karena sakit.', 32, '', 'false'),
('2016-08-24 19:31:36', '2016-08-24 19:24:01', '004F00700065007200610074006F007200200053006D0073002000470061007400650077006100790020004D006F0068006F006E0020004B00650020005200750061006E006700200047007500720075', '+6281995386839', 'Default_No_Compression', '', '+62816124', -1, 'Mohon informasi kehadiran putra kami Rizal Ramadhan kelas XII IPS - 2 pada hari ini.', 33, '', 'false');

--
-- Trigger `inbox`
--
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER //
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox`
 FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Trigger `outbox`
--
DROP TRIGGER IF EXISTS `outbox_timestamp`;
DELIMITER //
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `pbk`
--

INSERT INTO `pbk` (`ID`, `GroupID`, `Name`, `Number`) VALUES
(3, 2, 'Awan Pribadi', '+6285785466352'),
(4, 2, 'Sisworoso, S.pd, M.Pd', '+6285674934596'),
(5, 2, 'Drs. Pratikno', '+6281276879383'),
(6, 2, 'Candra Pratiwi, S.Hum', '+6285749422912'),
(7, 2, 'Lilis Rohani, S.Pd', '+6289646587092'),
(9, 3, 'Lilik Setyowati, S.E', '+6281235468605'),
(10, 3, 'Wiwik Pujiastuti', '+6285874834790'),
(11, 3, 'Sujono', '+6281555666777'),
(12, 3, 'Paimin', '+6285677033444');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `pbk_groups`
--

INSERT INTO `pbk_groups` (`Name`, `ID`) VALUES
('Guru', 2),
('Karyawan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `phones`
--

INSERT INTO `phones` (`ID`, `UpdatedInDB`, `InsertIntoDB`, `TimeOut`, `Send`, `Receive`, `IMEI`, `Client`, `Battery`, `Signal`, `Sent`, `Received`) VALUES
('', '2016-08-29 15:44:17', '2016-08-29 14:53:54', '2016-08-29 15:44:27', 'yes', 'yes', '353907049302499', 'Gammu 1.33.0, Windows Server 2007, GCC 4.7, MinGW 3.11', 100, 24, 2, 5);

--
-- Trigger `phones`
--
DROP TRIGGER IF EXISTS `phones_timestamp`;
DELIMITER //
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `polling`
--

CREATE TABLE IF NOT EXISTS `polling` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `voting` int(11) NOT NULL DEFAULT '0',
  `kode` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `polling`
--

INSERT INTO `polling` (`ID`, `nama`, `voting`, `kode`) VALUES
(1, 'Adipati Dolken', 2, 'VOTE ADIPATI'),
(2, 'Herjunot Ali', 4, 'VOTE JUNOT'),
(3, 'Lukman Sardi', 5, 'VOTE LUKMAN'),
(4, 'Reza Rahadian', 24, 'VOTE REZA'),
(5, 'Vino Bastian', 9, 'VOTE VINO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` varchar(5) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `pesan` varchar(160) NOT NULL,
  `status` enum('terkirim','belum') NOT NULL DEFAULT 'belum',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`ID`, `tanggal`, `jam`, `no_hp`, `pesan`, `status`) VALUES
(3, '2016-08-25', '19:55', '+6285749422912', 'Tes SMS Terjadwal App CISMS306.', 'terkirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sentitems`
--

INSERT INTO `sentitems` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `DeliveryDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `SenderID`, `SequencePosition`, `Status`, `StatusError`, `TPMR`, `RelativeValidity`, `CreatorID`) VALUES
('2016-08-25 14:52:30', '2016-08-25 14:52:18', '2016-08-25 14:52:30', NULL, '0042006500720061007400200062006100640061006E00200044004F0044004900540020004D0055004C00590041004E0054004F0020006100640061006C006100680020003500320020006B0067002E', '+6285785466352', 'Default_No_Compression', '', '+62816124', -1, 'Berat badan DODIT MULYANTO adalah 52 kg.', 7, '', 1, 'SendingOKNoReport', -1, 243, 255, ''),
('2016-08-29 14:56:04', '2016-08-29 14:55:53', '2016-08-29 14:56:04', NULL, '00540061006E006700670061006C0020006C0061006800690072002000410047005500530020004800410052004900590041004E0054004F0020006100640061006C00610068002000310032002D00300034002D0031003900390030002E', '+6282332557253', 'Default_No_Compression', '', '+62816124', -1, 'Tanggal lahir AGUS HARIYANTO adalah 12-04-1990.', 9, '', 1, 'SendingOKNoReport', -1, 34, 255, ''),
('2019-01-22 08:12:58', '2019-01-22 08:12:41', '2019-01-22 08:12:58', NULL, '00680079002000670061006E00740065006E0067', '+6289601901385', 'Default_No_Compression', '', '+6289644000001', -1, 'hy ganteng', 1, '', 1, 'SendingOKNoReport', -1, 69, 255, ''),
('2019-01-22 08:15:13', '2019-01-22 08:14:40', '2019-01-22 08:15:13', NULL, '0072006500660069002000630061006E0074006900690069006B0020006C006F0076006500200079006F0075007500750075', '+6289622996960', 'Default_No_Compression', '', '+6289644000001', -1, 'refi cantiiik love youuuu', 2, '', 1, 'SendingOKNoReport', -1, 70, 255, ''),
('2019-01-22 08:48:18', '2019-01-22 08:47:47', '2019-01-22 08:48:18', NULL, '0070006500720063006F006200610061006E00200073006D0073002000670061007400650077006100790020006B0065006C006F006D0070006F006B00200033', '+6285795163129', 'Default_No_Compression', '', '+6289644000001', -1, 'percobaan sms gateway kelompok 3', 3, '', 1, 'SendingOKNoReport', -1, 71, 255, '');

--
-- Trigger `sentitems`
--
DROP TRIGGER IF EXISTS `sentitems_timestamp`;
DELIMITER //
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `signature`
--

CREATE TABLE IF NOT EXISTS `signature` (
  `message` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `signature`
--

INSERT INTO `signature` (`message`) VALUES
('Dikirim dari App CISMS306.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isBlokir` enum('y','n') NOT NULL DEFAULT 'n',
  `level` enum('operator','admin') NOT NULL DEFAULT 'operator',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `isBlokir`, `level`) VALUES
(1, 'admin', '89ccfac87d8d06db06bf3211cb2d69ed', 'n', 'admin'),
(2, 'awan', 'e19cb7c038c2159012047e8b276bb6a2', 'n', 'operator'),
(5, 'jono', '42867493d4d4874f331d288df0044baa', 'n', 'operator'),
(6, 'arman', '66059a527018b32e4597dd27574929f6', 'n', 'operator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
