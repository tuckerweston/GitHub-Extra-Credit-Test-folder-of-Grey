<?php
/*
* config.php - a file to store data and 
* configuration info
*
*/

include 'credentials.php';

define('DEBUG',TRUE); #we want to see all errors

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

$nav1["index.php"] = "Home Page";
$nav1["links.php"] = "Links";
$nav1["database1.php"] = "Database 1";
$nav1["database2.php"] = "Beer Database";
$nav1["order.php"] = "Order A Website";
$nav1["contact.php"] = "Contact Us";
$nav1["location.php"] = "Location";

//echo THIS_PAGE;

switch(THIS_PAGE)
{
	case "index.php":
	
		$title = "Grey Template"; 
		$banner = "My Banner"; 
		$slogan = "My Slogan"; 
		$image = "lego.jpg";
		$image2 = "build.jpg"; 
	break;
	
	case "links.php":
	
		$title = "My Links Page"; 
		$banner = "My Links Banner"; 
		$slogan = "My Clever Links Slogan!";
		$image = "lego2.jpg"; 
		$image2 = "build2.jpg";  
		
	break;
	
	case "location.php":
	
		$title = "My location Page"; 
		$banner = "My location Banner"; 
		$slogan = "My Clever location Slogan!"; 
		$image = "lego3.jpg"; 
		$image2 = "build3.jpg"; 
	break;
	
	case "contact.php":
	
		$title = "My contact Page"; 
		$banner = "My contact Banner"; 
		$slogan = "My Clever contact Slogan!"; 
		$image = "lego4.jpg"; 
		$image2 = "build4.jpg"; 
	break;
	
	case "order.php":
	
		$title = "Order"; 
		$banner = "My Order Banner"; 
		$slogan = "My Clever Order Slogan!"; 
		$image = "lego2.jpg"; 
		$image2 = "build3.jpg"; 
	break;
	
	case "database1.php":
	
		$title = "Database #1"; 
		$banner = "Database #1 Banner"; 
		$slogan = "Database #1 Slogan"; 
		$image = "lego.jpg";
		$image2 = "build.jpg"; 
	break;
	
	case "database2.php":
	
		$title = "Database #2"; 
		$banner = "Database #2 Banner"; 
		$slogan = "Database #2 Slogan"; 
		$image = "lego.jpg";
		$image2 = "build.jpg"; 
	break;
	
	default:
		$title = THIS_PAGE; 
		$banner = "Default Banner"; 
		$slogan = "Default Slogan!"; 
		$image = "lego2.jpg"; 
		$image2 = "build3.jpg"; 
}


function makeLinks($linkArray)
{
    $myReturn = '';
    foreach($linkArray as $url => $text)
    {
        if(THIS_PAGE == $url)
		{//current page, add class
		
			$myReturn .= '<li class="current"><a href="' . $url . '">' . $text . '</a></li>';
			
		}else{
			
			$myReturn .= '<li><a href="' . $url . '">' . $text . '</a></li>';
		
		}
		
		    
    }    
    return $myReturn;    
}


//used for order.php to build a better email
function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}

function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
        echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
        die();
    }
}

