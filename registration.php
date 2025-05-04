
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Store Management System</title>
    <style>
        /* style.css */
        body {
            background-image: url("images/back4.png");
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #6AFB92 , #12E193;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 310px;
            height: 640px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Register</h1>
            <form action="user_panel.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="store_manager">Store Manager</option>
                </select>
                <input type="number" id="age" name="age" placeholder="Age" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="date" id="birthdate" name="birthdate" placeholder="Birthdate" required>
                <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" required>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="loginform.php">Login here</a></p>
        </div>
    </div>
</body>
</html> -->




<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        // File upload successful
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }

    // Store user information
    $sql = "INSERT INTO $role (username, password, age, address, birthdate, mobile, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $username, $password, $age, $address, $birthdate, $mobile, $target_file);
    $stmt->execute();

    // Redirect to user panel with user details
    header("Location: user_panel.php?username=" . urlencode($username) . "&role=" . urlencode($role) . "&profile_picture=" . urlencode($target_file));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Store Management System</title>
    <style>
        /* Your CSS styles */
        body {
            background-image: url("images/back4.png");
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #6AFB92 , #12E193;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 310px;
            height: 640px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Register</h1>
            <form action="registration.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="store_manager">Store Manager</option>
                </select>
                <input type="number" id="age" name="age" placeholder="Age" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="date" id="birthdate" name="birthdate" placeholder="Birthdate" required>
                <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" required>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="loginform.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
