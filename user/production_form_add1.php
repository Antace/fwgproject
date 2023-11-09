<?php
$query1 = "SELECT * FROM tb_product ORDER BY product_id" or die("Erorr:" . mysqli_error($con));
$result1 = mysqli_query($con, $query1);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);


if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['function']) && $_POST['function'] == 'contactFrm'){
        print_r($_POST);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Codeat21 - Popup Contact Form using jQuery, Ajax, and PHP</title>
<meta charset="utf-8">



</head>
<body>
<div class="container">
    <h2>Popup Contact Form with Email</h2>
    
    <!-- Trigger/Open The Modal -->
    <button id="mbtn" class="btn btn-primary turned-button">Contact Us</button>
    
    <!-- The Modal -->
    <div id="modalDialog" class="modal">
        <div class="modal-content animate-top">
            <div class="modal-header">
                <h5 class="modal-title">กรอกรายละเอียด :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="contactFrm"  action="" enctype="multipart/form-data">
                <input type="hidden" name="fuction" value="insert">
            <div class="modal-body">
                <!-- Form submission status -->
                <div class="response"></div>
                
                <!-- Contact form -->
                <div class="form-group">
                    <label>หน่วยงาน/โครงการ :</label>
                    <select class="select2bs4" name="product_id" style="width: 100%;">
							<option value="">-</option>
							<?php foreach ($result3 as $results) { ?>
								<option value="<?php echo $results["department_name"]; ?>">
									<?php echo $results["department_name"]; ?>
								</option>
							<?php } ?>
						</select>
                </div>

                <div class="form-group">
                    <label>รายการผลิต :</label>
                    <select class="select2bs4" name="product_id" style="width: 100%;">
							<option value="">-</option>
							<?php foreach ($result1 as $results) { ?>
								<option value="<?php echo $results["product_id"]; ?>">
									<?php echo $results["product_name"]; ?>
								</option>
							<?php } ?>
						</select>
                </div>
                <div class="form-group">
                    <label>แปลง :</label>
                    <input type="text" name="production_place" id="email" class="form-control"  required="">
                </div>

                <div class="form-group">
                    <label>ความยาว/เมตร :</label>
                    <input type="decimal" name="production_uom" id="email" class="form-control"  required="">
                    
                </div>
                <div class="form-group">
                    <label>จำนวนที่สั่งผลิต :</label>
                    <input type="number" name="production_uom" id="email" class="form-control"  required="">
                    
                </div>
                <div class="form-group">
                    <label>หน่วย :</label>
                    <select class="select2bs4" name="production_unit" style="width: 100%;">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>


$('#contactFrm').submit(function(){
    console.log($(this).serialize() );
    var data = $(this).serialize();
    var action = $(this).attr('astion');
    $.ajax({
        url: action,
        type: "post",
        data: data,
        // datatype: "json",
        dataType: "html",
        success: function (response){
            console.log(response)
        }
    })
    return false;
});
</script>



</body>
</html>