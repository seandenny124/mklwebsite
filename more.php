
<?php session_start();
include 'config.php';
$msg = '';
if (isset($_POST['comment']) && $_POST['comment'] !='') {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $comment = $_POST['comment'];
        if(isset($_SESSION["email"])){
           $user_email = $_SESSION["email"];
        }
        $stmt = $conn->prepare("INSERT INTO comments (comment, username) VALUES (?, ?)");
        $stmt->bind_param("ss", $comment, $user_email);
        if ($stmt->execute()) {
           echo $msg = "<div class='success'>Comment added successfully</div>";
        } else {
           echo $msg = "<div class='error'>Error: " . $stmt->error."</div>";
        }
        $stmt->close();
    } else {
       echo $msg = "<div class='error'>Comment field is empty</div>";
    }
    
}
?>
<html>
    <head>
        <title>Mario Kart Lore</title>
        <link rel="icon" type="image/x-icon" href="https://assets.nintendo.com/image/upload/f_auto/q_auto/dpr_2.0/c_scale,w_400/ncom/en_US/games/switch/m/mario-kart-8-deluxe-switch/description-image">
        <link rel="stylesheet" href="stylesMore.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.m100{
    width: 100%;
  float: left;
}

.m33{
    width: 33%;
  float: left;
}

body {
  overflow-y: inherit;
}
</style>
    </head>
    <body>

        <div id ="HEADER"> 
            <div id = "WELCOME">
                <div id ="LOGO">
            <img src="https://mario.wiki.gallery/images/7/7a/MK8_Star_Cup_Alternate_Emblem.svg">
                </div>
                <div id = "TITLE">
                    <div id = "HEAD TITLE">
                        <h1>Mario Kart Lore</h1>
                    </div>
                    <div id = "WELCOME_MESSAGE" >
                        <div class="page">
                            <button class="my-button">More: Comments and Questions</button>
                        </div>
                    </div>
                </div>
                <div id = "HELP SECTION">
                    <div id = "SEARCH">

                    </div>
                    <div id = "LOGIN">

                    </div>
                </div>
            </div>
        </div>
        <div id = "Buttons"></div>

        <div class = "last-img">
            <img src = "https://assets.nintendo.com/image/upload/f_auto/q_auto/dpr_2.0/c_scale,w_400/ncom/en_US/games/switch/m/mario-kart-8-deluxe-switch/description-image">
        </div>

<?php if(isset($_SESSION["email"])){ ?>
    <div class="login">
            <button class="tablinks"><a href="logout.php">Logout</a></button>
            </div>
    <?php }else{ ?>
        
            <div class="login">
            <button class="tablinks"><a href="login.php">Log In</a></button>
            <button class="tablinks"><a href="signup.php">Sign Up</a></button>
        </div>
        <?php } ?>
            
        <div class="tab">
            <button class="tablinks"><a href="index.html">Homepage</button>
            <button class="tablinks"> <a href="karts.html">Karts</a></button>
            <button class="my-button"><a href="maps.html">Maps</a></button>
            <button class="tablinks"><a href="characters.html">Characters</a></button>
            <button class="my-button">More</button>
        <!-- <button class="tablinks" onclick="openCity(event, 'London')">London</button>
        <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
        <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
        </div>
                        
        <div>

                        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
                        <div class="action-container">
                        <p>References:<br><br></p>
                        <ul id="menu">
                            <li class="sub"><a href="https://www.mariowiki.com/Mario_Kart_(series)">Mario Kart Wiki<br><br></a>  </li>
                            <li class="sub"><a href="https://www.thegamer.com/things-facts-trivia-didnt-know-mario-kart-franchise-games-nintendo/">Things you didn't know about Mario Kart<br><br></a>  </li>
                            <li class="sub"><a href="https://www.videogameschronicle.com/features/the-complete-history-of-mario-kart-games/">History of Mariokart<br><br></a>  </li>
                            <li class="sub"><a href="https://www.eurogamer.net/mario-kart-8-guide-tips-tricks-shortcuts-deluxe">Mario Kart Tips and Tricks<br><br></a></li>
                        </ul>
                        </div>
                        <div class = "search">
                            <label for="Name">Search:</label>
                            <input type="text" id="Name" name="Name" placeholder="Mario">
                                </div>

                        
                        
                                <?php
                               
