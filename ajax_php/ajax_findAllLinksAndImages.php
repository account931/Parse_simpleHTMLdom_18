<?php
//session_start();
//https://ruseller.com/lessons.php?rub=37&id=639
//http://simplehtmldom.sourceforge.net/manual.htm  - list of selectors

//include('../Classes/My_Simple_Html_Dom.php');
include('../Library/simpleHTMLdom/simple_html_dom.php');










 //gets all <img><a> for URL from your input, triggered by js/myParse-core.js with function {contact_php_findAllLinksAndImages()}
 function findAllLinksAndImages($targetURL)  //$targetURL is your input, sent from ajax by js/myParse-core.js with function {contact_php_findAllLinksAndImages()}
 {
	                      
					      $myHtml = new simple_html_dom(); //creates object of Library, included in ('Library/simpleHTMLdom/simple_html_dom.php');
                          
                          // Load file from http://, it uses file_get_contents, so if it is not working, use CURL and load result to {$html->load($result);}
                          //$html->load_file('https://code.tutsplus.com/');
						  
						  //CURL---------
						  //$url = 'https://code.tutsplus.com/';  //https://code.tutsplus.com
                          $myCurl = curl_init();
                          curl_setopt($myCurl, CURLOPT_URL, $targetURL);
                          //curl_setopt($myCurl, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurl, CURLOPT_SSL_VERIFYPEER, false);
                          $result = curl_exec($myCurl);
                          curl_close($myCurl);
						  //END CURL------
						  
						  
						  $myHtml->load($result); //load s result from curl
						  //$single = $myHtml->find('#foo', 0);
						  $collectionURL = $myHtml->find('a'); //finds all <a href>
						  $collectionImages = $myHtml->find('img'); //finds all <a href>
						  //echo $myHtml->save(); //echo whole web page
						  
						  //loop through array of found links
						  foreach($collectionURL as $links){
							  echo $links . '<br>';  //text of Link
							  echo $links->href . '<br><br>';  //href of link
						  }
						  
						  //loop through array of found images
						  foreach($collectionImages as $links2){
							  echo $links2 . '<br>';  //text of Link
							  echo $links2->src . '<br><br>';  //href of link
						  }
						  
						  
						  /*
						  // Загрузка из строки
                          $html->load('<html><body><p>Hello World!</p><p>We re here</p></body></html>');
						  $element = $html->find("p");
                          // модифицируем его
                          $element[1]->innertext .= " and we're here to stay.";
                          //Выводим
                          echo $html->save();
						 */
					 
	      
	}








                         //gets all <img><a> for URL from your input, call the function
                         findAllLinksAndImages($_POST['serverUrl']);



 ?>