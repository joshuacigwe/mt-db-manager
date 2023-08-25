<?php
if(isset($_POST["login_database"])) {
$subdirectory = $_SERVER["DOCUMENT_ROOT"].'/mt-db-manager/';
$filename = $subdirectory . 'db_login.php';

$database_username=$_POST["database_username"];
$database_password=$_POST["database_password"];

$content = '<?php' . "\n";
$content .= '// Database Login Credentials' . "\n";
$content .= '$username="'.$database_username.'";' . "\n";
$content .= '$password="'.$database_password.'";' . "\n";
$content .= '?>';

// Check if the file exists
if (!file_exists($filename)) {
    // Create and write content to the file
    if (file_put_contents($filename, $content) !== false) {
        //echo "File '$filename' created successfully.";
    } else {
        //echo "Error creating '$filename'.";
    }
} else {
    // Update the content of the file
    if (file_put_contents($filename, $content) !== false) {
        //echo "File '$filename' updated successfully.";
    } else {
        //echo "Error updating '$filename'.";
    }
}

?>
<script>
window.location.replace("/mt-db-manager");
</script>
<?php
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to Mastertools Wizard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/mt-db-manager/assets/css/bootstrap.min.css" rel="stylesheet">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>-->
<link rel="shortcut icon" type="image/x-icon" href="/mt-db-manager/assets/img/mastertools-logo.png">

<style>
.error {
    border: 1px solid red;
}

.mt-activate-form {
    display: flex;
    justify-content: center;
    margin: 45px 0 55px;
}

.mt-activate-form-inner {
    width: 100%;
    max-width: 390px;
}

.mt-db-frm-header {
    background: #133a69;
    color: #fff;
    border-radius: 15px 15px 0 0;
}

.mt-db-frm-header-inner {
    display: flex;
    align-items: center;
    padding: 6px 20px 4px;
    height: 80px;
}

.mt-db-fhd-logo {
    color: #fff;
    font-family: sans-serif;
    display: flex;
    align-items: center;
}

.mt-dash-logo {
    width: 60px;
    height: 60px;
    border-radius: 90px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 60px 60px;
    margin-right: 8px;
    border: 1px solid #ffffff;
}

.mt-fhd-dec-txt {
    font-size: 24px;
    margin-left: 4px;
    font-style: italic;
    font-weight: 500;
}

.mt-db-frm-body {
    border: 1px solid #ddd;
    border-radius: 0 0 3px 3px;
}

.mt-db-frm-body-inner {
    padding: 20px 30px 30px;
}

.form-group.mt-db-submit {
    margin-top: 30px;
}

.mt-db-submit input.btn.btn-primary {
    background-color: #133a69;
    border-color: #133a69;
    min-width: 115px;
}

.mt-db-frm-body label {
    margin: 0;
}

.mt-db-frm-body .form-control {
    background-color: #e2e6eb;
}
</style>
</head>
<body>

<section class="mt-wizard-section">
    <div class="container">
        
        <div class="mt-activate-form">
            <div class="mt-activate-form-inner">
                
<?php
if($_GET["s"]=="0") {
?>
<div class="alert alert-danger conn-status" role="alert">(<?php echo $_GET["db"];?>) db login is invalid!</div>
<?php } ?>
                
                <div class="mt-db-frm-header">
                    <div class="mt-db-frm-header-inner">
                        
                        <div class="mt-db-fhd-logo">
                            <span style="background-image: url(/mt-db-manager/assets/img/mastertools-logo.png);" class="mt-dash-logo"></span>
                        </div>
                        
                        <div class="mt-db-fhd-desc">
                            <div class="mt-fhd-dec-txt">Database Login</div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="mt-db-frm-body">
                    <div class="mt-db-frm-body-inner">
                
                        <div id="error-message" style="color: red;"></div>
                        
                        <form action="" method="POST" class="loginForm" autocomplete="off">
                          <div class="form-group">
                            <label for="database_username">db Username</label>
                            <input type="text" id="database_username" name="database_username" class="form-control" placeholder="Database Username">
                          </div>
                          <div class="form-group">
                            <label for="database_password">db Password</label>
                            <input type="password" id="database_password" name="database_password" class="form-control" placeholder="Database Password">
                          </div>
                          
                          <div class="form-group mt-db-submit">
                            <input type="submit" name="login_database" value="Log In" onclick="validateForm('loginForm')" class="btn btn-primary">
                          </div>
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</section>

<script>
function validateForm(formClassName) {
    var form = document.querySelector("." + formClassName);
    var formFields = form.querySelectorAll("[name]");
    
    var errorMessage = "";

    formFields.forEach(function(field) {
        if (field.value === "") {
            var fieldName = field.getAttribute("name");
            errorMessage += fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + " is required.<br>";
            field.classList.add("error");
            
            setTimeout(function() {
            field.classList.remove("error");
            }, 2000);
            
        } else {
            field.classList.remove("error");
        }
    });

    if (errorMessage !== "") {
        event.preventDefault(); // Prevent form submission
            
            setTimeout(function() {
            
            }, 2000);
            
    } else {
        
    }
}
</script>
<script type="text/javascript" src="/mt-db-manager/assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="/mt-db-manager/assets/js/popper.min.js"></script>
<script type="text/javascript" src="/mt-db-manager/assets/js/bootstrap.min.js"></script>
</body>
</html>