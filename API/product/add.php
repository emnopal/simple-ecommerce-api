<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

require_once __DIR__ . "/../../Repository/ProductRepository.php";
require_once __DIR__ . "/../../Model/ProductModel.php";
require_once __DIR__ . "/../../Service/ProductServices.php";
require_once __DIR__ . "/../../Database/Connection.php";

use Model\Product\ProductModelImpl;
use Repository\Product\ProductRepositoryImpl;
use Services\Product\ModelServices;
use Database\Connection;

header("Content-Type: application/json; charset=UTF-8");

$productRepository = new ProductRepositoryImpl(Connection::connect());
$productModel = new ProductModelImpl($productRepository);
$productService = new ModelServices($productModel);

if (!isset($_POST["logout"]) || $_POST["logout"] == "" ){

    if (!isset($_SESSION["login"]) || $_SESSION["login"] == false){
        header("Location: /auth");
        exit();
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            echo $productService->showAllProduct();
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo $productService->saveProduct();
        } else {
            echo json_encode(array("error" => "Method not allowed"));
        }
    }
}else {
    session_destroy();
    echo json_encode(["message" => "logout success"]);
}
