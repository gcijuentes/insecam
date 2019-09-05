<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("simple_html_dom.php");
require_once("paises.php");
require_once("view.php");
require_once("tab.php");
require_once("divInsecam.php");

$view = "http://www.insecam.org/en/view/";


//$pais

//$pais[] = "LC";


$baseUrl = "http://insecam.org";
$j=1;

$countPaginas= 0;
$numFile = 1;
$fecha = date('Y-m-d-Hi');
//echo $pais;


foreach ($paises as $key => $value) { 

$paginas = ceil($value/6);
		for($i=1;$i<=$paginas;$i++){//pagina
			$urls = "http://insecam.org/en/bycountry/".$key."/?page=".$i;
			$byCountry = file_get_html($urls);
	  		
	  		//echo '$byCountry: <br>' .$byCountry;

	  		foreach($byCountry->find('.thumbnail-item__wrap') as $ele){



	  			$fichero = 'sql/camaras_'.$key.'_'.$fecha.'.sql'; 
				//$ficheroError = 'sql/camarasError_'.$key.'.txt'; 

		  		echo "<br>".$j++."--- >".$baseUrl.$ele->href."         ->".$urls;




		  		if($countPaginas == 1000){
		  			$numFile++;$countPaginas = 0;
		  		} 
		  		//echo $baseUrl.$ele->href;

		  		//tabworker($baseUrl.$ele->href,"_".$numFile);
		  		divworker($baseUrl.$ele->href,$fichero,$key);
		  		
		  		$countPaginas++;
		  		//break;
	  		}
	  		//if ($i >2) break;

		}
}


/*

for($p=0;$p<count($pais);$p++){//pais
	//echo "<br>otro pais <br>";
	for($i=1;$i<=$paginas;$i++){//pagina
	//	echo "<br>otra pagina <br>";
			$urls = "http://insecam.org/en/bycountry/".$pais[$p]."/?page=".$i;
			$byCountry = file_get_html($urls);
			//echo $urls."<br>";
	  	foreach($byCountry->find('.thumbnail-item__wrap') as $ele){
	  		echo "<br>".$j++."->".$baseUrl.$ele->href."   ->".$urls;
	  		
	  		if($countPaginas == 1000){
	  			$numFile++;$countPaginas = 0;
	  		} 

	  		worker($baseUrl.$ele->href,"_".$numFile);
	  		$countPaginas++;

	  	}
	  	
		}
	}

?>
