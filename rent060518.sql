-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 May 2018, 23:35:18
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rent`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `plate` varchar(10) NOT NULL,
  `gear` varchar(10) NOT NULL,
  `fuel` varchar(10) NOT NULL,
  `carName` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cars`
--

INSERT INTO `cars` (`id`, `plate`, `gear`, `fuel`, `carName`, `status`) VALUES
(1102, '06ABC123', 'manuel', 'elektrik', 't4', 'alÄ±nabilir'),
(1369, '34ABC123', 'manuel', 'dizel', 'arc3', 'alnabilir'),
(1370, '63ab123', 'otomatik', 'benzin', 'arc44', 'alinabilir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `password`, `type`) VALUES
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'calisan'),
(4, 'musteri', '7cb945493fd4764bbc4b88514acc329f', 'musteri'),
(6, 'x', '9dd4e461268c8034f5c8564e155c67a6', 'musteri'),
(7, 'xy', '81dc9bdb52d04dc20036dbd8313ed055', 'musteri'),
(8, 'df', 'eff7d5dba32b4da32d9a67a519434d3f', 'musteri'),
(9, 'yusuf1', '81dc9bdb52d04dc20036dbd8313ed055', 'yonetici'),
(10, 'yusuf', '81dc9bdb52d04dc20036dbd8313ed055', 'yonetici');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici` (`username`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1371;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
