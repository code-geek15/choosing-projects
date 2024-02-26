<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include FontAwesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS for Sidebar and Content -->
    <style>
        /* Global styles */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #075e54;
            padding-top: 20px;
        }

        .sidebar h2 {
            padding-left: 20px;
            color: #fff;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #128c7e;
        }

        /* Content styles */
        .content {
            padding: 20px;
            margin-left: 250px; /* Adjust this to match the sidebar width */
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            background-color: #075e54;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Card styles */
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #333;
        }

        .card-text {
            color: #777;
        }

        /* Chart container styles */
        #usageChartContainer {
            margin-top: 20px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
                background-color: #075e54;
                text-align: center;
                padding-top: 20px;
            }

            .sidebar a {
                padding: 10px;
                font-size: 16px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 class="text-white ml-3"> <i class="fas fa-user fa-x text-white ml-3"></i> Admin</h2>
    <a href="#"><i class="fas fa-home"></i> Dashboard</a>
    <a href="#" onclick=""><i class="fas fa-users"></i> Users</a>
    <a href="admin/create_user.php"><i class="fas fa-users"></i> Add User</a>
    <a href="#"><i class="fas fa-envelope"></i> Messages</a>
    <a href="#"><i class="fas fa-chart-bar"></i> Statistics</a>
    <a href="#" onclick="confirmLogout(); return false;" ><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
    <h1>Welcome to the Admin Dashboard</h1>
    <div class="row" id="userList"></div>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">2</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Messages</h5>
                    <p class="card-text">10</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Users</h5>
                    <p class="card-text">2</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Subscribed Users</h5>
                    <p class="card-text">2</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
 function fetchUsers() {
    // Use JavaScript to make an AJAX request to your PHP script
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "all_users.php", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // When the request is successful, update the content of the user list div
            document.getElementById("userList").innerHTML = xhr.responseText;

            // Remove all divs except for the "userList" div
            var container = document.getElementById("userList").parentNode;
            var divs = container.querySelectorAll("div");
            for (var i = 0; i < divs.length; i++) {
                if (divs[i] !== document.getElementById("userList")) {
                    container.removeChild(divs[i]);
                }
            }
        }
    };

    xhr.send();
}

    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
            // If the user clicks OK in the confirmation dialog, redirect them to login.php.
            window.location.replace("./login.php");
        } else {
            // If the user clicks Cancel, nothing happens, and they stay on the current page.
        }
    }

</script>
</body>
</html>
