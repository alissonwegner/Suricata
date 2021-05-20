<?php

#BANCO DE DADOS
$server = "172.16.142.95";
$user = "remote";
$password = "c2t0i2s0m";
$data_base = "devices"; 

require 'data.php';
require 'connectDB.php';
$connectDB = new connectDB();
$connectDB-> __constructor($server, $user, $password, $data_base);
$resultId=$connectDB->searchId();


while($line = mysqli_fetch_array($resultId)){    
    $name_class = $line['sig_class_name'];
    $id_class = $line['sig_class_id'];
    echo "---------------------------------------------------------------------\n";
    echo "ID $id_class --- $name_class\n";

    $resultSig=$connectDB->searchSig($id_class);
    $soma_intrusion=0;
    $aux_num = 0;

    while($line_2 = mysqli_fetch_array($resultSig)){
        $sig_name = $line_2['sig_name'];
        $sig_id = $line_2['sig_id'];

        $resultIntrusion=$connectDB->searchIntrusion($sig_id);
        $num_line = mysqli_num_rows($resultIntrusion);
        echo "Assinatura: $sig_name ----- Intrusões: $num_line \n";

        if($aux_num < $num_line){
            $aux_num = $num_line;
            $aux_sig_id = $sig_id;
            $aux_sig_name = $sig_name;
        }
        $soma_intrusion = $soma_intrusion + $num_line;
    }

    echo "\n====== RESULTADO ======\n";
    echo "Total Intrusão: $soma_intrusion\n";
    echo "Maior Quantidade: ID: $aux_sig_id - Assinatura: $aux_sig_name - Quantidade: $aux_num\n";

    $data = new data($id_class, $name_class, $soma_intrusion, NULL);
    $array_data[$id_class] = $data;

    echo "---------------------------------------------------------------------\n";
    echo "\n\n";

}

$total_intrusion = 0;
foreach($array_data as $key_data_one => &$data_one){
    $soma_intrusion = $data_one -> __get('total_class_intrusion');
    $total_intrusion += $soma_intrusion;
}

foreach($array_data as $key_data_one => &$data_one){
    $soma_intrusion = $data_one -> __get('total_class_intrusion');
    $porc_intrusion = (($soma_intrusion*100)/$total_intrusion);
    $data_one -> __set('porc_intrusion', $porc_intrusion );
}

echo "\n===========RESULTADO PORCENTAGEM===========\n";
foreach($array_data as $key_data_one => &$data_one){
    
    $id_class = $data_one -> __get('class_id');
    $name_class = $data_one -> __get('class_name');
    $soma_intrusion = $data_one -> __get('total_class_intrusion');
    $porc_intrusion = $data_one -> __get('porc_intrusion');
    $porc_intrusion = number_format($porc_intrusion, 3, '.', '');

    echo "ID: $id_class --- Classe: $name_class\n";
    echo "Soma: $soma_intrusion - $porc_intrusion%\n\n";

}




$connectDB-> __destructor();



