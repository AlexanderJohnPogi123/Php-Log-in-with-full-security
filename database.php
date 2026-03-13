<?php
require_once 'env.php';

try {

    $dsn = "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";charset=utf8mb4";

        $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                PDO::ATTR_EMULATE_PREPARES => false
                                    ]);

                                    } catch (PDOException $e) {

                                        if($_ENV['APP_ENV'] === 'development'){
                                                die("Database Error: " . $e->getMessage());
                                                    }

                                                        die("Database connection failed.");
                                                        }