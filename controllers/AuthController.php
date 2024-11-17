<?php 

include_once './config/database.php';
include_once './models/UserModel.php';

class AuthController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    // login functions

    public function showLogin($error = ''){
        require './views/login.php';
    }

    public function handleLogin(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
            $password = $_POST['password'];

            if(empty($email) || empty($password)){
                $error = "Please fill all the inputs";
                return $this->showLogin($error);
            }

            $loginResult = $this->userModel->loginUser($email, $password);

            if(!$loginResult){
                $error = "Invalid Login";
                return $this->showLogin($error);
            }

            header('Location: /reusable_Codes_PHP/AUTH%20MVC/dashboard');
        } else {
            return $this->showLogin();
        }
    }

    // register functions

    public function showRegister($error = ''){
        require './views/register.php';
    }

    public function handleRegister(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
            $password = trim($_POST['password']);

            if (empty($username) || empty($email) || empty($password)) {
                $error = "All fields are required.";

                return $this->showRegister($error);
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $registerResult = $this->userModel->registerUser($username, $email, $hashedPassword);

            if ($registerResult === true) {

                header("Location: /login");
                exit(); 
            } else {
                
                return $this->showRegister($registerResult);
            }

        } else {
            return $this->showRegister();
        }
    }

    public function handleLogout(){
        require './views/logout.php';
    }

}