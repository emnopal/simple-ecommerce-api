<?php

// service -> implentasi logic

namespace Model\User {

    session_status() === PHP_SESSION_ACTIVE ?: session_start();

    require_once __DIR__ . "/../Repository/UserRepository.php";

    use \User\Repository\UserRepository;

    interface UserModel {
        function isLogin(): bool;
        function login(string $username, string $password): bool;
        function register(string $username, string $password): mixed;
    }


    class UserModelImpl implements UserModel {

        private UserRepository $UserRepository;

        public function __construct(UserRepository $UserRepository) {
            $this->UserRepository = $UserRepository;
        }

        function isLogin(): bool {
            if ($_SESSION["login"] == true) {
                return true;
            }
            return false;
        }

        function login(string $username, string $password): bool {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user = $this->UserRepository;
                if ($user->loginUser($username, $password)){
                    $_SESSION["login"] = true;
                    return true;
                }
                return false;
            }
        }

        function register(string $username, string $password): mixed {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["register"] == "yes"){
                    $user = $this->UserRepository;
                    if ($user->createUser($username, $password)){
                        $this->login($username, $password);
                        return json_encode(array("status" => "success", "message" => "Register user $username Success"));
                    }
                    return false;
                }else if (!isset($_POST["register"])||$_POST["register"] == ""){
                    return json_encode(array("status" => "error", "message" => "Access denied"));
                }else {
                    return json_encode(array("status" => "error", "message" => "Access denied"));
                }
            }
        }

    }
}