<?php include_once("index.html"); 

// Check the 'tab' parameter in the URL
$selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 'tab1';



// Display content based on the selected tab
echo "<section id='tab1' style='display: " . ($selectedTab === 'tab1' ? 'block' : 'none') . "'>";
echo "<h2>Tab 1 Content</h2>";
echo "<p>This is the content for Tab 1.</p>";
echo "</section>";

echo "<section id='tab2' style='display: " . ($selectedTab === 'tab2' ? 'block' : 'none') . "'>";
echo "<h2>Tab 2 Content</h2>";
echo "<p>This is the content for Tab 2.</p>";
echo "</section>";

echo "<section id='tab3' style='display: " . ($selectedTab === 'tab3' ? 'block' : 'none') . "'>";
echo "<h2>Tab 3 Content</h2>";
echo "<p>This is the content for Tab 3.</p>";
echo "</section>";
?>


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