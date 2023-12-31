<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<form name="frmMain" action="" method="post" id="contactFrm">
<div class="modal-body">
<div class="response"></div>

			<div class="form-group">
                    <label>Name:</label>
                    <input type='text' class='form-control' name='production_place' value='<?php echo $_GET["name"] ?>'  />
                </div>
	
				<div class="modal-footer">
                <!-- Submit button -->
                <input type="button" name="btnClose" value="Close" OnClick="window.close();">
            </div>
	
	
		
</form>

<script>
$(document).ready(function(){
    $('#contactFrm').submit(function(e){
        e.preventDefault();
        $('.modal-body').css('opacity', '0.5');
        $('.btn').prop('disabled', true);
        
        $form = $(this);
        $.ajax({
            type: "POST",
            url: 'ajax_submit.php',
            data: 'contact_submit=1&'+$form.serialize(),
            dataType: 'json',
            success: function(response){
                if(response.status == 1){
                    $('#contactFrm')[0].reset();
                    $('.response').html('<div class="alert alert-success">'+response.message+'</div>');
                }else{
                    $('.response').html('<div class="alert alert-danger">'+response.message+'</div>');
                }
                $('.modal-body').css('opacity', '');
                $('.btn').prop('disabled', false);
            }
        });
    });
});


/*
 * Modal popup
 */
// Get the modal
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the <span> element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on <span> (x), close the modal
    span.on('click', function() {
        modal.hide();
    });
});

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.hide();
    }
});
</script>
</body>
</html>