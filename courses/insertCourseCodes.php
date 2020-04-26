<?php
  require_once("page.inc.php");
require_once('mysql.inc.php');
require_once('auth.inc.php');

  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
    echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }

  function addProducts($db) {
    //check for no or incorrect input
    if(!isset($_POST['addProduct1']))
      return false;

    //dynamic query
    $name =  htmlspecialchars($_POST['addProduct1']);
    $price =  htmlspecialchars($_POST['addProduct2']);
    $stock =  htmlspecialchars($_POST['addProduct3']);
    $SKU =  htmlspecialchars($_POST['addProduct4']);

    $query = "INSERT INTO PRODUCT (Name, Price, Stock, SKU)
                VALUES (?, ?, ?, ?);";

    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('sdis', $name, $price, $stock, $SKU);

    $success = $stmt->execute();
    if (!$success || $db->affected_rows == 0) {
      echo "<h5>ERROR: " . $db->error . " for query *$query*</h5><hr>";
      return false;
    }

    $stmt->close();

    return true;
  }

  $page = new Page("Lab06");
  $page->content .= '
  <div class="cover-container">
    <div class="inner cover">
      <div class="row">
      </div>';

  //display form when no or incorrect input received
  if(!addProducts($db)) {
    $page->content .= '
      <h1 class="header"><br>Add Products<br><br></h1>
      <div class="row">
        <form class="form-horizontal" method="POST" action="add_products.php">
          <label>Enter Product Information</label>
          <div class="form-group form-group-lg">
            <label for="addProduct1" class="col-sm-1 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="addProduct1" name="addProduct1" placeholder="Name" required>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label for="addProduct2" class="col-sm-1 control-label">Price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="addProduct2" name="addProduct2" placeholder="Price" required>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label for="addProduct3" class="col-sm-1 control-label">Stock</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="addProduct3" name="addProduct3" placeholder="Stock" required>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <label for="addProduct4" class="col-sm-1 control-label">SKU</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="addProduct4" name="addProduct4" placeholder="SKU #" required>
            </div>
          </div>
          <div class="form-group form-group-lg">
            <button type="submit" class="btn btn-primary">Add Product</button>
          </div>
        </form>
      </div>';
  }

  else {
    $page->content .= '<div class="row">
                        <p><h1>Product added!</p><br>
                        <p><a href="add_products.php" class="btn btn-lg btn-default">Insert Another Product</a></p>
                      </div>';
  }

  $page->content .= '
    <div class="row">
    </div>

    <div class="row">
    </div>

    <div class="row">
    </div>

    <br><br><br>
    <div class="row">
      <p class="lead">
        <a href="#" class="btn btn-lg btn-default">Learn more</a>
      </p>
      </div>
    </div>
</div>';
  $page->display();
?>
