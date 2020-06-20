$('#save').click(function () {
    //populate the field with the activated list
    //get activated list
    var checkboxes = document.getElementsByName('selection');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
        {
            if (checkboxes[i].checked) 
            {
                vals += ","+checkboxes[i].value;
            }
        }
        if (vals) vals = vals.substring(1);
        $('#itemselection').modal('hide');
        $('#elements').val(vals);  
})

function findItem() {
    // Search bar at the top of the table to search by model 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("getItem");
    filter = input.value.toUpperCase();
    table = document.getElementById("data");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }