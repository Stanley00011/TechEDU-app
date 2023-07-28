<?php
include_once("./../connection/connection.php");

if (isset($_GET['action']) && $_GET['action'] == 'signup') {
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $role = $_POST['role'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = './../../images/upload_files/'.$rename;
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->bind_param("s", $email); 
    $select_user->execute();
    $select_user_result = $select_user->get_result();
    if($select_user_result->num_rows > 0){
        $response = array(
            "status" => "error",
            "message" => "Email Already Exist"
        );
    } else {
        if($pass != $cpass){
            $response = array(
                "status" => "error",
                "message" => "Your password and confirm password do not match!"
            );
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image, `role`) VALUES(?,?,?,?,?,?)");
            $insert_user->bind_param("ssssss", $id, $name, $email, $cpass, $rename,$role);
            if($insert_user->execute()){
                if(move_uploaded_file($image_tmp_name, $image_folder)){
                    $response = array(
                        "status" => "success",
                        "message" => "You are registered successfully",
                    );
                } else {
                    $response = array(
                        "status" => "error",
                        "message" => "Cannot upload the image",
                    );
                }
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Something went wrong while uploading data",
                );
            }
        }
    }
    echo json_encode($response);
}

if (isset($_GET['action']) && $_GET['action'] == 'signin') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        $userID = $row['id'];
        $role = $row['role'];
        // Verify the password
        if($role=="admin"){
            setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
        }
        if ($password) {
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            $response = array(
                "status" => "success",
                "message" => "Login successful",
                "userID" => $userID,
                "role"=>$role
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Invalid email or password"
            );
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "Invalid email or password"
        );
    }
    echo json_encode($response);
}



?>
