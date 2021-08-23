<html>
<head>
    <title>Sprinkler Bot - Schedules</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="p-lg-5 p-2">
        <div class="row text-center">
            <div class="col-lg-3 col-1"></div>
            <div class="col-lg-6 col-10">
                <h1>Schedules</h1>
                <h4><a href="schedule.php"><- Home </a></h4>
            </div>
        </div>
        <div class="row largeText text-center">
            <div class="col-1 col-lg-4"></div>
            <div class="col-lg-4 col-10">
                <?php
                    
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    $url = 'http://192.168.1.225/schedule.html';
                        
                    $username = "admin";
                    $password = "natsco";
            
                    $options = array(
                            CURLOPT_URL            => $url,
                            CURLOPT_HEADER         => true,    
                            CURLOPT_VERBOSE        => true,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_SSL_VERIFYPEER => false,    // for https
                            CURLOPT_USERPWD        => $username . ":" . $password,
                            CURLOPT_HTTPAUTH       => CURLAUTH_DIGEST
                    );
            
                    $ch = curl_init();
            
                    curl_setopt_array( $ch, $options );
            
                    try {
                        $raw_response  = curl_exec( $ch );

                        echo ($raw_response);
            
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
                    
                ?>
                

            </div>
            
        </div>
    </div>
</body>
</html>