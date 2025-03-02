<html>
    <head>
        <title>Belajar</title>
    </head>
    <body>
        
        <form method="post" enctype="multipart/form-data">
            <label for="">Upload</label>
            <input type="file" name="file" >

            <input type="submit" value="upload">
        </form>
    </body>

    <?php
        $target_dir = 'upload/';
        $target_file = $target_dir. basename($_FILES['file']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST)){
            $check = getimagesize($_FILES['file']['tmp_name']);
            if($check !== FALSE){
                echo "file is an image" . $check["mime"] . ".";
                $uploadOk = 1;
            }else{
                echo "file is not image";
                $uploadOk = 0;
            }

            if(file_exists($target_file)){
                echo "file is alredy exists";
                $uploadOk = 0;
            }

            if($_FILES['file']['size'] > 100000){
                echo "sorry, your file to large";
                $uploadOk = 0;
            }

            if($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png"){
                echo "file is only jpg,jpeg,png";
                $uploadOk = 0;
            }

            // uploadOk = 0 adalah error 
            if($uploadOk == 0){
                echo "your file not uploaded";
            }else{
                // jika file lolos semua file akan di upload
                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                    echo "this file" . htmlspecialchars(basename($_FILES['file']['name']. "has ben uploaded"));
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    ?>

</html>