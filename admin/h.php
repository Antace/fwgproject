<?php
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <?php
    //print_r($_SESSION);
    include('../condb.php');
    $employee_id = $_SESSION['employee_id'];
    $username = $_SESSION['username'];
    $employee_email = $_SESSION['employee_email'];
    //echo session_save_path();
    //exit;
    if ($employee_id == '') {
        Header("Location: ../logout.php");
    }
    $sql = "SELECT username FROM tb_employee WHERE employee_id=$employee_id";
    $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error());
    $row = mysqli_fetch_array($result);
    $sql1 = "SELECT * FROM tb_po WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 AND cb_name = ' '"; //SELECT ข้อมูลทั้งหมดจาก ตาราง tb_po กำหนดเงื่อนไขคอลัมภ์ เป็น po_dateexpire น้อยกว่า วันที่ปัจจุบัน และ po_dateexpire ไม่เท่ากับ 0000-00-00
    $result1 = mysqli_query($con, $sql1);
    $rec = mysqli_num_rows($result1);

    $sql2 = "SELECT * FROM tb_po WHERE po_name !=''"; //SELECT ข้อมูลทั้งหมดจาก ตาราง tb_po กำหนดเงื่อนไขคอลัมภ์ เป็น po_dateexpire น้อยกว่า วันที่ปัจจุบัน และ po_dateexpire ไม่เท่ากับ 0000-00-00
    $result2 = mysqli_query($con, $sql2);
    $rec2 = mysqli_num_rows($result2);


    $sql3 = "SELECT * FROM tb_po WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 OR cb_name != ''"; //SELECT ข้อมูลทั้งหมดจาก ตาราง tb_po กำหนดเงื่อนไขคอลัมภ์ เป็น po_dateexpire น้อยกว่า วันที่ปัจจุบัน และ po_dateexpire ไม่เท่ากับ 0000-00-00
    $result3 = mysqli_query($con, $sql3);
    $rec3 = mysqli_num_rows($result3);
    $m_name = $row['username'];

    ?>

    <meta charset="utf-8">
    <meta name="viewport">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>FINE WORK GROUP</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
    <!--Script SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">




    <script src="../js/gijgo.min.js" type="text/javascript"></script>
    <link href="../css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        function autoTab(obj) {

            /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น
            
            1. รูปแบบเลขที่บัตรประชาชน เช่น 4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
            2. รูปแบบเบอร์โทรศัพท์ เช่น 08-4521-6521 กำหนดเป็น __-____-____
            3. รูปแบบกำหนดเวลา เช่น 12:45:30 กำหนดเป็น __:__:__
            
            ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
            */

            var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
            var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>




</head>

<body class="hold-transition sidebar-mini layout-fixed">