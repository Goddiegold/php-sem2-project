<?php
    include "./config.php";

    $sql = "SELECT * FROM students";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $studentId = $row['studentId'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $gender = $row['gender'];
            $department = $row['department'];
            $intake = $row['intake'];
        }
    } else {
        echo "No student data found.";
    }

    mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="./static/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .profile-container {
            position: absolute;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.9);
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
        }
        .profile {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }
        .profile h2 {
            color: red;
            margin-bottom: 20px;
            text-align: center;
        }
        .profile p {
            font-size: 20px;
            color: red;
        }
        .show {
            display: block;        
        }
        .close-icon {
            position: absolute;
            top: 35px;
            left: 90%;
        }
        .btns {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }
        button {
          background-color: #ff0000;
          color: #fff;
          border: none;
          padding: 10px 20px;
          border-radius: 4px;
          cursor: pointer;
          width: 100%;
        }
        button:hover {
          background-color: #cc0000;
        }
        .btns button a {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg main-nav">
                <a class="navbar-brand" href="#">
                    <img src="https://img1.wsimg.com/isteam/ip/0d532241-dda1-42d3-9ca9-6c0bd972594a/Logo%20Trans-fde57a7.png/:/rs=w:407,h:80,cg:true,m/cr=w:407,h:80/qt=q:95" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar icon-bar-1"></span>
                    <span class="icon-bar icon-bar-2"></span>
                    <span class="icon-bar icon-bar-3"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainMenu">
                    <ul class="navbar-nav ml-auto text-uppercase f1">
                        <li><a href="dashboard.php" class="active active-first">Home</a></li>
                        <li><a href="#">Overview</a></li>
                        <li><a href="#">Manage</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#clearance_form.php">Clearance</a></li>
                        <li id="profile-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="card mb-3" style="max-width: 100%; height: 100vh; padding-left: 20px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <h1 id="education">Education</h1>
                    <h1 id="for-all">For All</h1>
                    <div class="card" style="border:
                    1px solid pink; border-radius: 10px;">
                        <div class="card-body-2">
                            <h4 class="card-title">Upcoming Tests</h4>
                            <div class="card-body whiteboard">
                            <h3>Get cleared to unlock</h3>
                            <p>Click to learn more</p>
                            </div>
                        </div>
                    </div>
                    <div class="msgs">
                        <div class="rows">
                            <h3>Messages</h3>
                        </div>
                        <?php

                            include "./admin/message_process.php";

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $sender = $row["sender"];
                                    $message = $row["message"];
                                    $image = $row["image"];

                                    echo '<div class="rows">';
                                    echo '<img src="' . $image . '">';
                                    echo '<p><b>' . $sender . '</b><br>' . $message . '</p>';
                                    echo '</div>';
                                }
                                mysqli_free_result($result);
                            } else {
                                echo 'Error: ' . mysqli_error($conn);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="profile-container" id="profile">
        <div class="profile">
            <div id="close-icon" class="close-icon">
                <svg viewPort="0 0 12 12" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
                    <line x1="1" y1="11" 
                        x2="11" y2="1" 
                        stroke="black" 
                        stroke-width="2"/>
                    <line x1="1" y1="1" 
                        x2="11" y2="11" 
                        stroke="black" 
                        stroke-width="2"/>
                </svg>
            </div>
            <h2>Student Profile</h2>
            <div class="profile-info">
                <p><strong>Student ID: </strong><?php echo $studentId; ?></p>
                <p><strong>Firstname: </strong><?php echo $firstname; ?></p>
                <p><strong>Lastname: </strong><?php echo $lastname; ?></p>
                <p><strong>Gender: </strong><?php echo $gender; ?></p>
                <p><strong>Department: </strong><?php echo $department; ?></p>
                <p><strong>Intake: </strong><?php echo $intake; ?></p>
            </div>
            <div class="btns">
                <button><a href="edit_profile.php">Edit profile</a></button>
                <button><a href="logout.php">Logout</a></button>
            </div>
        </div>
    </div>

    <script>
        const profileIcon = document.getElementById("profile-icon");
        const profile = document.getElementById("profile");
        const closeIcon = document.getElementById("close-icon");
        profileIcon.addEventListener("click", () => {
            profile.classList.add("show");
        })
        closeIcon.addEventListener("click", () => {
            profile.classList.remove("show");
        })
    </script>
</body>
</html>