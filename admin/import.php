<?php  



if(isset($_POST['import'])){
    $filename = $_FILES['file']['tmp_name'];

    $file =  fopen($filename, "r");

    while(($col = fgetcsv($file, 10000, ",")) !== FALSE){
        $sql = "INSERT INTO voters (voters_id, password, firstname,lastname, cy)VALUES('".$col[0]."', '".$col[1]."','".$col[2]."','".$col[3]."','".$col[4]."' )";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
            $type = "success";
            $message = "CSV file into the Database";
        }else {
            $type = "error";
            $message = "Problem in Importing CSV";
        }
    }

}



?>