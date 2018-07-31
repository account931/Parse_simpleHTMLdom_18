$(document).ready(function(){
	
	
	$("#doParse").click(function() {   // $(document).on("click", '.circle', function() {   // this  click  is  used  to   react  to  newly generated cicles;
        
		contact_php_findAllLinksAndImages();
    });
	
	
	
	
	
	// Core action which sends ajax to Classes/My_Simple_Html_Dom/findAllLinksAndImages($targetURL)  onClick
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	function contact_php_findAllLinksAndImages() 
	{	
	
	    var inputX = $("#myURLInput").val();
		alert(inputX);
	
        // send  data  to  PHP handler  ************ 
        $.ajax({
            url: 'ajax_php/ajax_findAllLinksAndImages.php',
            type: 'POST',
			dataType: 'text', // without this it returned string(that can be alerted), now it returns object
			//passing the data
            data: { 
			    serverUrl: inputX,
				//serverFunct:"findAllLinksAndImages",
			},
            success: function(data) {
                // do something;
                //$("#weatherResult").stop().fadeOut("slow",function(){ $(this).html(data) }).fadeIn(2000);
			    //alert(data.city.name);
				$("#trainResult").stop().fadeOut("slow",function(){ $(this).html(data)}).fadeIn(2000);
            },  //end success
			error: function (error) {
				$("#trainResult").stop().fadeOut("slow",function(){ $(this).html("ERROR")}).fadeIn(2000);
            }	
        });
                                               
       //  END AJAXed  part 
	
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	// END Core action which includes getWeather(function (data), it is called onLoad and onClick
	
	
});
// end ready	
	