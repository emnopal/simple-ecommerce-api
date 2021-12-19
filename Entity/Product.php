<?php

namespace Entity\Product{

    class Product{

        public function __construct(
            private ?string $nama_produk,
            private ?string $tipe_produk,
            private ?int $harga,
            private ?int $stok){
                $this->nama_produk = $nama_produk;
                $this->tipe_produk = $tipe_produk;
                $this->harga = $harga;
                $this->stok = $stok;
        }

        public function getNamaProduk(): ?string{
            return $this->nama_produk;
        }

        public function getTipeProduk(): ?string{
            return $this->tipe_produk;
        }

        public function getHarga(): ?int{
            return $this->harga;
        }

        public function getStok(): ?int{
            return $this->stok;
        }

        public function setNamaProduk(?string $nama_produk): void{
            $this->nama_produk = $nama_produk;
        }

        public function setTipeProduk(?string $tipe_produk): void{
            $this->tipe_produk = $tipe_produk;
        }

        public function setHarga(?int $harga): void{
            $this->harga = $harga;
        }

        public function setStok(?int $stok): void{
            $this->stok = $stok;
        }

    }

}