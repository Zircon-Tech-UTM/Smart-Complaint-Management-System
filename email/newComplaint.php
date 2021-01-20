<?php

    function newuserMail($receiver){
        $to_email = $receiver;
        $subject = "KVPJB System Member Registration";
        
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Yoru Account is ready</title>
        </head>
        <body>
            <div class="card">
                <div class="card-body">
                <h2 class="card-title">New Complaints!</h2>
                <p class="card-text">Please check your KVPJB system.</p>
                <a href="#" class="btn btn-primary">Click here!</a>
                </div>
            </div>
        </body>
        </html>
        ';
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <lsyuan1029@gmail.com>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";
        
        if (mail($to_email, $subject, $body, $headers)){
            echo "Email sent to $to_email successfully";
        }else{
            echo "Failed";
        }
    }

    newuserMail("lsyuan1029@gmail.com");
?>