if(isset($_SESSION["email"])){
    // If user is logged in
    ?>
    <!-- Comment form -->
    <form method="post">
        <div class="comments">
            <label for="comment" style="width:100%;float:left">Add Comment</label>
            <input type="text" id="comment" name="comment" placeholder="" style="padding: 10px 10px;width: 30%;margin:15px 0"><br>
            <input type="submit" name="submit" value="Submit" style="padding: 10px 30px;background: red;border-radius: 5px;border: 1px solid red;color: #fff;font-size: 17px;font-weight: 600;cursor:pointer;">
        </div>
    </form>
    <?php 
    if(isset($_SESSION) && $_SESSION['user_role'] == 1){
        $stmt_check = $conn->prepare("SELECT comments.*, comments.id AS cid, users.* FROM comments JOIN users ON comments.username = users.email");
    }
    else {
    $stmt_check = $conn->prepare("SELECT comments.*, comments.id AS cid, users.* FROM comments JOIN users ON comments.username = users.email WHERE comments.username = ?");
        $stmt_check->bind_param("s", $_SESSION["email"]);
    }
    
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    
    if ($result->num_rows > 0) { 
        ?>
        <!-- Comments table -->
        <table style="width: 30%;float: left;position: absolute;z-index: 999999999999;top: 80%;left: 1%;">
            <thead>
                <tr>
                    <?php if(isset($_SESSION) && $_SESSION['user_role'] == 1 || isset($_SESSION) && $_SESSION['user_role'] == 2 ){ ?>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Date - Time</th>
                    <th>Admin Reply</th>
                    <?php if(isset($_SESSION) && $_SESSION['user_role'] == 1){ ?>
                    <th>Reply</th>
                    <th>Delete</th>
                    <?php } ?>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $badWords = array("Fool", "Idiot", "Stupid", "lame", "horrible", "terrible", "awful", "deficient");
                    $comment = $row['comment'];
                    $filteredComment = str_replace($badWords, "****", $comment);
                    ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $filteredComment; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['admin_reply']; ?></td>
                        <?php if(isset($_SESSION) && $_SESSION['user_role'] == 1){ ?>
                        <td>
                            <form method="post">
                                <input type="text" name="admin_reply" placeholder="Admin Reply" style="padding: 10px;">
                                <input type="hidden" name="comment_id" value="<?php echo $row['cid']; ?>">
                                <input type="submit" name="submit_reply" value="Reply" style="padding: 10px 21px;margin-top: 10px;background: green;border: none;color: #fff;font-weight: 700;">
                            </form>
                        </td>
                        <td><a href="more.php?delID=<?php echo $row['cid']; ?>" style="padding: 10px 30px;background: red;border-radius: 5px;border: 1px solid red;color: #fff;font-size: 17px;font-weight: 600;">Delete</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php 
    } 
} else {
    // If user is not logged in
    ?>
    <div class="description">
        Comments: <p>Please Login First <a href="login.php">Login here</a></p>
    </div>
<?php 
}

// Process admin replies
if(isset($_POST['submit_reply']) && isset($_SESSION["email"])) {
    $admin_reply = $_POST['admin_reply'];
    $comment_id = $_POST['comment_id'];
    
    // Update the comment with admin's reply
    $stmt_update = $conn->prepare("UPDATE comments SET admin_reply = ? WHERE id = ?");
    $stmt_update->bind_param("si", $admin_reply, $comment_id);
    
    if ($stmt_update->execute()) {
        $msg = "<div class='success'>Admin reply added successfully</div>";
    } else {
        $msg = "<div class='error'>Error: " . $stmt_update->error . "</div>";
    }
    
    $stmt_update->close();
}

if(isset($_GET['delID']) && isset($_SESSION["email"])) {
    $comment_id = $_GET['delID'];
    
    // Delete the comment from the database
    $stmt_delete = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt_delete->bind_param("i", $comment_id);
    
    if ($stmt_delete->execute()) {
        $msg = "<div class='success'>Comment deleted successfully</div>";
    } else {
        $msg = "<div class='error'>Error: " . $stmt_delete->error . "</div>";
    }
    
    $stmt_delete->close();
}

echo $msg; 

?>

                       
        </div></div>
        <div class="footer" style="margin-top: 0;bottom:unset !important;">Copyright Nintendo PSYCH I own nintendo now don't mess with me >:)</div>


    </body>
</html>
