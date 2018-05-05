-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Nis 2018, 23:27:24
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
  `carName` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cars`
--

INSERT INTO `cars` (`id`, `plate`, `gear`, `fuel`, `carName`, `status`) VALUES
(3, '41ABC123', 'manuel', 'benzin', 'arc412', 'kullanÄ±mda'),
(4, '54ABC123', 'otomatik', 'elektrik', 'tesla1', 'alÄ±nabilir'),
(8, '34ABC12', 'otomatik', 'benzin', 'arc0', 'alÄ±nabilir'),
(9, '65KB123', 'manuel', 'elektrik', 'tesla2', 'alÄ±nabilir'),
(10, '33abc12', 'otomatik', 'benzin', 'arc5', 'kullanÄ±mda'),
(12, '61ts1967', 'manuel', 'elektrik', 'falcon', 'alÄ±nabilir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `password`, `type`) VALUES
(3, 'calisan', 'df4459c4e900e72ab805217d726e0ba4', 'calisan'),
(6, 'musteri', '7cb945493fd4764bbc4b88514acc329f', 'musteri'),
(7, 'yusuf', '81dc9bdb52d04dc20036dbd8313ed055', 'yonetici'),
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yonetici'),
(10, 'Ã¶zlem', '7f32e848f3f643ab76cd98f9a605cf66', 'yonetici');

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
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
