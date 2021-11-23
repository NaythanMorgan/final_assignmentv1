<?php
$connect =mysqli_connect('localhost','root','','school');

if(isset ($_POST['btnsignup']))
{
    $sname = $_POST['txtsname'];
    $age=$_POST['txtage'];
    $gender = $_POST['rdogender'];
    $email = $_POST['txtemail'];
    $address = $_POST['txtaddress'];
    $phone = $_POST['txtphone'];
    $pass = md5($_POST['txtpass']);

    $pass ;
    // .....................Image Saving............................
    
    $staffprofile=$_FILES['filpp']['name'];
    $staffimgfolder="StaffImg/";

    if ($staffprofile) 
    {
        $filename = $staffimgfolder."".$staffprofile;
        $copy = copy($_FILES['filpp']['tmp_name'],$filename);
        if (!$copy) 
        {
            exit("Problem ocurred while storing profile image!");
        }
    }
    // .....................Image Saving............................



    $checkemail ="SELECT * from staff where Email ='$email'";
    $runcheckemail = mysqli_query($connect,$checkemail);
    $countemail = mysqli_num_rows ($runcheckemail);
    if ($countemail ==0)
    {
        $staffinsert = "Insert into staff (Name,Age,Gender,Email,Address,PhoneNumber,Password,ProfilePicture) values('$sname','$age','$gender','$email','$address','$phone','$pass','$filename')";

        $run = mysqli_query($connect,$staffinsert);
        if ($run) 
        {
        echo "<script>alert('Staff Register Successful!')</script>";
        echo "<script>location='staff_registration.php'</script>";
        }
        else 
        {
        echo "<script>alert('Something went wrong. Pls try again!.')</script>";
        echo "<script>location='staff_registration.php'</script>";
        }
        
    }
    else
    {
        echo "<script>alert('Email already exist. Use another email!.')</script>";
        echo "<script>location='staff_registration.php'</script>";
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Staff Registeration</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
        <table align="center">
            <h2 style="text-align:center;">Staff Registration Form</h2>
            <tr>
                <td>Name :</td>
                <td><input type="text" name="txtsname" placeholder="Eg: John" required></td>
            </tr>
            <tr>
                <td>Age :</td>
                <td><input type="text" name="txtage" required></td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td><input type="radio" name="rdogender" Value="Male" Checked>Male
                <input type="radio" name="rdogender" Value="Fenale">Female</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="txtemail" placeholder="Eg: John@gmail.com" required></td>
            </tr>
            <tr>
                <td>Address :</td>
                <td><textarea name="txtaddress" placeholder="Eg.101/102,Tarmwe,Yangon" required></textarea></td>
            </tr>
            <tr>
                <td>Phone Number :</td>
                <td><input type="text" name="txtphone" placeholder="093334534" required></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input type="password" name="txtpass" placeholder="*********" required></td>
            </tr>
            <tr>
                <td>Profile Picture</td>
                <td><input type="file" name="filpp" required></td>
            </tr>
            <tr>
                <td><input type="checkbox" required>I agree Terms and Conditions</td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" Value="Sign Up" name="btnsignup"></td>
            </tr>
            
        </table>
    </form>
    
</body>
</html>