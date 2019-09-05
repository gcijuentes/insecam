<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("simple_html_dom.php");
       



function tabworker($view,$pais){
$fichero = 'sql/camaras_'.$pais.'.sql'; 
$ficheroError = 'sql/camarasError_'.$pais.'.txt'; 

      //$view = "http://insecam.org/en/view/448054/";
     //  echo $view;
      $viewHtml = file_get_html($view);

       //exit(1);
         if(false !== $viewHtml){

            foreach ($viewHtml->find('a[rel=nofollow]') as $camara) {
                        $camara. '<br>';
                 break;
             }

      	foreach($viewHtml->find('tr') as $tr){
      		//pais
      		 $row1 = $tr->next_sibling();
                   echo $tr->next_sibling()->innertext();
                  $sPais = trim(str_replace('.','',$tr->next_sibling()->last_child()->find('a',0)->innertext()));
                  //echo $sPais;
 
      		//codigo pais
      		$row2 = $row1->next_sibling();
                  //echo $row2->innertext();
      		$sPaisCode = trim($row2->last_child()->innertext());
                  echo $sPaisCode;

      		//region
      		$row3 = $row2->next_sibling();
      		foreach($row3->last_child()->find('a') as $element) 
             	$sRegion = trim($element->innertext());
                  echo $sRegion;
/*
             	//ciudad
             	$row4 = $row3->next_sibling();
             	$sCiudad = trim($row4->last_child()->find('a',0)->innertext());
                  //echo $sCiudad;


             	//latitude
             	$row5 = $row4->next_sibling();
             	$sLatitud = trim($row5->last_child()->innertext());
                  //echo $sLatitud;
             	
             	//Longitud
             	$row6 = $row5->next_sibling();
             	$sLongitud = trim($row6->last_child()->innertext());
             	
             	//zipcode
             	$row7 = $row6->next_sibling();
             	$sZipCode = trim($row7->last_child()->innertext());

             	//Timezone
             	$row8 = $row7->next_sibling();
             	foreach($row8->find('a') as $element) 
             	    $sTimeZone = trim($element->innertext());

             	//Manufacturer
             	$row9 = $row8->next_sibling();
             	foreach($row9->find('a') as $element) 
             			echo $sManu = trim($element->innertext());

      		 break;
*/
                   break;
      		
      	}

/*          $qCamara = "INSERT INTO `camara` (`id`, `latitud`, `longitud`, `title`, `description`, `image`, `pais`, `codigopais`, `ciudad`, `zipcode`, `timezone`, `manufacturer`, `camara`, `region`) VALUES (NULL, '".$sLatitud."', '".$sLongitud."', NULL, NULL, NULL, '".$sPais."',  '".$sPaisCode."', '".$sCiudad."','".$sZipCode."', '".$sTimeZone."', '".$sManu."', '".$camara."','".$sRegion."');";
*/

            //echo $qCamara;
           // file_put_contents($fichero, $qCamara.PHP_EOL, FILE_APPEND);

      }
      else{
            echo "vista error: ".$view;
            file_put_contents($ficheroError, $view.PHP_EOL, FILE_APPEND);

      }


}



?>