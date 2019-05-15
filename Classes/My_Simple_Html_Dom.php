<?php
//namespace Some\Path\To\Controller;

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
		
		
	




	
	
	
 // Checks is argument contains{()}, we will use it later in loop to decide whethre to imply eval() or not 
	 function checkIfArgumentIsMethod($item)
     { 
	    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    //return true;// decomment this line FOR 000webhost ONLY, as this method cause error on 000webhost!!!!!!!!!!!!!!!!!!!!!!!
		
	   //foreach($item as $x){
		   if (preg_match("/[(].*[)]/i", $item)) {  // if there is (),it may contain something inside or not (.*), ie it will match () and (2)
                echo "FOUND MATCH!!!!<br>";
			    //$result = substr($item, 0,-2);
				//echo "CUT-> " . $result;
				return true;
			
           } else {
              echo "Not found<br>";
			   //$result = $item;  //return without change
			   return false;
           }
	   //}
	       //return $result;
   }
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
	
	




	
	
	


    //<!------------------------------------------------THE MOST CORE FUNCTION------------------------------------------------->
	
	
	
	
	
	

    // THE MOST CORE UNIVERSAL FUNCTION -> gets infro from anywhere, just call it with 3 relevant arguments, here we get Crs from http://waze.zzz.com.ua/support/web/
	//designed to get/display 2 elements
	//Example how to use
	//new My_Simple_Html_Dom()->myCoreFunctParseAnyResource('http://waze.zzz.com.ua/support/web/',  'div[class=accordion] h4',  array('plaintext', 'next_sibling')  );
	//new My_Simple_Html_Dom()->myCoreFunctParseAnyResource('https://korrespondent.net/ukraine/',  'div[class=article_rubric_top]',  array('children', 'children')  );  
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public function myCoreFunctParseAnyResource($myURL, $myTargetDiv, $arrayOfNodesToGet )  //$arrayOfNodesToGet=array('plaintext', 'plaintext')
	//arguments($myURL = url to parse, $myTargetDiv = what div to find for start parsing, $arrayOfNodesToGet = from what web page's nodes  we have to parse content and add it to array)

	{
		
		$array_with_allParsedData = array(); //array that will store all found CRs
		
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
                          echo '<h4>It took simpleHTMLDom Library <span class="red">' . $info['total_time'] . ' seconds </span> to proccess url <span class="red"> ' . $info['url'] . "</span></h4><br>";
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
		  echo "Found " /* h4 inside div[class=accordion] h4 */ . $myTargetDiv .  " => " . count($items_CR) . "<br>";  
 
 
          //adds to array CR header + CR   //$articles = ( array("head1", "CR1"), array("head2", "CR2") );
		  //we found and save to variable {$items_CR} all <h4> inside <div class='accordion'>
		  //CR's have structure <div class='accordion'> <h4>Head</h4> <p>text</p> </div>, so we add to array $array_with_allParsedData[] a new array with 2 elements($post(i.e <h4> content), $post->next_sibling()(i.e <p> following the <h4>)),
          
		 /////!!!!!! RETURN, below is used without 3rd argument in function
		 /*
		  foreach($items_CR as $post) {
             $array_with_allParsedData[] = array($post->plaintext ,  //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}
                                    $post->next_sibling() );   //$post->children(6)->first_child()->outertext
         }
         */

		   //just for information
		   $v = '$post->' . $arrayOfNodesToGet[1];
		   echo "second => " . $arrayOfNodesToGet[1] . " - " . $v  . "<br><br><br><br>";
		   
		   
		   
		   
		   
		    //BIG LOOP START !!!!!!!!!!!!
		   //if use 3rd function argument $arrayOfNodesToGet[]
		   for($i = 0; $i < count($arrayOfNodesToGet); $i++){  //count($arrayOfNodesToGet)   //for($i = 0; $i < count($arrayOfNodesToGet); $i++)
			   $counter = $i + 1;
			   $int = settype($counter,'integer');  //MUST set  to int as it'll crash
			   
			   //check if a 3rd argument array contains a method with ()
			   //$this->checkIfArgumentIsMethod($arrayOfNodesToGet[$int]);  //crash without $this->
			   
			   
			    //add parsed data to array {$array_with_allParsedData[]}                                             
		       foreach($items_CR as $post) {   
			   
			   ///screw
			   /*
			    $s = '$post->' . $arrayOfNodesToGet[1];  
			    $j = $post->next_sibling(); // $post->$arrayOfNodesToGet[$int];  echo "eval- > ". $s . "<br>";
			    $number = '$post->'.$arrayOfNodesToGet[$int];
                echo 'NN -> '.eval('return '. $number.';') . "<br>";  
				*/
			   //screw
			   
			   
			      //checking if we have to apply eval to array elem, i.e if it contains {()}, if not returns without eval()
				  $subArrayWithNodes = array();  //a subarray which will be added to $array_with_allParsedData[] in order to keep structure $array=(array(x,y..), array(x,y..))
			      for($ix = 0; $ix < count($arrayOfNodesToGet); $ix++){
			          if($this->checkIfArgumentIsMethod( '$post->'.$arrayOfNodesToGet[$ix])){  //if {()} is found
					      $nodes1 = eval('return '. '$post->'.$arrayOfNodesToGet[$ix].';'  );
					  } else {
						  //if {()} is NOT found, return without changes
					      $nodes1 = $post->$arrayOfNodesToGet[$ix];
						  echo "<br> IT-> ".$nodes1;
				     }
					 
                     array_push($subArrayWithNodes, $nodes1); //$subArrayWithNodes[] = $nodes1;		//$subArrayWithNodes = [x, y, etc]	, length depends on	count($arrayOfNodesToGet) 
				  }
				
			   
			          //array with parsed data, add to final array subarray with $arrayOfNodesToGet arguments. Final structure will be -> $array=(array(x,y..), array(x,y..))
                      $array_with_allParsedData[] = //array( 
				                $subArrayWithNodes; //$nodes1 , //eval('return '. '$post->'.$arrayOfNodesToGet[$i].';'  ),      // i.e $post->plaintext //$post->$arrayOfNodesToGet[$i]
                                //eval('return '. '$post->'.$arrayOfNodesToGet[$int].';')    //$post->$arrayOfNodesToGet[$int] // i.e $post->next_sibling()  //mega ERROR, {$post->$arrayOfNodesToGet[1]} DOES NOT WORK ->add{()}
				  	  /* ); */
					
				  //}
			  
				   //MEGA TOUGHEST PART -> should use {eval('return '. '$post->'.$arrayOfNodesToGet[$int].';')} instead of {$post->$arrayOfNodesToGet[$int]}, 
				   // as 2nd variant will crash if the 3rd argument in function is with(), i.e array('plaintext', 'next_sibling()')
					
                   //explain for above-> e.g <h4>content = $post, to get next tag after <h4> = $post->next_sibling(), to get 1st<p> inside<h4> = $post->children(0), to get <span> in <h4><p><span></span></p></h4> = $post->children(6)->first_child()
				   //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}										   
				   //$post->children(6)->first_child()->outertext
										   
               }    
		   } //end for
		  
		  
		  
		  
		  	//var_dump($array_with_allParsedData);
		
		
		
		  
		  
		  
		  //var_dump($array_with_allParsedData);
		  
		  
		  
		  
          //Display CR results to Div from array $array_with_allParsedData, designed for structure $array=(array(x,y..), array(x,y..))
		  for($i = 0; $i < count($array_with_allParsedData); $i++){  //iterats over found lements legth
          //foreach($array_with_allParsedData as $item) {
			  
			  //adds a  distance between 2 blocks
			  //if($i%2==0){
				  echo " <br> <br> ";
			 // }
			 
			 
			 
			  
			  for($k = 0; $k < count($arrayOfNodesToGet); $k++){    //iterats over 3rd argument length
			       //adds border to evert second subblock, a d we we removed formatting
			       if(!$k%2==0){  //if its the 2nd add style with border
				       $style = "style='border:1px solid black; padding:10px;'";
			       } else {
				       $style = "style=''";
			       }
			 
			       //check if aarray elem exists, was mostle done for testing, as prev array[x][1] was empty
			      if(isset($array_with_allParsedData[$i][$k])){
                      echo "<p " . $style . ">" . $array_with_allParsedData[$i][$k] . "</p>";
                      //echo $array_with_allParsedData[$i][1] .   "</p><br>";
				  } else {
					  echo "<p> I am empty</p>"; 
				  }
			  }
			   
	      }		  
		//END Display CR results to Div from array $array_with_allParsedData, designed for structure $array=(array(x,y..), array(x,y..))
		
		
				
		  // checks if next page button exists
		  /*
          if($next = $html->find('li[class=next]', 0)) {
                $URL = $next->children(0)->href;
                echo "going on to $URL <<<\n";
                # подчищаем утечки памяти
                $html->clear();
                unset($html);
                $this->myCoreFunctParseAnyResource('http://waze.zzz.com.ua/support/web/',  'div[class=accordion] h4',  array('plaintext', 'next_sibling')  );
          }
	      */
		  
		  
		  
		 //Save array with parsed data to CVS file
		 $CVS = new My_CVS_Save();
		 $CVS->save_to_CVSfile($array_with_allParsedData, "cvs_files/contacts.csv", count($arrayOfNodesToGet) ); //count($arrayOfNodesToGet)-> how many elem every subarrays (array lenghth of argument $arrayOfNodesToGet passed in myCoreFunctParseAnyResource() ) 
		  //explaination is in Classes/My_CVS_Save.php
		  
		  
	
	}
		
		
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************	
	//MOST CORE UNIVERSAL FUNCTION -> gets infro from anywhere,	




		
		
		public function b(){
	
		}
		
		
		
		
		
		


  //-- simpleHTMLDom Library sample Without Function procedures--------------------------------------------------------------------------------------
  /*
  echo "<h2> Sample without function</h2>";
  $array_with_allParsedData = array(); //array that will store all found CRs
		
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
		  //CR's have structure <div class='accordion'> <h4>Head</h4> <p>text</p> </div>, so we add to array $array_with_allParsedData[] a new array with 2 elements($post(i.e <h4> content), $post->next_sibling()(i.e <p> following the <h4>)),
          
		 /////!!!!!! RETURN, below is used without 3rd argument in function
		 
		  foreach($items_CR as $post) {
             $array_with_allParsedData[] = array($post->plaintext ,  //i.e <h4> content //use ->plaintext to remove image from content //use {->innertext()}to removes formatting, like borders // was {$post->children(1)}, here we take just {$post}, h4 content itself a sit was found in {->find('div[class=accordion] h4')}
                                    $post->next_sibling() );   //$post->children(6)->first_child()->outertext
         }
         

		   
          //Display CR results to Div
          foreach($array_with_allParsedData as $item) {
            echo "<p>" . $item[0] . "<br>";
            echo $item[1] .   "</p><br>";
		  }
		
		*/
  //-- simpleHTMLDom Library sample Without Function procedures-----------------------------------------------------------------------------------------------------------


		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 


	
}






?>