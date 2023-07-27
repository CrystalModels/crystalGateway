<?php

class versiones {

function ver_change() {
    
    $values=[];

    $value=[
        '1.2.0-Beta' => '2023-07-27-endpoints de cortes',
        '1.0.1-Beta' => '2023-07-25-sistema de versionamiento',
        '1.0.0-Beta' => '2023-07-25-sistema base'
        
    ];
    array_push($values,$value);

    return json_encode(['crystalGateway-apiIntegrations'=>$values]);
}

}

?>