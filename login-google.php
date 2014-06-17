<?php
        require_once 'scripts/fb-google-login/googlesrc/src/Google_Client.php';
        require_once 'scripts/fb-google-login/googlesrc/src/contrib/Google_PlusService.php';
        require_once 'scripts/fb-google-login/googlesrc/src/contrib/Google_Oauth2Service.php';
        session_start();
       $client = new Google_Client();
       $client->setApplicationName("Google+ PHP Starter Application");
       $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/plus.me'));
       $client->setClientId('900396124145-n5o38vahnahhnkb02llrekkpl8g6b94p.apps.googleusercontent.com');
       $client->setClientSecret('UE0pSHN8rZCn-hSX6P7JL-mL');
       $client->setRedirectUri('http://localhost:1000/connectmu/login-google.php');
       $client->setDeveloperKey('AIzaSyB3o5hYpyAtAVsdJ8MOXNAE5kRdMH6Yq6Y');
       $plus = new Google_PlusService($client);
       $oauth2 = new Google_Oauth2Service($client); 
     

       if (isset($_REQUEST['logout'])) {
                unset($_SESSION['access_token']);
        }

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if (isset($_SESSION['access_token'])) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        if ($client->getAccessToken()) {
            $user = $oauth2->userinfo->get();
            $me = $plus->people->get('me');
        
            $name = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
            $gender=$me['gender'];
            $firstname=$user['given_name'];
            $lastname=$user['family_name'];
            if(isset($_SESSION['email']))
            {
                unset($_SESSION['email']);
            }
            else
            {
                $_SESSION['oauth']="google";
                $_SESSION['email']=$email;
                $_SESSION['firstname']=$firstname;
                $_SESSION['lastname']=$lastname;
                $_SESSION['gender']=$gender;
                $_SESSION['name']=$name;
                header("location: getpass.php");
            }
  // The access token may have been updated lazily.
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
    header("Location: " . $authUrl);
}
?>