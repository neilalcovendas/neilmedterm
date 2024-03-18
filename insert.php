<?php
require_once './conn.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];
    
    $select_query = "SELECT * FROM registration_tbl WHERE email_address = :email_address";
    $stmt1 = $conn->prepare($select_query);
    $stmt1->bindParam(':email_address', $email_address);
    $stmt1->execute();
    if ($stmt1->rowCount() > 0) {
        $data = array("status" => "error", "message" => "Email already exists.");
        echo json_encode($data);
    } else {
    try {
        $sql = "INSERT INTO registration_tbl (user_id, first_name, middle_name, last_name, gender, birthdate, age, email_address, password) 
        VALUES (:username, :first_name, :middle_name, :last_name, :gender, :birthdate, :age, :email_address, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        echo "Data inserted.";

        $data = array("status" => "success", "message" => "Data inserted.");
        echo json_encode($data);

        $con = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
} else {
echo "server error";
}

?>