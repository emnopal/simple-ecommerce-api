<?php


namespace User\Repository{

    interface UserRepository{
        function loginUser(string $username, string $password): bool;
        function createUser(string $username, string $password): bool;
    }

    class UserRepositoryImpl implements UserRepository{

        public function __construct(private \PDO $connection){
            $this->connection = $connection;
        }

        function loginUser(string $username, string $password): bool {
            $sql = "SELECT * FROM productdb.user WHERE username = ? AND password = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$username, hash("sha256", $password)]);
            $result = $statement->fetch();
            if ($result){
                return true;
            } else {
                return false;
            }
        }

        function createUser(string $username, string $password): bool {
            $sql = "INSERT INTO productdb.user (username, password) VALUES (?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$username, hash("sha256", $password)]);
            return true;
        }
    }

}