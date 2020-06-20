function showHint(str) { //
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                $("#submitprinter").removeAttr('disabled');
            }
        };
        xmlhttp.open("GET", "controllers/snmp_echo.php?ip=" + str, true);
        xmlhttp.send();
    }
}

function findModel() {
    // Search bar at the top of the table to search by model 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("getModel");
    filter = input.value.toUpperCase();
    table = document.getElementById("printers");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
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

  $('#submitprinter').click(function(){
      console.log('Submit Clicked!');
      $address = $('#address').val();
      $legacy = ($('#legacy').prop('checked') ? 1 : 0);
      $.ajax({
        type: "POST",
        url: 'controllers/addprinter.php',
        data: {
          'address': $address,
          'legacy': $legacy
          }, 
        success: function (response){
          $('#form').text(response);
          document.getElementById('submitprinter').style.display = "none";
          document.getElementById('backButton').style.display = "block";
        }
      });
    });

  $('#newuser').click(function(){
    $username = $('#username').val();
    $password = $('#password').val();
    $email = $('#email').val();
    $.ajax({
      type: "POST",
      url: 'controllers/register.php',
      data: {
        'username': $address,
        'password': $legacy,
        'email' : $email
        }, 
      success: function (response){
        $('#registration').text(response);
        document.getElementById('newuser').hide();
      }
    });
  });

$( document ).ready(function(){// To colorize the network status of the printers
    $('.net:contains("Offline")').css('color', 'red');
    $('.net:contains("Online")').css('color', 'green');
    $('.status:contains("Offline")').css('color', 'red');
    $('.status:contains("Online")').css('color', 'green');
});