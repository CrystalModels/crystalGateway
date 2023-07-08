
<?php

require 'flight/Flight.php';

require 'database/db_users.php';
require 'env/domain.php';

 

Flight::route('POST /postUsersBySuperAdmin/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
   
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {
        $dta = array(
            
            'name' => Flight::request()->data->name,
            'lastName' => Flight::request()->data->lastName,
            'personalMail' => Flight::request()->data->personalMail,
            'companyMail' => Flight::request()->data->companyMail,
           
            
            'ownerId' => Flight::request()->data->ownerId,
            'rolId' => Flight::request()->data->rolId,
            'imageUrl' => Flight::request()->data->imageUrl
        );



        // Acceder a los encabezados
    
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apk, 
          'xapiKey' => $xapk
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $dt=json_encode($dta);

      curl_close($curl);
      $url = $sub_domain."/crystalCore/apiUsers/v1/postUsersBySuperAdmin/$response1/$xapk";

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dt);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
        'Content-Type: application/json'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

 
    curl_close($curl);

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes 234';
    }
});




Flight::route('POST /postUsersByAdmin/@profileId', function ($profileId) {
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'name' => Flight::request()->data->name,
            'lastName' => Flight::request()->data->lastName,
            'personalMail' => Flight::request()->data->personalMail,
            'companyMail' => Flight::request()->data->companyMail,
           
            
            'ownerId' => Flight::request()->data->ownerId,
            'rolId' => Flight::request()->data->rolId,
            'imageUrl' => Flight::request()->data->imageUrl
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/postUsersByAdmin/'.$profileId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /putUsersByAdmin/@profileId/@putId', function ($profileId,$putId) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = array(
            
            'name' => Flight::request()->data->name,
            'lastName' => Flight::request()->data->lastName,
            'personalMail' => Flight::request()->data->personalMail,
            'companyMail' => Flight::request()->data->companyMail,
           
            
            'ownerId' => Flight::request()->data->ownerId,
            'rolId' => Flight::request()->data->rolId,
            'imageUrl' => Flight::request()->data->imageUrl
        );



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putUsersByAdmin/'.$profileId.'/'.$putId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /putUsersBySuperAdmin/@apk/@xapk/@putId', function ($apk,$xapk,$putId) {
  
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
   
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {
        // Leer los datos de la solicitud
        $dta = array(
            
            'name' => Flight::request()->data->name,
            'lastName' => Flight::request()->data->lastName,
            'personalMail' => Flight::request()->data->personalMail,
            'companyMail' => Flight::request()->data->companyMail,
            'internalMail' => Flight::request()->data->internalMail,
            
            'imageUrl' => Flight::request()->data->imageUrl
        );





        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apk, 
          'xapiKey' => $xapk
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      $dt=json_encode($dta);


      curl_close($curl);
      $url = $sub_domain."/crystalCore/apiUsers/v1/putUsersBySuperAdmin/$response1/$xapk/$putId";

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dt);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers = array(
        'Content-Type: application/json'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
   
    curl_close($curl);

 
echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});





Flight::route('POST /putUserStatusBySuperAdmin/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
   
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {
        // Leer los datos de la solicitud
        $dta = array(
            
            'profileId' => Flight::request()->data->profileId,
            'value' => Flight::request()->data->value
        );




        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apk, 
          'xapiKey' => $xapk
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $dt=json_encode($dta);

      curl_close($curl);
      $url = $sub_domain."/crystalCore/apiUsers/v1/putUserStatusBySuperAdmin/$response1/$xapk";

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dt);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers = array(
        'Content-Type: application/json'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /putUsersBySuperAdminGeneral/@putId', function ($putId) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'name' => Flight::request()->data->name,
            'lastName' => Flight::request()->data->lastName,
            'personalMail' => Flight::request()->data->personalMail,
            'companyMail' => Flight::request()->data->companyMail,
           
            
            
            'internalMail' => Flight::request()->data->internalMail,
            'imageUrl' => Flight::request()->data->imageUrl
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putUsersBySuperAdminGeneral/'.$putId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});


Flight::route('POST /putUsersRolByAdmin/@profileId/@putId', function ($profileId,$putId) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'rolId' => Flight::request()->data->rolId
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putUsersRolByAdmin/'.$profileId.'/'.$putId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /putKeyword/@profileId', function ($profileId) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'keyWord' => Flight::request()->data->keyWord,
            'newkeyWord' => Flight::request()->data->newkeyWord
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putKeyword/'.$profileId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /forgotKeyword/', function () {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'userName' => Flight::request()->data->userName
        ];



        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/forgotKeyword/';

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /forgotKeywordValidate/', function () {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'userName' => Flight::request()->data->userName,
            'code' => Flight::request()->data->code,
            'newkeyWord' => Flight::request()->data->newkeyWord
        ];



        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/forgotKeywordValidate/';

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /validateLogIn/@headerslink', function ($headerslink) {
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    $parts = explode(" ", $headerslink);

// Crear el array con los valores correspondientes


    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if ($headerslink !="0") {
        // Leer los datos de la solicitud
        $dta = [
            
            'userName' => Flight::request()->data->userName,
            'keyWord' => Flight::request()->data->keyWord,
            'ipAdd' => Flight::request()->data->ipAdd,
            'browser' => Flight::request()->data->browser
        ];



        // Acceder a los encabezados
       
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyLog/';
      
        $data = array(
          
          'xapiKey' => $headerslink
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/validateLogIn/'.$headerslink;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;
//echo json_encode($dta);
        
    } else {
        echo 'Error: Encabezados faltantes';
        
    }
});



Flight::route('POST /validateLogOut/', function () {
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'profileId' => Flight::request()->data->profileId
        ];



        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/validateLogOut/';

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});





Flight::route('POST /putUsersRolBySuperAdmin/@apk/@xapk', function ($apk,$xapk) {
  
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
   
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {
        // Leer los datos de la solicitud
        $dta = array(
            
            'rolId' => Flight::request()->data->rolId,
            'putId' => Flight::request()->data->putId
        );

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apk, 
          'xapiKey' => $xapk
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

        
      $dt=json_encode($dta);


      curl_close($curl);
      $url = $sub_domain."/crystalCore/apiUsers/v1/putUsersRolBySuperAdmin/$response1/$xapk";

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dt);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
      $headers = array(
        'Content-Type: application/json'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});




Flight::route('POST /putUsersRolByAdmin/@profileId', function ($profileId) {
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'rolId' => Flight::request()->data->rolId,
            'putId' => Flight::request()->data->putId
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putUsersRolByAdmin/'.$profileId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});





Flight::route('POST /putKeyword/@profileId', function ($profileId) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'keyWord' => Flight::request()->data->keyWord,
            'newkeyWord' => Flight::request()->data->newkeyWord
        ];



        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
          'ApiKey' =>$apiKey, 
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/putKeyword/'.$profileId;

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          'Api-Key: ' . $response1,
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});



Flight::route('POST /forgotKeyword/', function () {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'keyWord' => Flight::request()->data->keyWord,
            'newkeyWord' => Flight::request()->data->newkeyWord
        ];



        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyLogGateway/';
      
        $data = array(
          
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/forgotKeyword/';

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});





Flight::route('GET /getSecretKey/@clientId', function ($clientId) {
    header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    //$headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
   
        // Leer los datos de la solicitud
        $dta = [
            
            'clientId' => Flight::request()->data->clientId
        ];



        // Acceder a los encabezados
        
        
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $response = file_get_contents($sub_domain.'/crystalCore/apiAuth/v1/getSecretKey/'.$clientId, false);
                 
           
        
        echo $response;
    
});


Flight::route('POST /forgotKeywordValidate/', function () {
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
        $dta = [
            
            'code' => Flight::request()->data->code,
            'userName' => Flight::request()->data->userName,
            'newkeyWord' => Flight::request()->data->newkeyWord
        ];



        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        

        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyLogGateway/';
      
        $data = array(
          
          'xapiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);
      $url = $sub_domain.'/crystalCore/apiUsers/v1/forgotKeywordValidate/';

      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dta);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $headers1 = array(
          
          'x-api-Key: ' . $xApiKey
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
      
      // Ejecutar la solicitud y obtener la respuesta
      $response2 = curl_exec($curl);
      

    //echo json_encode($headers);

//echo $response2;
    curl_close($curl);

    //echo json_encode($headers);
        // Realizar acciones basadas en los valores de los encabezados
  //echo "true";

echo $response2;

        
    } else {
        echo 'Error: Encabezados faltantes';
    }
});


Flight::route('GET /getAllUsersBySuperAdmin/@headerslink', function ($headerslink) {
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
       
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllUsersBySuperAdmin/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});


Flight::route('GET /getAllModels/@headerslink', function ($headerslink) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
     
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllModels/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});




Flight::route('GET /getAllMonitors/@headerslink', function ($headerslink) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
       
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllMonitors/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getAllPhotographs/@headerslink', function ($headerslink) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
       
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllPhotographs/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getAllRoles/@headerslink', function ($headerslink) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
        
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllRoles/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});

Flight::route('GET /getAllRolesAdmin/@headerslink', function ($headerslink) {
    
  
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
    
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllRolesAdmin/', false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getOneUserBySuperAdmin/@headerslink/@profileId', function ($headerslink,$profileId) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
       
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getOneUserBySuperAdmin/'.$profileId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});


Flight::route('GET /getAllUsersByAdmin/@headerslink/@adminId', function ($headerslink,$adminId) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
      
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllUsersByAdmin/'.$adminId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getOneUserByAdmin/@headerslink/@adminId/@profileId', function ($headerslink,$adminId,$profileId) {
  
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
     
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getOneUserByAdmin/'.$adminId.'/'.$profileId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getProfileInfoLog/@userName/@sessionId', function ($userName,$sessionId) {
    
    header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        
        $xApiKey = $headers['x-api-Key'];
        $ApiKey = $headers['Api-Key'];
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            
            'xapiKey' => $xApiKey,
            'apiKey' => $ApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getProfileInfoLog/'.$userName.'/'.$sessionId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});



Flight::route('GET /getProfileInfoLogJS/@apk/@xapk/@userName/@sessionId', function ($apk,$xapk,$userName,$sessionId) {
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
   
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apk) && !empty($xapk)) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        
    
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            
            'xapiKey' => $apk,
            'apiKey' => $xapk
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xapk\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getProfileInfoLog/'.$userName.'/'.$sessionId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});




Flight::route('GET /getAllUsersGeneral/@headerslink/@profileId', function ($headerslink,$profileId) {
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $parts = explode(" ", $headerslink);

    $apiKey=$parts[0];
    $xApiKey=$parts[1];
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (!empty($apiKey) && !empty($xApiKey)) {
        // Leer los datos de la solicitud
       
       
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKeyGateway/';
      
        $data = array(
            'ApiKey' =>$apiKey, 
            'xapiKey' => $xApiKey
            
            );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      


      curl_close($curl);

      

        // Realizar acciones basadas en los valores de los encabezados


        if ($response1 != 'false' ) {
           


            $sub_domaincons = new model_dom;
            $sub_domain = $sub_domaincons->dom();
            
            // Configurar los headers
            $options = array(
                'http' => array(
                    'header' => "Api-Key: $response1\r\n" .
                                "x-api-Key: $xApiKey\r\n"
                )
            );
            $context = stream_context_create($options);
            
            // Realizar la solicitud y obtener la respuesta
            $response = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getAllUsersGeneral/'.$profileId, false, $context);
                 
           
        
              echo $response;



        } else {
           echo 'Error: Autenticación fallida';
             //echo json_encode($response1);
           // echo $response1;
        }
    } else {
        echo 'Error: Encabezados faltantes';
    }






});

Flight::start();
