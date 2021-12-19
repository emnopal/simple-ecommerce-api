<?php

namespace Model\Product {

    require_once __DIR__ . "/../Repository/ProductRepository.php";
    require_once __DIR__ . "/../Entity/Product.php";

    use Exception;
    use \Repository\Product\ProductRepository;
    use \Entity\Product\Product;

    interface ProductModel {

        function saveProduct(Product $product): mixed;
        function deleteProduct(int $id): mixed;
        function updateProduct(Product $product, int $id): mixed;
        function showAllProduct(): mixed;
        function getProductById(int $id): mixed;

    }

    class ProductModelImpl implements ProductModel{

        private ProductRepository $ProductRepository;

        public function __construct(ProductRepository $ProductRepository){
            $this->ProductRepository = $ProductRepository;
        }

        public function showAllProduct(): mixed {
            try {
                if ($this->ProductRepository->show() == null || $this->ProductRepository->show() == false) {
                    return json_encode(array(
                        "message" => "Product is empty"
                    ));
                }
                return json_encode(array(
                    "message" => "Showing all Product",
                    "count" => count($this->ProductRepository->show()),
                    "data" => $this->ProductRepository->show()
                ));
            } catch (Exception $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            } catch (\PDOException $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            }
        }

        public function saveProduct(Product $product): mixed {
            try {
                $nama_produk = $product->getNamaProduk();
                $tipe_produk = $product->getTipeProduk();
                $harga = $product->getHarga();
                $stok = $product->getStok();
                if ($this->ProductRepository->save($nama_produk, $tipe_produk, $harga, $stok) == true) {
                    return json_encode(array(
                        "message" => "Success add to Product"
                    ));
                }
                return json_encode(array(
                    "message" => "Failed add to Product"
                ));
            } catch (Exception $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            } catch (\PDOException $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            }
        }

        public function updateProduct(Product $product, int $id): mixed {
            try {
                $nama_produk = $product->getNamaProduk();
                $tipe_produk = $product->getTipeProduk();
                $harga = $product->getHarga();
                $stok = $product->getStok();
                if ($this->ProductRepository->update($id, $nama_produk, $tipe_produk, $harga, $stok) == true) {
                    return json_encode(array(
                        "message" => "Success update Product",
                        "product_id" => $id
                    ));
                }
                return json_encode(array(
                    "message" => "Failed update Product"
                ));
            } catch (Exception $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            } catch (\PDOException $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            }
        }

        public function deleteProduct(int $id): mixed {
            try {
                if ($this->ProductRepository->delete($id)) {
                    return json_encode(array(
                        "message" => "Success delete Product",
                        "product_id" => $id
                    ));
                }
                return json_encode(array(
                    "message" => "Failed delete Product"
                ));
            } catch (Exception $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            } catch (\PDOException $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            }
        }

        public function getProductById(int $id): mixed {
            try {
                if ($this->ProductRepository->getById($id) == null) {
                    return json_encode(array(
                        "message" => "Product is empty"
                    ));
                }
                return json_encode(array(
                    "message" => "Showing all Product",
                    "count" => count($this->ProductRepository->getById($id)),
                    "data" => $this->ProductRepository->getById($id)
                ));
            } catch (Exception $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            } catch (\PDOException $e) {
                return json_encode(
                    array(
                        "message" => "Error",
                        "error_message" => $e->getMessage()
                    )
                );
            }
        }
    }
}
