<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Parse simpleHTMLdom</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  
	  <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html">
      <meta name="description" content="Train tracker" />
      <meta name="keywords" content="Train tracker">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  
      <script src="js/myParser_core.js"></script><!--  Core Parse JS-->  
	  <link rel="stylesheet" type="text/css" href="css/myParserStyle.css"> 
	  <script src="js/changeStyleTheme.js"></script><!--  change wallpapers,changeStyleTheme JS-->
	 
      
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Icon lib-->
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- GOOGLE Icon lib-->
	  
	  
	  
	  <!--Favicon-->
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

  </head>
  <body>
  
  
  
  
  
  
  
  
  
  
  
  
  
   <div id="headX" class=" text-center  colorAnimate head-style"> <!--#2ba6cb;   myShadow-->
	   
         <h1 id="h1Text">
             <img id ="wLogo" class="shrink-large" src="">	 
		     <span id="textChange" class="textShadow">simpleHTMLdom Library</span> 
			 <i class="material-icons " style="font-size:66px; color:;position:relative; top:20px;margin-left:1%;">pan_tool</i>
		     
			 <img id ="wLogo2" src="" style="width:44%;"/>
			 <br>
			 <?php date_default_timezone_set("Europe/Kyiv"); ?>
			 
			 
		 </h1> 
		   
           <!--<p class="header_p">All cities weather processor</p>-->  <!--generates random lists, ramdomizes integers, etc--> <!--<span class="glyphicon glyphicon-duplicate"></span>-->  
	   </div>
	   
	 



         <br>
		 <!--<div class="item contact padding-top-0 padding-bottom-0" id="contact1">-->
         <div class="wrapper grey">
    	     <div class="container">
		   
		   
		         <!--------------------FORM----------------------------->
		         <div class="col-sm-12 col-xs-12  mainX head-style" style="background-color:;">  <!-- myShadow -->
				    <i class="	fa fa-bell-slash-o" style="font-size:40px"></i>  &nbsp;&nbsp; <br><br>
				 
				    <form class="form-inline" action="">
                          <div class="form-group">
						      <label for="usr">URL:</label>
                               <input type="text" id="myURLInput" value="" placeholder="your URL" size="18" class="form-control"/><!-- enter URL to parse--> 
  
		                       <input type="button" value="Get <img>/<a href>" id="doParse" class="btn"/>							 
                          </div>
					</form>		        	   
			     </div> <!--END  <div class="col-sm-4 col-xs-12 myShadow mainX-->
				<!-----------------END FORM----------------------------->
				 
				 
				 
				 
				 <!-- JUST parse image-->
				 <div class="col-sm-12 col-xs-12 parse-image" id="">
				      <center>
				      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvSyTcqK0dJk37RkfpTBZ2JkXNHU5fcZ_egHGXAVsHXBD428-y" alt="img"/>
					  </center>
				 </div>
				  
				  
				  
				  
				  
				  
				  <!----------------------------------------Parse  result_1, find all Links-------------------------------------------------->
				  
				  <div class="col-sm-12 col-xs-12 myShadow" id="trainResult" > <!-- div calc exchange-->
				  
				      <?php
					      //include('Classes/My_Simple_Html_Dom.php');  //delegated to autoload.php 
						  include('Classes/autoload.php');
						  echo "<h2> Find all links</h2>";
						  //Method to find all links
					      //My_Simple_Html_Dom::findAllLinksAndImages('https://code.tutsplus.com/');  //works!!!
					  ?>
				  </div> <!-- END class="row trainResult">-->
				  <!----------------------------------------Parse  result------------------------------------------------>
				  
				  
				  
				  
				  
				  
				  
				  
				  <!--------------------------------------Parse  result2 Korrespondent.net----------------------------------------------------->
				  
				  <div class="col-sm-12 col-xs-12 myShadow" id="trainResult2" > <!-- div calc exchange-->
				  
				      <?php
					     echo "<br><br></br><h2><center>Get articles from https://korrespondent.net/ukraine/</center></h2><br>";
						 //Method to get articles from Korrespondent
					     //My_Simple_Html_Dom::parseKorrespondentAtricles();  //works!!!
					  ?>
				  </div> <!-- END class="row trainResult">-->
				  <!---------------------------------------Parse  result2-------------------------------------------------------------------->
				  
				  
				  
				  
				  
				 <!------------------------------------Parse Core UNIVERSAL FUNCTION result3 http://waze.zzz.com.ua/support/web ------------------------------------>
				  
				  <div class="col-sm-12 col-xs-12 myShadow" id="trainResult3" > 
				  
				      <?php
					     echo "<br><br></br><h2><center>http://waze.zzz.com.ua/support/web</center></h2><br>";
						 //Method to get CR's from http://waze.zzz.com.ua/support/web/
						 $library = new My_Simple_Html_Dom();
					     $library->myCoreFunctParseAnyResource('http://waze.zzz.com.ua/support/web/',  'div[class=accordion] h4',  array('plaintext', 'next_sibling()')  );
						 //$library->b();
						
						 
						 //working Korrespondent example below, just have to fix in {foreach($items_CR as $post) { array( $post->$arrayOfNodesToGet[$i] +(0) ,$post->$arrayOfNodesToGet[$int](2) }
						 //$library->myCoreFunctParseAnyResource('https://korrespondent.net/ukraine/',  'div[class=article_rubric_top]',  array('children(0)', 'children(2)')  );  
						 
					  ?>
				  </div> <!-- END class="row trainResult">-->
				  <!---------------------------------------------------Parse Core result3-------------------------------------------------------------------->
				  
				  
				           
				  
				  
				  
				  
				  
				 
				  
				  
				  
				 
				 <!--<br><br><br><br><br><br><br><br><br><br><br>-->
				 <!-------------------------------FACEBOOK SHARE--------------------------------------->
				 <!-- my custom FB share-->
				 <!--
				 <div class="col-sm-12 col-xs-12 facebook>
				     
					 <center>
                         <a class="fb-share-button large" href="https://www.facebook.com/sharer/sharer.php?u=http://waze.zzz.com.ua/store_locator" target="_blank"><input type="button" value="MyShare" style="background:blue;padding:5px 20px 5px 20px;color:white;border-radius:20px;"/></a>
				    
					     <div class="fb-share-button large" 
                             data-href="=https://www.facebook.com/sharer/sharer.php?u=http://waze.zzz.com.ua/store_locator" 
                             data-layout="button_count">
                         </div>
					</center>
				 </div>--><!-- END <div class="col-sm-4 col-xs-12 facebook>-->
				 
                 <!-----------------------------END FACEBOOK SHARE--------------------------------------->                  
     
    	     </div><!-- /.container -->			  		
    	 </div><!-- /.wrapper -->
      <!--</div>-->   <!-- /.item -->
	  
	     <div style="height:277px;"></div><!-- just to press footer-->
                

       
		<!---------PAGE LOADER SPINNER START, visible while the page is loading, uses js/main_layout.js, css is in yii2_mine.css--------------->
	    <div id="overlay" class="col-sm-12 col-xs-12 myShadow">
		    <center>
		        <img src="images/spinner.gif" alt="" style="width:33%;"/>
			</center>
        </div>
        <!---------END PAGE LOADER SPINNER------------------------------------------------------------------------------------------------------>
	
	
	
		
		
		  <!-----Footer ---->
		        
				<div class="footer"> <!--navbar-fixed-bottom  fixxes bootom problem-->
				    <!--Contact: --> <strong>dimmm931@gmail.com</strong><br>
					<?php  echo date("Y"); ?>
				</div>
		<!--END Footer ---->  
		
		
		
	
		
		
  
  
  
  
  
  
  
  
  
       <!-----------------  Button to change Style theme------------------------->
	   <input type="button" class="btn" value=">>" id="changeStyle" style="position:absolute;top:0px;left:0px;" title="click to change theme"/>
	   <!-----------------  Button to change Style theme------------------------->
  
      
	   <!-----------------  Button with info------------------------------------>
	   <!--data-toggle="modal" data-target="#myModalZ" is a Bootstrap trigger---->
	   <button data-toggle="modal" data-target="#myModalZ" class="btn" style="font-size:17px; position:absolute;top:0px;right:0px;" title="click to see info">
	       &nbsp;<i class="fa fa-info-circle"></i>&nbsp;
	   </button>    
	   <!-----------------  Button with info------------------------------------>
  
  
  
  
  
  
      <!-----------------  Modal window with info------------------------------>
      <div id="myModalZ" class="modal fade" role="dialog">
          <div class="modal-dialog">
          <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">About simpleHTMLdom </h4>
                  </div>
                  <div class="modal-body">
				      <center>
				      
                      <p>
					     Uses simpleHTMLdom
					  </p>
					  </center>
                  </div>
                  <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>

         </div>
     </div>
      <!-----------------  END Modal window with info---------------------------->
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 
 <!----------------------- FB API  share---------------------->
 <center><br><br>
  
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your share button code -->
<!--
  <div class="fb-share-button large" 
    data-href="=http://waze.zzz.com.ua/store_locator/" 
    data-layout="button_count">
  </div>
  -->
  <!----------------------- END FB API  share---------------------->

 <br>
 
 
 

 

</body>
</html>