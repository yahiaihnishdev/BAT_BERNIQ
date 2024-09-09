{{-- <?php
session_start();
include "./master/sections/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['pass'];

    // Use prepared statements for security
    $stmt = $conn->prepare("SELECT emp_id, emp_username, user_type_name, job_title
        FROM employees
        INNER JOIN learn_user_types ON employees.user_type_id = learn_user_types.user_type_id
        INNER JOIN jobs ON employees.job_id = jobs.job_id
        WHERE emp_username = :username
        AND emp_password = :password");

    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();

    $user_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($user_info) > 0) {
        $_SESSION['userid'] = $user_info[0]['emp_id'];
        $_SESSION['username'] = $user_info[0]['emp_username'];
        $_SESSION['usertype'] = $user_info[0]['user_type_name'];
        $_SESSION['jobs'] = $user_info[0]['job_title'];
        header("location:pages/admin/dashboard/admin.php");
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sign In | Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Admin & Dashboard Template" name="description">
    <meta content="Author" name="author">
    <link rel="shortcut icon" href="master/assets/images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="master/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="master/assets/css/custom.css">
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Welcome Back!</h4>
                        <p class="text-center text-muted mb-4">Sign in to continue to the dashboard.</p>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <?php if (isset($login_error)) { ?>
                                <div class="alert alert-danger">
                                    <?php echo $login_error; ?>
                                </div>
                            <?php } ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username or Email</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username or email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="pass" id="password" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Don't have an account? <a href="auth-signup-cover.html" class="text-primary">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="master/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}
