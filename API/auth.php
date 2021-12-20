<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

require_once __DIR__ . "/../Repository/UserRepository.php";
require_once __DIR__ . "/../Model/UserModel.php";
require_once __DIR__ . "/../Database/Connection.php";

use User\Repository\UserRepositoryImpl;
use Database\Connection;
use Model\User\UserModelImpl;

header("Content-Type: application/json; charset=UTF-8");

$userLogin = new UserRepositoryImpl(Connection::connect());
$userLoginImpl = new UserModelImpl($userLogin);

if (!isset($_SESSION["login"])){
    $_SESSION["login"] = false;
}

if (!isset($_POST["logout"]) || $_POST["logout"] == "" ){
    if ($userLoginImpl->isLogin()){
        header("Location: /product");
        exit();
    } else {
        if (!isset($_POST['username']) || !isset($_POST['password']) || $_POST['username'] == "" || $_POST['password'] == "") {
            echo json_encode(array("status" => "error", "message" => "Access denied"));
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($userLoginImpl->login($username, $password)) {
                echo json_encode(array("status" => "success", "message" => "Login successful"));
                header("Location: /product");
                exit();
            } else {
                echo $userLoginImpl->register($username, $password);
            }
        }
    }
} else {
    session_destroy();
    echo json_encode(["message" => "logout success"]);
}


