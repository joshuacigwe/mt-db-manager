<?php
$subdirectory = $_SERVER["DOCUMENT_ROOT"].'/mt-db-manager/';
$filename = $subdirectory . 'db_login.php';

$content = '<?php' . "\n";
$content .= '// Database Login Credentials' . "\n";
$content .= '$username="";' . "\n";
$content .= '$password="";' . "\n";
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
window.location.replace("/mt-db-manager/login");
</script>