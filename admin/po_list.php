<?php
if(@$_GET['do']=='success'){
  echo '<script type="text/javascript">
  swal("", "ทำรายการสำเร็จ !!", "success");
  </script>';
  echo '<meta http-equiv="refresh" content="1;url=po.php" />';
  }else if(@$_GET['do']=='finish'){
  echo '<script type="text/javascript">
  swal("", "ทำรายการสำเร็จ !!", "success");
  </script>';
  echo '<meta http-equiv="refresh" content="1;url=po.php" />';
  }
  $qpo = (isset($_GET['qpo']) ? $_GET['qpo'] : '');
  $qcus = (isset($_GET['qcus']) ? $_GET['qcus'] : '');
  $qdept = (isset($_GET['qdept']) ? $_GET['qdept'] : '');
  $qcate = (isset($_GET['qcate']) ? $_GET['qcate'] : '');
  //4เงื่อนไข ถ้า เลขpo และ ลูกค้า และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show.php และไฟล์ footer.js.php
  if($qpo AND $qcus AND $qdept AND $qcate !=''){
  include ('po_list_show.php');
  include ('footerjs.php');
  exit;
  }//3เงื่อนไข ถ้า เลขpo และ ลูกค้า และ โครงการ ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show2.php และไฟล์ footer.js.php
  elseif($qpo AND $qcus AND $qdept !=''){
  include ('po_list_show2.php');
  include ('footerjs.php');
  exit;
  }//3เงื่อนไข ถ้า เลขpo และ ลูกค้า และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show21.php และไฟล์ footer.js.php
  elseif($qpo AND $qcus AND $qcate !=''){
  include ('po_list_show21.php');
  include ('footerjs.php');
  exit;
  }//3เงื่อนไข ถ้า เลขpo และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show22.php และไฟล์ footer.js.php
  elseif($qpo AND $qdept AND $qcate !=''){
  include ('po_list_show22.php');
  include ('footerjs.php');
  exit;
  }//3เงื่อนไข ถ้า ลูกค้า และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show23.php และไฟล์ footer.js.php
  elseif($qcus AND $qdept AND $qcate !=''){
  include ('po_list_show23.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qpo AND $qcus  !=''){
  include ('po_list_show3.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qpo AND $qdept  !=''){
  include ('po_list_show31.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qpo AND $qcate  !=''){
  include ('po_list_show32.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qcus AND $qdept  !=''){
  include ('po_list_show33.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qcus AND $qcate  !=''){
  include ('po_list_show34.php');
  include ('footerjs.php');
  exit;
  }//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
  elseif($qdept AND $qcate  !=''){
  include ('po_list_show35.php');
  include ('footerjs.php');
  exit;
  }elseif($qpo !=''){
  include ('po_list_show4.php');
  include ('footerjs.php');
  exit;
  }elseif($qcus !=''){
  include ('po_list_show41.php');
  include ('footerjs.php');
  exit;
  }elseif($qdept !=''){
  include ('po_list_show42.php');
  include ('footerjs.php');
  exit;
  }elseif($qcate !=''){
  include ('po_list_show43.php');
  include ('footerjs.php');
  exit;
  }
  $query = "SELECT * FROM tb_po
  WHERE po_dateexpire >= current_date OR po_dateexpire = 0000-00-00 AND cb_name = '' ORDER BY po_id DESC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  
  
include "po_list_thead.php";
include "po_slist.php";

mysqli_close($con);
?>