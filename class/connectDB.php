<?php

class connectDB{
    private $conexao;

    #ABRE CONEXÃO
    public function __constructor($server, $user, $password, $data_base){
         $this->conexao = mysqli_connect($server, $user, $password, $data_base); 
    }

    #ENCERRA CONEXÃO
    public function __destructor(){
        mysqli_close($this->conexao);
    }

    public function searchId(){
        $query = "SELECT sig_class_id, sig_class_name FROM sig_class ORDER BY sig_class_id";
        $searchCID = mysqli_query($this->conexao, $query);
        return $searchCID;
    }

    public function searchSig($id){
        $query = "SELECT sig_class.sig_class_name, signature.sig_id , signature.sig_name from sig_class, signature WHERE signature.sig_class_id='$id' AND signature.sig_class_id=sig_class.sig_class_id;";
        $searchCID = mysqli_query($this->conexao, $query);
        return $searchCID;
    }

    public function searchIntrusion($id){
        $query = "SELECT cid from event where signature='$id'";
        $searchCID = mysqli_query($this->conexao, $query);
        return $searchCID;
    }

}
