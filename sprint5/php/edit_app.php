// <?php
// require '/home/gnocchig/attdb.php';

// $sql = "
//         SELECT * FROM applications
//         ORDER BY application_id
//     ";

// $result = mysqli_query($cnxn, $sql);

// $applications = [];

// while ($row = mysqli_fetch_assoc($result)) {
//     $applications[] = $row;
// }

// header('Content-Type: application/json');
// echo json_encode($applications);
// ?>



// <?php
// require '/home/gnocchig/attdb.php';

// if (isset($_GET['id']) && is_numeric($_GET['id'])) {
//     $applicationId = $_GET['id'];
//     $sql = "SELECT * FROM applications WHERE application_id = 1";
//     $stmt = mysqli_prepare($cnxn, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $applicationId);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     $appData = mysqli_fetch_assoc($result);
    
//     echo $result;
    
// } else {
    
//     echo $_GET['id'];
//     echo "hello world!";
//     // Handle the error case where 'id' is not set or not numeric
// }

// // ... rest of the code to display the form ...
// ?>


<?php
// Include your database connection file
require '/home/gnocchig/attdb.php';

echo var_dump($_GET);

// Check if the 'id' GET parameter is set
if(isset($_GET["id"])) {
    $application_id = $_GET["id"];

    // Fetch the application data from the database
    $sql = "SELECT * FROM applications WHERE application_id =" . $application_id;
    $stmt = $cnxn->prepare($sql);
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appData = $result->fetch_assoc();
    
    

    // Check if the application exists
    if($appData) 
    {
       
    } 
    else 
    {
        echo "Application not found.";
    }
} 
else 
{
    echo "No application ID provided.";
}

                                
// Handle the form submission
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Retrieve form data
//     $application_name = $_POST['application_name'];
//     // Ensure this matches the 'name' attribute of your Job Description URL input
//     $application_url = $_POST['application_url'];
//     $application_date = $_POST['application_date'];
//     $application_status = $_POST['application_status'];
//     $application_updates = $_POST['application_updates'];
//     $application_followUp = $_POST['application_followUp'];

//     // Prepare the SQL UPDATE query
//     $update_sql = "UPDATE applications SET application_name = ?, application_url = ?, application_date = ?, application_status = ?, application_updates = ?, application_followUp = ? WHERE application_id = ?";
//     echo $update_sql;
//     $update_stmt = $cnxn->prepare($update_sql);
//     // 'ssssssi' corresponds to the data types of the parameters in order: string, string, string, string, string, string, integer
//     $update_stmt->bind_param("ssssssi", $application_name, $application_url, $application_date, $application_status, $application_updates, $application_followUp, $application_id);

//     // Execute the update
//     if($update_stmt->execute()) 
//     {
//         echo "Application updated successfully.";
//         // Redirect back to dashboard or to the updated application details
//         header("Location: dashboard.php");
//         exit();
//     } 
//     else
//     {
//         echo "Error updating application.";
//     }
// }
?>

 



<!DOCTYPE html>
    <html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

      
        <link rel="stylesheet" href="../styles/newApplicationForm.css">

         
        <link rel="stylesheet" href="../styles/global.css">
        <title>Application Form</title>
    </head>
    <body>
    <header class="site-navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand fs-3" href="dashboard.php">GRC ATT</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                        <span class="navbar-dark navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse fs-3" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../html/newApplicationForm.html">New Application</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../html/contactForm.html">Contact</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="admin-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item fs-5" href="adminDashboard.php">Admin Dashboard</a></li>
                                    <li><a class="dropdown-item fs-5" href="../html/adminAnnouncement.html">Admin Announcement</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="../html/signUpForm.html"><button type="button" class="btn btn-bd-primary signUp">Sign Up</button></a>
                                <button type="button" class="btn btn-bd-primary signUp dark-mode-btn" onclick="toggleDarkMode()">Toggle Dark Mode</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>



     
    <div class="form-container">
    
    <form action="edit_app.php?id=<?php echo htmlspecialchars($appData['application_id']); ?>" method="post">

            <input type="hidden" name="application_id" value="<?php echo $appData['application_id']; ?>" required>

            <label for="application_name">Name of Role:</label>
            <input type="text" name="application_name" value="<?php echo htmlspecialchars($appData['application_name']); ?>" required>


            <label for="application_url">Job Description URL:</label>
            <input type="url" name="application_url" value="<?php echo htmlspecialchars($appData['application_url']); ?>" required>

            <label for="application_date">Date of Application:</label>
            <input type="date" name="application_date" value="<?php echo htmlspecialchars($appData['application_date']); ?>" required>

            <label for="application_status">Status:</label>
            <select name="application_status">
                <option value="Need to Apply" <?php echo $appData['application_status'] == 'Need to Apply' ? 'selected' : ''; ?>>Need to Apply</option>
                <option value="Applied" <?php echo $appData['application_status'] == 'Applied' ? 'selected' : ''; ?>>Applied</option>
                <option value="interviewing" <?php echo $appData['application_status'] == 'Interviewing' ? 'selected' : ''; ?>>Interviewing</option>
                <option value="Rejected" <?php echo $appData['application_status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                <option value="Accepted" <?php echo $appData['application_status'] == 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                <option value="Inactive/Expired" <?php echo $appData['application_status'] == 'Inactive/Expired' ? 'selected' : ''; ?>>Inactive/Expired</option>
            </select>

            <label for="application_updates">Updates:</label>
            <textarea name="application_updates"><?php echo htmlspecialchars($appData['application_updates']); ?></textarea>

            <label for="application_followUp">Follow Up Date:</label>
            <input type="date" name="application_followUp"
            value="<?php echo htmlspecialchars($appData['application_followUp']); ?>" required>

            <input type="submit" value="Update Application">
        </form>
    </div>
      
    <script src="../scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
    </body>
</html>