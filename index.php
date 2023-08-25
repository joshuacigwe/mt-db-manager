<?php
$page_title="Tables";
$page_head="tables";

include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/header.php');

$databaseHandler = new DatabaseHandler($conn);
$tables = $databaseHandler->listTables($username);
?>

<section class="mt-wizard-section">
    <div class="container">
        
        <div class="mt-wizard-main">
            <div class="mt-wizard-main-inner">
                
                <div class="mt-wiz-heading">
                    <div class="mt-wiz-heading-txt"><?php echo $page_title;?> in <span class="mt-migo"><?php echo $username;?></span> Database</div>
                </div>
            
                <?php
                if (!empty($tables)) {
                    echo "<ul class='mt-dbt-ul'>";
                    foreach ($tables as $table) {
                ?>
                         <li class="mt-dbt-li">
                             <div class="mt-dbt-li-inner">
                                 <a href="/mt-db-manager/manage-table/?dbt=<?php echo $table;?>" class="mt-dbtable-link"><?php echo $table;?></a>
                                 
                                 <div class="mt-dbt-action">
                                     <a href="/mt-db-manager/insert-data/?dbt=<?php echo $table;?>" class="mt-dbt-a-btn mt-dbt-add" title="Insert Data">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                     </a>
                                     <a href="/mt-db-manager/add-column/?dbt=<?php echo $table;?>" class="mt-dbt-a-btn mt-dbt-insert" title="Add Columns">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                                     </a>
                                     <a href="javascript:void(0)" onclick="delData(this)" data-src="/mt-db-manager/delete-table/?dbt=<?php echo $table;?>" class="mt-dbt-a-btn mt-dbt-del" title="Delete Table">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                     </a>
                                 </div>
                             </div>
                         </li>
                <?php
                    }
                    echo "</ul>";
                } else {
                    echo "No tables found in the database '$databaseName'.";
                }
            
                $databaseHandler->closeConnection();
                ?>
                
            </div>
        </div>
        
    </div>
</section>
    
<?php include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/footer.php');?>