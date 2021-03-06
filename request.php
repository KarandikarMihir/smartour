<?php   include 'ajax_requests.php';      
        include 'functions.php';
        
        $key=$_REQUEST['KEY'];
        $user=decrypt($_COOKIE['SmarTourID'], $Salt);
        $name=decrypt($_COOKIE['Identification'], $Salt);
	switch($key) {

		case 'fetchMsgCnt':	fetchMsgCnt($name);
					break;
                case 'fetchFeedbk':     fetchFeedbk();
                                        break;
                case 'fetchEnqTrk':     fetchEnqTrk();
                                        break;
                case 'fetchPayChk':     fetchPayChk();
                                        break;
                case 'showcaseResults': $SearchParam=$_REQUEST['SearchParam'];
                                        showcaseResults($SearchParam);
                                        break;
                case 'enquiryResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        enquiryResults($SearchParam);
                                        break;
                case 'enquiryUpdateResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        enquiryUpdateResults($SearchParam);
                                        break;
                case 'enquiryDeleteResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        enquiryDeleteResults($SearchParam);
                                        break;
                case 'enqAppResults':   $SearchParam=$_REQUEST['SearchParam'];
                                        enqAppResults($SearchParam);
                                        break;
                case 'appResults':      $SearchParam=$_REQUEST['SearchParam'];
                                        appResults($SearchParam);
                                        break;
                case 'appDeleteResults':$SearchParam=$_REQUEST['SearchParam'];
                                        appDeleteResults($SearchParam);
                                        break;
                case 'appUpdateResults':$SearchParam=$_REQUEST['SearchParam'];
                                        appUpdateResults($SearchParam);
                                        break;
                case 'voucherResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        voucherResults($SearchParam);
                                        break;
                case 'invoiceResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        invoiceResults($SearchParam);
                                        break;
                case 'receiptResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        receiptResults($SearchParam);
                                        break;
                case 'rcptAppResults':  $SearchParam=$_REQUEST['SearchParam'];
                                        rcptAppResults($SearchParam);
                                        break;
                case 'hotelResults':    $SearchParam=$_REQUEST['SearchParam'];
                                        hotelResults($SearchParam);
                                        break;
                case 'hotelRoomResults':$SearchParam=$_REQUEST['SearchParam'];
                                        hotelRoomResults($SearchParam);
                                        break;
                case 'hotelUpdateResults':$SearchParam=$_REQUEST['SearchParam'];
                                        hotelUpdateResults($SearchParam);
                                        break;
                case 'hotelDeleteResults':$SearchParam=$_REQUEST['SearchParam'];
                                        hotelDeleteResults($SearchParam);
                                        break;
                case 'deleteEnquiry':   $SearchParam=$_REQUEST['SearchParam'];
                                        deleteEnquiry($SearchParam, $user);
                                        break;
                case 'deleteApp':       $SearchParam=$_REQUEST['SearchParam'];
                                        deleteApplication($SearchParam, $user);
                                        break;
                case 'deleteHotel':     $SearchParam=$_REQUEST['SearchParam'];
                                        deleteHotel($SearchParam, $user);
                                        break;
                case 'fetchRoomTypes':  $SearchParam=$_REQUEST['SearchParam'];
                                        fetchRoomTypes($SearchParam);
                                        break;    
                case 'fetchRoomDetails':$SearchParam=$_REQUEST['SearchParam'];
                                        fetchRoomDetails($SearchParam);
                                        break;
                case 'deleteRoom':      $SearchParam=$_REQUEST['SearchParam'];
                                        deleteRoom($SearchParam, $user);
                                        break;
                case 'clearActivity':   clearActivity($user);
                                        break;
                case 'deleteUser':      $SearchParam=$_REQUEST['SearchParam'];
                                        deleteUser($SearchParam, $user);
                                        break;
                case 'blockUser':       $SearchParam=$_REQUEST['SearchParam'];
                                        blockUser($SearchParam, $user);
                                        break;
                case 'unblockUser':     $SearchParam=$_REQUEST['SearchParam'];
                                        unblockUser($SearchParam, $user);
                                        break;
                case 'resetUser':       $SearchParam=$_REQUEST['SearchParam'];
                                        resetUser($SearchParam, $user);
                                        break;
                case 'resetUser':       $SearchParam=$_REQUEST['SearchParam'];
                                        resetUser($SearchParam, $user);
                                        break;                                    
                case 'addapproom':      $roomtype=$_REQUEST['roomtype'];
                                        $fromdate=$_REQUEST['FromDate'];
                                        $todate=$_REQUEST['ToDate'];
                                        $nightnos=$_REQUEST['nightnos'];
                                        $roomnos=$_REQUEST['roomnos'];
                                        $rate=$_REQUEST['rate'];
                                        $extrapax=$_REQUEST['extrapax'];
                                        $extrarate=$_REQUEST['extrarate'];
                                        $children=$_REQUEST['children'];
                                        $childrate=$_REQUEST['childrate'];
                                        $hid=$_REQUEST['hid'];
                                        $eid=$_REQUEST['eid'];
                                        addapproom($roomtype, $fromdate, $todate, $nightnos, $roomnos, $rate, $extrapax, $extrarate, $children, $childrate, $hid, $eid, $user);
                                        break;
                case 'addcity':         $city = $_REQUEST['city'];
                                        $state = $_REQUEST['state'];
                                        addcity($city, $state);
                                        break;
                case 'addstate':        $state = $_REQUEST['state'];
                                        $country = $_REQUEST['country'];
                                        addstate($state, $country);
                                        break;
                case 'addcountry':      $country = $_REQUEST['country'];
                                        addcountry($country);
                                        break;
                case 'addhotel':        $param = $_REQUEST['hotel'];
                                        $eid = $_REQUEST['eid'];
                                        addhotel($param, $eid, $user);
                                        break;
                case 'removehotel':     $param = $_REQUEST['hotel'];
                                        $eid = $_REQUEST['eid'];
                                        removehotel($param, $eid);
                                        break;
                case 'removeroom':      $param = $_REQUEST['room'];
                                        removeroom($param);
                                        break;                                    
                case 'custResults':     $SearchParam=$_REQUEST['SearchParam'];
                                        custResults($SearchParam);
                                        break;
                case 'custTourResults': $SearchParam=$_REQUEST['SearchParam'];
                                        custTourResults($SearchParam);
                                        break;
                case 'deleteCustomer':  $SearchParam=$_REQUEST['SearchParam'];
                                        deleteCustomer($SearchParam, $user);
                                        break;
                case 'customerResults': $SearchParam=$_REQUEST['SearchParam'];
                                        customerResults($SearchParam);
                                        break;
                case 'customerUpdateResults': $SearchParam=$_REQUEST['SearchParam'];
                                        customerUpdateResults($SearchParam);
                                        break;
                case 'customerDeleteResults': $SearchParam=$_REQUEST['SearchParam'];
                                        customerDeleteResults($SearchParam);
                                        break;
                case 'delTourBooking':  $SearchParam=$_REQUEST['SearchParam'];
                                        delTourBooking($SearchParam, $user);
                                        break;
                case 'delTourListItem': $SearchParam=$_REQUEST['SearchParam'];
                                        delTourListItem($SearchParam, $user);
                                        break;
                case 'tourResults':     $SearchParam=$_REQUEST['SearchParam'];
                                        tourResults($SearchParam, $user);
                                        break;
                case 'tourBookingResults':$SearchParam=$_REQUEST['SearchParam'];
                                        tourBookingResults($SearchParam, $user);
                                        break;
                case 'tourRcptResults': $SearchParam=$_REQUEST['SearchParam'];
                                        tourRcptResults($SearchParam, $user);
                                        break;
                case 'rcptBookResults': $SearchParam=$_REQUEST['SearchParam'];
                                        rcptBookResults($SearchParam);
                                        break;      
                case 'deleteTourRcpt':  $SearchParam=$_REQUEST['SearchParam'];
                                        deleteTourRcpt($SearchParam, $user);
                                        break;
	}
?>
