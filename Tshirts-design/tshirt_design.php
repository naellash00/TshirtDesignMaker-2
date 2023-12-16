<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>T-shirt Design Maker</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <style>
   
    .row {
      display: flex;
      justify-content: center;
    }

    .column {
      margin: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .dropdown-container,
    .input-group,
    #logo-input,
    #logo-size-input {
      margin-bottom: 10px;
      width: 200px;

    }


    label {
      margin-bottom: 4%;
    }

    input,
    select {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
      margin-left: 8px;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    #logo-size-input {
      display: flex;
      align-items: center;
    }

    #logo-size-input label {
      margin-right: 8px;
    }

    #logo-size {
      width: 81px;

    }

    .form-control {
      display: block;
      width: 100%;
      height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #e9ecef;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 26.25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    #buttons-container {
      display: flex;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 0;
    }

    .button-design {
      width: 177px;
      margin: 10px 3px;
      background-color: #bd2130;
      border: none;
      padding: 11px 34px;
      font-size: 12px;
      font-weight: bold;
      color: white;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }


    #text-overlay {
      position: absolute;
      top: 48%;
      font-size: 17px;
      font-weight: bold;
      left: 50%;
      transform: translateX(-50%);
      max-width: 121px;

      text-align: center;

    }

    #logo-overlay {
      position: absolute;
      top: 35%;
      left: 50%;
      transform: translateX(-50%);
      max-width: 80px;
      width: 100%;
      height: auto;
      text-align: center;
      background-size: contain;
      background-repeat: no-repeat;
    }
  </style>

</head>

<body>
  <!-- Navbar start -->
  <!-- first tag to Navbar -->
  <!--navbar-expand makes you responsive -->
  <nav class="navbar navbar-expand-md navbar-light" style="background-color: #fde3e9;">
    <!-- Brand -->
    <a class="navbar-brand" href="../payment-code/index.php"><i class=""></i>&nbsp;&nbsp; T-shirt Design Maker </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../shippmentTrack/index.php"><i class="bi bi-truck"></i> Tracking</a><!-- for track page -->
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../signup_and_login/index.php"><i class="bi bi-person-fill"></i> Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../payment-code/cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a><!-- for cart page -->
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <div class="container">

    <div class="row">

      <!-- Fixed bottom navigation bar -->
      <div class="row mt-3">
        <div class="column">
          <div id="app" class="text-center">
            <div id="tshirt-container" class="position-relative">
              <div id="text-overlay" class="overlay"></div>
              <div id="logo-overlay" class="overlay"></div>
              <img id="tshirt-img" src="Tshirts-images\WhiteT-shirt1.png" alt="T-shirt" class="img-fluid rounded">
            </div>
          </div>
          <!--price-display -->
          <div id="price-display">
            <p class="text-left fs-5">$20.00</p>
          </div>

          <!-- Quantity Input -->
          <div class="input-group">
            <label for="quantity">Quantity: </label>
            <input type="number" id="quantity" class="form-control" min="1" value="1" onchange="calculatePrice()">
          </div>

          <!-- Color Selection Dropdown -->
          <div class="dropdown-container">
            <label for="color">T-shirt Color:</label>
            <select id="color" class="form-control" onchange="changeTshirtColor()">
              <option value="white">White</option>
              <option value="yellow">Yellow</option>
              <option value="pink">Magenta</option>
              <option value="blue">Blue</option>
              <option value="baby-pink">Baby Pink</option>
            </select>
          </div>

          <!-- Size Selection Dropdown -->
          <div class="dropdown-container">
            <label for="tshirt-size">T-shirt Size:</label>
            <select id="tshirt-size" class="form-control">
              <option value="s">S</option>
              <option value="m">M</option>
              <option value="l">L</option>
              <option value="xl">XL</option>
            </select>
          </div>

          <!-- Text Controls -->
          <div id="text-controls">
            <div id="text-input" class="input-group">
              <label for="text">Add Text (15 letter only):</label>
              <input type="text" id="text" class="form-control" placeholder="Enter text" maxlength="15">
            </div>
          </div>
          <div id="text-color-input" class="input-group">
            <label for="text-color">Text Color:</label>
            <input type="color" id="text-color" class="form-control" value="#ffffff">
          </div>

          <!-- Logo Input, Logo Size Input -->
          <div class="column">
            <div id="logo-input">
              <label for="logo">Logo:</label>
              <input type="file" id="logo" accept="image/*" onchange="loadLogo()">
            </div>
            <div id="logo-size-input">
              <label for="logo-size">Logo Size:</label>
              <input type="number" id="logo-size" class="form-control" value="90" min="85" max="95" step="1" onchange="resizeLogo()">

            </div>
            <div>
              <button type="button" class="btn btn-outline-danger mt-3 mb-3" onclick="previousDesign()">Previous Designs</button>
              <button type="button" class="btn btn-outline-danger mt-3 mb-3" onclick="saveDesign()">Save Design</button>
              <button type="button" class="btn btn-outline-danger mt-3 mb-3" onclick="customizeTshirt()">Create design</button>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>


  <script src="../Tshirts-design/js/main.js"></script>
</body>

</html>