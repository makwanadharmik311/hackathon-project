<?php 
      $profileImgHide = true; 
      require_once 'config.php'; 
      //include('includes/header.php'); 
      //require_once 'after_google_login.php'; 
      //require_once 'auth.php'; 
      include_once 'includes/sessionStart.php';
      if(!isset($_SESSION['user_email_address'])){
        echo "<script>alert('You have to first Log In/Sign Up!');
        window.location.href = 'auth.php';
        </script>";
        exit();
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Template</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>

<body>
<?php 
    $user_email = $_SESSION['user_email_address'];
    //$googleImage = $_SESSION['user_image']  ?? null;
    //$defaultImage = "default.png";
    //$sql = "SELECT `profile_picture` FROM `users` WHERE `email` = ?";
    $sql2 = "SELECT * FROM users WHERE `email` = ?";
    //$stmt = $conn->prepare($sql);
    $stmt2 = $conn->prepare($sql2);
    $role = $_SESSION["role"];
    //$stmt->bind_param("s",$user_email);
    $stmt2->bind_param("s",$user_email);

    $stmt2->execute(); 
    $res2 = $stmt2->get_result();
    $row1 = $res2->fetch_assoc();
    $storedImage = $row1['profile_picture'] ?? null;
    //echo  $storedImage;
    // if(isset($_SESSION['google_id']) && !$storedImage){
    //     $googleImage = $_SESSION['user_image'] ?? null;
    //     if($googleImage){
    //     $sqlGoogIm = "UPDATE `users` SET `profile_picture`= '$googleImage' WHERE email = ?"; 
    //     $stmtGoIm = $conn->prepare($sqlGoogIm);
    //     $stmtGoIm->bind_param("s",$user_email);
    //     $stmtGoIm->execute();
    //     $profileImg = $googleImage;
    //     }
    // }
    // else{
    //     $profileImg = $storedImage ?: $defaultImage;
    // }

    //$stmt2->execute();
    ?>

 <?php 
   include('includes/header.php');
 ?>

<hr style = 'border:none;height:4px;background:linear-gradient(to right,red,blue);'>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4"><u>
            Account Settings
        </h4></u>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-info">Info</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-social-links">Social links</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-connections">Connections</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-notifications">Notifications</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="<?php echo htmlspecialchars($storedImage);?>" alt = "image"
                                   height = "150px" width = "150px">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary" onclick = "promptUpload()">
                                        Upload new photo
                                    </label> &nbsp;
                                    
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo  $row1['name']?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo $user_email;?>" readonly>
                                    <!-- <div class="alert alert-warning mt-3">
                                        Your email is not confirmed. Please check your inbox.<br>
                                        <a href="javascript:void(0)">Resend confirmation</a>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <label class="form-label" readonly>Role</label>
                                    <input type="text" class="form-control" value="<?php echo $role;?>" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" value="Company Ltd." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
    <div class="card-body pb-2">
        <!-- <div class="form-group">
            <label class="form-label">Current password</label>
            <input type="password" class="form-control">
        </div> -->
        <form id = "passwordForm" action = "new_pass.php" method = "POST" onsubmit = "return validateForm()">
        <div class="form-group">
            <label class="form-label">New password</label>
            <input type="password" name = "npass" id = "newPassword" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Confirm New password</label>
            <input type="password" id = "confirmPassword" name = "cpass" class="form-control" required>
            <small>New Password & Confirm Password must be match!</small><br>
        </div>
        <span id = "message"></span><br> 
        <input type = "submit" name = "submitpass" value = "Change">                          
        </form>
    </div>
</div> 
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                               
                                <div class="form-group">
                                    <label class="form-label">Birthday</label>
                                    <input type="text" class="form-control" value="May 3, 1995">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="custom-select">
                                        <option>India</option>
                                        <option selected>Canada</option>
                                        <option>UK</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Contacts</h6>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="+0 (123) 456 7891">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" value>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-social-links">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" value="https://twitter.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" value="https://www.facebook.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Google+</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" value="https://www.instagram.com/user">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-connections">
                            <div class="card-body">
                                <button type="button" class="btn btn-twitter">Connect to
                                    <strong>Twitter</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <h5 class="mb-2">
                                    <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i
                                            class="ion ion-md-close"></i> Remove</a>
                                    <i class="ion ion-logo-google text-google"></i>
                                    You are connected to Google:
                                </h5>
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-facebook">Connect to
                                    <strong>Facebook</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-instagram">Connect to
                                    <strong>Instagram</strong></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-notifications">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Activity</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone comments on my article</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone answers on my forum
                                            thread</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone follows me</span>
                                    </label>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Application</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">News and announcements</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly product updates</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly blog digest</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div><hr>


        <!-- Footer Starts from Here -->
        
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"></script>


<script>
    function promptUpload(){
        let confirmUpload = confirm("You are going to upload a new profile picture : ");
        if(confirmUpload){
            window.location.href = "http://localhost/php_e-commerce/upload.php";
        }
    }
</script>

<script>
function checkPasswordMatch() {
    let newPassword = document.getElementById("newPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let message = document.getElementById("message");

    if (newPassword === confirmPassword && newPassword !== "") {
        message.style.color = "green";
        message.innerHTML = "✅ Passwords match!";
        return true;
    } else {
        message.style.color = "red";
        message.innerHTML = "❌ Passwords do not match!";
        return false;
    }
}

function validatePassword(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
    return regex.test(password);
}

function validateForm() {
    if (!checkPasswordMatch()) {
        alert("Passwords do not match!");
        return false;
    }
    let password = document.getElementById("newPassword").value;
    if (!validatePassword(password)) {
        alert("Password must contain at least one uppercase, one lowercase, one number, one special character and be minimum 6 characters long.");
        return false;
    }
    return true;
}
</script>

<footer>
    <?php include 'includes/footer.php'; ?> 
</footer> 

</body>
</html>
    