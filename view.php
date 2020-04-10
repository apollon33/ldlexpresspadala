<?php
error_reporting (E_ALL ^ E_NOTICE); //para no undefined error
include("conn.php");
include("nav.php");

session_start();
$logged_info = $_SESSION['s_username'] . " - " . $_SESSION['s_branch'];
$v_type = $_SESSION['s_type'];




//redirect to login if no variable set for empid
if(!isset($_SESSION['s_username']) || empty($_SESSION['s_username'])){
	header("location: login.php");
}

if($v_type == "admin"){
    $ito_dapat = mysqli_query($conn,"SELECT * FROM tbl_ldlpadalaexpress ORDER BY date_time_sent DESC");
    
}elseif($v_type == "emp"){
    $ito_dapat = mysqli_query($conn,"SELECT * FROM tbl_ldlpadalaexpress WHERE processed_by='$logged_info' ORDER BY date_time_sent DESC");
    
}

//view
//$view_query = mysqli_query($conn,"SELECT * FROM tbl_ldlpadalaexpress WHERE processed_by='$logged_info' ORDER BY date_time_sent DESC");

 echo '<b><div class="intitle"><center>View</center></div></b>';
	echo "<div class='form'><table border='1' width='100%'";
	echo "<tr>
		<td align='center'><b>Txn No</b></td>
		<td align='center'><b>Amount</b></td>
		<td align='center'><b>Sender</b></td>
        <td align='center'><b>Receiver</b></td>
        <td align='center'><b>Date</b></td>
        <td align='center'><b>Processed by</b></td>
		</tr>";
	
	//while($row = mysqli_fetch_assoc($view_query)) {
    while($row = mysqli_fetch_assoc($ito_dapat)) {
		
		$db_txn_no = $row["txn_no"];
		$db_amt = $row["amt"];
        $db_sender = $row["sender"];
		$db_receiver = $row["receiver"];		
        $db_date_time_sent = $row["date_time_sent"];
        $db_processed_by = $row["processed_by"];
		echo "<tr>
		<td>$db_txn_no</td>
		<td>$db_amt</td>
        <td>$db_sender</td>
		<td>$db_receiver</td>
        <td>$db_date_time_sent</td>
        <td>$db_processed_by</td>
		</tr>";
	}
	
	echo "</table></div> ";   


?>
<title>View</title>

<?php include ('footer.php');?>
