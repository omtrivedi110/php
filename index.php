<?php
include('config/config.php');
$obj = new Conect();
$obj->connect();
$sbm = @$_REQUEST['sb'];
$upd = @$_REQUEST['up_btn'];
$fetch_single_rec = null;
$res = $obj->getRecord();

$del = @$_GET['del'];

if(isset($del)){
    $delId = $_GET['del_id'];
    $kje = $obj->deleteRecord($delId); 
    $res = $obj->getRecord();
}

if(isset($upd)){
    $up_id = $_GET['upd_id'];
    $data = $obj->fetch_single_redcord($up_id);
    $fetch_single_rec = mysqli_fetch_assoc($data);  
}
       
if(isset($sbm)){

    $name = $_GET['fname'];
    $age = $_GET['age'];
    $mail = $_GET['mail'];

    $obj->insert($name,$age,$mail);
    $res = $obj->getRecord();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <form action="" method = "get">

    <div class="conainer pt-10 s">
        <?php if($sbm != null){?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }?>
    </div>

    <label for="fname">Name :</label>
    <input type="text" name="fname" value="<?php if($fetch_single_rec != null){ echo $fetch_Single_rec['name'];}?>"><br><br>
    
    <label for="age">Age :</label>
    <input type="number" name="age" value="<?php if($fetch_single_rec != null){ echo $fetch_Single_rec['age'];}?>"><br><br>
    
    <label for="mail">mail :</label>
    <input type="text" name="mail" value="<?php if($fetch_single_rec != null){ echo $fetch_Single_rec['mail'];}?>"><br><br>

    <input type="submit" value="<?php if($fetch_single_rec != null){echo "Update";}else{echo "Submit";}?>" name="<?php if($fetch_single_rec != null){echo "up";}else{echo "sb";}?>">

    </form>

    <div class="container pt-5">

    <table class="table table-striped table-hover">

<thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Age</th>
    <th scope="col">Mail</th>
    <th scope="col" colspan="2">Actions</th>
</tr>
</thead>
<tbody>
    <?php while($rec = mysqli_fetch_assoc($res)){?>
    <tr>
    <th scope="row"><?php echo $rec['id'];?></th>
    <td><?php echo $rec['name'];?></td>
    <td><?php echo $rec['age'];?></td>
    <td><?php echo $rec['mail'];?></td>
    <form action="" method = "get">
        <input type="hidden" name="upd_id" value=<?php echo $rec['id'];?>>
        <td> <input type="submit" value="UPDATE" name = 'up_btn'></td>
        <input type="hidden" name="del_id" value="<?php echo $rec['id'];?>">
        <td> <input type="submit" value="DELETE" name="del"></td>
    </form>
</tr>
    <?php } ?>
</tbody>

</table>
    </div>
</body>
</html>