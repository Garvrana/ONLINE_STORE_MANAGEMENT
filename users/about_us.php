<?php
if (isset($_GET['redirect'])) {
    $username = isset($_GET['username']) ? $_GET['username'] : '';
    $role = isset($_GET['role']) ? $_GET['role'] : '';
    $profile_picture = isset($_GET['profile_picture']) ? $_GET['profile_picture'] : '';

    header('Location: ../user_panel.php?username=' . urlencode($username) . '&role=' . urlencode($role) . '&profile_picture=' . urlencode($profile_picture));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Store Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #28a745;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #218838;
        }

        .header {
            background-color: #28a745;
            color: white;
            padding: 1px 0;
            text-align: center;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #28a745;
        }

        p {
            line-height: 1.6;
        }

        .team-section {
            margin-top: 40px;
        }

        .team-member {
            margin-bottom: 20px;
        }

        .team-member h3 {
            margin: 5px 0;
            color: #28a745;
        }

        .team-member p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <a href="http://localhost/intership/user_panel.php?redirect=true&username=<?php echo urlencode($_GET['username']); ?>&role=<?php echo urlencode($_GET['role']); ?>&profile_picture=<?php echo urlencode($_GET['profile_picture']); ?>">Home</a>

    </div>

    <div class="header">
        <h1>About Us</h1>
    </div>
    <div class="container">
        <h1>Welcome to Store Management System</h1>
        <p>
            Our Store Management System is a project developed by a dedicated team of college students who are passionate about leveraging technology to solve real-world problems. Our system is designed to simplify and streamline the operations of retail businesses, helping store managers and owners efficiently manage their inventory, sales, and customer data. With our system, you can expect increased productivity, better inventory tracking, and enhanced customer service.
        </p>
        <p>
            Our mission is to provide an intuitive and powerful tool that helps retailers focus on what they do best - running their stores and serving their customers. We are dedicated to continuous improvement and innovation, ensuring that our system evolves with the needs of the market.
        </p>
        <p>
            Founded as a college project in 2024, our team of enthusiastic students has worked tirelessly to create a system that meets the unique challenges of the retail industry. We believe in the power of technology to transform businesses, and we are committed to delivering solutions that drive success.
        </p>

        <div class="team-section">
            <h2>Meet the Team</h2>
            <div class="team-member">
                <h3>Garv Rana</h3>
                <p>Project Leader</p>
                <p>Garv is a computer science student with a knack for leadership and project management. His vision and organizational skills have been crucial in steering our project towards success.</p>
            </div>
            <!-- <div class="team-member">
                <h3>Ankita Parmar</h3>
                <p>Chief Technology Officer</p>
                <p>Ankita, a budding software engineer, is the technical brain behind our system. Her expertise in software development ensures that our system is robust, scalable, and secure.</p>
            </div>
            <div class="team-member">
                <h3>Bhavesh Patil</h3>
                <p>Head of Customer Success</p>
                <p>Bhavesh is committed to ensuring that our users get the most out of our system. His dedication to customer support and training helps businesses achieve their goals.</p>
            </div>
            <div class="team-member">
                <h3>Hiteshree</h3>
                <p>Marketing and Outreach</p>
                <p>Hiteshree is focused on connecting with potential users and spreading the word about our system. Her efforts in marketing and outreach help us reach a wider audience.</p>
            </div> -->
        </div>
    </div>
</body>
</html>
