<?php include 'app/views/shares/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #eef2f7 0%, #d1d9e6 100%);
    color: #2c3e50;
    margin: 0; padding: 0;
    min-height: 100vh;
  }

  .gradient-custom {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
  }

  .login-card {
    background: rgba(0, 0, 0, 0.7);
    border-radius: 20px;
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .login-card .card-body {
    padding: 3rem;
  }

  .login-title {
    font-weight: 900;
    font-size: 2.5rem;
    background: linear-gradient(90deg, #fff, #ccc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 2px;
    margin-bottom: 2rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .form-group {
    position: relative;
    margin-bottom: 2rem;
    text-align: left;
  }

  .form-label {
    display: block;
    color: white;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .form-control {
    background: transparent;
    border: none;
    border-bottom: 2px solid rgba(255, 255, 255, 0.4);
    border-radius: 0;
    color: white !important;
    padding: 0.5rem 0;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    width: 100%;
  }

  .form-control:focus {
    box-shadow: none;
    border-bottom-color: white;
    background: transparent;
    outline: none;
  }

  .btn-login {
    background: linear-gradient(145deg, #7928ca, #ff0080);
    border: none;
    font-weight: 700;
    padding: 12px 36px;
    box-shadow: 0 8px 15px rgba(255, 0, 128, 0.4);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 60px;
    color: white;
    letter-spacing: 1.3px;
    margin-top: 1rem;
  }

  .btn-login:hover {
    background: linear-gradient(145deg, #ff0080, #7928ca);
    box-shadow: 0 12px 30px rgba(255, 0, 128, 0.7);
    transform: translateY(-4px);
    color: white;
  }

  .social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    margin: 0 0.5rem;
    transition: all 0.3s ease;
  }

  .social-icon:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
  }

  .signup-link {
    color: rgba(255, 255, 255, 0.7);
    transition: all 0.3s ease;
  }

  .signup-link a {
    color: white;
    font-weight: 700;
    text-decoration: none;
    background: linear-gradient(90deg, #2575fc, #7928ca);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .signup-link a:hover {
    text-decoration: underline;
  }

  .forgot-password {
    color: rgba(255, 255, 255, 0.7);
    transition: all 0.3s ease;
  }

  .forgot-password:hover {
    color: white;
    text-decoration: none;
  }
</style>

<section class="gradient-custom d-flex align-items-center">
  <div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card login-card">
          <div class="card-body p-5 text-center">
            <form action="/webbanhang/account/checklogin" method="post">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="login-title mb-4">LOGIN</h2>
                <p class="text-white-50 mb-5">Please enter your login credentials</p>
                
                <div class="form-group">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" />
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" />
                </div>
                
                <p class="small mb-5 pb-lg-2">
                  <a class="forgot-password" href="#!">Forgot password?</a>
                </p>
                
                <button class="btn btn-login btn-lg px-5" type="submit">Login</button>
                
                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                  <a href="#!" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                  <a href="#!" class="social-icon"><i class="fab fa-twitter"></i></a>
                  <a href="#!" class="social-icon"><i class="fab fa-google"></i></a>
                </div>
              </div>
              
              <div>
                <p class="mb-0 signup-link">Don't have an account? 
                  <a href="/webbanhang/account/register">Sign Up</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>