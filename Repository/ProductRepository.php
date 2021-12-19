<?php

namespace Repository\Product {

    use Exception;

    interface ProductRepository
    {
        function save(string $nama_produk, string $tipe_produk, int $harga, int $stok): bool;
        function delete(int $id): bool;
        function update(int $id, string $nama_produk, string $tipe_produk, int $harga, int $stok): bool;
        function show(): array|bool;
        function getById(int $id): array|bool;
    }

    class ProductRepositoryImpl implements ProductRepository
    {

        public function __construct(private \PDO $connection)
        {
            $this->connection = $connection;
        }

        public function save(string $nama_produk, string $tipe_produk, int $harga, int $stok): bool {

            $sql = "INSERT INTO produk (nama_produk, tipe_produk, harga, stok) VALUES (?, ?, ?, ?)";

            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute([$nama_produk, $tipe_produk, $harga, $stok]);
            } catch (\PDOException $e) {
                echo "Error while insert into db: " . $e->getMessage();
                return false;
            }

            return true;
        }

        public function delete(int $id): bool{

            $sql = "SELECT * FROM produk WHERE id = ?";
            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute([$id]);
                $result = $statement->fetch();
            } catch (\PDOException $e) {
                throw new Exception("Error while insert into db: " . $e->getMessage());
            }

            if ($result) {
                $sql = "DELETE FROM produk WHERE id = ?";
                try {
                    $statement = $this->connection->prepare($sql);
                    $statement->execute([$id]);
                } catch (\PDOException $e) {
                    throw new Exception("Error while insert into db: " . $e->getMessage());
                }
                return true;
            } else {
                return false;
            }
        }

        public function update(int $id, string $nama_produk, string $tipe_produk, int $harga, int $stok): bool
        {

            $sql = "UPDATE produk SET nama_produk=?, tipe_produk=?, harga=?, stok=? WHERE id=?";

            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute([$nama_produk, $tipe_produk, $harga, $stok, $id]);
            } catch (\PDOException $e) {
                throw new Exception("Error while insert into db: " . $e->getMessage());
            }

            if ($statement) {
                return true;
            } else {
                return false;
            }
        }

        public function show(): array|bool{

            $sql = "SELECT * FROM produk ORDER BY id ASC";

            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw new Exception("Error while insert into db: " . $e->getMessage());
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        }

        public function getById(int $id): array|bool{

            $sql = "SELECT * FROM produk WHERE id=? ORDER BY id ASC";

            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute([$id]);
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw new Exception("Error while insert into db: " . $e->getMessage());
            }

            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }
}
