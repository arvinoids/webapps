$( document ).ready(function(){
 
  $(':submit').click(function() {
    //get the values of variables
    $action = $(this).text();
    $address = $(this).parent().closest('tr').children('td.address').text();
    $model = $(this).closest('tr').find('td:eq(1)').text();
    $useraddress = $('meta[name=useraddress]').attr('content');
    $user = $('meta[name=user]').attr('content');
    if($action=='Disabled') {
      alert('This printer is currently offline and cannot be reserved or released. Check network connection and make sure that the printer is powered on.');
    } else {
      $.ajax({
        type: "POST",
        url: 'controllers/action.php',
        data: {
          'address': $address,
          'model': $model,
          'action': $action,
          'useraddress': $useraddress,
          'user': $user
          },
      });

      if (confirm('You are about to '+$action+' the printer at '+$address+'.\nAre you sure you want to continue?\nThe page will reload when this is completed.\n It may take a minute for the printer to be accessible. \nIf you are requesting access, please wait for the user to grant you.')) {

        $.ajax({
          type: "POST",
          url: 'controllers/action.php',
          data: {
            'address': $address,
            'model': $model,
            'action': $action,
            'useraddress': $useraddress,
            'user': $user,
            'confirm': 'true'
            },
        });
        setTimeout(() => window.location.reload(), 1000);
        } 
      }
    });

    $('#getmodel').click(function(){
      //check if IP address is available
      if( !$(this).val() ) {
        alert("Hello! I am an alert box!!");
  } else {
            $.ajax({
              type: "POST",
              url: 'controllers/snmp.php',
              data: {
                'model': $model
                },
                async: false,
              success: function(data) {
              return data;
              },
            });

    }
  });
});
