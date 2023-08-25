<!-- Large modal -->

<div class="modal fade mt-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="mtWizardModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="mtWizardModal">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
          ....
      </div>
      
      <div class="modal-footer">
        .....
      </div>
      
    </div>
  </div>
</div>

<script>
function delData(element) {
    var dataSrcValue = element.getAttribute("data-src");
    console.log("data-src value:", dataSrcValue);
  if (confirm("Are you sure you want to delete this data?") == true) {
    window.location.replace(dataSrcValue);
  }
}

function validateForm(formClassName, excludedFieldNames) {
    var form = document.querySelector("." + formClassName);
    var formFields = form.querySelectorAll("[name]");
    
    var errorMessage = "";

    formFields.forEach(function(field) {
        var fieldName = field.getAttribute("name");

        // Skip validation for excluded field names
        if (excludedFieldNames && excludedFieldNames.includes(fieldName)) {
            field.classList.remove("error");
            return; // Skip to the next iteration
        }

        if (field.value === "") {
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
        document.getElementById("error-message").innerHTML = errorMessage;
        event.preventDefault(); // Prevent form submission
            
        setTimeout(function() {
            document.getElementById("error-message").innerHTML = "";
        }, 2000);
            
    } else {
        document.getElementById("error-message").innerHTML = ""; // Clear any previous error messages
        // Perform your form submission or other actions here
    }
}

</script>

<script>
let isFirstEntry = true; // To keep track of the first entry

function autoExpand(textarea) {
   textarea.style.height = 'auto'; // Reset the height to auto
   textarea.style.height = (textarea.scrollHeight) + 'px'; // Set the new height
}

function insertDataType() {

   const columnNameInput = document.getElementById("column_name");
   const columnName = columnNameInput.value.trim(); // Trim to remove leading/trailing whitespace

   if (columnName !== "") {

      // Get selected data type and column name
      const selectedDatatype = document.getElementById("data_type").value;
      const columnName = document.getElementById("column_name").value;

      // Convert column name to lowercase and replace spaces with underscores
      const formattedColumnName = columnName.toLowerCase().replace(/\s+/g, '_');

      // Get the generated_datatype textarea
      const generatedDatatypeTextarea = document.getElementById("generated_datatype");

      // Append the new datatype to the existing content
      const newDatatype = formattedColumnName + " " + selectedDatatype;

      // Check if this is the first entry
      if (isFirstEntry) {
         generatedDatatypeTextarea.value += "id INT AUTO_INCREMENT PRIMARY KEY";
         alert("id INT AUTO_INCREMENT PRIMARY KEY must be added first");
         isFirstEntry = false;
      } else {
         generatedDatatypeTextarea.value += ("," + newDatatype);
      }

      // Clear the column name field for the next entry
      document.getElementById("column_name").value = '';

      // Auto-expand the generated_datatype textarea after adding the new content
      autoExpand(document.getElementById("generated_datatype"));

   } else {

      columnNameInput.classList.add("error");

      setTimeout(function () {
         columnNameInput.classList.remove("error");
      }, 2000);
   }
}

function generateRows() {
   const targetElement = $("#generateRows");

   // Toggle the element's visibility with slideToggle()
   targetElement.slideToggle(500, function () {
      // Check if the element is now visible or hidden
      const isVisible = targetElement.is(":visible");

      // Execute other code based on the toggle state
      if (isVisible) {
         console.log("Element is now visible");
         // Execute your code for when the element is visible
         $("#generateRowBtn").text("Finish");
         $("#mt-wzd-btn").hide();
      } else {
         console.log("Element is now hidden");
         // Execute your code for when the element is hidden
         $("#generateRowBtn").text("Generate Rows");
         $("#mt-wzd-btn").show();
      }
   });
}
</script>

<script type="text/javascript" src="/mt-db-manager/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/mt-db-manager/assets/js/popper.min.js"></script>
<script type="text/javascript" src="/mt-db-manager/assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/prism.min.js"></script>
</body>
</html>