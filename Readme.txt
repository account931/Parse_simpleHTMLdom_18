App to parse web content

# function myCoreFunctParseAnyResource($myURL, $myTargetDiv, $arrayOfNodesToGet ) is CORE UNIVERSAL, gets info from anywhere, just call it with 3 relevant arguments
# myCoreFunctParseAnyResource arguments($myURL = url to parse, $myTargetDiv = what div to find for start parsing, $arrayOfNodesToGet = from what web page's nodes  we have to parse content and add it to array)
# Examples to call function//Example how to use
	//new My_Simple_Html_Dom()->myCoreFunctParseAnyResource('http://waze.zzz.com.ua/support/web/',  'div[class=accordion] h4',  array('plaintext', 'next_sibling()')  );
	//new My_Simple_Html_Dom()->myCoreFunctParseAnyResource('https://korrespondent.net/ukraine/',  'div[class=article_rubric_top]',  array('children(0)', 'children(2)')  );

	
//-----------------------------------------------------------

 General informaion:
1.Uses Library Php simpleHTMLdom, shoul include one fille to work ->  simpleHTMLdom/simple_html_dom.php
2. Logic located in Classes/My_Simple_Html_Dom.php. This Class includes methods:
   2.1 function findAllLinksAndImages($targetURL), finds images and urls, works onClick only (enter desired URL in input)
   2.2 function parseKorrespondentAtricles(), gets news articles from korrespondent.net, disabled, in order to turn on, uncomment it in index.php in section {result2 Korrespondent.net}
   2.3 
   
   
   
   
   
   
   
   
//-------------------------------------------------------------------
 How function myCoreFunctParseAnyResource($myURL, $myTargetDiv, $arrayOfNodesToGet ) works.
 1. Function is designed to get info(content) from 2 nodes(elements), which are added to 2-elements array $array_with_allParsedData[], and therefore display/echo arr[1] and arr[2] data to <div>
 2. Function accepts 3 arguments ($myURL = url to parse, $myTargetDiv = what div to find for start parsing, $arrayOfNodesToGet = from what web page's nodes  we have to parse content and add it to array)
 
 77. The Mega Error happened during pushing parsed values to $array_with_allParsedData[], as 3rd function argument $arrayOfNodesToGet is an array and it except 2 elements(i.e parsing path) either ending in {()} or not/ E.g ['plaintext', 'next_sibling()'].
  If arr[element] did not contain (), it goes OK, but arr[elem] with () were treated as strings not as methods {'$post->next_sibling()'}.
  The solution was to use eval for both elemenents with or without {()}. To get {$post->next_sibling()} instead of  {$post->$arrayOfNodesToGet[$int]} I used {eval('return '. '$post->'.$arrayOfNodesToGet[$int].';'}





   
   
   
   
   
//-----------------------------------------------------------
   
How generally simpleHTMLdom Library works
1. include simpleHTMLdom/simple_html_dom.php
2. $html = new simple_html_dom();
2. Use $html->load_file($url) to load page, it uses file_get_contents() and if it does not work due server settings use cURL to get the sane result2
                          $myCurlX = curl_init();
                          curl_setopt($myCurlX, CURLOPT_URL, $page);
                          //curl_setopt($myCurlX, CURLOPT_POST, 1);  // $_POST['']
                          //curl_setopt($myCurlX, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); //sends $_POST['']
                          curl_setopt($myCurlX, CURLOPT_RETURNTRANSFER, true);
                          curl_setopt($myCurlX, CURLOPT_SSL_VERIFYPEER, false);
                          $resultX = curl_exec($myCurlX);
                          curl_close($myCurlX);
						  
3. Load cURL result -> $html->load($resultX);
4. Find necessary start tag point -> $items = $html->find('div[class=article_rubric_top]'); 
5. Add to your array $articles desired text(in this example add 2 values)->
                          foreach($items as $post) {
                          $articles[] = array($post->children(0) ,
                                  $post->children(2) );   //$post->children(6)->first_child()->outertext
                          }
6. Display array $articles with loop->
                          foreach($articles as $item) {
                              echo "<p>" . $item[0];
                              echo $item[1] .   "</p><br>";
	                      }
						  
7. I f u want to display the whole parsed page use -> /echo $html->save();



//------------------------------------------------------------------------------------