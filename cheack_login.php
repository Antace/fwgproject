<?php 
session_start();
        if(isset($_POST['username'])){
        //connection
                  include("condb.php");
        //รับค่า user & mem_password
                  $username = mysqli_real_escape_string($con,$_POST['username']);
                  $password = mysqli_real_escape_string($con,$_POST['password']);

			
                    //query 
                              $sql="SELECT * FROM tb_employee
                              WHERE username='".$username."' 
                              AND password='".$password."'";
                              $result = mysqli_query($con, $sql);

                              //echo $sql;

                              // echo mysqli_num_rows($result);

                              //exit;
                    
                              if(mysqli_num_rows($result)==1){

                                  $row = mysqli_fetch_array($result);

                                  $_SESSION["employee_id"] = $row["employee_id"];  
                                  $_SESSION["username"] = $row["username"];
                                  $_SESSION["employee_email"] = $row["employee_email"]; 
								                  $_SESSION["employee_level"] = $row["employee_level"];
                                      

                                      if($row['employee_level']=="admin"){                                     
                                          Header("Location: admin/");
                                          
                                      }elseif($row['employee_level']=="user"){
                                          Header("Location: user/");
                                      } 

                              }else{
                                    echo "<script>";
                                    echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                                    echo "window.history.back()";
                                    echo "</script>";
                              }


                    //close else chk trim

                    //exit();




        }else{


             Header("Location: index.php"); //user & mem_password incorrect back to login again

        }
?>