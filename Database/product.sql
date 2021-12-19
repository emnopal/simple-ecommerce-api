CREATE DATABASE IF NOT EXISTS productdb;

CREATE TABLE IF NOT EXISTS `produk` (
    `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
    `nama_produk` varchar(30) DEFAULT NULL,
    `harga` int(50) DEFAULT NULL,
    `tipe_produk` varchar(30) DEFAULT NULL,
    `stok` int(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO `produk`(`nama_produk`, `harga`, `tipe_produk`, `stok`)
VALUES ('Super 25', 30000, 'Baju', 10);
INSERT INTO `produk`(`nama_produk`, `harga`, `tipe_produk`, `stok`)
VALUES ('Jeas Ver', 40000, 'Baju', 10);
INSERT INTO `produk`(`nama_produk`, `harga`, `tipe_produk`, `stok`)
VALUES ('Uyta', 50000, 'Baju', 10);
INSERT INTO `produk`(`nama_produk`, `harga`, `tipe_produk`, `stok`)
VALUES ('Vander', 60000, 'Baju', 10);