<?php 
class Account{
    private $con;
    private $error_array=array();

    //最初に実行される。
    public function __construct($con){
        $this ->con = $con;
    }
    
    public function login($id,$pw){
        $query = $this->con->prepare("SELECT * FROM student WHERE student_id=:id AND student_password=:pw");
        $query->bindValue(":id", $id);
        $query->bindValue(":pw", $pw);
        $query->execute();
        
        if ($query->rowCount()==1){
            return True;
        }
        else{
            array_push($this->error_array,"ユーザー名またはパスワードが間違いました");
            return False;
        }
    }

    public function get_error($error){
        if (in_array($error,$this->error_array)){
            return True;
        }
    }
}
?>