  <?php
  include('../condb.php');

  //*** Add Condition ***//
  // if(isset($_POST["hdnCmd"]) == "Add") {
  //   $emp_id = mysqli_real_escape_string($con, $_POST["emp_id"]);
  //   $employee_name = mysqli_real_escape_string($con, $_POST["employee_name"]);
  //   $Accountnumber = mysqli_real_escape_string($con, $_POST["Accountnumber"]);
  //   $name_dept = mysqli_real_escape_string($con, $_POST["name_dept"]);
  //   $name_position = mysqli_real_escape_string($con, $_POST["name_position"]);
  //   $Salary = mysqli_real_escape_string($con, $_POST["Salary"]);
  //   $Allowance = mysqli_real_escape_string($con, $_POST["Allowance"]);
  //   $Position = mysqli_real_escape_string($con, $_POST["Position"]);
  //   $House = mysqli_real_escape_string($con, $_POST["House"]);
  //   $Phone = mysqli_real_escape_string($con, $_POST["Phone"]);
  //   $Diligent = mysqli_real_escape_string($con, $_POST["Diligent"]);
  //   $Oil = mysqli_real_escape_string($con, $_POST["Oil"]);
  //   $Bonus = mysqli_real_escape_string($con, $_POST["Bonus"]);
  //   $Income = mysqli_real_escape_string($con, $_POST["Income"]);
  //   $Overtime = mysqli_real_escape_string($con, $_POST["Overtime"]);
  //   $username = mysqli_real_escape_string($con, $_POST["username"]);

  //   $sql = "INSERT INTO tb_employees
	// (emp_id,employee_name,Accountnumber,name_dept,name_position,Salary,Allowance,Position,House,Phone,Diligent,Oil,Bonus,Income,Overtime,username)
	// VALUES
	// ('$emp_id','$employee_name','$Accountnumber','$name_dept','$name_position','$Salary','$Allowance','$Position','$House','$Phone','$Diligent','$Oil','$Bonus','$Income','$Overtime','$username')";
  //   $objQuery = mysqli_query($con, $sql);
  //   if (!$objQuery) {
  //     echo "Error Save [" . mysqli_error() . "]";
  //   }
  //   //header("location:$_SERVER[PHP_SELF]");
  //   //exit();
  // }

  //*** Update Condition ***//
  if(@($_POST["hdnCmd"]) == "Update") {
    $employee_id = mysqli_real_escape_string($con, $_POST["hdnEditemployee_id"]);
    // $emp_id = mysqli_real_escape_string($con, $_POST['emp_id']);
    $employee_name = mysqli_real_escape_string($con, $_POST["employee_name"]);
    // $Accountnumber = mysqli_real_escape_string($con, $_POST["Accountnumber"]);
    // $name_dept = mysqli_real_escape_string($con, $_POST["name_dept"]);
    // $name_position = mysqli_real_escape_string($con, $_POST["name_position"]);
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
    // $username = mysqli_real_escape_string($con, $_POST["username"]);


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
    $objQuery = mysqli_query($con, $sql);
    if (!$objQuery) {
      echo "Error Update [" . mysqli_error() . "]";
    }
    //header("location:$_SERVER[PHP_SELF]");
    //exit();
  }

  //*** Delete Condition ***//
  if(@($_GET["Action"]) == "Del") {
    $strSQL = "DELETE FROM tb_employees ";
    $strSQL .= "WHERE employee_id = ''" . $_GET["ID"] . "' ";
    $objQuery = mysqli_query($con, $strSQL);
    if (!$objQuery) {
      echo "Error Delete [" . mysqli_error() . "]";
    }
    //header("location:$_SERVER[PHP_SELF]");
    //exit();
  }

  $strSQL = "SELECT * FROM tb_employees as e
  INNER JOIN tb_dept as d ON e.name_dept = d.dept_id
  INNER JOIN tb_position as p ON e.name_position = p.position_id
  ORDER BY employee_id ASC" or die("Error:" . mysqli_error());

  $objQuery = mysqli_query($con, $strSQL) or die("Error Query [" . $strSQL . "]");

  
  $query2 = "SELECT * FROM tb_dept ORDER BY dept_id asc" or die("Error:" . mysqli_error());
  $result2 = mysqli_query($con, $query2);
  ?>
  <form name="frmMain" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="hdnCmd" value="">
    <table class="table table-bordered table-striped">
      <tr class='table-light'>
        <th width="10">
          <div align="center">ลำดับ </div>
        </th>
        <!-- <th width="10">
          <div align="center">รหัส </div>
        </th> -->

        <th width="130">
          <div align="center">ชื่อ-นามสกุล </div>
        </th>
        <!-- <th width="97">
          <div align="center">เลขที่บัญชี </div>
        </th> -->
        <!-- <th width="150">
          <div align="center">แผนก </div>
        </th>
        <th width="150">
          <div align="center">ตำแหน่ง </div>
        </th> -->
        <th width="55">
          <div align="center">เงินเดือน </div>
        </th>
        <th width="55">
          <div align="center">เบี้ยเลี้ยง </div>
        </th>
        <th width="5">
          <div align="center">ค่าตำแหน่ง </div>
        </th>
        <th width="60">
          <div align="center">ค่าเช่าบ้าน </div>
        </th>
        <th width="25">
          <div align="center">ค่าโทรศัพท์ </div>
        </th>
        <th width="20">
          <div align="center">เบี้ยขยัน </div>
        </th>
        <th width="20">
          <div align="center">ค่าน้ำมัน </div>
        </th>
        <th width="20">
          <div align="center">โบนัส </div>
        </th>
        <th width="30">
          <div align="center">เงินได้อื่น </div>
        </th>
        <th width="30">
          <div align="center">OT </div>
        </th>

        <!-- <th width="10">
          <div align="center">Edit </div>
        </th> -->
        <th width="10">
          <div align="center">- </div>
        </th>
      </tr>
      
      

      
      <?php
      $i = 1;
      while ($objResult = mysqli_fetch_array($objQuery)) {
      ?>

        <?php
        if ($objResult["employee_id"] == (@($_GET["ID"])) and (@($_GET["Action"])) == "Edit") {
        ?>
          <tr>
            <td>
              <div align="center">
                <input type="text" class="form-control" name="txtEditemployee_id" size="5" value="<?php echo $objResult["employee_id"]; ?>"readonly>
                <input type="hidden" class="form-control" name="hdnEditemployee_id" size="5" value="<?php echo $objResult["employee_id"]; ?>"readonly>
              </div>
            </td>

            <!-- <td><input type="text" class="form-control" name="emp_id" size="15" value="<?php echo $objResult["emp_id"]; ?>"></td> -->
            <td align="center"><input type="text" class="form-control" name="employee_name" size="20" value="<?php echo $objResult["employee_name"]; ?>"></td>
            <!-- <td align="center"><input type="text" class="form-control" name="Accountnumber" size="15" value="<?php echo $objResult["Accountnumber"]; ?>"></td> -->
            <!-- <td>
              <div align="center"><select class="form-control" name="name_dept" id="dept">
                  <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['name_dept']; ?></option>
                  <?php foreach ($result2 as $value) { ?>
                    <option value="<?= $value['dept_id'] ?>"><?= $value['name_dept'] ?></option>
                  <?php } ?>
                </select></div>
            </td>
            <td>
              <div align="center"><select class="form-control" name="name_position" id="position">
                  <option value="<?php echo $row['position_id']; ?>"><?php echo $row['name_position']; ?></option>
                </select></div>
            </td> -->
            <td align="right"><input type="text" class="form-control" name="Salary" size="20" value="<?php echo number_format($objResult["Salary"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Allowance" size="20" value="<?php echo number_format($objResult["Allowance"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Position" size="5" value="<?php echo number_format($objResult["Position"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="House" size="20" value="<?php echo number_format($objResult["House"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Phone" size="15" value="<?php echo number_format($objResult["Phone"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Diligent" size="10" value="<?php echo number_format($objResult["Diligent"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Oil" size="10" value="<?php echo number_format($objResult["Oil"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Bonus" size="10" value="<?php echo number_format($objResult["Bonus"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Income" size="20" value="<?php echo number_format($objResult["Income"],2); ?>"></td>
            <td align="right"><input type="text" class="form-control" name="Overtime" size="10" value="<?php echo number_format($objResult["Overtime"],2); ?>"></td>
            

            <td colspan="2" align="right">
              <div align="center">
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
            <!-- <td align="center"><?php echo $objResult["Salary"]; ?></td>
            <td align="center"><?php echo $objResult["Allowance"]; ?></td>
            <td align="center"><?php echo $objResult["Position"]; ?></td>
            <td align="center"><?php echo $objResult["House"]; ?></td>
            <td align="center"><?php echo $objResult["Phone"]; ?></td>
            <td align="center"><?php echo $objResult["Diligent"]; ?></td>
            <td align="center"><?php echo $objResult["Oil"]; ?></td>
            <td align="center"><?php echo $objResult["Bonus"]; ?></td>
            <td align="center"><?php echo $objResult["Income"]; ?></td>
            <td align="center"><?php echo $objResult["Overtime"]; ?></td> -->
            <!-- <td align="center"></td> -->
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
  <?php include('scriptselect.php'); ?>
  <?php
  mysqli_close($con);
  ?>