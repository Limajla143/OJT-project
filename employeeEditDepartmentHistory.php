
<?php
    require('../ojt/connectDB.php');
?>

<?php
    if(isset($_POST['HiddenEmployeeID'])) {
        $employeeID = $_POST['HiddenEmployeeID'];
    } else {
        $employeeID = 'null';
    }
    
    if(isset($_POST['DepartmentName'])) {
        $departmentName = $_POST['DepartmentName'];
    } else {
        $departmentName = 'null';
    }
    if(isset($_POST['EffectiveDate'])) {
        $departmentDate = $_POST['EffectiveDate'];
    } else {
        $departmentDate = 'null';
    }
    
    $sql = "Select * from employee_department where ID='$employeeID'";
    $result = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $sql = "Select * from department where Description='$departmentName'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $deptCode = $row["DepartmentCode"];
        
        $sql = "Update employee_department set DepartmentCode='$deptCode', DepartmentDate='$departmentDate' where ID='$employeeID'";
        
        $result = mysqli_query($connection, $sql);

        $sql = "Update employee set DepartmentCode='$deptCode' where EmployeeID='$employeeID'";
        
        $result = mysqli_query($connection, $sql);
        echo "Success";
    } else {
        echo "Empty";
    }
?>

<?php
    mysqli_close($connection);
?>