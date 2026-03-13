<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/validator.php';

class AuthController {

    private $pdo;

        public function __construct($pdo)
            {
                    $this->pdo = $pdo;
                        }

                            public function register($username, $email, $password)
                                {

                                        $username = sanitize($username);
                                                $email = sanitize($email);

                                                        if(empty($username) || empty($email) || empty($password)){
                                                                    return "All fields are required.";
                                                                            }

                                                                                    if(!validateEmail($email)){
                                                                                                return "Invalid email format.";
                                                                                                        }

                                                                                                                if(!validatePassword($password)){
                                                                                                                            return "Password must be at least 6 characters.";
                                                                                                                                    }

                                                                                                                                            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                                                                                                                                                    try {

                                                                                                                                                                $sql = "INSERT INTO users (username,email,password) VALUES (?,?,?)";

                                                                                                                                                                            $stmt = $this->pdo->prepare($sql);

                                                                                                                                                                                        $stmt->execute([$username,$email,$hashedPassword]);

                                                                                                                                                                                                    return "Registration successful.";

                                                                                                                                                                                                            } catch(PDOException $e) {

                                                                                                                                                                                                                        return "Error: Email may already exist.";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                        public function login($email, $password)
                                                                                                                                                                                                                                            {

                                                                                                                                                                                                                                                    $email = sanitize($email);

                                                                                                                                                                                                                                                            if(!validateEmail($email)){
                                                                                                                                                                                                                                                                        return "Invalid email.";
                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
                                                                                                                                                                                                                                                                                                $stmt->execute([$email]);

                                                                                                                                                                                                                                                                                                        $user = $stmt->fetch();

                                                                                                                                                                                                                                                                                                                if(!$user){
                                                                                                                                                                                                                                                                                                                            return "User not found.";
                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                            if(password_verify($password, $user['password'])){

                                                                                                                                                                                                                                                                                                                                                        session_regenerate_id(true);

                                                                                                                                                                                                                                                                                                                                                                    $_SESSION['user_id'] = $user['id'];
                                                                                                                                                                                                                                                                                                                                                                                $_SESSION['username'] = $user['username'];

                                                                                                                                                                                                                                                                                                                                                                                            return true;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                            return "Incorrect password.";
                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                }