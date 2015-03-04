<?php
/**
 * contact.php is a postback application designed to provide a 
 * contact form for users to email our clients.  contact.php references 
 * recaptchalib.php as an include file which provides all the web service plumbing 
 * to connect and serve up the CAPTCHA image and verify we have a human entering data.
 *
 * See document in package for installation instructions.
 *
 * @package nmCAPTCHA
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.1 2014/01/20
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see contact_include.php 
 * @see recaptchalib.php
 * @see util.js 
 * @todo none
 */

# For each customer/domain, get a key from https://www.google.com/recaptcha/admin#whyrecaptcha (DON'T LET A CUSTOMER USE YOUR KEY) 
# Seattle Central edison ONLY reCAPTCHA keys are below:
# edison $publickey = "6Lf8FMkSAAAAAIR0DTQO4f0zjP-hlyBVcVTjRNB-";
# edison $privatekey = "6Lf8FMkSAAAAAKsfveeLDuVJBWTNOm8PvRqL9lNm";

#bellow are my keys to tucker-weston.com
$publickey = "6Lcr9AATAAAAAEJ2wW27Kx3a4sIV5RV0s89WpgI0";
$privatekey = "6Lcr9AATAAAAAD-RFIwyNMpA5guw-j49fZ-s9tTT";

#EDIT THE FOLLOWING:
$toAddress = "tuckerweston@hotmail.com";  //place your/your client's email address here - EDISON/ZEPHIR WILL ONLY EMAIL seattlecentral.edu ADDRESSES!
$toName = "Tucker Weston "; //place your client's name here
$website = "tucker-weston.com";  //place NAME of your client's website here
$sendEmail = TRUE; //if true, will send an email, otherwise just show user data.
$recaptchaTheme = "white"; //options are 'white', 'black', 'clean' or none (empty)
$dateFeedback = true; //if true will show date/time with reCAPTCHA error - style a div with class of dateFeedback
#--------------END CONFIG AREA ------------------------#
include 'contact-lib/contact_include.php'; #complex unsightly code moved here
if (isset($_POST["recaptcha_response_field"]))
{# Check for reCAPTCHA response
    $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
	if ($resp->is_valid)
	{#reCAPTCHA agrees data is valid (PROCESS FORM & SEND EMAIL)
         handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);        
         #Here we can enter the data sent into a database in a later version of this file
?>
	<!-- START HTML THANK YOU MESSAGE -->
	<div class="contact-feedback">
		<h2>Your Comments Have Been Received!</h2>
		<p>Thanks for the input!</p>
		<p>We'll respond via email within 48 hours, if you requested information.</p>
	</div>    
    <!-- END HTML THANK YOU MESSAGE -->        
<?php
    }else{#reCATPCHA response says data not valid - prepare for feedback
            $error = $resp->error;
			$feedback = dateFeedback($dateFeedback);
            send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
    }
}
if(!isset($_POST["recaptcha_response_field"])|| $error != "")
{#show form, either for first time, or if data not valid per reCAPTCHA  
?>
	<!-- START HTML FORM -->
	<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post">
	
    
    <p>
			<label for="Name">Name:</label>
			<input type="text" id="Name" name="Name" required="required" title="We need your name" placeholder="Enter your Name" />
		</p>
		<p>
			<label for="Email">Email:</label>
			<input type="email" id"Email" name="Email" required="required" title="We need your email" placeholder="Enter your Email" />
		</p>
		<p>
			<label for="Type">Type of website:</label>
			<br>
			<input type="radio" 
				   id="Type" 
				   name="Type_of_website" 
				   required="required" 
				   title="We need to know what type of site" 
				   placeholder="Choose the type of site"
				   value="Custom" 
			/> Custom<br />
	  
			<input type="radio"
				   name="Type_of_website"
				   required="required"
				   title="We need to know what type of site"
				   placeholder="Choose the type of site"
				   value="CMS"
			/> CMS<br />
			
			<input type="radio"
				   name="Type_of_website"
				   required="required"
				   title="We need to know what type of site"
				   placeholder="Choose the type of site"
				   value="Framework"
			/> Framework<br />
		</p>
		
		<p>
			<label for="Features">Features:</label>
			<br>
			<input type="checkbox" 
				   id="Features" 
				   name="Website_features[]" 
				   value="SEO" 
			/> Search Engine Visibility<br />
	  
			<input type="checkbox" 
				   id="Features" 
				   name="Website_features[]" 
				   value="SMO" 
			/> Social Media Integration<br />
			
			<input type="checkbox" 
				   id="Features" 
				   name="Website_features[]" 
				   value="Shopping Cart" 
			/> Shopping Cart<br />
			
			<input type="checkbox" 
				   id="Features" 
				   name="Website_features[]" 
				   value="Website Search" 
			/> Website Search<br />
		</p>
		
		<p>
			<label for="Comments">Comments:</label>
			<textarea type="text"
				   id="Comments"
				   name="Comments"
				   required="required"
				   title="We need your comments"
				   placeholder="Comments"
			></textarea>
		</p>	
	<div>
		<?php 
		echo $feedback;
		echo recaptcha_get_html($publickey, $error); 
		?>
	</div>
	<div>
		<input type="submit" value="submit" />
	</div>
    </form>
	<!-- END HTML FORM -->
<?php
}
?>