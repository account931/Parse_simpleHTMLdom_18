App to parse web
 
 How it works:
1.Uses Library Php simpleHTMLdom, shoul include one fille to work ->  simpleHTMLdom/simple_html_dom.php
2. Logic located in Classes/My_Simple_Html_Dom.php. This Class includes methods:
   2.1 function findAllLinksAndImages($targetURL), finds images and urls, works onClick only (enter desired URL in input)
   2.2 function parseKorrespondentAtricles(), gets news articles from korrespondent.net, disabled, in order to turn on, uncomment it in index.php in section {result2 Korrespondent.net}
   2.3 function parseWazeCannedResponse($myURL, $myTargetDiv, $arrayOfNodes), gets CR from waze.zzz.com.ua/support, it is going to be configurable
   
   
   
   //-----------------------------------------------------------
   
How it generally simpleHTMLdom Library works
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