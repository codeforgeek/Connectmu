  <?php
       require_once('scripts/fb-google-login/fbsrc/facebook.php');
        $config = array(
        'appId' => '1417329685178130',
        'secret' => '09e1a3e0598e0c73efc061baf6533b88',
        'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
        );
        $facebook = new Facebook($config);
        $user_id = $facebook->getUser();
    
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        if(isset($_SESSION['email']))
        {
            unset($_SESSION['email']);
        }
        else
        {
            $_SESSION['email']=$user_profile['email'];
            $_SESSION['oauth']="facebook";
            $_SESSION['name']=$user_profile['name'];
            $_SESSION['birthday']=$user_profile['birthday'];
            $_SESSION['gender']=$user_profile['gender'];
            $_SESSION['firstname']=$user_profile['first_name'];
            $_SESSION['lastname']=$user_profile['last_name'];
        }
        header("location: getpass.php");

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
     $loginUrl = $facebook->getLoginUrl(
array( 
'scope' => 'user_birthday,email'
));
  header("Location: " . $loginUrl);
}
?>