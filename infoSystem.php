<?php

include('backend.php');
class InfoSystem extends DataSystem{
    private $conn;
    private function OpenBD(){
        $conn = new mysqli(DataSystem::dbHost, DataSystem::dbUser, DataSystem::dbPwd, DataSystem::dbName);
        if ($conn->connect_errno){
            $this->conn = false;
        }else{
            $this->conn = $conn;
        }
    }
    private function CloseBD(){
        mysqli_close($this->conn);
    }

    public function NewUser($strJson){
        $dataDecode64 = base64_decode($strJson);
        $dataDecodeJson = json_decode($dataDecode64);
        $usernombre = $dataDecodeJson->{'usernombre'};
        $useremail = $dataDecodeJson->{'useremail'};
        $userpassword = $dataDecodeJson->{'userpassword'};

        $sql = "INSERT INTO user_pHaCi (nameUhc, emailUhc, pwUhc) VALUES ('$usernombre', '$useremail', '$userpassword');";
        
        $this->OpenBD();
        if ($this->conn->query($sql) === TRUE) {
            $arrJson = array("code"=>"200", "desc"=>"ok");
            $strEcho = json_encode($arrJson);
            $strEcho = base64_encode($strEcho);
        } else {
            $arrJson = array("code"=>"500", "desc"=>$sql.", ".$conn->error);
            $strEcho = json_encode($arrJson);
            $strEcho = base64_encode($strEcho);
        }
        $this->CloseBD();
       
        return $strEcho;

    }
    // SELECT COUNT(emailUhc) AS LI FROM user_pHaCi WHERE estatus_idUhc = 1 AND emailUhc = 'Denisse@gmail.com'
    public function GetUser($strJson){
        $dataDecode64 = base64_decode($strJson);
        $dataDecodeJson = json_decode($dataDecode64);
        $useremail = $dataDecodeJson->{'useremail'};

        $sql = " SELECT COUNT(emailUhc) AS L1 FROM user_pHaCi WHERE estatus_idUhc = 1 AND emailUhc = '$useremail';";
        
        $this->OpenBD();
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $arrJson = array("code"=>"200", "desc"=>$row["L1"]);
                $strEcho = json_encode($arrJson);
                $strEcho = base64_encode($strEcho);
            } 
        } /*else {
            $arrJson = array("code"=>"204", "desc"=>"No Content");
            $strEcho = json_encode($arrJson);
            $strEcho = base64_encode($strEcho);
        }*/
        $this->CloseBD();
       
        return $strEcho;

    }
}

?>