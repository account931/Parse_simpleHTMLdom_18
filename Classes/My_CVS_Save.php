<?php


//Save array with parsed data to CVS file
 class My_CVS_Save
 {
	
	//
	// **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // **                                                                                  **
	
    public static function save_to_CVSfile($arrayX, $pathToFile, $countX)  //(what array to write to cvs, to what file, how may elem in every subarray(in order this funct to be Universal))
	{
	                      
		 $file = fopen($pathToFile, "w");
          foreach ($arrayX as $line){
			   $lineFinale = "";
			   for($k = 0; $k < $countX; $k++){
			  
			       $lineFinale = $lineFinale . str_replace("," ,"/", $line[$k]) . ",";
			  
			       //replace {,} in parsed content $line[0], $line[1], as  while impororting to excel, any {,} in content is considered a trigger to move to next column
			       //$line1 = str_replace("," ,"/", $line[0]);
			       //$line2 = str_replace("," ,"/", $line[1]);
			  
			  }
			  
              fputcsv($file,explode(',', $lineFinale));  //elements separated by comma will be imported to next column in Excel, each additional fputcvs() creates a new row
			  //fputcsv($file,explode(',',$line[1]));
          }
          fclose($file);
		  		 
					 
	      
	}
	// **                                                                                  **
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	
	
	
 }	
	
	
	
?>