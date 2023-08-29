<script>
    $('#dept').change(function() {
    var id_dept = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db_img.php",
      data: {id:id_dept,function:'dept'},
      success: function(data){
          $('#position').html(data); 
      }
    });
  });
</script>

