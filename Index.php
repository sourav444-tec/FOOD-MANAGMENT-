<?php
session_start();

// initialize message variable
$mess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Send'])) {

    // connect to database
    $conn = mysqli_connect("localhost", "root", "", "food");
    if (!$conn) {
        $mess = '<div class="text-danger">Database connection failed: ' . htmlspecialchars(mysqli_connect_error()) . '</div>';
    } else {
        // basic input handling
        $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
        $pass = isset($_POST['pass']) ? mysqli_real_escape_string($conn, $_POST['pass']) : '';

        // avoid empty credentials
        if ($username === '' || $pass === '') {
            $mess = '<div class="text-danger">Please enter username and password.</div>';
        } else {
            $sql = "SELECT * FROM ADMIN WHERE username = '$username' AND pass = '$pass'";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['id'] = $row['id'];
                    // redirect and exit
                    header('Location: home.php');
                    exit;
                } else {
                    $mess = '<div class="text-danger">Wrong username or password</div>';
                }
            } else {
                $mess = '<div class="text-danger">Query error: ' . htmlspecialchars(mysqli_error($conn)) . '</div>';
            }
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Admin Login</h4>
                        <?php if ($mess) echo $mess; ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" required>
                            </div>
                            <button type="submit" name="Send" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>