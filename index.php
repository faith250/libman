<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Choose Role</title>
    <style>
             /* Base styling */
             body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4b6cb7, #182848); /* Gradient for a polished background */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Container styling */
        .container {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            padding: 50px 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            transform: scale(0.8);
            animation: fadeInScale 0.8s ease-out forwards;
            backdrop-filter: blur(10px); /* Adds a glass effect */
        }

        /* Smooth scaling animation for the container */
        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Header styling */
        h1 {
            font-size: 2.8em;
            color: #182848;
            margin-bottom: 15px;
            animation: textGlow 1.5s ease-in-out infinite alternate;
        }

        /* Glowing effect on header */
        @keyframes textGlow {
            from {
                text-shadow: 0 0 10px #fff, 0 0 20px #4b6cb7, 0 0 30px #182848;
            }
            to {
                text-shadow: 0 0 20px #fff, 0 0 30px #4b6cb7, 0 0 40px #182848;
            }
        }

        /* Quote styling */
        .quote {
            font-style: italic;
            font-size: 1.3em;
            color: #666;
            margin-bottom: 25px;
            position: relative;
        }

        /* Small decorative underline for the quote */
        .quote::before, .quote::after {
            content: '“';
            font-size: 2em;
            color: #bbb;
            position: absolute;
        }
        .quote::before {
            left: -20px;
            top: -10px;
        }
        .quote::after {
            content: '”';
            right: -20px;
            bottom: -10px;
        }

        /* Box layout for roles */
        .swot-box {
            display: flex;
            justify-content: space-around;
            margin: 15px 0;
        }

        /* Role box styling */
        .swot {
            background-color: #f7f9fc;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 25px 20px;
            width: 45%;
            transition: transform 0.4s, box-shadow 0.4s;
            position: relative;
            overflow: hidden;
        }
        .swot:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        /* Floating pattern background within each role box */
        .swot::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image: radial-gradient(circle, #e0e4e7 10%, transparent 11%);
            background-size: 40px 40px;
            opacity: 0.15;
            animation: patternMove 10s linear infinite;
            z-index: 0;
        }

        /* Pattern animation */
        @keyframes patternMove {
            from {
                transform: translateX(0) translateY(0);
            }
            to {
                transform: translateX(40px) translateY(40px);
            }
        }

        /* Link styling */
        a {
            text-decoration: none;
            font-size: 1.2em;
            color: #4b6cb7;
            font-weight: bold;
            display: block;
            transition: color 0.3s, transform 0.3s;
            position: relative;
            z-index: 1;
        }
        a:hover {
            color: #182848;
            transform: scale(1.1);
        }

        /* Header for each role box */
        .header {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            z-index: 1;
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
