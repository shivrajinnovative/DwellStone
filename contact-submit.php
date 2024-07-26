<?php

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email']; 
        $phone_number = $_POST['phone'];
        $formmessage = $_POST['message'];

        
        if(empty($fname)) {
            $errfName = "First Name Field Is Required";
        }
        if(empty($lname)) {
            $errlName = "Last Name Field Is Required";
        }
        if(empty($email)){
            $errEmail = "Email Field Is Required";
        }
        if(empty($phone_number)){
            $errPhoneNo = "Phone Number Field Is Required";
        }
        if(empty($formmessage)){
            $errMsg = "Message Field Is Required";
        }
        if(empty($fname) || empty($lname) || empty($email) || empty($phone_number) || empty($formmessage)){
            $output = array("flag"=>"3", "fname"=>$errfName, "lname"=>$errlName, "email"=>$errEmail, "phone"=>$errPhoneNo, "message"=>$errMsg, "smsg"=>"", "emsg"=>"");
        } else {
            
            $to = 'projects@dwellstoneengineers.com';
            //  $to = 'dwellstoneengineers@gmail.com';
            // $to = 'shivraj.innovative@gmail.com';
            // $to = 'iwsreports23@gmail.com';

            $subject = 'Contact Us Page';

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: " . strip_tags($email) . "\r\n";
            $headers .= "Reply-To: " . strip_tags($email) . "\r\n";

            $message = '<p><strong>Name : </strong> '.$fname.' '.$lname.'</p>';
            $message .= '<p><strong>Email : </strong> '.$email.'</p>';
            $message .= '<p><strong>Phone Number : </strong> '.$phone_number.'</p>';
            $message .= '<p><strong>Message : </strong> '.$formmessage.'</p>';
            
            if(mail($to, $subject, $message, $headers)){
                $output = array("flag"=>"1", "smsg"=>"Thank You For Reaching Us. We Will Get Back To You ASAP.", "emsg"=>"", "redirect"=>1);
            } else {
                $output = array("flag"=>"2", "smsg"=>"", "emsg"=>"Sorry Something Went Wrong! Please Try Later");
            }
        }
        
        echo json_encode($output, 200);
    
        
    } else {
        header("Location: http://dwellstoneengineers.com/contact.html");
    }
        
        