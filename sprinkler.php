<?php 
    if(isset($_POST['zone']) && isset($_POST['dur'])) {
        $zone = intval($_POST['zone']);
        $dur = $_POST['dur'];
        if($zone == 3 ){
            $zone = 2;
            $url = "http://192.168.1.225/Forms/ring_1?OverrideStatus=12&RingCircuitNum=$zone&CircuitsPgNext=1&OverrideDur=$dur&Submit=Ok";
            sendPost($url);
            sleep(1);
            $zone = 4;
            $url = "http://192.168.1.225/Forms/ring_1?OverrideStatus=12&RingCircuitNum=$zone&CircuitsPgNext=1&OverrideDur=$dur&Submit=Ok";
            sendPost($url);
        }else{
            $url = "http://192.168.1.225/Forms/ring_1?OverrideStatus=12&RingCircuitNum=$zone&CircuitsPgNext=1&OverrideDur=$dur&Submit=Ok";
            sendPost($url);
        }
        
    } 

    function testFun($zone){
        return $zone." is active";
    }

    function sendPost($url){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        

        //$url = 'http://192.168.1.225/circuits.html';

            
        $username = "admin";
        $password = "natsco";
        $post_data = array(
                'fieldname1' => 'value1',
                'fieldname2' => 'value2'
        );

        $options = array(
                CURLOPT_URL            => $url,
                CURLOPT_HEADER         => true,    
                CURLOPT_VERBOSE        => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,    // for https
                CURLOPT_USERPWD        => $username . ":" . $password,
                CURLOPT_HTTPAUTH       => CURLAUTH_DIGEST
                //CURLOPT_POST           => true,
                //CURLOPT_POSTFIELDS     => http_build_query($post_data) 
        );

        $ch = curl_init();

        curl_setopt_array( $ch, $options );

        try {
            $raw_response  = curl_exec( $ch );

            // validate CURL status
            if(curl_errno($ch))
                throw new Exception(curl_error($ch), 500);

            // validate HTTP status code (user/password credential issues)
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($status_code != 200)
                throw new Exception("Response with Status Code [" . $status_code . "].", 500);

        } catch(Exception $ex) {
            if ($ch != null) curl_close($ch);
            throw new Exception($ex);
        }

        if ($ch != null) curl_close($ch);
    }

?>