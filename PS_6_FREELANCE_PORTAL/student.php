<?php
// Include your database connection code here
$servername = "localhost";
$username = "id21039813_root";
$password = "Admin@123";
$dbname = "id21039813_task";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the student details from the session
$studentId = $_SESSION['student_id'];
$studentName = $_SESSION['student_name'];

// Retrieve the assigned job details for the student
$assignedJobQuery = "SELECT jobs.id AS job_id, jobs.title, jobs.description, jobs.salary, jobs.duration, students.name AS student_name FROM jobs LEFT JOIN students ON jobs.assigned_to = students.id WHERE students.id = $studentId";
$assignedJobResult = $conn->query($assignedJobQuery);

// Retrieve the jobs accepted by the student
$acceptedJobsQuery = "SELECT jobs.id AS job_id, jobs.title, jobs.description, jobs.salary, jobs.duration, students.name AS student_name FROM jobs LEFT JOIN students ON jobs.assigned_to = students.id WHERE students.id = $studentId AND jobs.assigned_to IS NOT NULL";
$acceptedJobsResult = $conn->query($acceptedJobsQuery);

// Retrieve the available jobs
$availableJobsQuery = "SELECT * FROM jobs WHERE assigned_to IS NULL";
$availableJobsResult = $conn->query($availableJobsQuery);

// Retrieve the student's current job
$currentJobQuery = "SELECT * FROM jobs WHERE assigned_to = $studentId";
$currentJobResult = $conn->query($currentJobQuery);
$currentJob = $currentJobResult->fetch_assoc();

// Handle job selection
if (isset($_POST['job_id'])) {
    // Check if the student already has a job
    // if ($currentJob) {
    //     // Remove the current job assignment
    //     $updateCurrentJobQuery = "UPDATE jobs SET assigned_to = NULL WHERE id = {$currentJob['id']}";
    //     $conn->query($updateCurrentJobQuery);
    // }

    $selectedJobId = $_POST['job_id'];

    // Update the selected job's assigned_to field to the student's ID
    $updateJobQuery = "UPDATE jobs SET assigned_to = $studentId WHERE id = $selectedJobId";
    $conn->query($updateJobQuery);

    // Redirect to refresh the page
    header("Location: student.php");
    exit();
}

// Handle dropping a job
if (isset($_POST['drop_job_id'])) {
    $droppedJobId = $_POST['drop_job_id'];

    // Update the dropped job's assigned_to field to NULL
    $updateDroppedJobQuery = "UPDATE jobs SET assigned_to = NULL WHERE id = $droppedJobId";
    $conn->query($updateDroppedJobQuery);

    // Redirect to refresh the page
    header("Location: student.php");
    exit();
}

// Handle completing a job
if (isset($_POST['complete_job_id'])) {
    $completedJobId = $_POST['complete_job_id'];

    // Delete the completed job from the jobs table
    $deleteJobQuery = "DELETE FROM jobs WHERE id = $completedJobId";
    $conn->query($deleteJobQuery);

    // Redirect to refresh the page
    header("Location: student.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="Freelancer-style.css" />
    <title>Student Portal</title>
    <script src="script.js"></script>
    <script src="script1.js"></script>
    <style>
        
  /* Loading Animation Styles */


  #loading-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #fff;
    z-index: 9999;
    transition: opacity 0.8s;
  }
  
  #loading-video {
    width: 70%;
    height: auto;
    max-height: 70vh;
  }
  
  .loading-text {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
  }
  
  /* Job Card Styles */

/* Job Card Styles */

.card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease-in-out;
  margin-bottom: 20px;
  padding: 20px;
}

.card:hover {
  box-shadow: 0 8px 12px teal;
  background-color: rgb(0,128,128,.5);
}

.card-title {
  font-size: 18px;
  margin-bottom: 10px;
  text-align: center;
  display:flex;
}

.card-body {
  font-size: 14px;
  margin-bottom: 10px;
  text-align: center;
  color:black;
}

.card-text {
  font-size: 14px;
  text-align: center;
}

.job-buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.job-buttons button {
  background-color: teal;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.3s ease-in-out;
}

.job-buttons button:hover {
  background-color: #006666;
}

.job-details {
  margin-top: 20px;
}

