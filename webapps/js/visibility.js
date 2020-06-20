$( document ).ready(function(){
 
      $currentUser = $('meta[name=user]').attr('content');
      $('tr').each(function() {
        var $reservedBy = $(this).parent().parent().find('.user').text();
        // ...get status
        // var reserved = $reservedBy.text();
        // if status is "Deleted"...
        if ($reservedBy === $currentUser ) {
          // ...disable button...
          $('button:contains("Reserve")').hide();
        };
      });
  
  
   
  
    });