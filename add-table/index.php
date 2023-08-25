<?php
$page_title="Add Table";
$page_head="add-table";

include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/header.php');

$response = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $databaseHandler = new DatabaseHandler($conn);

        $tableName = strtolower(str_replace(' ', '_', $_POST['table_name']));
        $columns = $_POST['columns'];
        $databaseHandler->createTableFromForm($tableName, $columns);

    $databaseHandler->closeConnection();
    
    $response = "<div class='response-data'>Executed Successfully</div>";
?>
<script>
window.location.replace("/mt-db-manager");
</script>
<?php
}
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
                                    <a class="mt-brmb-link black-text active-2" href="javascript:void(0)">
                                        <span><?php echo $page_title;?></span>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                	
                    <h2 class="mt-wizard-heading-txt"><?php echo $page_title;?></h2>
                    
                </div>

                <div class="mt-database-tool">
                    <div class="mt-database-tool-inner">
                        
                        <?php echo $response;?>
                        
                        <form method="post" action="" class="add-table-form" autocomplete="off">
                                
                            <div class="form-group">
                                <label for="table_name">Table Name:</label><br>
                                <input type="text" id="table_name" name="table_name" placeholder="customer_cart" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="generated_datatype">Table Columns (Comma-separated):</label><br>
                                <div class="position-relative">
                                   <textarea id="generated_datatype" name="columns" rows="5" oninput="autoExpand(this)" class="form-control textarea" aria-label="With textarea" placeholder="id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), email VARCHAR(255), longtext ..."></textarea>
                                </div>
                            </div>
                            
                            <div id="generateRows" class="auto-rows-group" style="display: none;">
                                <div class="form-group">
                                  <label for="data_type">Data Type</label>
                                  <select name="data_type" id="data_type" class="form-control">
                                    <option value="INT AUTO_INCREMENT PRIMARY KEY">INT AUTO_INCREMENT</option>
                                    <option value="VARCHAR(255)">VARCHAR(255)</option>
                                    <option value="LONGTEXT">LONGTEXT</option>
                                    <option value="TINYINT">TINYINT</option>
                                    <option value="SMALLINT">SMALLINT</option>
                                    <option value="MEDIUMINT">MEDIUMINT</option>
                                    <option value="INT">INT</option>
                                    <option value="BIGINT">BIGINT</option>
                                    <option value="FLOAT">FLOAT</option>
                                    <option value="DOUBLE">DOUBLE</option>
                                    <option value="DECIMAL">DECIMAL</option>
                                    <option value="DATE">DATE</option>
                                    <option value="TIME">TIME</option>
                                    <option value="DATETIME">DATETIME</option>
                                    <option value="TIMESTAMP">TIMESTAMP</option>
                                    <option value="YEAR">YEAR</option>
                                    <option value="CHAR">CHAR</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="BLOB">BLOB</option>
                                    <option value="ENUM">ENUM</option>
                                    <option value="SET">SET</option>
                                  </select>
                                </div>
                            
                                <div class="form-group">
                                  <label for="column_name" class="col-form-label">Name</label>
                                  <div class="position-relative">
                                      <input type="text" name="column_name" id="column_name" placeholder="Row Name" class="form-control">
                                      <button type="button" id="insertDatatypeBtn" onclick="insertDataType()" class="mt-push-btn">Push Row</button>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="mt-goright">
                                <a href="javascript:void(0)" id="generateRowBtn" class="mt-wd-txt-btn" onclick="generateRows()">Generate Rows</a>
                            </div>
                                
                            <div id="mt-wzd-btn" class="form-group form-submit">
                                <input type="submit" value="Create Table" onclick='validateForm("add-table-form", ["column_name"])' class="form-btn">
                            </div>
                            
                            <div id="error-message" style="color: red;"></div>
                            
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</section>
    
<?php include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/footer.php');?>