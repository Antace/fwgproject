  <?php
  include('../condb.php');

  if (@$_GET['do'] == 'success') {
    echo '<script type="text/javascript">
            swal("", "ทำรายการสำเร็จ !!", "success");
            </script>';
    echo '<meta http-equiv="refresh" content="1;url=employee.php" />';
  } else if (@$_GET['do'] == 'finish') {
    echo '<script type="text/javascript">
            swal("", "แก้ไขสำเร็จ !!", "success");
            </script>';
    echo '<meta http-equiv="refresh" content="1;url=employee.php" />';
  }

  //*** Update Condition ***//
  if(($_POST["hdnCmd"]) == "Update") {
    $employee_id = mysqli_real_escape_string($con, $_POST["hdnEditemployee_id"]);
    $employee_name = mysqli_real_escape_string($con, $_POST["employee_name"]);
    $Salary = mysqli_real_escape_string($con, $_POST["Salary"]);
    $Allowance = mysqli_real_escape_string($con, $_POST["Allowance"]);
    $Position = mysqli_real_escape_string($con, $_POST["Position"]);
    $House = mysqli_real_escape_string($con, $_POST["House"]);
    $Phone = mysqli_real_escape_string($con, $_POST["Phone"]);
    $Diligent = mysqli_real_escape_string($con, $_POST["Diligent"]);
    $Oil = mysqli_real_escape_string($con, $_POST["Oil"]);
    $Bonus = mysqli_real_escape_string($con, $_POST["Bonus"]);
    $Income = mysqli_real_escape_string($con, $_POST["Income"]);
    $Overtime = mysqli_real_escape_string($con, $_POST["Overtime"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);


    $sql = "UPDATE tb_employees SET 
	  employee_name='$employee_name',
    Salary='$Salary',
    Allowance='$Allowance',
    Position='$Position',
    House='$House',
    Phone='$Phone',
	  Diligent='$Diligent',
    Oil='$Oil',
	  Bonus='$Bonus',
    Income='$Income',
	  Overtime='$Overtime',
    username='$username'
	  WHERE employee_id=$employee_id";

// echo $sql;
// exit;
    $objQuery = mysqli_query($con, $sql);
    if (!$objQuery) {
      echo "Error Update [" . mysqli_error($con) . "]";
    }
    // echo $objQuery;
    // header("location:$_SERVER[PHP_SELF]");
    // exit();
  }

  //*** Delete Condition ***//
  if(@($_GET["Action"]) == "Del") {
    $strSQL = "DELETE FROM tb_employees ";
    $strSQL .= "WHERE employee_id = ''" . $_GET["ID"] . "' ";
    $objQuery = mysqli_query($con, $strSQL);
    if (!$objQuery) {
      echo "Error Delete [" . mysqli_error($con) . "]";
    }
    //header("location:$_SERVER[PHP_SELF]");
    //exit();
  }

  $strSQL = "SELECT * FROM tb_employees as e
  INNER JOIN tb_dept as d ON e.name_dept = d.dept_id
  INNER JOIN tb_position as p ON e.name_position = p.position_id
  ORDER BY employee_id ASC" or die("Error:" . mysqli_error($con));

  $objQuery = mysqli_query($con, $strSQL) or die("Error Query [" . $strSQL . "]");
  $query2 = "SELECT * FROM tb_dept ORDER BY dept_id asc" or die("Error:" . mysqli_error($con));
  $result2 = mysqli_query($con, $query2);
  ?>
  <form name="frmMain" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="hdnCmd" value="">
    <table id ="example1"class="table table-bordered table-hover table-sm">
    <thead align='center'>
      <tr class='table-light'>
        <th width="10">ลำดับ</th>
        <th width="120">ชื่อ-นามสกุล</th>
        <th width="55">เงินเดือน </div></th>
        <th width="55">เบี้ยเลี้ยง </div></th>
        <th width="5">ค่าตำแหน่ง</th>
        <th width="60">ค่าเช่าบ้าน</th>
        <th width="25">ค่าโทรศัพท์ </th>
        <th width="20">เบี้ยขยัน</th>
        <th width="20">ค่าน้ำมัน</th>
        <th width="20">โบนัส</th>
        <th width="30"> เงินได้อื่น</th>
        <th width="30">OT </th>
        <th width="10"></th>
      </tr>
    </thead>

      <?php
      $i = 1;
      while ($objResult = mysqli_fetch_array($objQuery)) {
      ?>

        <?php
        if ($objResult["employee_id"] == (($_GET["ID"])) and (($_GET["Action"])) == "Edit") {
        ?>
          <tr>
            <td>
              <input type="text" class="form-control" style="text-align: center;" name="txtEditemployee_id" value="<?php echo $objResult["employee_id"]; ?>"readonly>
              <input type="hidden" class="form-control" name="hdnEditemployee_id" value="<?php echo $objResult["employee_id"]; ?>"readonly>
            </td>
            <td ><input type="text" class="form-control" style="text-align: left;"  name="employee_name" value="<?php echo $objResult["employee_name"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Salary" value="<?php echo $objResult["Salary"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Allowance" value="<?php echo $objResult["Allowance"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Position" value="<?php echo $objResult["Position"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="House" value="<?php echo $objResult["House"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Phone" value="<?php echo $objResult["Phone"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Diligent" value="<?php echo $objResult["Diligent"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Oil" value="<?php echo $objResult["Oil"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Bonus" value="<?php echo $objResult["Bonus"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Income" value="<?php echo $objResult["Income"]; ?>"></td>
            <td ><input type="text" class="form-control" style="text-align: right;" name="Overtime" value="<?php echo $objResult["Overtime"]; ?>"></td>
            

            <td colspan="2" align="right">
              <div align="center">
                <input type="hidden" class="form-control" name="username" value="<?php echo $username; ?>">
                <input name="btnAdd" class="btn btn-success btn-xs" type="button" id="btnUpdate" value="Update" OnClick="frmMain.hdnCmd.value='Update';frmMain.submit();">
                <input name="btnAdd" class="btn btn-warning btn-xs" type="button" id="btnCancel" value="Cancel" OnClick="window.location='<?php echo $_SERVER["PHP_SELF"]; ?>';">
              </div>
            </td>
          </tr>
        <?php
        } else {
        ?>
          <tr>
            <td align="center"><?php echo $i++ ; ?></td>
            <!-- <td align="center"><?php echo $objResult["emp_id"]; ?></td> -->
            <td align="left"><?php echo $objResult["employee_name"]; ?></td>
            <!-- <td align="center"><?php echo $objResult["Accountnumber"]; ?></td> -->
            <!-- <td align="center"><?php echo $objResult["name_dept"]; ?></td>
            <td align="center"><?php echo $objResult["name_position"]; ?></td> -->
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center">- -</td>
            <td align="center"><a href='employee.php?act=edit&ID=<?php echo $objResult["employee_id"]?>' class='btn btn-secondary btn-xs'><i class='fas fa-pencil-alt'></i></a><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Edit&ID=<?php echo $objResult["employee_id"]; ?>" class="btn btn-warning btn-xs">Edit</a> 
            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&ID=<?php echo $objResult["employee_id"]; ?>';}" class="btn btn-danger btn-xs">Delete</a></td>
          </tr>
        <?php
        }
        ?>
      <?php
      }
      ?>
      
    </table>
  </form>
  <?php include('employeescriptselect.php'); ?>
  <?php
  mysqli_close($con);
  ?>