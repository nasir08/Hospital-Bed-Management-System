<?php
	session_start();
	require_once('inc/functions.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		$error="";
		$error2="";
		$msg="<br><span class=msg>Bed Assigned Successfully</span><br><br>";
		$msg2="<br><span class=msg>Bed Has Been Unssigned Successfully</span><br><br>";
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
                    	<li><a href="patients.php">VIew All Patients</a></li>
                    	<li><a href="add-patient.php">Add New Patient</a></li>
                    	<li><a href="assign-bed.php" class="active">Assign/Unassign Beds</a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>Assign/Unassign Beds</h2>
                
                <div id="main">
                <form method="post" class="jNice" name="frm1">
					<h3>Assign Beds</h3>
                    <?php
						if(isset($_POST['assign']))
						{
							$patient=$_POST['patient'];
							$bed=$_POST['bed'];
							
							if($patient=="none"){ $error="<br><span class=error>Please select a patient</span><br><br>"; }
							elseif($bed=="none"){ $error="<br><span class=error>Please select a bed</span><br><br>"; }
							else
							{
								$result4=mysql_query("SELECT * FROM pat_to_bed WHERE bed_id='$bed'");
								if($row4=mysql_num_rows($result4)>0){ $error="<br><span class=error>Bed $bed has already been assigned to a patient</span><br><br>"; }
								else
								{
									mysql_query("UPDATE pat_to_bed SET bed_id='$bed' WHERE pat_id='$patient'");
									echo $msg;
								}
							}
							
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset>
                            <p><label>Patient:</label>
                            <select name="patient">
                            	<option value="none">[--------SELECT--------]</option>
                                <?php
									$result=mysql_query("SELECT p.pat_id,p.name,pb.pat_id,pb.bed_id FROM patients P, pat_to_bed pb WHERE p.pat_id=pb.pat_id AND pb.bed_id='none' ORDER BY p.pat_id DESC");
									while($row=mysql_fetch_row($result))
									{
										$rn=$row['0'];
					 					if(strlen($rn)==1)
					 					$rn="000".$rn;
					 					elseif(strlen($rn)==2)
					 					$rn="00".$rn;
					 					elseif(strlen($rn)==3)
					 					$rn="0".$rn;
					 					elseif(strlen($rn)>3)
					 					$rn=$rn;
										echo"<option value=$row[0]>$rn - $row[1]</option>";
									}
								?>
                            </select>
                            </p>
                            <p><label>Bed:</label>
                            <select name="bed">
                            	<option value="none">[--------SELECT--------]</option>
                            	<?php
									$result2=mysql_query("SELECT * FROM beds ORDER BY bed_id DESC");
									while($row2=mysql_fetch_assoc($result2))
									{
										echo"<option value=$row2[bed_id]>Bed $row2[bed_id] - $row2[type]</option>";
									}
								?>
                            </select>
                            </p>
                            <input type="submit" value="Assign Bed" name="assign" />
                        </fieldset>
                    </form>
                        <br /><br />
                    <form method="post" class="jNice" name="frm2">
					<h3>Unssign Beds</h3>
                    <?php
						if(isset($_POST['unassign']))
						{
							$ptb=trim($_POST['ptb']);
							
							if($ptb=="none"){ $error2="<br><span class=error>Please select a relationship</span><br><br>"; }
							else
							{
								mysql_query("UPDATE pat_to_bed SET bed_id=0 WHERE pat_id='$ptb'");
								echo $msg2;
							}
							
							if($error2!=""){ echo $error2; }
						}
					?>
                    	<fieldset>
                            <p><label>Patient - Bed Relationship:</label>
                            <select name="ptb">
                            	<option value="none">[--------SELECT--------]</option>
                                <?php
                                $result3=mysql_query("SELECT p.pat_id,p.name,pb.pat_id,pb.bed_id FROM patients P, pat_to_bed pb WHERE p.pat_id=pb.pat_id AND pb.bed_id>0 ORDER BY p.pat_id DESC");
									while($row3=mysql_fetch_row($result3))
									{
										$rn=$row3['0'];
					 					if(strlen($rn)==1)
					 					$rn="000".$rn;
					 					elseif(strlen($rn)==2)
					 					$rn="00".$rn;
					 					elseif(strlen($rn)==3)
					 					$rn="0".$rn;
					 					elseif(strlen($rn)>3)
					 					$rn=$rn;
										echo"<option value=$row3[0]>Bed $row3[3] to $rn - $row3[1]</option>";
									}
									?>
                            </select>
                            </p>
                            <input type="submit" value="Unassign Bed" name="unassign" />
                        </fieldset>
                    </form>
                </div>
                <!-- // #main -->
 <?php
	require_once('inc/footer.php');
?>               