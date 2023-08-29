<?php
session_start();?>
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
        if($employee_id==''){
        Header("Location: ../logout.php");
        }
        $sql = "SELECT username FROM tb_employee WHERE employee_id=$employee_id";
        $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        $sql1="SELECT * FROM tb_po WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 AND cb_name = ' '" ; //SELECT ข้อมูลทั้งหมดจาก ตาราง tb_po กำหนดเงื่อนไขคอลัมภ์ เป็น po_dateexpire น้อยกว่า วันที่ปัจจุบัน และ po_dateexpire ไม่เท่ากับ 0000-00-00
        $result1 = mysqli_query($con, $sql1);
        $rec = mysqli_num_rows($result1);
        $m_name = $row['username'];
        
        ?>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <!--Script SweetAlert -->
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">