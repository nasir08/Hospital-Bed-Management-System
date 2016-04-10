<?php
	session_start();
	require_once('inc/functions.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		require_once('inc/header.php');
	}
?>
        <ul id="mainNav">
        	<li><a href="dashboard.php">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="patients.php" class="active">PATIENTS</a></li>
        	<li><a href="beds.php">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul>
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a href="patients.php" class="active">VIew All Patients</a></li>
                    	<li><a href="add-patient.php">Add New Patient</a></li>
                    	<li><a href="assign-bed.php">Assign/Unassign Beds</a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>View All Patients</h2>
                
                <div id="main">
					<h3>Patient Records</h3>
                    	<table cellpadding="0" cellspacing="0">
							<tr>
                                <td><b>Patient ID</b></td>
                                <td><b>Name</b></td>
                                <td><b>Age</b></td>
                                <td><b>Sex</b></td>
                                <td><b>Blood Group</b></td>
                                <td><b>Status</b></td>
                            </tr> 
                            <?php
								$result=mysql_query("SELECT p.*,pb.pat_id,pb.bed_id AS bed FROM patients p,pat_to_bed pb WHERE p.pat_id=pb.pat_id ORDER BY p.pat_id DESC");
								while($row=mysql_fetch_row($result))
								{
									$status="";
									if($row[7]=="none"){ $status="Unassigned"; }
									elseif($row[7]>0){ $status="Admitted <font color=#c66653>{Bed $row[7]}</font>"; } else{ $status="<font color=#33CC99>Discharged</font"; }
									
									
									$rn=$row['0'];
					 				if(strlen($rn)==1)
					 				$rn="000".$rn;
					 				elseif(strlen($rn)==2)
					 				$rn="00".$rn;
					 				elseif(strlen($rn)==3)
					 				$rn="0".$rn;
					 				elseif(strlen($rn)>3)
					 				$rn=$rn;
									
									echo"<tr class=odd>
                                	<td>$rn</td>
                                	<td>$row[1]</td>
                                	<td>$row[2]</td>
                                	<td>$row[3]</td>
                                	<td>$row[4]</td>
									<td>$status</td>
                            		</tr>";
								}
							?>                       
                        </table>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('inc/footer.php');
?>               