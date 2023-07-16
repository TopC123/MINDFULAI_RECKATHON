<!DOCTYPE html>
<html>
<head>
  <title>FreeLancer.com</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body>
    
    <div id="loading-container">
    <video id="loading-video" autoplay loop muted>
      <source src="/Animation/loading.mp4" type="video/mp4">
    </video>
    <div class="loading-text">Loading...</div>
    
  </div>
  
 

  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form action="#">
        <h1>Create Account</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f facebook"></i></a>
          <a href="#" class="social"><i class="fab fa-google-plus-g google"></i></a>
          <a href="#" class="social"><i class="fab fa-linkedin-in linkedin"></i></a>

        </div>
        <span>or use your email for registration</span>
        <input type="text" placeholder="Name" required/>
        <input type="email" placeholder="Email" required />
        <input type="password" placeholder="Password" required />
        <button>Sign Up</button>
      </form>
    </div>
    
    
    <div class="form-container sign-in-container">
      <form action="login.php" method="POST">
        <h1>Sign in</h1>
        <div class="social-container">
          <a href="#" class="social"><i class="fab fa-facebook-f facebook"></i></a>
          <a href="#" class="social"><i class="fab fa-google-plus-g google"></i></a>
          <a href="#" class="social"><i class="fab fa-linkedin-in linkedin"></i></a>
        </div>
        <span>or use your account</span>
        <input type="email" id="email-input" name ="email-input"  placeholder="Email" required/>
        <input type="password" id="password-input" name ="password-input" placeholder="Password" required/>
        <a href="#">Forgot your password?</a>
        <button type="submit" id="sign-in">Sign In</button>
      </form>
    </div>
    
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        
        
        <div class="overlay-panel overlay-right">
          <h1>Hello, Friend!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <script>
   window.addEventListener('beforeunload', function() {
      
      document.getElementById('loading-container').style.display = 'block';
    });

    window.addEventListener('load', function() {
     
      document.getElementById('loading-container').style.display = 'none';
    });
</script>

<script src="script.js"></script>
</body>
</html>
