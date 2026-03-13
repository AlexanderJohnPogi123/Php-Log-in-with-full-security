<?php
session_start();

require_once '../controllers/AuthController.php';

$auth = new AuthController($pdo);

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $result = $auth->login($_POST['email'], $_POST['password']);

        if($result === true){
                header("Location: dashboard.php");
                        exit;
                            } else {
                                    $error = $result;
                                        }
                                        }
                                        ?>

                                        <form method="POST">

                                        <input type="email" name="email" placeholder="Email" required>

                                        <input type="password" name="password" placeholder="Password" required>

                                        <button type="submit">Login</button>

                                        </form>

                                        <p><?= $error ?></p>