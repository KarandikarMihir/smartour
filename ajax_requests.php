<?php
/*
function fetchMsgCnt($name)
{
    //dbConnect();
    $dbObj = dbPlugIn();
    $result = $dbObj->query("SELECT * FROM messenger WHERE recipient='" . $name . "' AND readstatus=0") or die(mysql_error());
    if(mysql_num_rows($result))
        $response="(" . mysql_num_rows($result) . ")";
    else
        $response="(0)";
    mysql_free_result($result);
    echo $response;
}

function fetchFeedbk()
{
    //dbConnect();
    $dbObj = dbPlugIn();
    $result= $dbObj->query("SELECT * FROM application WHERE feedbackflag=0 AND cancelflag=0") or die(mysql_error());
    if(mysql_num_rows($result)==1)
        $response=mysql_num_rows($result) . " feedback pending";
    else
        $response=mysql_num_rows($result) . " feedbacks pending";
    mysql_free_result($result);
    echo $response;
}

function fetchEnqTrk()
{
    //dbConnect();
    $dbObj = dbPlugIn();
    $result= $dbObj->query("SELECT * FROM enquiry WHERE applock=0") or die(mysql_error());
    if(mysql_num_rows($result)==1)
        $response=mysql_num_rows($result) . " unhatched query";
    else
        $response=mysql_num_rows($result) . " unhatched queries";
    mysql_free_result($result);
    echo $response;
}
*/
function fetchRoomTypes($SearchParam)
{
    $SearchParam = trim($SearchParam);
    $response ='';
    if($SearchParam=='')
        return $response;
    dbConnect();
    $result = mysql_query("SELECT srno FROM hotellist WHERE name='$SearchParam'");
    if(mysql_num_rows($result))
    {
        while($row=mysql_fetch_array($result))
        {
            $roomTypes = mysql_query("SELECT * FROM roomdetails WHERE hotelid=" . $row['srno']);
            while($room=mysql_fetch_array($roomTypes))
            {
                $response.='<option>' . $room['roomtype'] . '</option>';
            }
        }
    }
    echo $response;    
}

function fetchRoomDetails($SearchParam)
{
    dbConnect();
    $result0 = mysql_query("SELECT hotellist.name FROM hotellist WHERE hotellist.srno= ". $SearchParam . "") or die(mysql_error());
    $row0 = mysql_fetch_array($result0);
    $response='<h2 class="fg-color-redLight" style="display: inline;border-bottom: 2px #ccc dotted;">' . $row0['name'] .  '</h2>';
    $response.='<table class="hovered" style="width:100%;margin-top: 20px;">';
    $result = mysql_query("SELECT * FROM roomlist WHERE roomlist.hid= ". $SearchParam . "") or die(mysql_error());
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" style="text-align: right;"><a href="hotel_add_rooms.php?KEY=' . $SearchParam . '">+Add New Rooms</a></td></tr>';
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="3" style="text-align: right;"><a href="hotel_add_rooms.php?KEY=' . $SearchParam . '">+Add New Rooms</a></td></tr>';
        $response.='<tr><td><b>Room</b></td><td><b>Pax</b></td><td><b>Rate</b></td></tr>';
            
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteRoom\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;" title="Click to delete">' . $row['roomtype'] . '</a></td>';
            $response.='<td>' . $row['paxnos'] . '+' . $row['extrapax'] . '</td>';
            $response.='<td>Rs. ' . $row['rate'] . '</td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;    
}

function fetchPayChk()
{
	//dbConnect();
        $dbObj = dbPlugIn();
	$result = $dbObj->query("SELECT * FROM application WHERE balance>0") or die(mysql_error());
        if($response=mysql_num_rows($result)==1)
            $response=mysql_num_rows($result) . " payment pending ";
        else
            $response=mysql_num_rows($result) . " payments pending";
	mysql_free_result($result);
	echo $response;
}

function showcaseResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response="<table class='hovered' style='width:100%'>";
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.srno=$SearchParam AND hotellist.cityid=citylist.srno ORDER BY hotellist.srno Asc") or die(mysql_error());
    }
    else if($SearchParam=='*')
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno ORDER BY hotellist.srno Asc") or die(mysql_error());
    }
    else if($SearchParam[0]==':' && strlen($SearchParam)>1)
    {
        $SearchParam = str_replace(":","",$SearchParam);
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno AND citylist.name LIKE '$SearchParam%' ORDER BY hotellist.srno Asc") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno AND hotellist.name LIKE '%$SearchParam%' ORDER BY hotellist.srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['cityname'] . '</td>';
            $response.='<td><a href="showcase_view.php?KEY=' . $row['srno'] . '" title="Click to view details">View</a></td>';
            $response.='</tr>';
        }
    }
    $response.="</table>";
    echo $response;
}

function enquiryResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno=$SearchParam ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE customer.name LIKE '%$SearchParam%' AND enquiry.cid=customer.srno ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['destination'] . '</td>';
            $response.='<td><a href="enquiry_view.php?KEY=' . $row['srno'] . '">View</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function enquiryUpdateResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno=$SearchParam AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE customer.name LIKE '%$SearchParam%' AND enquiry.cid=customer.srno AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['destination'] . '</td>';
            $response.='<td><a href="enquiry_update_form.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function enquiryDeleteResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno=$SearchParam AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT enquiry.srno, name, destination FROM enquiry, customer WHERE customer.name LIKE '%$SearchParam%' AND enquiry.cid=customer.srno AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['destination'] . '</td>';
            $response.='<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteEnquiry\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function enqAppResults($SearchParam) 
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT enquiry.srno, customer.name, enquiry.destination, customer.mobile FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno=$SearchParam AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT enquiry.srno, customer.name, enquiry.destination, customer.mobile FROM enquiry, customer WHERE enquiry.cid=customer.srno AND customer.name LIKE '%$SearchParam%' AND enquiry.applock=0 ORDER BY enquiry.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Mobile</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['destination'] . '</td>';
            $response.='<td>' . $row['mobile'] . '</td>';
            $response.='<td><a href="application_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function appResults($SearchParam)
{
    if(trim($SearchParam)=='')
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag, enquiry.destination FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag, enquiry.destination FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND customer.name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            if($row['cancelflag'])
                $response.='<tr style="background: #ffe8cb;" title="Canceled Application">';
            else
                $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['destination'] . '</td>';
            $response.='<td><a href="application_view.php?KEY=' . $row['srno'] . '">View</a></td>';
            $response.='</tr>';
        }
    }
    mysql_fetch_array($result);
    $response.='</table>';
    echo $response;
}

function appDeleteResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.srno=$SearchParam ORDER BY application.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND customer.name LIKE '%$SearchParam%' ORDER BY application.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Hotel</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            if($row['cancelflag']){
                $response.='<tr style="background: #ffe8cb;" title="Cancelled Application">';
            }
            else{
                $response.='<tr>';
            }
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            
            $result_=mysql_query("SELECT hotellist.name FROM application_hotel, hotellist WHERE application_hotel.aid=" . (int)$row['srno'] . " AND application_hotel.hid=hotellist.srno") or die(mysql_error());
            $hotelname='';
            while($row_=  mysql_fetch_array($result_)){
                $hotelname.=trim($row_['name']) . ', ';
            }
            $hotelname = rtrim($hotelname, ", ");
            if(strlen($hotelname)>30){
                $response.='<td title="' . $hotelname . '">' . substr($hotelname, 0, 30) . '...</td>';
            }
            else{
                $response.='<td>' . $hotelname . '</td>';
            }            
            $response.='<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteApp\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function appUpdateResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.srno=$SearchParam ORDER BY application.srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND customer.name LIKE '%$SearchParam%' ORDER BY application.srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Hotel</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            if($row['cancelflag']){
                $response.='<tr style="background: #ffe8cb;" title="Cancelled Application">';
            }
            else{
                $response.='<tr>';
            }
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            
            $result_=mysql_query("SELECT hotellist.name FROM application_hotel, hotellist WHERE application_hotel.aid=" . (int)$row['srno'] . " AND application_hotel.hid=hotellist.srno") or die(mysql_error());
            $hotelname='';
            while($row_=  mysql_fetch_array($result_)){
                $hotelname.=trim($row_['name']) . ', ';
            }
            $hotelname = rtrim($hotelname, ", ");
            if(strlen($hotelname)>30){
                $response.='<td title="' . $hotelname . '">' . substr($hotelname, 0, 30) . '...</td>';
            }
            else{
                $response.='<td>' . $hotelname . '</td>';
            }            
            $response.='<td><a href="application_new.php?KEY=' . $row['eid'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function voucherResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.srno=$SearchParam ORDER BY application.srno DESC") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application.srno, customer.name, application.cancelflag FROM application, customer, enquiry WHERE application.eid=enquiry.srno AND enquiry.cid=customer.srno AND customer.name LIKE '%$SearchParam%' ORDER BY application.srno DESC") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Hotel</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            if($row['cancelflag'])
                $response.='<tr style="background: #ffe8cb;" title="Cancelled Application">';
            else
                $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';            
            $result_=mysql_query("SELECT application_hotel.hid, hotellist.name FROM application_hotel, hotellist WHERE application_hotel.aid=" . (int)$row['srno'] . " AND application_hotel.hid=hotellist.srno") or die(mysql_error());
            if(mysql_num_rows($result_)==1){
                $row_=  mysql_fetch_array($result_);
                $response.='<td>' . $row_['name'] . '</td>';
                $response.='<td><a href="voucher_view.php?AID=' . $row['srno'] . '&HID=' . $row_['hid'] . '" target="_blank">Print Preview</a></td>';
            }
            else if(mysql_num_rows($result_)>1){
                $i=1;
                while($row_=  mysql_fetch_array($result_)){
                    if($i==1){
                        $response.='<td>' . $row_['name'] . '</td>';
                    }
                    else{
                        $response.='<tr>';
                        $response.='<td colspan="2"></td>';
                        $response.='<td>' . $row_['name'] . '</td>';
                    }
                    $response.='<td><a href="voucher_view.php?AID=' . $row['srno'] . '&HID=' . $row_['hid'] . '" target="_blank">Print Preview</a></td>';
                    $response.='</tr>';
                    $i++;
                }                        
            }
            $response.='</tr>';            
        }
    }
    mysql_fetch_array($result);
    $response.='</table>';
    echo $response;
}

function invoiceResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, hotelname, chkin, chkout, cancelflag FROM application WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, hotelname, chkin, chkout, cancelflag FROM application WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td style="width:50px;">No.</td><td style="width:200px;">Name</td><td style="width:150px;">Hotel Name</td><td style="width:150px;">Check In</td><td style="width:150px;">Check Out</td><td style="width:150px;">Action</td></tr>';
        while($row = mysql_fetch_array($result))
        {
            if($row['cancelflag'])
                $response.='<tr class="error">';
            else
                $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['hotelname'] . '</td>';
            $response.='<td>' . $row['chkin'] . '</td>';
            $response.='<td>' . $row['chkout'] . '</td>';
            if($row['cancelflag'])
                $response.='<td>Canceled Application</td>';
            else
                $response.='<td><a href="invoice_view.php?KEY=' . $row['srno'] . '" target="_blank">Print Preview</a></td>';
            $response.='</tr>';
        }
    }
    mysql_fetch_array($result);
    $response.='</table>';
    echo $response;
}

function receiptResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT receipt.srno as rno,customer.name,hotellist.name as hotelname,application.srno as ano,receipt.amount FROM receipt,application,enquiry,customer,hotellist WHERE receipt.aid = application.srno and application.eid = enquiry.srno and enquiry.cid = customer.srno and application.hid = hotellist.srno and receipt.srno = $SearchParam ORDER BY receipt.srno DESC") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT receipt.srno as rno,customer.name,hotellist.name as hotelname,application.srno as ano,receipt.amount FROM receipt,application,enquiry,customer,hotellist WHERE receipt.aid = application.srno and application.eid = enquiry.srno and enquiry.cid = customer.srno and application.hid = hotellist.srno and customer.name like '%$SearchParam%' ORDER BY receipt.srno DESC") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td style="width:50px;">No.</td><td style="width:200px;">Name</td><td style="width:150px;">Hotel Name</td><td style="width:150px;">Amount</td><td style="width:150px;">Action</td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['rno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['hotelname'] . '</td>';
            $response.='<td>Rs. ' . $row['amount'] . '</td>';
            $response.='<td><a href="receipt_view.php?KEY=' . $row['srno'] . '" target="_blank">View</a></td>';
            $response.='</tr>';
        }
    }
    $response.='</table>';
    echo $response;
}

function rcptAppResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application.srno, customer.name, hotellist.name AS hotelname, application.chkin, application.chkout FROM application, enquiry, customer, hotellist, application_amount WHERE application.srno=$SearchParam AND application_amount.aid=application.srno AND application_amount.balance_amount>0 AND application.cancelflag=0 AND application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.hid=hotellist.srno ORDER BY application.srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application.srno, customer.name, hotellist.name AS hotelname, application.chkin, application.chkout FROM application, enquiry, customer, hotellist, application_amount WHERE customer.name LIKE '%$SearchParam%' AND application_amount.aid=application.srno AND application_amount.balance_amount>0 AND application.cancelflag=0 AND application.eid=enquiry.srno AND enquiry.cid=customer.srno AND application.hid=hotellist.srno ORDER BY application.srno Asc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td style="width:50px;">No.</td><td style="width:200px;">Name</td><td style="width:150px;">Hotel Name</td><td style="width:150px;">Check In</td><td style="width:150px;">Check Out</td><td style="width:150px;">Action</td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['hotelname'] . '</td>';
            $response.='<td>' . $row['chkin'] . '</td>';
            $response.='<td>' . $row['chkout'] . '</td>';
            $response.='<td><a href="receipt_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_fetch_array($result);
    $response.='</table>';
    echo $response;
}

function hotelResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.srno=$SearchParam ORDER BY hotellist.name Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.name LIKE '%$SearchParam%' ORDER BY hotellist.name Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['cityname'] . '</td>';
            $response.='<td><a href="hotel_view.php?KEY=' . $row['srno'] . '">View</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function hotelRoomResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno AND hotellist.srno=$SearchParam ORDER BY hotellist.name Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno AND hotellist.name LIKE '%$SearchParam%' ORDER BY hotellist.name Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' hotel(s) in the list</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td><a href="javascript:;" onClick="loadResults(\'resultset\',\'fetchRoomDetails\',\'request.php\',\'' . $row['srno'] . '\');">' . $row['name'] . '</a></td>';
            $response.='<td>' . $row['cityname'] . '</td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}


function hotelUpdateResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.srno=$SearchParam ORDER BY hotellist.name Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.name LIKE '%$SearchParam%' ORDER BY hotellist.name Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td><td colspan="3"><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['cityname'] . '</td>';
            $response.='<td><a href="hotel_update_form.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update Info</a></td>';
            $response.='<td><a href="hotel_add_photos.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Add Photos</a></td>';
            $response.='<td><a href="hotel_delete_photos.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Delete Photos</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function hotelDeleteResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.srno=$SearchParam ORDER BY hotellist.name Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid = citylist.srno AND hotellist.name LIKE '%$SearchParam%' ORDER BY hotellist.name Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' hotel(s) in the list</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['cityname'] . '</td>';
            $response.='<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteHotel\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}


