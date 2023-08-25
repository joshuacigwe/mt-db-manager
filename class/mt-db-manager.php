<?php
/**
 * Database and Table Manager.
 * PHP Version 1.
 *
 * @author    Joshua Igwe (original founder) <joshua@mastertoolsoft.com>
 * @copyright 2022 - 2023 Joshua Igwe
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */
 
class DatabaseHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createTableFromForm($tableName, $columns) {
        // Create the table using the submitted form data
        $sql = "CREATE TABLE IF NOT EXISTS $tableName ($columns)";
        $this->conn->query($sql);
    }

    public function addColumnsToTable($tableName, $columns) {
        $alterStatements = array();

        foreach ($columns as $columnName => $columnType) {
            $alterStatements[] = "ADD COLUMN $columnName $columnType";
        }

        $alterStatement = implode(', ', $alterStatements);

        $sql = "ALTER TABLE $tableName $alterStatement";

        return $this->conn->query($sql);
    }

    public function deleteTable($tableName) {
        $sql = "DROP TABLE $tableName";
        return $this->conn->query($sql);
    }

    public function insertDataToTable($tableName, $formData) {
        $columns = implode(', ', array_keys($formData));
        $placeholders = implode(', ', array_fill(0, count($formData), '?'));

        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
        
        $stmt = $this->conn->prepare($sql);

        $bindTypes = '';
        $bindValues = array();

        // Build bindTypes and bindValues arrays
        foreach ($formData as $key => $value) {
            $bindTypes .= 's'; // Assuming all values are strings
            $bindValues[] = &$formData[$key]; // Pass value by reference
        }
        
        // Add bindTypes as the first element in the bindValues array
        array_unshift($bindValues, $bindTypes);

        // Use call_user_func_array to bind the parameters dynamically
        call_user_func_array(array($stmt, 'bind_param'), $bindValues);
        
        return $stmt->execute();
    }

    public function updateColumn($tableName, $formData, $condition) {
        $sql = "UPDATE $tableName SET ";

        $updateStatements = array();
        foreach ($formData as $column => $value) {
            // Exclude specific fields, like the submit button, from being updated
            if ($column !== 'submit') {
                $updateStatements[] = "$column = '$value'";
            }
        }

        $sql .= implode(', ', $updateStatements) . " WHERE $condition";
        
        return $this->conn->query($sql);
    }

    public function deleteData($tableName, $dataId) {
        $sql = "DELETE FROM $tableName WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $dataId);
        return $stmt->execute();
    }
    
    public function tableColumns($tableName, $columnId = null) {
        $columnNames = array();
        $dataTypes = array(); // Added array for data types
    
        $sql = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $columnNames[] = $row['COLUMN_NAME'];
                $dataTypes[$row['COLUMN_NAME']] = $row['DATA_TYPE'];
            }
    
            // Fetch table data
            $tableData = array();
            $selectColumns = implode(', ', $columnNames);
            
            if ($columnId !== null) {
                $sqlSelectData = "SELECT $selectColumns FROM $tableName WHERE id='$columnId'";
            } else {
                $sqlSelectData = "SELECT $selectColumns FROM $tableName";
            }
            
            $resultSelectData = $this->conn->query($sqlSelectData);
    
            if ($resultSelectData->num_rows > 0) {
                while ($row = $resultSelectData->fetch_assoc()) {
                    $tableData[] = $row;
                }
            }
        }
    
        // Return column names, data types, and table data
        return array('columnNames' => $columnNames, 'dataTypes' => $dataTypes, 'tableData' => $tableData);
    }

    public function retrieveData($tableName) {
        $data = array();
        $sql = "SELECT * FROM $tableName";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function listDatabases() {
        $sql = "SHOW DATABASES";
        $result = $this->conn->query($sql);

        $databases = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_row()) {
                $databases[] = $row[0];
            }
        }

        return $databases;
    }

    public function listTables($databaseName) {
        $sql = "SHOW TABLES FROM $databaseName";
        $result = $this->conn->query($sql);

        $tables = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_row()) {
                $tables[] = $row[0];
            }
        }

        return $tables;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>