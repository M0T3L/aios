<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<?php include("partials/_navbar.php");?>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <hr style="border-top:1px dotted #ccc;"/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <?php if(isset($_SESSION['messageR']));?>
                        <div class="alert alert-<?php echo $_SESSION['messageR']['alert'] ?> msg"><?php echo $_SESSION['messageR']['text'] ?></div>
                        <script>
                            (function() {
                                setTimeout(function(){
                                    document.querySelector('.msg').remove();
                                },3000)
                            })();
                        </script>
                        <form action="query/_registerquery.php" method="POST">   
                            <h4 class="text-success">Register</h4>
                            <hr style="border-top:1px groovy #000;">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" class="form-control" name="firstname" required/>
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" class="form-control" name="lastname" required/>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off" required/>
                            </div>
                            <br />
                            <div class="form-group">
                                <button class="btn btn-primary form-control" name="register">Register</button>
                            </div>
                            <br>
                        </form>
                        <form action="login.php">
                                <input class="btn btn-secondary form-control" type="submit" value="Login"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>