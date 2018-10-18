<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> Game Register</title>
    <script src="modernizr.custom.65897"></script>
</head>

<body>
    <?php
    // entry code
    // how did we get here?
    //on submit proccess the data
    // validate and write to a file
    $dir = ".";
    $saveFileName = "./TheGamers.txt";
    $saveString = "";
    $dataArray = array();

    function displayAlert($message){
        echo "<script>alert(\"$message\")</script>";
    }
    if(is_dir($dir)){
        if(isset($_POST['save'])){
            if(empty($_POST['usernam'])){
                displayAlert("Unknown User");
            }else{
                $dataArray[] = $_POST['username'];
                $dataArray[]= stripslashes($_POST['fName']);
                $dataArray[]= stripslashes($_POST['lName']);
                $dataArray[]= stripslashes($_POST['email']);
                $dataArray[]= stripslashes($_POST['age']);
                $dataArray[]= stripslashes($_POST['sName']);
                $dataArray[]= stripslashes($_POST['username']);
                $dataArray[]= stripslashes($_POST['password']);
                $dataArray[]= stripslashes($_POST['comment']);
                $saveString = implode(";",$dataArray);
                $saveString .= "\n";
                $fileHandle = fopen($saveFileName, "ab");
                if($fileHandle === false){
                    displayAlert("There was an error creating $saveFileName");
                }else{
                    if(flock($fileHandle, LOCK_EX)){
                        if(fwrite($fileHandle, $saveString) >0){
                            displayAlert("Successfully wrote to file $saveFileName.");
                        }else{
                            displayAlert("There was an error writting to file $saveFileName");
                        }
                        flock($fileHandle, LOCK_UN);
                    }else{
                       displayAlert("There was an error locking file $saveFileName for writing"); 
                    }
                    fclose($fileHandle);
                }
            }
        }
    }
    ?>
    <!-- html form -->
    <h1>Register for the game</h1>
    <form action="TheGamer.php" method="post" enctype="multipart/form-data">
        First Name:<input type="text" name="fName"><br>
        Last Name: <input type="text" name="lName"><br>
        email: <input type="email" name="email"><br>
        age: <input type="number" name="age"><br>
        screen name: <input type="text" name="sName"><br>
        Username:<input type="text" name="username"><br>
        Password:<input type="password" name="password"> <br>
        <textarea name="comment" cols="100" rows="6"></textarea> <br>
        <input type="submit" name="submit" value="Upload the File"> <br>
    </form>
    <?php
    //display code
    //read the file and display the data
    ?>
</body>

</html>