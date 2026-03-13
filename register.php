<?php
session_start();

require_once '../controllers/AuthController.php';

$auth = new AuthController($pdo);

$message = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $message = $auth->register(
            $_POST['username'],
                    $_POST['email'],
                            $_POST['password']
                                );
                                }
                                ?>

                                <form method="POST">

                                <input type="text" name="username" placeholder="Username" required>

                                <input type="email" name="email" placeholder="Email" required>

                                <input type="password" name="password" placeholder="Password" required>

                                <button type="submit">Register</button>

                                </form>

                                <p><?= $message ?></p>