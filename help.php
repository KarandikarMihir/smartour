<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px">Help Center</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="width:100%;height:340px;overflow:auto;float: left;">
        <div style="width:99%;float: left;">
            <ul class="accordion" data-role="accordion" style="margin: 0;">
                <li>
                    <a href="javascript:;">Logging In</a>
                    <div>
                        <ul>
                            <li id="bullet">Make sure no one else is logged in. To log someone else out: Look at the top-right corner of Navigation Bar and select <b>Logout</b>.</li>
                            <li id="bullet">Go to <a href="login.php" target="_blank">login</a> page and enter a pair of valid User Name and Password.</li>
                            <li id="bullet">Click <b>Secure Login</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Managing Account</a>
                    <div>
                        <ul>
                            <li id="bullet">Only administrator can delete your account information.</li>
                            <li id="bullet">If you have administrative privileges:
                                <ul>
                                    <li id="bullet">To view account information, click Housekeeping > <a href="userac.php" target="_blank">User Accounts</a>.</li>
                                    <li id="bullet">You can either <b>View</b> account details, <b>Update</b> them or <b>delete</b> the account.</li>
                                    <li id="bullet">Account details cannot be altered by any other general user.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Hotel Showcase</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Master > <a href="showcase.php" target="_blank">Showcase</a></li>
                            <li id="bullet">Enter hotel's name, you will be shown a suggestive list. Select desired name.</li>
                            <li id="bullet">A list of hotels with similar names will be displayed. Choose the desired row and click <b>View</b>.</li>
                            <li id="bullet">You will be able to see <b>Hotel Details</b> along with the <b>Photo Gallery</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Manage Cities and Hotels</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Master > <a href="hotel_master.php" target="_blank">Hotel Master</a></li>
                            <li id="bullet">To manage list of locations:
                                <ul>
                                    <li id="bullet">Click on the first <i class="icon-cog"></i> icon from left</li>
                                    <li id="bullet">You can now <b>add</b> or <b>delete</b> Cities, States and Countries</li>
                                </ul>
                            </li>
                            <li id="bullet">To manage list of hotels:
                                <ul>
                                    <li id="bullet">Click on the second <i class="icon-cog"></i> icon from left.</li>
                                    <li id="bullet">You can <a href="hotel.php" target="_blank">Search</a>, <a href="hotel_new.php" target="_blank">Append</a>, <a href="hotel_update.php" target="_blank">Update</a> and <a href="hotel_delete.php" target="_blank">Delete</a> Hotels from the Task Pane.</li>
                                    <li id="bullet">You can also manage Hotel Rooms by selecting <b>Rooms</b> option from the Task Pane.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Enquiry</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Master > <a href="enquiry.php" target="_blank">Enquiry</a></li>
                            <li id="bullet">Select appropriate option from the Task Pane.</li>
                            <li id="bullet">For new enquiry, select <b>Append</b></li>
                            <li id="bullet">To modify an existing enquiry, select <b>Update</b></li>
                            <li id="bullet">To remove an existing enquiry permanently, select <b>Delete</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Application</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Master > <a href="application.php" target="_blank">Application</a></li>
                            <li id="bullet">Select appropriate option from the Task Pane.</li>
                            <li id="bullet"><b>Note:</b> You must submit a corresponding enquiry before you create an application.</li>
                            <li id="bullet">For new application, select <b>Append</b></li>
                            <li id="bullet">To modify an existing application, select <b>Update</b></li>
                            <li id="bullet">To remove an existing application permanently, select <b>Delete</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Feedback</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Master > <a href="feedback.php" target="_blank">Feedback Form</a></li>
                            <li id="bullet">You will be shown pending entries.</li>
                            <li id="bullet">Choose desired row and click <b>Submit</b></li>
                            <li id="bullet">Fill up the information and submit the form</li>
                            <li id="bullet"><b>Note:</b> Feedback form cannot be altered, deleted or created anew.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Voucher</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Transaction > <a href="voucher_search.php" target="_blank">Voucher</a></li>
                            <li id="bullet">You will be redirected to search page.</li>
                            <li id="bullet">Type application number or applicant's name and click <b>Search.</b></li>
                            <li id="bullet">Select the correct row and click on <b>Print Preview.</b></li>
                            <li id="bullet">You can print the page by simply pressing <b>ctrl+p</b></li>
                            <li id="bullet"><b>Note:</b> You cannot alter a voucher.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Receipt</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Transaction > <a href="receipt.php" target="_blank">Receipt</a></li>
                            <li id="bullet">Select appropriate option from the Task Pane.</li>
                            <li id="bullet">To issue a new receipt, click <b>Append</b></li>
                            <li id="bullet"><b>Note:</b> You cannot alter a receipt.</li>
                            <li id="bullet">You can delete receipts. Click <b>Delete</b> and select a receipt to delete.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Invoice</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Transaction > <a href="invoice_search.php" target="_blank">Invoice</a></li>
                            <li id="bullet">You will be redirected to search page.</li>
                            <li id="bullet">Type application number or applicant's name and click <b>Search.</b></li>
                            <li id="bullet">Select the correct row and click on <b>Print Preview.</b></li>
                            <li id="bullet">You can print the page by simply pressing <b>ctrl+p</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Cancellation</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Transaction > <a href="cancellation.php" target="_blank">Cancellation</a></li>
                            <li id="bullet">You will be redirected to intermediate page.</li>
                            <li id="bullet">Fill up the necessary information.</li>
                            <li id="bullet">Submit query.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Parameters</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Transaction > <a href="params.php" target="_blank">Parameters</a></li>
                            <li id="bullet">You can change primary information of the company at any point.</li>
                            <li id="bullet">Click <b>Submit</b> to modify the details.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Database Management</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Housekeeping > <a href="dbms.php" target="_blank">Database Management</a></li>
                            <li id="bullet">Only Administrators are allowed to perform database related operations.</li>
                            <li id="bullet">Select appropriate option from the task pane.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Activity Log</a>
                    <div>
                        <ul>
                            <li id="bullet">Select Housekeeping > <a href="activity.php" target="_blank">Activity Log</a></li>
                            <li id="bullet">All the important activities can be seen here.</li>
                            <li id="bullet">Logs cannot be altered.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Messenger</a>
                    <div>
                        <ul>
                            <li id="bullet">Select <a href="messenger.php" target="_blank">Messenger</a> from navigation menu.</li>
                            <li id="bullet">To send a message to another user of the system, select <a href="messenger_send.php" target="_blank">Send Message</a> from the Task Pane.</li>
                            <li id="bullet">To view all the received messages, select <a href="messenger_oldmsg.php" target="_blank">Received Message</a> from the Task Pane.</li>
                            <li id="bullet">You can <b>Delete</b> all messages by selecting <b>Delete All Messages</b></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:;">Google Maps</a>
                    <div>
                        <ul>
                            <li id="bullet">Select <a href="googlemaps.php" target="_blank">Google Maps</a> from navigation menu.</li>
                            <li id="bullet">Enter the destination.</li>
                            <li id="bullet">That's it!</li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<?php include 'footer.html' ?>