<?php

//https://ruseller.com/lessons.php?rub=37&id=639
//http://simplehtmldom.sourceforge.net/manual.htm  - list of selectors


//Have some issue here with {findAllLinksAndImages()} if it si called onLoad from index.php, so it configured to work from ajax, not work onload 

include('Library/simpleHTMLdom/simple_html_dom.php');	 //include ORIGINAL simpleHTMLdom Library Library


 class My_Simple_Html_Dom
 {
	
	//simple example finds all links- NOT USED AS TRANSFERED TO AJAX, ajax_php/ajax_findAllLinksAndImages.php
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public static function findAllLinksAndImages($targetURL)
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
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
	
	
	
	
	
	
	
	// Core -> gets  news from korrespondent.net
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public static function parseKorrespondentAtricles()
	{
		# глобальный массив, который будет заполняться информацией статьи
        $articles = array();

        # передаем первую страницу на парсинг, до последней он доберется сам
        //getArticles('https://korrespondent.net/ukraine/');

     
        //$page = 'https://korrespondent.net/ukraine/'; //mine for function

      function getArticles($page) {
          global $articles, $descriptions;
    
          $html = new simple_html_dom();
          //$html->load_file($page); //file_get_content crashes, use CURL and then {$myHtml->load($resultX);}
		  
		  //CURL------------
						  
                          $myCurlX = curl_init();
                          curl_setopt($myCurlX, CURLOPT_URL, $page);
                          //curl_setopt($myCurlX, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurlX, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurlX, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurlX, CURLOPT_SSL_VERIFYPEER, false);
                          $resultX = curl_exec($myCurlX);
                          curl_close($myCurlX);
		  //END CURL----------
		  
          $html->load($resultX);
          $items = $html->find('div[class=article_rubric_top]');    
		  //.article article_rubric_top   .article__title   //.col__main partition  //.article_top
		  //echo $html->save(); //will dispaly the whole page to div
		  //echo $items;
    
	     //adds to array news header + news   //$articles = ( array("head1", "news1"), array("head2", "news2")
         foreach($items as $post) {
             $articles[] = array($post->children(0) ,
                                  $post->children(2) );   //$post->children(6)->first_child()->outertext
         }
		 
		 //var_dump($articles);
		 //test
		 /*
		 $articles22 = array();
		 $articles22 = [array("item1", "item2")];
		 */
		 
		 /*
Это суть функции getArticles. Нужно разобраться более детально, чтобы понять, что происходит.

Строка 1: Создаем массив элементов – тег div с классом preview. Теперь у нас есть коллекция статей, сохраненная в $items.

Строка 4: $post теперь ссылается на единичный div класса preview. Если мы взглянем в оригинальный  HTML, то увидим, что третий элемент потомок - это тег H1, который содержит заголовок статьи. Мы берем его и присваиваем $articles[index][0].

Помните о начале отсчета с 0 и учете комментариев исходного кода, когда будете определять правильный индекс узла.

Строка 5: Шестой потомок $post - это <div class=”text”>. Нам нужен текст описания из него, поэтому мы используем outertext – в описание будет включен тег параграфа. Единичная запись в массиве статей будет выглядеть примерно так:
		 */
         
		 
		/* 
        # посмотрим, есть ли следующая страница
        if($next = $html->find('a[class=nextpostslink]', 0)) {
            $URL = $next->href;
            echo "going on to $URL <<<\n";
            # подчищаем утечки памяти
            $html->clear();
            unset($html);
        
            getArticles($URL);
        }
		*/
		
		
		//display new thread from Korrespondent
	    //echo "<h1>" . $articles[1] . "<h1><br><br>";
	
	    foreach($articles as $item) {
            echo "<p>" . $item[0];
            echo $item[1] .   "</p><br>";
	    }
	
   } // end function

   
   
   
   
   getArticles('https://korrespondent.net/ukraine/');
   
   
   

    
	
	
	}
		
		
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************	
	//End gets  news from korrespondent.net	
		
		
	










    //<!------------------------------------------------CORE FUNCTION------------------------------------------------->
	
	
	
	
	 function checkIfArgumentIsMethod($item)
     {
	   //foreach($item as $x){
		   if (preg_match("/[(][)]/i", $item)) {  // if there is ()
                echo "FOUND MATCH!!!!";
			    //$result = substr($item, 0,-2);
				//echo "CUT-> " . $result;
				return true;
			
           } else {
               echo "Not found";
			   $result = $item;  //return without change
			   return false;
           }
	   //}
	       //return $result;
   }
	
	
	

    // CORE FUNCTION -> gets infro from anywhere, here we get Crs from http://waze.zzz.com.ua/support/web/
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public function parseWazeCannedResponse($myURL, $myTargetDiv, $arrayOfNodes)
	//params(url to parse, $myTargetDiv = what div to find, $arrayOfNodes = of what nodes'content we have to add to array(NOT USED)
	{
		
		$wazeCannedR = array(); //array that will store all found CRs
		
		$html = new simple_html_dom();
        //$html->load_file($page); //if file_get_content crashes, use CURL and then {$myHtml->load($resultX);}
		  
		//$page= "http://waze.zzz.com.ua/support/web/";
		  
		  //CURL----------- 
                          $myCurlWaze = curl_init();
                          curl_setopt($myCurlWaze, CURLOPT_URL, $myURL);
                          //curl_setopt($myCurlWaze, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurlWaze, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurlWaze, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurlWaze, CURLOPT_SSL_VERIFYPEER, false);
                          $resultWaze = curl_exec($myCurlWaze);
						  
						  //printing cURL info (time and url) (must be before {curl_close($myCurlWaze);})
		                  $info = curl_getinfo($myCurlWaze);
                          echo 'Took ' . $info['total_time'] . ' seconds for url ' . $info['url'] . "<br>";
						  //close cURL
                          curl_close($myCurlWaze);
		  //END CURL----------
		  
		  
		  //Check if no error in Curl_exec
		  if ($resultWaze === FALSE) {
              echo "cURL Error: " . curl_error($ch);
          }
		  //END Check if no error in Curl
		  
		  

		  
		  
          $html->load($resultWaze);  //loads results from cuRL, if u can not use file_get_contents()
          //$items_CR = $html->find('div[class=accordion]');  //finds core parent div
		  $items_CR = $html->find( $myTargetDiv/* 'div[class=accordion] h4' */ );  //finds core parent div      
		  
		  //counts found <h4> inside <div class='accordion'>
		  echo "Found " /* h4 inside div[class=accordion] h4 */ . $myTargetDiv .  " => " . count($items_CR) . "<br><br><br>";  
 
 
          //adds to array CR header + CR   //$articles = ( array("head1", "CR1"), array("head2", "CR2") );
		  //we found and save to variable {$items_CR} all <h4> inside <div class='accordion'>
		  //CR's have structure <div class='accordion'> <h4>Head</h4> <p>text</p> </div>, so we add to array $wazeCannedR[] a new array with 2 elements($post(i.e <h4> content), $post->next_sibling()(i.e <p> following the <h4>)),
          
		 /////!!!!!! RETURN, below is used without 3rd argument in function
		 /*
		  foreach($items_CR as $post) {
             $wazeCannedR[] = array($post->plaintext ,  //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}
                                    $post->next_sibling() );   //$post->children(6)->first_child()->outertext
         }
         */

		   $v = '$post->' . $arrayOfNodes[1];
		   echo "second => " . $arrayOfNodes[1] . " - " . $v  . "<br><br>";
		 
		   //if use 3rd function argument $arrayOfNodes[]
		   for($i = 0; $i < count($arrayOfNodes); $i++){
			   $counter = $i + 1;
			   $int = settype($counter,'integer');  //MUST set  to int as it'll crash
			   
			   //check if a 3rd argument array contains a method with ()
			   //$this->checkIfArgumentIsMethod($arrayOfNodes[$int]);  //crash without $this->
			   
			   
			                                                   
		       foreach($items_CR as $post) { 
			       //array with parsed data
                   $wazeCannedR[] = array( $post->$arrayOfNodes[$i] ,    // i.e $post->plaintext

				                           $post->$arrayOfNodes[$int]()   ); // i.e $post->next_sibling()  //mega ERROR, {$post->$arrayOfNodes[1]} DOES NOT WORK ->add()
                                            //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}										   
										   //$post->children(6)->first_child()->outertext
										   
               }    
		   } 
		  
		  
		  //var_dump($wazeCannedR);
		   
          //Display CR results to Div
          foreach($wazeCannedR as $item) {
            echo "<p>" . $item[0] . "<br>";
            echo $item[1] .   "</p><br>";
	    }		  
		
		
	
	}
		
		
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************	
		






  //-- Without Function procedures--------------------------------------------------------------------------------------
  /*
  $wazeCannedR = array(); //array that will store all found CRs
		
   $html = new simple_html_dom();
        //$html->load_file($page); //if file_get_content crashes, use CURL and then {$myHtml->load($resultX);}
		  
   $page= "http://waze.zzz.com.ua/support/web/";
		  
		  //CURL----------- 
                          $myCurlWaze = curl_init();
                          curl_setopt($myCurlWaze, CURLOPT_URL, $page);
                          //curl_setopt($myCurlWaze, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurlWaze, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurlWaze, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurlWaze, CURLOPT_SSL_VERIFYPEER, false);
                          $resultWaze = curl_exec($myCurlWaze);
						  
						  //printing cURL info (time and url) (must be before {curl_close($myCurlWaze);})
		                  $info = curl_getinfo($myCurlWaze);
                          echo 'Took ' . $info['total_time'] . ' seconds for url ' . $info['url'] . "<br>";
						  //close cURL
                          curl_close($myCurlWaze);
		  //END CURL----------
		  
		  
		  //Check if no error in Curl_exec
		  if ($resultWaze === FALSE) {
              echo "cURL Error: " . curl_error($ch);
          }
		  //END Check if no error in Curl
		  
		  

		  
		  
          $html->load($resultWaze);  //loads results from cuRL, if u can not use file_get_contents()
          //$items_CR = $html->find('div[class=accordion]');  //finds core parent div
		  $items_CR = $html->find( 'div[class=accordion] h4' );  //finds core parent div      
		  
		  //counts found <h4> inside <div class='accordion'>
		  echo "Found h4 inside div[class=accordion] h4  => " . count($items_CR) . "<br><br><br>";  
 
 
          //adds to array CR header + CR   //$articles = ( array("head1", "CR1"), array("head2", "CR2") );
		  //we found and save to variable {$items_CR} all <h4> inside <div class='accordion'>
		  //CR's have structure <div class='accordion'> <h4>Head</h4> <p>text</p> </div>, so we add to array $wazeCannedR[] a new array with 2 elements($post(i.e <h4> content), $post->next_sibling()(i.e <p> following the <h4>)),
          
		 /////!!!!!! RETURN, below is used without 3rd argument in function
		 
		  foreach($items_CR as $post) {
             $wazeCannedR[] = array($post->plaintext ,  //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}
                                    $post->next_sibling() );   //$post->children(6)->first_child()->outertext
         }
         

			   
			                                                   
		       foreach($items_CR as $post) { 
			       //array with parsed data
                   $wazeCannedR[] = array( $post->plaintext ,    // i.e $post->plaintext
				                           $post->next_sibling()   ); // i.e $post->next_sibling()  //mega ERROR, {$post->$arrayOfNodes[1]} DOES NOT WORK ->add()
                                            //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}										   
										   //$post->children(6)->first_child()->outertext
										   
               }    
		   } 
		  

		   
          //Display CR results to Div
          foreach($wazeCannedR as $item) {
            echo "<p>" . $item[0] . "<br>";
            echo $item[1] .   "</p><br>";
	    }		  
		
		*/
  //-- End without Universal procedures-----------------------------------------------------------------------------------------------------------





	
}






?>