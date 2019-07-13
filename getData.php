<?php

    include('connection.php');
	include('simple_html_dom.php');
	
    $url = $_POST['url'];
	$html = file_get_html($url);
	$title = $html->find('title', 0)->plaintext;
	
    $description = $html->find('meta[name="description"]', 0);
 
    if($description == ""){
		
		$description = $html->find('meta[name="Description"]', 0);
		if($description == ""){
			$description = "";
		}else{
			$description = $description->getAttribute("content");
		}
		
		
	}else{
		
		$description = $description->getAttribute("content");
	}

	$pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
	
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
	  
         $domain_name = $regs['domain'];
	
     }
	 
	 $get_rank_url = 'http://data.alexa.com/data?cli=10&url='.$domain_name;
	 
	 $html = file_get_html($get_rank_url);
	 $rank = $html->find('REACH', 0)->getAttribute("rank");
	 
	 $data['title'] = $title;
	 $data['description'] = $description;
	 $data['rank'] = $rank;
	 
	 echo json_encode($data);
	 exit;
?>