<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Responsive Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav-style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">ÈPICER</label>
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="recepten.php">Recepten</a></li>
        <li><a href="ingredienten.php">Ingredienten</a></li>
        <li><a href="specials.php">Specials</a></li>

        <?php if(isset($_SESSION["gebruikerData"]["rol"])){ ?>

          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        <?php }else{ ?>
            
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>

        <?php } ?>
      </ul>
    </nav>
    
  </body>
</html>
