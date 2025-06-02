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

  .register-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 800px;
    margin: 2rem auto;
  }

  .register-card .card-body {
    padding: 3rem;
  }

  .register-title {
    font-weight: 900;
    font-size: 2.5rem;
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 2px;
    margin-bottom: 2rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    margin-bottom: 1.5rem;
    text-align: left;
  }

  .form-label {
    display: block;
    color: #2c3e50;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .form-control-user {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    color: #2c3e50 !important;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }

  .form-control-user:focus {
    box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.2);
    border-color: #6a11cb;
    background: white;
    outline: none;
  }

  .btn-register {
    background: linear-gradient(145deg, #7928ca, #ff0080);
    border: none;
    font-weight: 700;
    padding: 12px 36px;
    box-shadow: 0 8px 15px rgba(255, 0, 128, 0.3);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 60px;
    color: white;
    letter-spacing: 1.3px;
    margin-top: 1.5rem;
    font-size: 1.1rem;
    width: 200px;
  }

  .btn-register:hover {
    background: linear-gradient(145deg, #ff0080, #7928ca);
    box-shadow: 0 12px 25px rgba(255, 0, 128, 0.4);
    transform: translateY(-3px);
    color: white;
  }

  .text-danger {
    color: #e74c3c !important;
    font-size: 0.9rem;
    margin-top: 0.25rem;
    font-weight: 500;
  }

  .error-container {
    background: rgba(231, 76, 60, 0.1);
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    border-left: 4px solid #e74c3c;
  }

  .error-container ul {
    margin: 0;
    padding-left: 1.2rem;
  }

  @media (max-width: 768px) {
    .register-card {
      margin: 1rem;
    }
    .register-card .card-body {
      padding: 2rem;
    }
  }
</style>

<div class="gradient-custom d-flex align-items-center">
  <div class="container py-5">
    <div class="register-card">
      <div class="card-body p-5 text-center">
        <h2 class="register-title mb-4">REGISTER</h2>
        
        <?php if (isset($errors)): ?>
        <div class="error-container text-left mb-4">
          <ul>
            <?php foreach ($errors as $err): ?>
              <li class="text-danger"><?php echo $err; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <form class="user" action="/webbanhang/account/save" method="post">
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label class="form-label" for="username">Username</label>
              <input type="text" class="form-control form-control-user"
                     id="username" name="username">
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="fullname">Full Name</label>
              <input type="text" class="form-control form-control-user"
                     id="fullname" name="fullname">
            </div>
          </div>
          
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label class="form-label" for="password">Password</label>
              <input type="password" class="form-control form-control-user"
                     id="password" name="password">
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="confirmpassword">Confirm Password</label>
              <input type="password" class="form-control form-control-user"
                     id="confirmpassword" name="confirmpassword">
            </div>
          </div>
          
          <div class="form-group text-center">
            <button class="btn btn-register" type="submit">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>