.job-details p {
  margin-bottom: 5px;
  line-height: 1.4;
}

  
    /*@keyframes slideIn {*/
    /*  0% {*/
    /*    opacity: 0;*/
    /*    transform: translateX(-100%);*/
    /*  }*/
    /*  100% {*/
    /*    opacity: 1;*/
    /*    transform: translateX(0);*/
    /*  }*/
    /*}*/

    /*.card {*/
    /*  animation: slideIn 0.5s ease-in-out;*/
    /*}*/

    /*@keyframes fadeIn {*/
    /*  0% {*/
    /*    opacity: 0;*/
    /*  }*/
    /*  100% {*/
    /*    opacity: 1;*/
    /*  }*/
    /*}*/

    /*.card-details {*/
    /*  animation: fadeIn 0.5s ease-in-out;*/
    /*}*/

    /*@keyframes dropButtonFadeIn {*/
    /*  0% {*/
    /*    opacity: 0;*/
    /*    transform: translateY(10px);*/
    /*  }*/
    /*  100% {*/
    /*    opacity: 1;*/
    /*    transform: translateY(0);*/
    /*  }*/
    /*}*/

    /*.card:hover .drop-button {*/
    /*  animation: dropButtonFadeIn 0.3s ease-in-out;*/
    /*}*/

    /*@keyframes cardHover {*/
    /*  0% {*/
    /*    transform: translateY(0);*/
    /*  }*/
    /*  50% {*/
    /*    transform: translateY(-5px);*/
    /*  }*/
    /*  100% {*/
    /*    transform: translateY(0);*/
    /*  }*/
    /*}*/

    /*.card:hover {*/
    /*  animation: cardHover 0.5s infinite;*/
    /*}*/
 
  
    </style>
  </head>

  <body>
  <!--    <div id="loading-container">-->
  <!--      <video id="loading-video" autoplay loop muted>-->
  <!--    <source src="/Animation/loading.mp4" type="video/mp4">-->
  <!--  </video>-->
  <!--  <div class="loading-text">Loading...</div>-->
    
  <!--</div>-->
    <nav>
      <div class="heading">
        <h4>Freelancer.com</h4>
      </div>

      <ul class="nav-links">
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Explore</a>
          <div class="dropdown-content">
            <a href="#">Community</a>
            <a href="#">Discover</a>
            <a href="#">Learn</a>
            <a href="#">Blog</a>
            <a href="#">Podcast</a>
            <a href="#">Tricks</a>
          </div>
        </li>
        <li><a class="active" href="student.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="Freelancer.html">My Jobs</a></li>
        <li><a href="index.php">Logout</a></li>
      </ul>
    </nav>
    <img src="font.png" alt="Font" class="header-font">
    <div class="carousel-container" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
      <div class="carousel-slide">
        <img src="image1.jpeg" alt="Image 1">
        <img src="image2.jpeg" alt="Image 2">
        <img src="image3.jpg" alt="Image 3">
      </div>
    </div>
    <main>
      <div class="result">
          

          <h2 style="margin-left:600px">YOUR ACCEPTED JOBS</h2>
          <?php if ($acceptedJobsResult && $acceptedJobsResult->num_rows > 0) {
              while ($acceptedJob = $acceptedJobsResult->fetch_assoc()) { ?>
                  <div class="card" >
                      <div class="card-body" style = "padding:15px">
                          <h5 class="card-title"><?php echo $acceptedJob['title']; ?></h5>
                          <p class="desc"><?php echo $acceptedJob['description']; ?></p>
                          <p class="card-text">Salary: <?php echo $acceptedJob['salary']; ?></p>
                          <p class="card-text">Duration: <?php echo $acceptedJob['duration']; ?></p>
                          <p class="card-text">Assigned to: <?php echo $acceptedJob['student_name']; ?></p>
                          <div class="form-container" style="top:70px">
                              <form action="student.php" method="POST">
                                  <input type="hidden" name="drop_job_id" value="<?php echo $acceptedJob['job_id']; ?>">
                                  <button class="drop" style="top:50px">Drop</button>
                              </form>
                              <form action="student.php" method="POST" class="completed-form">
                                  <input type="hidden" name="complete_job_id" value="<?php echo $acceptedJob['job_id']; ?>">
                                  <button class="completed">Completed</button>
                              </form>
                          </div>
                      </div>
                  </div>
              <?php }
          } else { ?>
              <p>No jobs accepted</p>
          <?php } ?>
          <br><br><br>
          <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
          <br><br><br>
          <h2 style="margin-left:650px">AVAILABLE JOBS</h2>
          <?php $cardCounter = 0;
          while ($row = $availableJobsResult->fetch_assoc()) {
              if ($cardCounter % 3 == 0) {
                  echo '<div class="row">';
              }
              ?>
              <div class="card">
                  <div class="card-body" style = "padding:15px">
                      <h5 class="card-title"><?php echo $row['title']; ?></h5>
                      <p class="card-text"><?php echo $row['description']; ?></p>
                      <p class="card-text">Salary: <?php echo $row['salary']; ?></p>
                      <p class="card-text">Duration: <?php echo $row['duration']; ?></p>
                      <?php if ($currentJob && $currentJob['id'] == $row['id']) { ?>
                          <p class="card-text">Current Job</p>
                      <?php } else { ?>
                          <form action="student.php" method="POST">
                              <input type="hidden" name="job_id" value="<?php echo $row['id']; ?>">
                              <button type="submit" class="btn btn-primary completed" style="top:70px">Select Job</button>
                          </form>
                      <?php } ?>
                  </div>
              </div>
              <?php
              if ($cardCounter % 3 == 2) {
                  echo '</div>';
              }
              $cardCounter++;
          }
          if ($cardCounter % 3 != 0) {
              echo '</div>';
          } ?>
      </div>
  </main>
//       <script>
    
//          window.addEventListener('beforeunload', function() {
      
//          document.getElementById('loading-container').style.display = 'block';
//             });

//                     window.addEventListener('load', function() {
     
//                 document.getElementById('loading-container').style.display = 'none';
//         });
    
//         window.addEventListener('load', function() {
//         const loadingContainer = document.getElementById('loading-container');
//         loadingContainer.style.display = 'flex';
//         });
        
//         setTimeout(function() {
//         const loadingContainer = document.getElementById('loading-container');
//         loadingContainer.style.display = 'none';
//         document.body.style.opacity = '1';
//         }, 3000);
        
//         const loadingContainer = document.getElementById('loading-container');


// window.addEventListener('load', function() {
//   loadingContainer.style.display = 'flex';
// });


// window.addEventListener('beforeunload', function() {
//   loadingContainer.style.display = 'flex';
// });

// // Hide the loading animation when the page is fully loaded
// document.addEventListener('DOMContentLoaded', function() {
//   loadingContainer.style.display = 'none';
// });

// // Hide the loading animation when the user clicks the back button
// window.addEventListener('popstate', function() {
//   loadingContainer.style.display = 'none';
// });

//     </script>

  </body>
</html>

<?php
// Close the database connection
$conn->close();
?>
