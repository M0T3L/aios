<!DOCTYPE html>
<?php include("functions/_check.php");?>
<html data-bs-theme="dark">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<?php include("partials/_navbar.php");?>
    <div class="container">
    <hr style="border-top:1px dotted #ccc;"/>
        <div class="row">
            <div class="col-md-6">
                <?php
                require_once 'query/_conn.php';
                $user_id = $_SESSION['user_id'];
                if (!isset($conn) || !($conn instanceof PDO)) {
                    echo "Error: Database connection not established.";
                    exit();
                }
                $stmt = $conn->prepare("SELECT pp1, pp2, pp3 FROM member WHERE user_id = ?");
                $stmt->execute([$user_id]);
                $paths = $stmt->fetch(PDO::FETCH_ASSOC);
                foreach ($paths as $path) {
                    if (!empty($path)) {
                        $relativePath = 'uploads/'.$path;
                        echo '<div class="mb-3">';
                        echo '<img src="' . $relativePath . '" class="img-thumbnail" alt="Image">';
                        echo '<form action="query/_deletequery.php" method="POST">';
                        echo '<input type="hidden" name="image_path" value="' . $path . '">';
                        echo '<button type="submit" class="btn btn-danger mt-2" name="delete">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                    }                    
                }
                ?>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($_SESSION['messageU']));?>
                            <div class="alert alert-<?php echo $_SESSION['messageU']['alert'] ?> msg"><?php echo $_SESSION['messageU']['text'] ?></div>
                            <script>
                                (function() {
                                    setTimeout(function(){
                                        document.querySelector('.msg').remove();
                                    },3000)
                                })();
                            </script>
                            <h4 class="text-success">Update Profile</h4>
                            <form action="query/_uploadquery.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" class="form-control" name="fileToUpload[]" id="fileToUpload" accept="image/*" multiple>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary form-control" name="submit">Upload</button>
                                </div>
                            </form>
                            <form action="query/_profilequery.php" method="POST">   
                                <hr style="border-top:1px groovy #000;">
                                <?php $username = $_SESSION['username'];$firstname = $_SESSION['firstname'];$lastname = $_SESSION['lastname'];echo '
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="'.$username.'" disabled/>
                                </div>
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="'.$firstname.'" required/>
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="'.$lastname.'" required/>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required/>
                                </div>
                                <br />
                                <div class="form-group">
                                    <button class="btn btn-primary form-control" name="profile">Update</button>
                                </div>
                                ';?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
