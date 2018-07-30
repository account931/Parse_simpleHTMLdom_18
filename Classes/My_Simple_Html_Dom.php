<?php
//https://ruseller.com/lessons.php?rub=37&id=639
include('Library/simpleHTMLdom/simple_html_dom.php');	 //include Library

 class My_Simple_Html_Dom
 {
	
	//simple example finds all links
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public static function runDom()
	{
	                      
					      $myHtml = new simple_html_dom(); //creates object of Library, included in ('Library/simpleHTMLdom/simple_html_dom.php');
                          
                          // Load file from http://, it uses file_get_contents, so if it is not working, use CURL and load result to {$html->load($result);}
                          //$html->load_file('https://code.tutsplus.com/');
						  
						  //CURL
						  $url = 'https://code.tutsplus.com/';  //https://code.tutsplus.com
                          $myCurl = curl_init();
                          curl_setopt($myCurl, CURLOPT_URL, $url);
                          //curl_setopt($myCurl, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurl, CURLOPT_SSL_VERIFYPEER, false);
                          $result = curl_exec($myCurl);
                          curl_close($myCurl);
						  //END CURL
						  
						  
						  $myHtml->load($result);
						  //$single = $myHtml->find('#foo', 0);
						  $collection = $myHtml->find('a'); //finds all <a href>
						  echo $myHtml->save();
						  
						  
						  
						  
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
	
    public static function parseAtricles()
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
          $items = $html->find('div[class=article_rubric_top]');    //article article_rubric_top   article__title   //col__main partition  //article_top
		  //echo $html->save(); //will dispaly the whole page to div
		  //echo $items;
    
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

   
   
   
   
   //getArticles('https://korrespondent.net/ukraine/');
   
   
   

    
	
	
	}
		
		
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************	
		
		
		
		
}






?>