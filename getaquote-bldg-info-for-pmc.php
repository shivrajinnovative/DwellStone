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
        $nooffloor = $_POST['nooffloor'];
        $wings = $_POST['wings'];

        $structuralaudit = $_POST['structuralaudit'];
        $repairestimate = $_POST['repairestimate'];
        $needtendering = $_POST['needtendering'];
        $name = $_POST['name'];
        $contactno = $_POST['contactno'];
        $remark = $_POST['remark'];

        
        if(empty($buildingname)) {
            $errBldgName = "Building Name Field Is Required";
        }
        if(empty($address)){
            $errAdd = "Address Field Is Required";
        }
        if(empty($nooffloor)){
            $errNoOfFloor = "Message Field Is Required";
        }
        if(empty($wings)){
            $errwings = "Wings Field Is Required";
        }
        
        if(empty($structuralaudit)){
            $errStructuralAudit = "Structural Audit Is Required";
        }
        if(empty($repairestimate)){
            $errRepairEstimate = "Repair Estimate Field Is Required";
        }
        if(empty($needtendering)){
            $errNeedTendering = "Need A Tender Field Is Required";
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
        if(empty($buildingname) || empty($address) || empty($nooffloor) || empty($wings) || empty($structuralaudit) || empty($repairestimate) || empty($needtendering) || empty($name) || empty($contactno) || empty($remark)){
            $output = array("flag"=>"3", 
                        "buildingname"=>$errBldgName, 
                        "address"=>$errAdd, 
                        "nooffloor"=>$errNoOfFloor, 
                        "wings"=>$errwings, 
                        "structuralaudit"=>$errStructuralAudit, 
                        "repairestimate"=>$errRepairEstimate, 
                        "needtendering"=>$errNeedTendering, 
                        "name"=>$errName, 
                        "contactno"=>$errContactNo, 
                        "remark"=>$errRemark, 
                        "smsg"=>"", 
                        "emsg"=>""
                    );
        } else {
            $to = 'projects@dwellstoneengineers.com';
            // $to = 'dwellstoneengineers@gmail.com';
            // $to = 'amar.innovativewebs@gmail.com';

            $subject = 'Building Information For PMC';
            
            
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            // $headers .= "From: " . strip_tags($email) . "\r\n";
            // $headers .= "Reply-To: " . strip_tags($email) . "\r\n";


            $message = '<p><strong>Building Name : </strong> '.$buildingname.'</p>';
            $message .= '<p><strong>Address : </strong> '.$address.'</p>';
            $message .= '<p><strong>Number Of Floor : </strong> '.$nooffloor.'</p>';
            $message .= '<p><strong>Number Of Wings : </strong> '.$wings.'</p>';
            $message .= '<p><strong>Structural Audit : </strong> '.$structuralaudit.'</p>';
            $message .= '<p><strong>Repair Estimate : </strong> '.$repairestimate.'</p>';
            $message .= '<p><strong>Need A Tender : </strong> '.$needtendering.'</p>';
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
        
        