 function validateForm() {
      // error handling
      var errorCounter = 0;

      $(".required").each(function(i, obj) {

          if($(this).val() === ''){
              $(this).parent().addClass("has-error");
              errorCounter++;
          } else{ 
              $(this).parent().removeClass("has-error"); 
          }


      });

      return errorCounter;
  }

