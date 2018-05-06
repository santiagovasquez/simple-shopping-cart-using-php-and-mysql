<?php
error_reporting(0);
//Setting session start
session_start();

$total=0;

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=snippetdeveloper.com;dbname=demo_carrito_php", 'santiago0', 'Thiago0666!');   
//$conn = new PDO("mysql:host=snippetdeveloper.com;dbname=demo_carrito_php", 'santiago0', 'Thiago0666!'); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

//Add to cart
if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {
	
	//Finding the product by code
	$query = "SELECT * FROM products WHERE sku=:sku";
	$stmt = $conn->prepare($query);
	$stmt->bindParam('sku', $_POST['sku']);
	$stmt->execute();
	$product = $stmt->fetch();
	
	$currentQty = $_SESSION['products'][$_POST['sku']]['qty']+1; //Incrementing the product qty in cart
	$_SESSION['products'][$_POST['sku']] =array('qty'=>$currentQty,'name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price']);
	$product='';
	header("Location:shopping-cart.php");
}

//Empty All
if($action=='emptyall') {
	$_SESSION['products'] =array();
	header("Location:shopping-cart.php");	
}

//Empty one by one
if($action=='empty') {
	$sku = $_GET['sku'];
	$products = $_SESSION['products'];
	unset($products[$sku]);
	$_SESSION['products']= $products;
	header("Location:shopping-cart.php");	
}


 
 
 //Get all Products
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KXLHW86');</script>
    <!-- End Google Tag Manager -->    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In this tutorial, I am demonstrating how to do step by step, a simple tutorial of a shopping cart with PHP 5.6 and MYSQL. This shopping cart application was developed very simple and simple for the learning purpose of all of us who like this language that has saved our lives at any time. One can take this as an easy shopping cart for any website, but this is purely an idea to create a shopping cart website.">
    <meta name="author" content="Santiago Vasquez Olarte">
    <meta name="keywords" content="HTML, CSS, JS, javascript, bootstrap 3,bootstrap, front-end, social network sites development and design foundations with html5, web design software, frontend and backend
    ,bootstrap code,mysql,bootstrap examples, CSS 3,php 5.6,login">    
    <link rel="icon" type="image/x-icon" href="assets/img/icon.png">

    <title>Elegant and Simple Shopping cart with PHP 5.6 and MYSQL</title>


    <script src="assets/js/jquery.1.11.2.min.js"></script>    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link href="bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/login_register.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <!-- styles  -->
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>

  <body class="bg_image">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
              <a href="cart.php"> Cart <i class="fa fa-2x fa-cart-plus" style="margin-top: 10px;"></i></a>
              <lavel id="cart-badge" class="badge badge-warning"><?php echo count($_SESSION['products']) ?></lavel>  
          </a>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><img width="153" src="https://snippetdeveloper.com/img/logos/logoBlack.png">   </a></li>
          </ul>
        </div>
      </div><!--/.container-fluid -->
    </nav>

  
    <div class="row">
      <div class="container bootstrap snippet"><br>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                  <strong class=""><i class="fa fa-mouse-pointer"></i> Choose your products to buy</strong>
                </div>
                <div class="panel-body">
                    <?php if(!empty($_SESSION['products'])):?>
                      <div class="alert alert-success" role="alert"><i class="fa fa-cart-plus"></i> Product added correctly <a href="cart.php">Go to shopping cart</a></div>
                    <?php endif;?> 

                    <?php foreach($products as $product):?>
                      <div class="product-content">
                        <div class="col-md-12 panelTop">  
                          <div class="col-md-4">  
                            <img class="img-responsive product-img" src="<?php print $product['image']?>" alt=""/>
                          </div>
                          <div class="col-md-8">  
                            <h2><?php print $product['name']?></h2>
                            <p><?php print utf8_decode($product['description']) ?></p>
                          </div>

                          <div class="col-md-12"><br>
                            <form method="post" action="shopping-cart.php?action=addcart">
                              <div class="col-md-4 text-center">
                                <button class="btn btn-lg btn-add-to-cart add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span>   Add to Cart</button>     
                                <input type="hidden" name="sku" value="<?php print $product['sku']?>">      
                              </div>
                            </form>
                            <div class="col-md-4 text-left">
                              <h5>Price <span class="itemPrice">$<?php print number_format($product['price']) ?></span></h5>
                            </div>
                            <div class="col-md-4">
                              <div class="stars">
                               <div id="stars" class="starrr"></div>
                              </div>
                            </div>                                  
                          </div>                                  
                        </div>
                      </div>
                      <hr>
                    <?php endforeach;?>      
                </div>
                <div class="panel-footer">Have an account? <a href="javascript:void(0)" class="">Enter here</a>
                </div>
            </div>
        </div>
      </div>      
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">&copy; 2018 by Santiago Vasquez O.</p>
      </div>
    </footer>
  </body>
</html>

<script type="text/javascript" src="assets/js/app.js"></script>