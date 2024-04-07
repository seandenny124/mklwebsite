<?php
include 'header.php';
$msg = '';
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: more.php");
    exit;
}
if (isset($_POST['email']) && $_POST['email'] !='') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='error'>Invalid email format</div>";
    }
    if ($password !== $confirm_password) {
        $msg = "<div class='error'>Passwords do not match</div>";
    }
    $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        $msg = "<div class='error'>Email already exists</div>";
    }else{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    if ($stmt->execute()) {
        sleep(2);
        header("location: index.php");
    } else {
        $msg = "<div class='error'>Error: " . $stmt->error;
    }
}
}
?>
<style>
    .error{
        background: palegoldenrod;
        padding: 14px;
        position: absolute;
        right: 1%;
        top: 10%;
        width: 20%;
    }
    .success{
        background: green;
        padding: 14px;
        color: #fff;
        position: absolute;
        right: 1%;
        top: 10%;
        width: 20%;
    }
    #submit{
        cursor: pointer !important;
    }
</style>
        <img src="https://mario.wiki.gallery/images/7/7a/MK8_Star_Cup_Alternate_Emblem.svg">
        <div class = "other-image">
            <img src="https://mario.wiki.gallery/images/7/7a/MK8_Star_Cup_Alternate_Emblem.svg">
        </div>
        <div class="login-box">
        <?php echo $msg; ?>
            <h1>Signup</h1>
            <form class="login-form" method="post">
                <input id="username" type="email" name="email" placeholder="Email" required>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <input id="password" type="password" name="confirm_password" placeholder="Confirm Password" required>
                  <input id="submit" type="submit" name="submit" value="Create Account">
                </form>
                </div>
            </form>
        </div>
    </body>
</html>