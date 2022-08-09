<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon-icon/24x24.png">
    
</head>
<body>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'user') {
    header("Location: " . $hostname);
}
include 'header.php'; ?>
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 class="section-head">My Profile</h2>
                    <?php
                        $user_id = $_SESSION["user_id"];
                        $db = new Database();
                        $db->select('user','*',null,"user_id = '{$user_id}'",null,null);
                        $result = $db->getResult();
                        if (count($result) > 0) {
                            $table = '<table>';
                            foreach($result as $row) { ?>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td><b>First Name :</b></td>
                                        <td><?php echo $row["f_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Name :</b></td>
                                        <td><?php echo $row["l_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username :</b></td>
                                        <td><?php echo $row["username"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile :</b></td>
                                        <td><?php echo $row["mobile"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address :</b></td>
                                        <td><?php echo $row["address"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>City :</b></td>
                                        <td><?php echo $row["city"]; ?></td>
                                    </tr>
                                </table>
                            <?php }
                        }
                        ?>
                        <a class="modify-btn btn" href="edit_user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                        <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';


?>
  