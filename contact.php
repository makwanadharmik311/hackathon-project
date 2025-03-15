<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tribal Art </title>
    <link rel="stylesheet" href="/assets/css/contact.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
</head>

<body>
    <div class="top-header">
        <p id="welcome-text">Welcome to our Website!</p>
        <div class="language-switch">
            <label for="language">🌐</label>
            <select id="language">
                <option value="en">English</option>
                <option value="gu">ગુજરાતી</option>
            </select>
        </div>
    </div>

    <?php
        include('includes/header.php');
    ?>

    <section class="contact">
        <div class="content">
         <h2>CONTACT US</h2>
         <p> Thank you for visiting Tribal Art, your destination for Masterpiece Art products.We value your feedback and are here to assist you with any inquiries you may have. Please feel free to reach out to us using any of the following methods:</p>
        </div>
        <div class="container"> 
         <div class="contactinfo">
            <div class="box">
                <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="text">
                    <h3>Address</h3>
                    <p>Tribal Art ,<br>CE Government Polytechnic,<br>Ahmedabad, Gujarat,<br> 380051</p>
                </div>
            </div>
            <div class="box">
                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                <div class="text">
                    <h3>Phone</h3>
                    <p>123-456-7890</p>
                </div>
            </div>
            <div class="box">
                <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="text">
                    <h3>Email</h3>
                    <p>For general inquiries: info@tribalart.com,<br>For customer support: support@tribalart.com</p>
                </div>
            </div>
         </div>
         <div class="contactform">
            <form>
                <h2>SEND MESSAGE</h2>
               
                <div class="inputBox">
                    <span>Full Name</span>
                    <input type="text" name="" required="required">         
                              
                </div>
                <div class="inputBox">  
                    <span>Email</span>                 
                    <input type="text" name="" required="required">
                    
                </div>
                <div class="inputBox">
                    <span>Type Your Message...</span>    
                   <textarea required="required"></textarea> 
                                 
                </div>
                <div class="inputBox">
                    <input type="submit" name="" value="SEND">
                </div>
                 
                
            </form>
         </div>
         </div>
    </div>
</section>
<footer class="section-p1">
        

    <div class="sec">
        <div class="col">
   
            <div class="follow">
                <h4>Follow us</h4>
                <div class="ficon">
                   <a href="www.facebook.com"> <i class="fab fa-facebook"></i></a>
                   <a href="www.instagram.com"><i class="fab fa-instagram"></i></a>
                   <a href="www.twitter.com"><i class="fab fa-twitter"></i></a>
                   <a href="www.youtube.com"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
                </div>
                
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms and Condition</a>
            <a href="#">Contact Us</a>          
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Account</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track my Order</a>
            <a href="#">Help</a>
        </div>

        
    </div>
    <div class="copyright">
        <p>&copy; 2025 Tribal Art. All rights reserved.</p>
        </div>
   
</footer>
</body>
</html>


    