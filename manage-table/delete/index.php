<?php
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/config.php');
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/class/mt-db-manager.php');

$databaseHandler = new DatabaseHandler($conn);

$tableName = $_GET["dbt"];
$dataId = $_GET['id'];

$result = $databaseHandler->deleteData($tableName, $dataId);

if ($result) {
    echo "Data deleted successfully!";
} else {
    echo "Error deleting data.";
}

$databaseHandler->closeConnection();
?>
<script>
window.location.replace("/mt-db-manager/manage-table/?dbt=<?php echo $tableName;?>");
</script>