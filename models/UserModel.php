<?php 
include_once './config/database.php';

class UserModel {
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->connectDB();
    }

    public function loginUser($email, $password){

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user && password_verify($password, $user['password'])){
            $_SESSION['loggedin'] = true;
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['email'] = $user['email'];

            return true;
        }

        return false;

    }

    public function registerUser($username, $email, $password){

        // check if email already exist
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return "Email already exists. Please choose a different one.";
        }

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $stmt->error;
        }

    }

}