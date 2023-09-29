<?php
include '1pgRequest/requests.php';

class Submission
{

    public $Requests1pg;  
    
    public function __construct()
    {
        $this->Requests1pg = new Requests;
    }
    
    public function submission($entry, $form){

        $url = home_url();
        
        if ($form['id'] == 9) {
            //url do site
            $name = $entry['5'];
            $email = $entry['21'];
            $password = $entry['23'];
            
            $user = $this->Requests1pg->createUser($name, $email, $password);
            
            if($user['data']['id']){
                $code = $this->Requests1pg->createAccess($user['data']['id']);

                //criando url com parametros para o front
                $url_success = $url .'/confirmacao?code='. $code['data']['one_time_login_code'] .'&planId='. 4;
                header("Location: $url_success");
                return;
            }
            $url_failed = $url .'/erro-confirmacao?msg='.$user['errors'][0]['title'].'&status='.$user['errors'][0]['status'];
            header("Location: $url_failed");   
        }
    
    }
}