<?php
require '../database/db_connect.php';
require '../includes/header.php';

// Check if the "Users Data" button is clicked
if (isset($_POST['fetchUsers'])) {
    // Fetch users data from the database
    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "ID: " . $row["id"]. " - Email: " . $row["email"]. " - Password: " . $row["password"]. "<br>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="../admin/adminImage/harmony.png">
    
    <!-- Link to Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Roboto:ital,wght@0,100;1,300;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <<link rel="stylesheet" href="../CSS/admin.css" />
    <link rel="stylesheet" href="../CSS/header-footer.css">
    <link rel="icon" href="adminImage/harmony.png" />
    <!-- <link rel="stylesheet" href="CSS/Maleda.css" /> -->
</head>
<body>

<section class="main">
<div class="sides">
    <div class="container">
        <div class="firstcolumn">
            <h2><i class="fas fa-user"></i> Admin Panel</h2>
            <button class="button orders">
                <i class="fas fa-shopping-cart"></i> Orders
            </button>
            <button class="button users" name="fetchUsers">
                <i class="fas fa-users"  ></i> Users Data
            </button>
            <div class="container">
                <button class="button products">
                    <i class="fas fa-box"></i> Products
                    <ul class="options-list">
                        <li onclick="showForm('add')">Add Products</li>
                        <li onclick="showForm('edit')">Edit Products</li>
                        <li onclick="showForm('remove')">Remove Products</li>
                    </ul>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="user-box" id="top">
        <div class="png">
          <img src="adminImage/user7.png" alt="" />
        </div>
        <div class="name">
          <p>Lily A.</p>
        </div>
        <div class="png">
          <img src="adminImage/user9.webp" alt="" />
        </div>
        <div class="name">
          <p>John D.</p>
        </div>
        <div class="png">
          <img src="adminImage/user6.png" alt="" />
        </div>
        <div class="name">
          <p>Abraham D.</p>
        </div>
        <button class="buttons">Show More <i class="fas fa-plus"></i></button>
      </div>
      <div class="user-box">
        <div class="text"><h2>Icome Status</h2></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    </div>
    <a href="#top" class="scroll"
      ><i class="fa fa-arrow-up" aria-hidden="true"></i
    ></a>
    </section>
<div id="form-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeForm()">&times;</span>
        <div id="form-container">
            <!-- Forms will be displayed here -->
        </div>
    </div>
</div>

<a href="#top" class="scroll"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>




<script src="../js/ad.js"></script>

<script src="../js/dropdown.js"></script>
<?php
require '../includes/footer.php'
?>
</body>
</html>