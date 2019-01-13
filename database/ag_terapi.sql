/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.1.29-MariaDB : Database - ag_terapi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ag_terapi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ag_terapi`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `level` varchar(16) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`user`,`pass`,`level`) values ('admin','admin','admin'),('user','user','user');

/*Table structure for table `tb_hari` */

DROP TABLE IF EXISTS `tb_hari`;

CREATE TABLE `tb_hari` (
  `kode_hari` varchar(256) NOT NULL,
  `nama_hari` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`kode_hari`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_hari` */

insert  into `tb_hari`(`kode_hari`,`nama_hari`) values ('H01','Senin'),('H02','Selasa'),('H03','Rabu'),('H04','Kamis'),('H05','Jumat'),('H06','Sabtu'),('H07','Minggu');

/*Table structure for table `tb_jadwal` */

DROP TABLE IF EXISTS `tb_jadwal`;

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `kode_siswa` varchar(16) DEFAULT NULL,
  `kode_waktu` varchar(16) DEFAULT NULL,
  `kode_ruang` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jadwal` */

insert  into `tb_jadwal`(`id_jadwal`,`kode_siswa`,`kode_waktu`,`kode_ruang`) values (1,'S001','17','R01'),(2,'S002','1','R01'),(3,'S003','31','R02'),(4,'S004','15','R05'),(5,'S005','10','R01'),(6,'S006','6','R06'),(7,'S007','4','R04'),(8,'S008','29','R05'),(9,'S009','5','R03'),(10,'S010','24','R03'),(11,'S011','33','R03'),(12,'S012','21','R05'),(13,'S013','8','R06'),(14,'S014','22','R03'),(15,'S015','34','R05'),(16,'S016','35','R01'),(17,'S017','7','R06'),(18,'S018','2','R04'),(19,'S019','30','R04'),(20,'S020','23','R03');

/*Table structure for table `tb_jam` */

DROP TABLE IF EXISTS `tb_jam`;

CREATE TABLE `tb_jam` (
  `kode_jam` varchar(16) NOT NULL,
  `nama_jam` time DEFAULT NULL,
  PRIMARY KEY (`kode_jam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_jam` */

insert  into `tb_jam`(`kode_jam`,`nama_jam`) values ('J01','07:30:00'),('J02','09:00:00'),('J03','10:30:00'),('J04','12:00:00'),('J05','13:30:00'),('J06','15:00:00');

/*Table structure for table `tb_ruang` */

DROP TABLE IF EXISTS `tb_ruang`;

CREATE TABLE `tb_ruang` (
  `kode_ruang` varchar(16) NOT NULL,
  `nama_ruang` varchar(255) DEFAULT NULL,
  `jenis` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_ruang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_ruang` */

insert  into `tb_ruang`(`kode_ruang`,`nama_ruang`,`jenis`) values ('R01','Ruang 1','Pra Akademik'),('R02','Ruang 2','Pra Akademik'),('R03','Ruang 3','Akademik'),('R04','Ruang 4','Akademik'),('R05','Ruang 5','Akademik'),('R06','Ruang 6','Akademik');

/*Table structure for table `tb_siswa` */

DROP TABLE IF EXISTS `tb_siswa`;

