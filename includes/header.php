<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else{
    header("Location: register.php");
}
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Water Colors</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/watercolor.js"></script>
        <script src="assets/js/jquery.Jcrop.js"></script>
        <script src="assets/js/jcrop_bits.js"></script>
        
        <!-- CSS -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/51271ac046.js"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/jquery.Jcrop.css">
    </head>
    <body>

        <div class="top_bar">
            <div class="logo">
                <a href="index.php">WaterColors</a>
            </div>  
            <nav>
                <?php
                    // unread messages
                    $messages = new Message($con, $userLoggedIn);
                    $num_messages = $messages->getUnreadNumber();

                    // unread notifications
                    $notifications = new Notification($con, $userLoggedIn);
                    $num_notifications = $notifications->getUnreadNumber();
                ?>

                <a href="<?php echo $userLoggedIn; ?>">
                    <?php echo $user['first_name']; ?>
                </a>
                <a href="index.php">
                    <i class="fas fa-home"></i>
                </a>
                <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
                    <i class="far fa-envelope"></i>
                    <?php
                    if($num_messages > 0)
                     echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
                    ?>
                </a>
                <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
                    <i class="far fa-bell"></i>
                    <?php
                    if($num_notifications > 0)
                     echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
                    ?>
                </a>
                <a href="requests.php">
                    <i class="fas fa-user-friends"></i>
                </a>
                <a href="#">
                    <i class="fas fa-cog"></i>
                </a>
                <a href="includes/handlers/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </nav>  

            <div class="dropdown_data_window" style="height: 0px;"></div>
            <input type="hidden" id="dropdown_data_type" value="">
        </div>

        <script>
                var userLoggedIn = '<?php echo $userLoggedIn; ?>';
                $(document).ready(function(){

                    $(window).scroll(function(){
                        
                        var inner_height = $('.dropdown_data_window').innerHeight(); //div containing data
                        var scroll_top = $(.dropdown_data_window).scrollTop();
                        var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
                        var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

                        if((scroll_top + inner_height > = $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false'){

                            var pageName; //holdsname of page to send ajax request to
                            var type = $('#dropdown_data_type').val();

                            if(type == 'notification')
                                pageName = "ajax_load_notifications.php";
                            else if(type == 'message')
                                pageName = 'ajax_load_messages.php'

                        var ajaxReq = $.ajax({
                            url: "includes/handlers/" + pageName,
                            type: "POST",
                            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                            cache: false,

                            success: function(response){
                                
                                $('.dropdown_data_window').find('.nextPageDropdownData').remove(); //removes current .nextpage
                                $('.dropdown_data_window').find('.noMoreDropdownData').remove(); //removes current .nextpage

                                $('.dropdown_data_window').append(response);
                            }
                        });

                        } // end if

                        return false;
                    }); // end $(window).scroll(function())
                });
            </script>

        <div class="wrapper">

        