<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	require_once("simple_html_dom.php");
       
$pag = 1;
$pais = 'IT';
$urls = "http://www.insecam.org/en/bycountry/IT/?page=2";
//$urls = "http://www.insecam.org/en/bycountry/IT/?page=2"
$urlFinal = "";
$htmlFinal= "";
$paginas = "";
	



$view = "http://www.insecam.org/en/view/";

	//$htmlNode = new simple_html_dom_node(); 
	$mapCity = "insecam.html";
	$htmlCity = file_get_html($mapCity);





	  	foreach($htmlCity->find('a') as $element){
	  		///echo $element->href. " - " .$element->plaintext ;
	  		preg_match('#\((.*?)\)#', $element->plaintext, $match);
			//print $match[1];
			
			$paginas = trim($match[1]);
	  		echo " Paginas: " . $paginas;
	  		echo '<br>';
	  		
	  			for($pag =1;$pag<2;$pag++){
				  	$urlFinal = "http://www.insecam.org/en/bycountry/".$pais."/?page=".$pag; 
				  //	echo '-----'.$urlFinal.'<br>';
				  	$html = file_get_html($urlFinal);

				  	//thumbnail
				  	//buscamos solo los links, para obtener los view
				  	//foreach($html->find('a') as $a){

				  	foreach($html->find('a[href^="/en/view"]') as $a){
						//
				  		//$links[] = $a->href;
				  		//echo 'links: <textarea>' .count($links). '</textarea><br>';
				  		echo ' thumbnail <textarea >'.$a . '</textarea>...<br>';
				  		//echo ' thumbnail '.$element->find('a')->href . '<br>';
			  		}

				  	foreach($html->find('img') as $element){
				  		//tamos dentro de la pagina
				  		echo '----------'.$element->src . '<br>';
				  	}




				}
				

	  	
	  	}


echo '<br>';echo '<br>';echo '<br>';echo '<br>';



	

$view = "http://www.insecam.org/en/view/335499/";





$text = 'ignore everything except this (text)';
preg_match('#\((.*?)\)#', $text, $match);
//print $match[1];
//$title 	= preg_replace('\[(.*?)\]', '( asdasd )',$title);


//http://www.insecam.org/en/mapcity/


/*

<img id="image3352881" src="http://216.41.250.81:80/cgi-bin/camera?resolution=640&amp;amp;quality=1&amp;amp;Language=0&amp;amp;COUNTER" class="thumbnailimg" title="View PanasonicHD CCTV IP camera online in United States, Bluff City" alt="">

*/

?>


