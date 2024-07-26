<?php

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_POST['wings']);
        
        // print_r($_POST['flattypes']);
        // echo "</pre>";
        // exit;
        $buildingname = $_POST['buildingname'];
        $address = $_POST['address'];
        $noofbldg = $_POST['noofbldg'];
        $nooffloor = $_POST['nooffloor'];
        $wings = $_POST['wings'];
        $noOfwings = implode(", ", $_POST['wings']);
        
        $flattypes = $_POST['flattypes'];
        $flatTypes = implode(", ", $_POST['flattypes']);
        $noofflats = $_POST['noofflats'];
        $noofshops = $_POST['noofshops'];
        $ageofbldg = $_POST['ageofbldg'];
        $drawingavailable = $_POST['drawingavailable'];
        $ocavail = $_POST['ocavail'];
        $notice = $_POST['notice'];
        $name = $_POST['name'];
        $contactno = $_POST['contactno'];
        $remark = $_POST['remark'];

        
        if(empty($buildingname)) {
            $errBldgName = "Building Name Field Is Required";
        }
        if(empty($address)){
            $errAdd = "Address Field Is Required";
        }
        if(empty($noofbldg)){
            $errNoOfBldg = "Number Of Building Field Is Required";
        }
        if(empty($nooffloor)){
            $errNoOfFloor = "Message Field Is Required";
        }
        if(!isset($wings) || empty($wings) && count($wings) == 0){
            $errwings = "Wings Field Is Required";
        }
        if(!isset($flattypes) || empty($flattypes) && count($flattypes) == 0){
            $errFlatTypes = "Flat Types Field Is Required";
        }
        if(empty($noofflats)){
            $errNoOfFlats = "No Of Flats Field Is Required";
        }
        if(empty($noofshops)){
            $errNoOfShops = "No Of Shops Field Is Required";
        }
        if(empty($ageofbldg)){
            $errAgeOfBldg = "Age Of Building Field Is Required";
        }
        if(empty($drawingavailable)){
            $errDrawingAvail = "Drawing Availability Field Is Required";
        }
        if(empty($ocavail)){
            $errOCavail = "OC Field Is Required";
        }
        if(empty($notice)){
            $errNotice = "Notice Field Is Required";
        }
        if(empty($name)){
            $errName = "Name Field Is Required";
        }
        if(empty($contactno)){
            $errContactNo = "Contact No Field Is Required";
        }
        if(empty($remark)){
            $errRemark = "Remark Field Is Required";
        }
        if(empty($buildingname) || empty($address) || empty($noofbldg) || empty($nooffloor) || empty($wings) || empty($flattypes) || empty($noofflats) || empty($noofshops) || empty($ageofbldg) || empty($drawingavailable) || empty($ocavail) || empty($notice) || empty($name) || empty($contactno) || empty($remark)){
            $output = array("flag"=>"3", "buildingname"=>$errBldgName, "address"=>$errAdd, "noofbldg"=>$errNoOfBldg, "nooffloor"=>$errNoOfFloor, "wings"=>$errwings, "flattypes"=>$errFlatTypes, "noofflats"=>$errNoOfFlats, "noofshops"=>$errNoOfShops, "ageofbldg"=>$errAgeOfBldg, "drawingavailable"=>$errDrawingAvail, "ocavail"=>$errOCavail, "notice"=>$errNotice, "name"=>$errName, "contactno"=>$errContactNo, "remark"=>$errRemark, "smsg"=>"", "emsg"=>""
                );
        } else {
            
            $to = 'projects@dwellstoneengineers.com';
            // $to = 'dwellstoneengineers@gmail.com';
            // $to = 'amar.innovativewebs@gmail.com';

            $subject = 'Building Information For A Structural Audit';
            
            
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            // $headers .= "From: " . strip_tags($email) . "\r\n";
            // $headers .= "Reply-To: " . strip_tags($email) . "\r\n";

            $message = '<p><strong>Building Name : </strong> '.$buildingname.'</p>';
            $message .= '<p><strong>Address : </strong> '.$address.'</p>';
            $message .= '<p><strong>Number Of Building : </strong> '.$noofbldg.'</p>';
            $message .= '<p><strong>Number Of Floor : </strong> '.$nooffloor.'</p>';
            $message .= '<p><strong>Number Of Wings : </strong> '.$noOfwings.'</p>';
            $message .= '<p><strong>Flat Types : </strong> '.$flatTypes.'</p>';
            $message .= '<p><strong>Number Of Flats : </strong> '.$noofflats.'</p>';
            $message .= '<p><strong>Number Of Shops : </strong> '.$noofshops.'</p>';
            $message .= '<p><strong>Age Of Building : </strong> '.$ageofbldg.'</p>';
            $message .= '<p><strong>Drawings Availability : </strong> '.$drawingavailable.'</p>';
            $message .= '<p><strong>OC Availability : </strong> '.$ocavail.'</p>';
            $message .= '<p><strong>Notice : </strong> '.$notice.'</p>';
            $message .= '<p><strong>Contact Person Name : </strong> '.$name.'</p>';
            $message .= '<p><strong>Contact Number : </strong> '.$contactno.'</p>';
            $message .= '<p><strong>Remark : </strong> '.$remark.'</p>';
            
            if(mail($to, $subject, $message, $headers)){
                $output = array("flag"=>"1", "smsg"=>"Thank You For Reaching Us. We Will Get Back To You ASAP.", "emsg"=>"", "redirect"=>1);
            } else {
                $output = array("flag"=>"2", "smsg"=>"", "emsg"=>"Sorry Something Went Wrong! Please Try Later");
            }
        }
        
        echo json_encode($output, 200);
    
        
    } else {
        header("Location: http://dwellstoneengineers.com/getaquote.html");
    }
        
        