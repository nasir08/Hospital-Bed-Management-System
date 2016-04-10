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
        	<li><a href="dashboard.php" class="active">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="patients.php">PATIENTS</a></li>
        	<li><a href="beds.php">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul>
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a>Welcome, <?php echo $_SESSION['name']; ?></a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>Dashboard</h2>
                
                <div id="main">
					<h3>Statistics</h3>
               	  <table>
                  <?php
				  	$result=mysql_query("SELECT COUNT(pat_id) FROM patients");
					$row=mysql_fetch_row($result);
					
					$result2=mysql_query("SELECT COUNT(bed_id) FROM beds");
					$row2=mysql_fetch_row($result2);
					
					$result3=mysql_query("SELECT COUNT(pat_id) FROM pat_to_bed WHERE bed_id>0");
					$row3=mysql_fetch_row($result3);
					
					$result4=mysql_query("SELECT COUNT(bed_id) FROM pat_to_bed WHERE bed_id>0");
					$row4=mysql_fetch_row($result4);
					
					$result5=mysql_query("SELECT COUNT(pat_id) FROM pat_to_bed WHERE bed_id=0 AND bed_id!='none'");
					$row5=mysql_fetch_row($result5);
					
					$row6[0] = $row2[0] - $row4[0];
					
					$result7=mysql_query("SELECT COUNT(pat_id) FROM pat_to_bed WHERE bed_id='none'");
					$row7=mysql_fetch_row($result7); 
					
					
					
  							echo"<tr>
    							<td align=center valign=middle><b>Patients</b></td>
    							<td align=center valign=middle><b>Beds</b></td>
  							</tr>
  							<tr>
    							<td align=center valign=middle>Total - $row[0]</td>
    							<td align=center valign=middle>Total - $row2[0]</td>
							</tr>
  							<tr>
    							<td align=center valign=middle>Admitted - $row3[0]</td>
    							<td align=center valign=middle>Occupied - $row4[0]</td>
							</tr>
  							<tr>
   		 						<td align=center valign=middle>Discharged - $row5[0]</td>
    							<td align=center valign=middle>Vacant - $row6[0]</td>
							</tr>
  							<tr>
   							  <td align=center valign=middle>Unassigned to bed - $row7[0]</td>
    							<td align=center valign=middle>&nbsp;</td>
							</tr>";
					?>
				  </table>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('inc/footer.php');
?>               