<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Choose Role</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://images.unsplash.com/photo-1531532068976-8e124b74d138'); /* Background image */
            background-size: cover; /* Cover the entire background */
            color: #333; /* Text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
            text-align: center;
            opacity: 0; /* Start with no visibility */
            transform: translateY(20px); /* Start slightly lower */
            animation: fadeIn 0.8s forwards; /* Fade-in animation */
        }
        @keyframes fadeIn {
            to {
                opacity: 1; /* Fully visible */
                transform: translateY(0); /* Return to original position */
            }
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .quote {
            font-style: italic;
            margin: 10px 0 20px;
            font-size: 1.2em;
            color: #555; /* A softer color for the quote */
        }
        .swot-box {
            display: flex;
            justify-content: space-between;
            margin: 15px 0; /* Space between boxes */
        }
        .swot {
            background-color: #f8f9fa; /* Light gray background for boxes */
            border: 1px solid #dee2e6; /* Border around boxes */
            border-radius: 5px;
            padding: 20px;
            width: 45%; /* Adjust width as needed */
            transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for scaling and shadow */
        }
        .swot:hover {
            transform: translateY(-5px); /* Lift the box slightly on hover */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Darker shadow on hover */
        }
        a {
            text-decoration: none;
            font-size: 1.2em;
            color: #007bff; /* Bootstrap primary color */
            transition: color 0.3s; /* Smooth color transition */
        }
        a:hover {
            color: #0056b3; /* Darker shade on hover */
        }
        .header {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Pantheon Libraries</h1>
        <p class="quote">"A library is not a luxury but one of the necessities of life." - Henry Ward Beecher</p>
        
        <div class="swot-box">
            <div class="swot">
                <div class="header">Admin Role</div>
                <a href="admin_login.php">Admin Login</a><br>
                <a href="admin_register.php">Admin Register</a>
            </div>
            
            <div class="swot">
                <div class="header">Student Role</div>
                <a href="student_login.php">Student Login</a><br>
                <a href="student_register.php">Student Register</a>
            </div>
        </div>
    </div>
</body>
</html>