CREATE TABLE `tb_siswa` (
  `kode_siswa` varchar(16) NOT NULL,
  `nama_siswa` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` varchar(16) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `wali` varchar(255) DEFAULT NULL,
  `telpon` varchar(16) DEFAULT NULL,
  `kode_terapi` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_siswa` */

insert  into `tb_siswa`(`kode_siswa`,`nama_siswa`,`tanggal_lahir`,`jk`,`alamat`,`wali`,`telpon`,`kode_terapi`) values ('S001','Siswa 1','2000-07-15','Laki-laki',NULL,NULL,NULL,'T02'),('S002','Siswa 2','2000-07-16','Perempuan',NULL,NULL,NULL,'T03'),('S003','Siswa 3','2000-07-17','Perempuan',NULL,NULL,NULL,'T02'),('S004','Siswa 4','2000-07-18','Laki-laki',NULL,NULL,NULL,'T06'),('S005','Siswa 5','2000-07-19','Laki-laki',NULL,NULL,NULL,'T01'),('S006','Siswa 6','2000-07-20','Laki-laki',NULL,NULL,NULL,'T06'),('S007','Siswa 7','2000-07-21','Perempuan',NULL,NULL,NULL,'T03'),('S008','Siswa 8','2000-07-22','Laki-laki',NULL,NULL,NULL,'T03'),('S009','Siswa 9','2000-07-23','Perempuan',NULL,NULL,NULL,'T06'),('S010','Siswa 10','2000-07-24','Laki-laki',NULL,NULL,NULL,'T04'),('S011','Siswa 11',NULL,NULL,NULL,NULL,NULL,'T04'),('S012','Siswa 12',NULL,NULL,NULL,NULL,NULL,'T05'),('S013','Siswa 13',NULL,NULL,NULL,NULL,NULL,'T06'),('S014','Siswa 14',NULL,NULL,NULL,NULL,NULL,'T03'),('S015','Siswa 15',NULL,NULL,NULL,NULL,NULL,'T04'),('S016','Siswa 16',NULL,NULL,NULL,NULL,NULL,'T01'),('S017','Siswa 17',NULL,NULL,NULL,NULL,NULL,'T06'),('S018','Siswa 18',NULL,NULL,NULL,NULL,NULL,'T04'),('S019','Siswa 19',NULL,NULL,NULL,NULL,NULL,'T04'),('S020','Siswa 20',NULL,NULL,NULL,NULL,NULL,'T03');

/*Table structure for table `tb_terapi` */

DROP TABLE IF EXISTS `tb_terapi`;

CREATE TABLE `tb_terapi` (
  `kode_terapi` varchar(256) NOT NULL,
  `nama_terapi` varchar(256) DEFAULT NULL,
  `semester` int(11) DEFAULT '0',
  `jenis` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_terapi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_terapi` */

insert  into `tb_terapi`(`kode_terapi`,`nama_terapi`,`semester`,`jenis`) values ('T01','Terapi 1',3,'Pra Akademik'),('T02','Terapi 2',2,'Pra Akademik'),('T03','Terapi 3',3,'Akademik'),('T04','Terapi 4',2,'Akademik'),('T05','Terapi 5',3,'Akademik'),('T06','Terapi 6',2,'Akademik');

/*Table structure for table `tb_terapis` */

DROP TABLE IF EXISTS `tb_terapis`;

CREATE TABLE `tb_terapis` (
  `kode_terapis` varchar(16) NOT NULL,
  `nama_terapis` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_terapis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_terapis` */

insert  into `tb_terapis`(`kode_terapis`,`nama_terapis`,`alamat`,`telpon`) values ('D001','Dosen 01','Alamat 1','1234567890'),('D002','Dosen 02','',NULL),('D003','Dosen 03','',NULL),('D004','Dosen 04','',NULL),('D005','Dosen 05','',NULL);

/*Table structure for table `tb_waktu` */

DROP TABLE IF EXISTS `tb_waktu`;

CREATE TABLE `tb_waktu` (
  `kode_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `kode_hari` varchar(16) DEFAULT NULL,
  `kode_jam` varchar(16) DEFAULT NULL,
  `status_waktu` varchar(16) DEFAULT NULL,
  `kode_terapis` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_waktu`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `tb_waktu` */

insert  into `tb_waktu`(`kode_waktu`,`kode_hari`,`kode_jam`,`status_waktu`,`kode_terapis`) values (1,'H01','J01','Tersedia','D003'),(2,'H01','J02','Tersedia','D002'),(3,'H01','J03','Tersedia','D002'),(4,'H01','J04','Tersedia','D003'),(5,'H01','J05','Tersedia','D002'),(6,'H02','J02','Tersedia','D002'),(7,'H02','J01','Tersedia','D002'),(8,'H02','J03','Tersedia','D002'),(9,'H02','J04','Tidak','D003'),(10,'H02','J05','Tersedia','D005'),(11,'H03','J01','Tersedia','D004'),(12,'H03','J02','Tersedia','D004'),(13,'H03','J03','Tidak','D005'),(14,'H03','J04','Tersedia','D005'),(15,'H03','J05','Tersedia','D004'),(16,'H04','J01','Tersedia','D005'),(17,'H04','J02','Tersedia','D004'),(18,'H04','J03','Tidak','D002'),(19,'H04','J04','Tersedia','D001'),(20,'H04','J05','Tidak','D004'),(21,'H05','J01','Tersedia','D003'),(22,'H05','J02','Tersedia','D002'),(23,'H05','J03','Tersedia','D002'),(24,'H05','J04','Tersedia','D001'),(25,'H05','J05','Tersedia','D002'),(26,'H06','J01','Tersedia','D002'),(27,'H06','J02','Tersedia','D001'),(28,'H06','J03','Tersedia','D004'),(29,'H06','J04','Tersedia','D004'),(30,'H06','J05','Tersedia','D001'),(31,'H01','J06','Tersedia','D003'),(32,'H02','J06','Tidak','D002'),(33,'H03','J06','Tersedia','D002'),(34,'H04','J06','Tersedia','D003'),(35,'H05','J06','Tersedia','D004'),(36,'H06','J06','Tersedia','D005');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
