
   <?php
include 'db.php';

if (!isset($_GET['username']) || !isset($_GET['role'])) {
    header("Location: loginform.php");
    exit();
}

$username = $_GET['username'];
$role = $_GET['role'];
$profile_picture = isset($_GET['profile_picture']) ? $_GET['profile_picture'] : 'default_profile_picture.jpg';

// Fetch user data from the database
$sql = "SELECT * FROM $role WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel | Store Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        /* Modal styling */
        #profileModal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Profile information styling */
        .profile-info {
            text-align: center;
        }

        .profile-info h2 {
            margin-bottom: 20px;
        }

        .profile-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 5px 0;
            font-size: 18px;
        }

        .profile-info p strong {
            display: inline-block;
            width: 100px;
            text-align: right;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .profile-pic {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 50%;
        }
        .profile-pic img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .profile-menu .dropdown-menu {
            right: 0;
            left: unset;
        }
        .profile-menu .fa-fw {
            margin-right: 10px;
        }

        .store-list {
            display: flex;
            flex-wrap: wrap;
            gap: 80px;
            padding: 20px;
        }
        .store-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 40px;
            padding: 20px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .store-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 30px;
            margin-bottom: 10px;
        }
        .store-item h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Store Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                    <a class="nav-link active" aria-current="page" href="users/about_us.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?> &profile_picture=<?php echo urlencode($profile_picture); ?>">About us</a>
                    
                </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-container" id="profileImg">
                                <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" class="profile-pic">
                            </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="container mt-5">
                                <button id="showModalBtn" class="btn btn-primary mt-3">Show Profile</button>
                                <div id="profileModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div class="profile-info">
                                            <h2>Your Profile</h2>
                                            <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
                                            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                                            <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                                            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                                            <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($user['birthdate']); ?></p>
                                            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="loginform.php"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <marquee behavior="" direction="left"><h1>Welcome to your user panel, <?php echo htmlspecialchars($user['username']); ?>!</h1></marquee>
        
  <div class="store-list">
        <div class="store-item">
            <img src="store/store1.png" alt="Store 1">
            <h3>Store 1</h3>
            <a href="storeitem/store1.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?> &profile_picture=<?php echo urlencode($profile_picture); ?>" class="btn btn-primary">Go to Store 1</a>
        </div>
        <div class="store-item">
            <img src="store/store2.png" alt="Store 2">
            <h3>Store 2</h3>
            <a href="storeitem/store2.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 2</a>
        </div>
        <div class="store-item">
            <img src="store/store3.png" alt="Store 3">
            <h3>Store 3</h3>
            <a href="storeitem/store3.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 3</a>
        </div>
        <div class="store-item">
            <img src="store/store4.png" alt="Store 4">
            <h3>Store 4</h3>
            <a href="storeitem/store4.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 4</a>
        </div>
        <div class="store-item">
            <img src="store/store5.png" alt="Store 5">
            <h3>Store 5</h3>
            <a href="storeitem/store5.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 5</a>
        </div>
        <div class="store-item">
            <img src="store/store6.png" alt="Store 6">
            <h3>Store 6</h3>
            <a href="storeitem/store6.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 6</a>
        </div>
        <div class="store-item">
            <img src="store/store7.png" alt="Store 7">
            <h3>Store 7</h3>
            <a href="storeitem/store7.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 7</a>
        </div>
        <div class="store-item">
            <img src="store/store8.png" alt="Store 8">
            <h3>Store 8</h3>
            <a href="storeitem/store8.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 8</a>
        </div>
        <div class="store-item">
            <img src="store/store9.png" alt="Store 9">
            <h3>Store 9</h3>
            <a href="storeitem/store9.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 9</a>
        </div>
        <div class="store-item">
            <img src="store/store10.png" alt="Store 10">
            <h3>Store 10</h3>
            <a href="storeitem/store10.php?username=<?php echo htmlspecialchars($username); ?>&role=<?php echo htmlspecialchars($role); ?>&profile_picture=<?php echo htmlspecialchars($profile_picture); ?>" class="btn btn-primary">Go to Store 10</a>
        </div>
    </div>


    <div class="footer">
        <center><p>&copy; <?php echo date('Y'); ?> Store Management System. All rights reserved.</p></center>
    </div> 





    <script>
        // Modal functionality
        var modal = document.getElementById("profileModal");
        var btn = document.getElementById("showModalBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
