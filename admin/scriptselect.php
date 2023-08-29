<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#dept').change(function() {
    var id_dept = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_dept,function:'dept'},
      success: function(data){
          $('#position').html(data); 
      }
    });
  });
</script>
