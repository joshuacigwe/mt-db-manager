<?php
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/config.php');
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/class/mt-db-manager.php');

$databaseHandler = new DatabaseHandler($conn);

$tableName = $_GET["dbt"];

$result = $databaseHandler->deleteTable($tableName);

if ($result) {
    echo "Table deleted successfully!";
}

$databaseHandler->closeConnection();
?>
<script>
window.location.replace("/mt-db-manager");
</script>