<?php
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/db_login.php');

if (empty($username) || empty($password)) {
?>
<script>
window.location.replace("/mt-db-manager/login");
</script>
<?php
exit();
}

$host = "localhost";
$database = $username;
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    $connection_status = "failed";
?>
<script>
window.location.replace("/mt-db-manager/login/?db=<?php echo $username;?>&s=0");
</script>
<?php
die();
}
?>