function deleteEnquiry($SearchParam, $user) 
{
    dbConnect();
    $result = mysql_query("DELETE FROM enquiry WHERE srno=$SearchParam") or die(mysql_error());
    if($result)
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Enquiry</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Enquiry</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function deleteApplication($SearchParam, $user) 
{
    dbConnect();
    $eidresult = mysql_query("SELECT eid from application WHERE srno = $SearchParam") or die(mysql_error());
    $eidrow = mysql_fetch_array($eidresult);
    $result = mysql_query("DELETE FROM application WHERE srno=$SearchParam");
    if($result)
    {
        mysql_query("UPDATE enquiry set applock=0 WHERE srno=" . $eidrow['eid']) or die(mysql_error());
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Application</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Application</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function deleteHotel($SearchParam, $user)
{
    dbConnect();
    $result = mysql_query("DELETE FROM hotellist WHERE srno = $SearchParam") or die(mysql_error());
    if($result)
    {
        rrmdir("hoteldata/$SearchParam");
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Hotel</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Hotel</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}
function deleteRoom($SearchParam, $user) 
{
    dbConnect();
    $result = mysql_query("DELETE FROM roomlist WHERE srno=$SearchParam") or die(mysql_error());
    if($result)
    {
        $response="<h3 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h3 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h3>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Hotel Room</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h3 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h3 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h3>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Hotel Room</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function clearActivity($user) 
{
    dbConnect();
    $RowNum = mysql_query("SELECT * FROM activitylog");
    $RowNum = mysql_num_rows($RowNum);
    $result = mysql_query("DELETE FROM activitylog") or die(mysql_error());
    if($result)
    {
        $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
        $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
        $MaxSr = intval($MaxSr[0]) + 1;
        mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Activity Log Cleared: $RowNum Record(s) Deleted','" . date('D, d-M-Y H-i-s T') . "','" . $user . "')") or die(mysql_error());
        
        $response="<h3 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h3 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h3>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Activity Log</td></tr>";
        $response.="<tr><td>Record ID</td><td>User Activity</td></tr>";
        $response.="<tr><td>Result</td><td>Cleared</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h3 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h3 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h3>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Activity Log</td></tr>";
        $response.="<tr><td>Record ID</td><td>User Activity</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function deleteUser($SearchParam, $user)
{
    dbConnect();
    $result = mysql_query("DELETE FROM useraccounts WHERE username='$SearchParam'") or die(mysql_error());
    if($result)
    {
        $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
        $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
        $MaxSr = intval($MaxSr[0]) + 1;
        mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'User $SearchParam deleted by $user','" . date('D, d-M-Y H-i-s T') . "','" . $user . "')") or die(mysql_error());
        
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}


function blockUser($SearchParam, $user)
{
    dbConnect();
    $result = mysql_query("UPDATE useraccounts SET blockstatus=1 WHERE username='$SearchParam'") or die(mysql_error());
    if($result)
    {
        $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
        $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
        $MaxSr = intval($MaxSr[0]) + 1;
        mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'User $SearchParam blocked by $user','" . date('D, d-M-Y H-i-s T') . "','" . $user . "')") or die(mysql_error());
        
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Blocked</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function unblockUser($SearchParam, $user)
{
    dbConnect();
    $result = mysql_query("UPDATE useraccounts SET blockstatus=0 WHERE username='$SearchParam'") or die(mysql_error());
    if($result)
    {
        $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
        $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
        $MaxSr = intval($MaxSr[0]) + 1;
        mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'User $SearchParam unblocked by $user','" . date('D, d-M-Y H-i-s T') . "','" . $user . "')") or die(mysql_error());
        
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Unblocked</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function resetUser($SearchParam, $user)
{
    dbConnect();
    $result = mysql_query("UPDATE useraccounts SET password='RESETPW' where username='$SearchParam'") or die(mysql_error());
    if($result)
    {
        $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
        $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
        $MaxSr = intval($MaxSr[0]) + 1;
        mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'User $SearchParam reset by $user','" . date('D, d-M-Y H-i-s T') . "','" . $user . "')") or die(mysql_error());
        
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Reset</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>System User</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}

function addcity($city, $state){
    dbConnect();
    mysql_query("INSERT INTO citylist(name, stateid) values('$city', $state)") or die(mysql_error());
}   
function addstate($state, $country){
    dbConnect();
    mysql_query("INSERT INTO statelist (name, countryid) values('$state', $country)") or die(mysql_error());
}
function addcountry($country){
    dbConnect();
    mysql_query("INSERT INTO countrylist (name) values('$country')") or die(mysql_error());
}
function addhotel($param, $eid, $user){
    dbConnect();
    $uid = namei($user);
    mysql_query("INSERT INTO application (eid, uid) values(" . (int)$eid . ", " . (int)$uid . ")");
    mysql_query("UPDATE enquiry SET applock=1 WHERE srno=" . $eid) or die(mysql_error());
    $result = mysql_query("SELECT srno FROM application WHERE eid=" . (int)$eid) or die(mysql_error());
    if(mysql_num_rows($result)){
        $row = mysql_fetch_array($result);
        mysql_query("INSERT INTO application_hotel (hid, aid) values(" . (int)$param . ", " . (int)$row['srno'] . ")") or die(mysql_error());
    }
}
function removehotel($param, $eid){
    dbConnect();
    $result = mysql_query("SELECT srno FROM application WHERE eid=" . (int)$eid) or die(mysql_error());
    if(mysql_num_rows($result)){
        $row = mysql_fetch_array($result);
        mysql_query("DELETE FROM application_hotel WHERE aid=" . $row['srno'] . " AND hid=" . (int)$param) or die(mysql_error());
        mysql_query("DELETE FROM application_rooms WHERE hid=" . (int)$param) or die(mysql_error());
    }
}
function addapproom($roomtype, $fromdate, $todate, $nightnos, $roomnos, $rate, $extrapax, $extrarate, $children, $childrate, $hid, $eid, $user){
    dbConnect();
    $uid = namei($user);
    $result = mysql_query("SELECT srno FROM application WHERE eid=" . (int)$eid) or die(mysql_error());
    if(mysql_num_rows($result)){
        $row = mysql_fetch_array($result);
        mysql_query("INSERT INTO application_rooms(roomtype, nightnos, roomnos, rate, amount, extrapax, extra_rate, extra_amount, children, child_rate, child_amount, chkin, chkout, aid, uid, hid) VALUES('" . $roomtype . "', " . (int)$nightnos . ", " . (int)$roomnos . ", " . (float)$rate . ", " . (float)((int)$nightnos*(int)$roomnos*(float)$rate) . ", " . (int)$extrapax . ", " . (float)$extrarate . ", " . (float)((int)$nightnos*(int)$extrapax*(float)$extrarate) . ", " . (int)$children . ", " . (float)$childrate . ", " . (float)((int)$nightnos*(int)$children*(float)$childrate) . ", '" . $fromdate . "', '" . $todate . "', " . (int)$row['srno'] . ", " . (int)$uid . ", " . (int)$hid . ")") or die(mysql_error());
    }
}
function removeroom($param){
    dbConnect();
    mysql_query("DELETE FROM application_rooms WHERE srno=" . (int) $param) or die(mysql_error());
}

function custResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, address FROM customer WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, address FROM customer WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Address</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            if(strlen($row['address'])>70)
                $response.='<td>' . mb_substr($row['address'], 0, 70) . '...</td>';
            else
                $response.='<td>' . $row['address'] . '</td>';
            $response.='<td><a href="enquiry_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}
function custTourResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, address FROM customer WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, address FROM customer WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Address</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            if(strlen($row['address'])>70)
                $response.='<td>' . mb_substr($row['address'], 0, 70) . '...</td>';
            else
                $response.='<td>' . $row['address'] . '</td>';
            $response.='<td><a href="tour_booking_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function customerResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, mobile FROM customer WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, mobile FROM customer WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="4" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Mobile</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['mobile'] . '</td>';
            $response.='<td><a href="customer_view.php?KEY=' . $row['srno'] . '">View</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function customerUpdateResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, address, mobile FROM customer WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, address, mobile FROM customer WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Address</b></td><td><b>Mobile</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            if(strlen($row['address'])>40)
                $response.='<td title="' . $row['address'] . '">' . mb_substr($row['address'], 0, 40) . '...</td>';
            else
                $response.='<td>' . $row['address'] . '</td>';
            $response.='<td>' . $row['mobile'] . '</td>';
            $response.='<td><a href="customer_update_form.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}

function customerDeleteResults($SearchParam)
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, address, mobile FROM customer WHERE srno=$SearchParam ORDER BY srno Asc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, address, mobile FROM customer WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;") or die(mysql_error());
    } 
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' record(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Address</b></td><td><b>Mobile</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            if (strlen($row['address']) > 70)
                $response.='<td title="' . $row['address'] . '">' . mb_substr($row['address'], 0, 70) . '...</td>';
            else
                $response.='<td>' . $row['address'] . '</td>';
            $response.='<td>' . $row['mobile'] . '</td>';
            $response.='<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'deleteCustomer\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}



function deleteCustomer($SearchParam, $user) 
{
    dbConnect();
    $result = mysql_query("DELETE FROM customer WHERE srno=$SearchParam");
    if(mysql_error()){
        if(strpos(mysql_error(), "Cannot delete or update a parent row")==0) {
            $response = "<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
            $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
            $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
            $response.="<tr><td style='width: 30%;'>Record Type</td><td>Customer</td></tr>";
            $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
            $response.="<tr><td>Error</td><td>The record belongs to one more enquiries.</td></tr>";
            $response.="<tr><td>User</td><td>" . $user . "</td></tr>";
            $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
            $response.="</table>";
            $response.='<meta http-equiv="refresh" content="3">';
            echo $response;
            die();
        }
    }
    if($result)
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Customer</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}
function delTourBooking($SearchParam, $user) 
{
    dbConnect();
    $result_ = mysql_query("SELECT seats, tid FROM application_tour WHERE srno=$SearchParam") or die(mysql_error());
    $row = mysql_fetch_array($result_);
    
    mysql_query("UPDATE tour SET seats_available=seats_available+" . $row['seats'] . " WHERE srno=" . $row['tid']) or die(mysql_error());
    $result = mysql_query("DELETE FROM application_tour WHERE srno=$SearchParam") or(die(mysql_error()));
    if($result)
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tour Booking</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tour Booking</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}
function delTourListItem($SearchParam, $user) 
{
    dbConnect();
    $result = mysql_query("DELETE FROM application_tour_list WHERE srno=$SearchParam") or(die(mysql_error()));
    if($result)
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tourist Detail</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Deleted</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tourist Detail</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}
function tourResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT srno, name, price, seats, seats_available FROM tour WHERE srno=$SearchParam ORDER BY srno Desc;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT srno, name, price, seats, seats_available FROM tour WHERE name LIKE '%$SearchParam%' ORDER BY srno Desc;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td style="width:50px;"><b>No.</b></td><td style="width:200px;"><b>Name</b></td><td style="width:150px;"><b>Price</b></td><td style="width:150px;"><b>Seats</b></td><td style="width:150px;"><b>Available</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['name'] . '</td>';
            $response.='<td>' . $row['price'] . '</td>';
            $response.='<td>' . $row['seats'] . '</td>';
            $response.='<td>' . $row['seats_available'] . '</td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}
function tourBookingResults($SearchParam) 
{
    $response='<table class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, application_tour.seats, tour.price, tour.stax FROM customer, tour, application_tour WHERE application_tour.srno=$SearchParam AND application_tour.cid=customer.srno and application_tour.tid=tour.srno ORDER BY application_tour.srno DESC;") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, application_tour.seats, tour.price, tour.stax FROM customer, tour, application_tour WHERE customer.name LIKE '%$SearchParam%' AND application_tour.cid=customer.srno and application_tour.tid=tour.srno ORDER BY application_tour.srno DESC;") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' result(s) found</td></tr>';
        $response.='<tr><td style="width:50px;"><b>No.</b></td><td style="width:200px;"><b>Name</b></td><td style="width:200px;"><b>Tour Name</td><td style="width:150px;"><b>Seats</td><td style="width:150px;"><b>Amount</td><td style="width:150px;"><b>Action</td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $amount = ($row['price'] * $row['seats']) + ($row['stax']*$row['seats']);
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['cname'] . '</td>';
            $response.='<td>' . $row['tname'] . '</td>';
            $response.='<td style="text-align: right;">' . $row['seats'] . '</td>';
            $response.='<td style="text-align: right;">' . number_format($amount, 2) . '</td>';
            $response.='<td><a href="tour_ticket.php?KEY=' . $row['srno'] . '" target="_blank">Print Ticket</a></td>';
            $response.='</tr>';
        }
    }
    mysql_free_result($result);
    $response.='</table>';
    echo $response;
}
function tourRcptResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT tour_receipt.srno as rno,customer.name as cname,tour.name as tname,tour_receipt.amount FROM customer, application_tour, tour, tour_receipt WHERE tour_receipt.srno=$SearchParam and tour_receipt.aid = application_tour.srno and application_tour.cid = customer.srno and application_tour.tid=tour.srno ORDER BY tour_receipt.srno DESC") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT tour_receipt.srno as rno,customer.name as cname,tour.name as tname,tour_receipt.amount FROM customer, application_tour, tour, tour_receipt WHERE customer.name like '%$SearchParam%' and tour_receipt.aid = application_tour.srno and application_tour.cid = customer.srno and application_tour.tid=tour.srno ORDER BY tour_receipt.srno DESC") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Tour Name</b></td><td><b>Amount</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $response.='<tr>';
            $response.='<td>' . $row['rno'] . '</td>';
            $response.='<td>' . $row['cname'] . '</td>';
            $response.='<td>' . $row['tname'] . '</td>';
            $response.='<td>Rs. ' . $row['amount'] . '</td>';
            $response.='<td><a href="tour_receipt_view.php?KEY=' . $row['rno'] . '" target="_blank">View</a></td>';
            $response.='</tr>';
        }
    }
    $response.='</table>';
    echo $response;
}
function rcptBookResults($SearchParam)
{
    if(trim($SearchParam)=='') 
        return 0;
    $response='<table  class="hovered" style="width:100%">';
    dbConnect();
    if(is_numeric($SearchParam))
    {
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, application_tour.seats, tour.price, tour.stax FROM application_tour, tour, customer WHERE application_tour.cid=customer.srno AND application_tour.tid=tour.srno AND application_tour.srno=$SearchParam ORDER BY application_tour.srno DESC") or die(mysql_error());
    }
    else
    {
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, application_tour.seats, tour.price, tour.stax FROM application_tour, tour, customer WHERE application_tour.cid=customer.srno AND application_tour.tid=tour.srno AND customer.name LIKE '%$SearchParam%' ORDER BY application_tour.srno DESC") or die(mysql_error());
    }
    if(!mysql_num_rows($result))
    {
        $response.='<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
        $response.='</table>';
    }
    else
    {
        $response.='<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
        $response.='<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Tour Name</b></td><td><b>Seats</b></td><td><b>Total Amount</b></td><td><b>Action</b></td></tr>';
        while($row = mysql_fetch_array($result))
        {
            $Price=$row['price']+$row['stax'];
            $response.='<tr>';
            $response.='<td>' . $row['srno'] . '</td>';
            $response.='<td>' . $row['cname'] . '</td>';
            $response.='<td>' . $row['tname'] . '</td>';
            $response.='<td>' . $row['seats'] . '</td>';
            $response.='<td>' . $Price . '</td>';
            $response.='<td><a href="tour_receipt_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
            $response.='</tr>';
        }
    }
    mysql_fetch_array($result);
    $response.='</table>';
    echo $response;
}
function deleteTourRcpt($SearchParam, $user) 
{
    dbConnect();
    $result = mysql_query("UPDATE tour_receipt SET cancelflag=1 WHERE srno=$SearchParam") or die(mysql_error());
    if($result)
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-green' style='display: inline;border-bottom: 2px #ccc dotted;'>200 OK</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tour Receipt</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Result</td><td>Cancelled</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    else
    {
        $response="<h2 class='icon-warning fg-color-blueDark' style='display: inline;'> Request Status : <h2 class='fg-color-redLight' style='display: inline;border-bottom: 2px #ccc dotted;'>#500 Internal Server Error</h2>";
        $response.="<table style='margin: 30px 0 0 30px;width: 80%'>";
        $response.="<tr><td colspan='2'><b>Description</b></td></tr>";
        $response.="<tr><td style='width: 30%;'>Record Type</td><td>Tour Receipt</td></tr>";
        $response.="<tr><td>Record ID</td><td>$SearchParam</td></tr>";
        $response.="<tr><td>Error</td><td>" . mysql_error() . "</td></tr>";
        $response.="<tr><td>User</td><td>". $user ."</td></tr>";
        $response.="<tr><td>Time Stamp</td><td>" . date('D, d-M-Y H-i-s T') . "</td></tr>";
        $response.="</table>";
        $response.='<meta http-equiv="refresh" content="3">';
    }
    echo $response;
}
?>