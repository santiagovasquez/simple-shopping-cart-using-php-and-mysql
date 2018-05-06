<?php
  error_reporting(0);
  //Setting session start
  session_start();

  $total=0;
  $amount=0;
  //get action string
  $action = isset($_GET['action'])?$_GET['action']:"";

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
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
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
          <a class="navbar-brand col-md-offset-7 shopping-cart" href="shopping-cart.php" id="shopping-cart">
            <i class="fa fa-arrow-left"></i> Keep buying
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>    
              <img width="372" src="https://snippetdeveloper.com/img/logos/logoBlack.png">   
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>


    <div class="container" style="margin-top:40px;background: #fff;border-radius: 13px;">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-md-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">(<strong><?php echo count($_SESSION['products'] ) ?></strong>) items</span>
                            <h5>Products in your cart</h5>
                        </div>
                        
                        <?php foreach($_SESSION['products'] as $key=>$product):?>
                          <div class="ibox-content">
                              <div class="table-responsive">
                                  <table class="table shoping-cart-table">
                                      <tbody>
                                      <tr>
                                          <td width="90">
                                              <div class="cart-product-imitation">
                                                   <img src="<?php print $product['image']?>" class="img-responsive">
                                              </div>
                                          </td>
                                          <td class="desc">
                                              <h3>
                                                <a href="javascript:void(0)" class="text-navy">
                                                    <?php print $product['name']?>                                          </a>
                                              </h3>
                                              <div class="m-t-sm">
                                                  <a href="cart.php?action=empty&sku=<?php print $key?>" class="text-muted"><i class="fa fa-trash"></i> Delete</a>
                                              </div>
                                          </td>

                                          <td>
                                              $<?php print number_format($product['price']) ?>                                    </td>
                                          <td width="65">
                                              <input type="number" name="[Product][2]" class="form-control input-product-amount" placeholder="<?php print $product['qty']?>" value="<?php print $product['qty']?>" data-product-id="2" disabled="">
                                          </td>
                                          <td>
                                              <h4 class="total-product-2"><?php print number_format($product['price']*$product['qty']) ?> </h4>
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>  
                        <?php  $amount +=$product['price']*$product['qty']; ?>
                        <?php endforeach;?>                    
                                            <div class="ibox-content">
                            <a href="javascript:void(0)" class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> To buy</a>
                            <a href="shopping-cart.php" class="btn btn-white"><i class="fa fa-arrow-left"></i> Keep buying</a>
                            <a href="shopping-cart.php?action=emptyall" class="btn btn-danger"><i class="fa fa-remove"></i> Empty cart</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Summary</h5>
                        </div>
                        <div class="ibox-content">
                            <span>
                                Total
                            </span>
                            <h2 class="font-bold total-general"><?php print number_format($amount) ?></h2>
                            <hr>
                            <span class="text-muted small">
                                                    </span>
                            <div class="m-t-sm">
                                <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> To buy</a>
                                <a href="javascript:void(0)" class="btn btn-white btn-sm"> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Support</h5>
                        </div>
                        <div class="ibox-content text-center">
                            <h3><i class="fa fa-whatsapp"></i> 3145193454</h3>
                            <span class="small">
                                Contact us if you have a question. we're 24/7
                            </span>
                        </div>
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
