<?php

namespace Services\Product {

    require_once __DIR__ . "/../Model/ProductModel.php";
    require_once __DIR__ . "/../Entity/Product.php";

    use Model\Product\ProductModel;
    use Entity\Product\Product;

class ModelServices{

        private ProductModel $productModel;

        public function __construct(ProductModel $productModel){
            $this->productModel = $productModel;
        }

        public function showAllProduct(): mixed {
            if (!isset($_GET['id']) || $_GET['id'] == null) {
                return $this->productModel->showAllProduct();
            }else {
                return $this->productModel->getProductById(id: htmlspecialchars($_GET['id']));
            }
        }

        public function saveProduct(): mixed {
            if (
                !isset($_POST['nama']) || $_POST['nama'] == null ||
                !isset($_POST['tipe']) || $_POST['tipe'] == null ||
                !isset($_POST['harga']) || $_POST['harga'] == null ||
                !isset($_POST['stok']) || $_POST['stok'] == null
            ) {
                return null;
            }
            $nama_produk = $_POST['nama'];
            $tipe_produk = $_POST['tipe'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $product = new Product($nama_produk, $tipe_produk, $harga, $stok);
            return $this->productModel->saveProduct(product: $product);
        }

        public function updateProduct(): mixed {
            if (
                !isset($_POST['id']) || $_POST['id'] == null ||
                !isset($_POST['nama']) || $_POST['nama'] == null ||
                !isset($_POST['tipe']) || $_POST['tipe'] == null ||
                !isset($_POST['harga']) || $_POST['harga'] == null ||
                !isset($_POST['stok']) || $_POST['stok'] == null
            ) {
                return null;
            }
            $nama_produk = $_POST['nama'];
            $tipe_produk = $_POST['tipe'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $product = new Product($nama_produk, $tipe_produk, $harga, $stok);
            return $this->productModel->updateProduct(product: $product, id: $_POST['id']);
        }

        function deleteProduct(): mixed {
            if (!isset($_POST['id']) || $_POST['id'] == null) {
                return null;
            }
            return $this->productModel->deleteProduct(id: $_POST['id']);
        }
    }
}

