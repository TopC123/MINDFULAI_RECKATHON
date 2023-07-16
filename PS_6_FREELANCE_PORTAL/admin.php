<?php
session_start();

// Establish a connection to your MySQL database
$servername = "localhost";
$username = "id21039813_root";
$password = "Admin@123";
$dbname = "id21039813_task";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_name'])) {
    header("Location: index.php");
    exit();
}

// Access the admin ID and name from the session
$adminId = $_SESSION['admin_id'];
$adminName = $_SESSION['admin_name'];

// Handle form submission for adding new jobs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['job-title']) && isset($_POST['job-description']) && isset($_POST['job-salary']) && isset($_POST['job-duration'])) {
        $jobTitle = $_POST['job-title'];
        $jobDescription = $_POST['job-description'];
        $jobSalary = $_POST['job-salary'];
        $jobDuration = $_POST['job-duration'];

        // Insert the new job into the "jobs" table
        $insertJobQuery = "INSERT INTO jobs (title, description, salary, duration) VALUES ('$jobTitle', '$jobDescription', '$jobSalary', '$jobDuration')";
        if ($conn->query($insertJobQuery) === TRUE) {
            echo "Job added successfully";
        } else {
            echo "Error adding job: " . $conn->error;
        }
    } elseif (isset($_POST['completed_btn'])) {
        $jobId = $_POST['job_id'];

        // Update the job's completed status in the "jobs" table
        $updateJobQuery = "UPDATE jobs SET completed = 1 WHERE id = $jobId";
        if ($conn->query($updateJobQuery) === TRUE) {
            echo "Job marked as completed";
        } else {
            echo "Error updating job status: " . $conn->error;
        }
    } elseif (isset($_POST['drop_btn'])) {
        $jobId = $_POST['job_id'];

        // Delete the job from the "jobs" table
        $deleteJobQuery = "DELETE FROM jobs WHERE id = $jobId";
        if ($conn->query($deleteJobQuery) === TRUE) {
            echo "Job dropped successfully";
        } else {
            echo "Error dropping job: " . $conn->error;
        }
    }
}

// Retrieve the list of jobs from the "jobs" table
$jobsQuery = "SELECT * FROM jobs";
$jobsResult = $conn->query($jobsQuery);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        body {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .card:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .completed {
            background-color: #d4f4dc;
        }
    </style>
</head>
<body>
    
     <div id="loading-container">
        <video id="loading-video" autoplay loop muted>
            <source src="/Animation/loading.mp4" type="video/mp4">
        </video>
        <div class="loading-text">Loading...</div>
    </div>
    
    <header>
        <h1>Welcome, <?php echo $adminName; ?></h1>
        <a href="index.php">Logout</a>
    </header>
   
    <main>
        <div class="container">
            <h2>Add New Job</h2>
            <form id="new-job-form" action="admin.php" method="POST">
                <!-- Job form fields -->
                <div class="form-group">
                    <label for="job-title">Job Title</label>
                    <input type="text" class="form-control" name="job-title" required>
                </div>
                <div class="form-group">
                    <label for="job-description">Job Description</label>
                    <textarea class="form-control" name="job-description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="job-salary">Salary</label>
                    <input type="text" class="form-control" name="job-salary" required>
                </div>
                <div class="form-group">
                    <label for="job-duration">Duration</label>
                    <input type="text" class="form-control" name="job-duration" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Job</button>
            </form>

            <h2>Jobs List</h2>
            <div class="row">
                <?php
                // Retrieve the list of jobs with student details
                $jobsQuery = "SELECT jobs.*, students.name AS student_name FROM jobs LEFT JOIN students ON jobs.assigned_to = students.id";
                $jobsResult = $conn->query($jobsQuery);

                if ($jobsResult->num_rows > 0) {
                    while ($job = $jobsResult->fetch_assoc()) {
                        $assignedTo = $job['assigned_to'];
                        $studentName = $job['student_name'];

                        echo '
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">' . $job['title'] . '</h5>
                                    <p class="card-text">' . $job['description'] . '</p>
                                    <p class="card-text">Salary: ' . $job['salary'] . '</p>
                                    <p class="card-text">Duration: ' . $job['duration'] . '</p>
                                    <p class="card-text">Assigned To: ' . ($assignedTo ? $studentName : 'Not Assigned') . '</p>';

                        if ($assignedTo && $job['completed'] == 0) {
                            echo '
                            <form class="completed-form" action="admin.php" method="POST">
                                <input type="hidden" name="job_id" value="' . $job['id'] . '">
                                <button type="submit" name="completed_btn" class="btn btn-success">Completed</button>
                            </form>';
                        }

                        if (!$assignedTo) {
                            echo '
                            <form class="drop-form" action="admin.php" method="POST">
                                <input type="hidden" name="job_id" value="' . $job['id'] . '">
                                <button type="submit" name="drop_btn" class="btn btn-danger">Drop</button>
                            </form>';
                        }

                        echo '
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '<p>No jobs found</p>';
                }
                ?>
            </div>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            // AJAX request to update the job status as completed
            var completedForms = document.querySelectorAll('.completed-form');

            completedForms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    var formData = new FormData(this);
                    var xhr = new XMLHttpRequest();

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Highlight the completed job in green
                            form.closest('.card-body').classList.add('completed');
                        }
                    };

                    xhr.open('POST', this.action, true);
                    xhr.send(formData);
                });
            });
        </script>
    </main>

    <script>
    
         window.addEventListener('beforeunload', function() {
      
         document.getElementById('loading-container').style.display = 'block';
            });

                    window.addEventListener('load', function() {
     
                document.getElementById('loading-container').style.display = 'none';
        });
    
        window.addEventListener('load', function() {
        const loadingContainer = document.getElementById('loading-container');
        loadingContainer.style.display = 'flex';
        });
        
        setTimeout(function() {
        const loadingContainer = document.getElementById('loading-container');
        loadingContainer.style.display = 'none';
        document.body.style.opacity = '1';
        }, 3000);
        
        const loadingContainer = document.getElementById('loading-container');


window.addEventListener('load', function() {
  loadingContainer.style.display = 'flex';
});


window.addEventListener('beforeunload', function() {
  loadingContainer.style.display = 'flex';
});

// Hide the loading animation when the page is fully loaded
document.addEventListener('DOMContentLoaded', function() {
  loadingContainer.style.display = 'none';
});

// Hide the loading animation when the user clicks the back button
window.addEventListener('popstate', function() {
  loadingContainer.style.display = 'none';
});

    </script>
</body>
</html>

<?php
$conn->close();
?>
