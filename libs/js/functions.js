
function suggetion() {

     $('#sug_input').keyup(function(e) {

         var formData = {
             'product_name' : $('input[name=title]').val()
         };

         if(formData['product_name'].length >= 1){

           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   //console.log(data);
                   $('#result').html(data).fadeIn();
                   $('#result li').click(function() {

                     $('#sug_input').val($(this).text());
                     $('#result').fadeOut(500);

                   });

                   $("#sug_input").blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {

           $("#result").hide();

         }

         e.preventDefault();
     });

 }
  $('#sug-form').submit(function(e) {
      var formData = {
          'p_name' : $('input[name=title]').val()
      };
        // process the form
        $.ajax({
            type        : 'POST',
            url         : 'ajax.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
            .done(function(data) {
                //console.log(data);
                $('#product_info').html(data).show();
                total();
                $('.datePicker').datepicker('update', new Date());

            }).fail(function() {
                $('#product_info').html(data).show();
            });
      e.preventDefault();
  });
  function total(){
    $('#product_info input').change(function(e)  {
            var price = +$('input[name=price]').val() || 0;
            var qty   = +$('input[name=quantity]').val() || 0;
            var total = qty * price ;
                $('input[name=total]').val(total.toFixed(2));
    });
  }

  $(document).ready(function() {

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function () {
       $(this).parent().children('ul.submenu').toggle(200);
    });
    //suggetion for finding product names
    suggetion();
    // Callculate total ammont
    total();

    $('.datepicker')
        .datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true
        });
  });


$('#contactForm').submit(function(e) {
    e.preventDefault();

    var valid;	
	valid = validateContact();

    if(valid) {
        jQuery.ajax({
            url: "contact_mail.php",
            data:'contact_name='+$("#contact_name").val()+'&contact_email='+$("#contact_email").val()+'&contact_company='+$("#contact_company").val()+'&contact_message='+$("#contact_message").val(),
            type: "POST",
            success:function(data){
                $("#mail-status").html(data);
                $('#contactForm').trigger("reset");
            },
            error:function (erro){
                console.log(error);
            }
        });
    }
});
        
function validateContact() {
    var valid = true;	
    
    if(!$("#contact_name").val()) {
        valid = false;
    }

    if(!$("#contact_email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        valid = false;
    }

    if(!$("#contact_message").val()) {
        valid = false;
    }

    return valid;
}

