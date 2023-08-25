<?php
$page_title="Resources";
$page_head="resources";

include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/header.php');

$database_table = $_GET["dbt"];

$databaseHandler = new DatabaseHandler($conn);

$columnInfo = $databaseHandler->tableColumns($database_table);
$databaseHandler->closeConnection();

$columnNames = $columnInfo['columnNames'];
$dataTypes = $columnInfo['dataTypes'];
//$tableData = $columnInfo['tableData'];
?>

<section class="mt-wizard-section">
    <div class="container">
        
        <div class="mt-wizard-main">
            <div class="mt-wizard-main-inner">
                
                <div class="mt-wizard-heading">
                    
                    <div class="mt-breadcrumb">
                        <nav aria-label="breadcrumb " class="second " >
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="black-text" href="/mt-db-manager">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="svg-angle"><path d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"/></svg>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mt-brmb-link black-text" href="/mt-db-manager/manage-table/?dbt=<?php echo $database_table;?>">
                                        <span class="mt-brmb-span"><?php echo $database_table;?></span>
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="svg-angle"><path d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"/></svg>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mt-brmb-link black-text active-2" href="javascript:void(0)">
                                        <span><?php echo $page_title;?></span>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                	
                	<h2 class="mt-wizard-heading-txt"><?php echo $page_title;?></h2>
                    
                </div>

<div class="code-container">
  <pre>
    <code class="html">
&lt;form method="POST" action=""&gt;

<?php
foreach ($columnNames as $field) {
$dataType = $dataTypes[$field]; // Get data type for the current field

if ($field == "id") {
} else {

if ($dataType == "longtext") {
?>
    &lt;div class="form-group"&gt;
        &lt;label for="<?php echo $field; ?>"&gt;<?php echo ucwords(str_replace('_', ' ', $field)); ?>&lt;/label&gt;&lt;br&gt;
        &lt;textarea id="<?php echo $field; ?>" name="<?php echo $field; ?>" rows="3" placeholder="Write here.." class="form-control textarea"&gt;&lt;/textarea&gt;
    &lt;/div&gt;
<?php
} else {
?>
    &lt;div class="form-group"&gt;
        &lt;label for="<?php echo $field; ?>"&gt;<?php echo ucwords(str_replace('_', ' ', $field)); ?>&lt;/label&gt;&lt;br&gt;
        &lt;input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" placeholder="<?php echo ucwords(str_replace('_', ' ', $field)); ?>" class="form-control"&gt;
    &lt;/div&gt;
<?php
}
}
}
?>
    &lt;div class="form-group form-submit"&gt;
        &lt;input type="submit" name="submit" value="Insert Now" class="btn btn-primary"&gt;
    &lt;/div&gt;

&lt;/form&gt;
      </code>
      <code class="php">

<?php
echo "if(isset(" . "$" . "_POST[" . '"' . "submit" . '"' . "])) { \n";

foreach ($columnNames as $field) {
        
        if ($field == "id") {
            continue; // Skip the "id" field
        } else {
            echo "$" . $field . " = $" . "_POST[" . '"' . $field . '"' . "]" . "; \n";
            //echo "\n";
        }
}

echo " \n";

echo "$" . "insertDate" . " = " . '"' . "INSERT INTO `" . $database_table . "`(";

$firstField = true; // Flag to track the first field

foreach ($columnNames as $field) {
        $dataType = $dataTypes[$field]; // Get data type for the current field
        
        if ($field == "id") {
            continue; // Skip the "id" field
        } else {
            if (!$firstField) {
                echo ", ";
            }
            echo "`" . $field . "`";
            $firstField = false;
        }
}

echo ")";
echo "\n";
echo "VALUES (";

$firstField = true; // Reset the flag for the values part

foreach ($columnNames as $field) {
        $dataType = $dataTypes[$field]; // Get data type for the current field
        
        if ($field == "id") {
            continue; // Skip the "id" field
        } else {
            if (!$firstField) {
                echo ", ";
            }
            echo "'$" . $field . "'";
            $firstField = false;
        }
}

echo ")";
echo '"';
echo ";";
echo "\n";
echo "$" . "conn->query(" . "$" . "insertDate);";
echo "\n";
echo "}";
?>

      </code>
    </pre>
</div>

            </div>
        </div>
        
    </div>
</section>
    
<?php include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/footer.php');?>