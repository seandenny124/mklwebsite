
<?php
include 'header.php';
$msg = '';
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    $msg = "<div class='error'>Already Logged In</div>";
    exit;
}
if (isset($_POST['email']) && $_POST['email'] != '') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute statement to get user data
    $query = "SELECT * FROM users WHERE email = ?";
    $user_data = get_data_by_query($query, array($email));

    if (count($user_data) == 1) {
        $hashed_password = $user_data[0]['password'];
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a new session
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user_data[0]['id'];
            $_SESSION["email"] = $user_data[0]['email'];
            $_SESSION["user_role"] = $user_data[0]['user_role'];
            // Redirect user to the previous page or index page
            header("location: more.php");
            exit;
        } else {
            $msg = "<div class='error'>Invalid password</div>";
        }
    } else {
        $msg = "<div class='error'>User not found</div>";
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
    .row{
        width: 100%;
  float: left;
  padding: 0 2rem;
  box-sizing: border-box;
    }
    .row .col{
        width: 50%;
        float: left;
        box-sizing: border-box;
    }

    .row .col input#submit,
    .row .col a{
        color: #010100;
        background-color: #e4ff77;
        border: 2px solid transparent;
        border-radius: 12px;
        width: 100%;
        height: 50px;
        margin: 0 !important;
        float: left;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
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
        <?php echo $msg; if(isset($_SESSION["success_message"])){
    echo $_SESSION["success_message"];
    // Unset the session variable to remove the message after displaying it once
    unset($_SESSION["success_message"]);
} ?>
            <h1>Login</h1>

            <form class="login-form" method="post">
                <input id="email" type="email" name="email" placeholder="Email" required>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <a id="pwdreset" href="#">Forgot password?</a>
                  <div class="row">
                    <div class="col" style="padding-right: 1rem;">
                    <input id="submit" type="submit" name="submit" value="Login">
                    </div>
                    <div class="col">
                  <a href="signup.php">Create Account</a>
                    </div>
                  </div>
                </form>
                </div>
            </form>

            

        </div>

    </body>


</html>