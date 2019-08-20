<?php
include("includes/header.php");
include("includes/classes/User.php");
?>
            <div class="user_details column">
                <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic']; ?>"> </a>
                
                <div class="user_details_left_right">
                <a href="<?php echo $userLoggedIn; ?>">
                    <?php 
                    echo $user['first_name'] . " " . $user['last_name'];
                    ?>
                </a>
                <br />
                <?php echo "Posts: " . $user['num_posts'] . "<br />";
                echo "Likes: " . $user['num_likes'];
                ?>
                </div>
            </div>

            <div class="main_column column">
                <form action="index.php" class="post_form" method="POST">
                    <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
                    <input type="submit" name="post" id="post_button" value="Post">
                    <hr/>

                </form>

<?php 
$user_obj = new User($con, $userLoggedIn);
echo $user_obj->getFirstAndLastName();
?>

            </div>

        </div>
    </body>
</html>