<?php 
class Conect{
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "dmp";
    private $tbl_name = "demo2";
    private $user_tbl = "user";

    private $media_table = "media";
    private $res;
    public function __construct(){
        $this->res = mysqli_connect(
            $this->host,$this->username,$this->password,$this->dbname
        );
        if($this->res){
            echo "<br>Connected !!";
        }else{
            echo "<br>Not Connected";
        }
    } 

    public function register_user($name,$email,$psw){

        $query = "INSERT INTO $this->user_tbl VALUES(101,'$name','$email','$psw')";

        return mysqli_query($this->res,$query);

    }
    public function getRecord(){
        $query = "SELECT * FROM $this->tbl_name";
        return mysqli_query($this->res,$query);
    }

    public function deleteRecord($id) {

        $query = "DELETE FROM $this->tbl_name WHERE id = $id";
        return mysqli_query($this->res,$query);

    }

    public function updateRecord($id,$name,$age,$mail){

        $query = "UPDATE TABLE $this->tbl_name SET name='$name',age=$age,mail='$mail' WHERE id = $id";

        return mysqli_query($this->res,$query);

    }
    

    public function fetch_single_redcord($id){
        $query = "SELECT * FROM $this->tbl_name WHERE id = $id";
        return mysqli_query($this->res,$query);
    }

    

    public function insert($name,$age,$mail){
        $res2 = mysqli_query($this->res,"INSERT INTO $this->tbl_name(name,age,mail) VALUES('$name',$age,'$mail');");
        if($res2){
            echo "<br>Inserted Succesfully";
        }
        else{
            echo "<br>Insertion Failed.....";
        }
    }

    public function insert_media($name,$path){

        $query = "INSERT INTO $this->media_table(name,path) VALUES('$name','$path')";

        return mysqli_query($this->res,$query);
    }

    public function get_media(){
        $query = "SELECT * FROM $this->media_table";

        
        return mysqli_query($this->res,$query);
    }

    private function fetch_single_media($id){

        $query = "SELECT * FROM $this->media_table WHERE id = $id";
        return mysqli_query($this->res,$query);
    }

    public function delete_media($id){

        $record = $this->fetch_single_media($id);

        if(mysqli_num_rows($record)==1){

            $data = mysqli_fetch_assoc($record);
            $file_name = $data['path'];

            $query = "DELETE FROM $this->media_table WHERE id =$id";

            if(mysqli_query($this->conn,$query) && unlink($file_name)){

                return "Deleted successfully..";
            }else{
                return "Failed to delete..";
            }
        }
        else{
            return "Media not exits...";
        }
    }
}
?>