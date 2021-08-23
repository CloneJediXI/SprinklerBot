<html>
<head>
    <title>Sprinkler Bot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Welcome to the Sprinkler Bot!</h1>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#testBtn').click(function(){
                $(this).text("Success");
                
            });
            $('#zoneDrp').change(function(){
                var value = $(this).val();
                var ajaxurl = 'sprinkler.php';
                data =  {zone: value};
                $.post(ajaxurl, data, function (response) {
                    $('#map').attr("src", response);
                    alert(response);
                });
            });
        });
    </script>
    
    <img src="House1.jpg" id="map" class="w-100" />

    <label for="zone">Select Zone</label>
    <select name="zone" id="zoneDrp">
        <option value="0">1</option>
        <option value="1">2</option>
        <option value="2">3</option>
        <option value="3">4</option>
        <option value="4">5</option>
    </select>
    <button id="testBtn">Click to test</button>
    
</body>
</html>
<?php 

    function testFun($zone){
        return $zone." is active";
    }

    function connect(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        

        $url = 'http://192.168.1.225/circuits.html';

            
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