<?php
	session_start();
	require_once('inc/functions.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		$error="";
		$msg="<br><span class=msg>Bed Added Successfully</span><br><br>";
		require_once('inc/header.php');
	}
?>
        <ul id="mainNav">
        	<li><a href="dashboard.php">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="patients.php">PATIENTS</a></li>
        	<li><a href="beds.php" class="active">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul>
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a href="beds.php">VIew All Beds</a></li>
                    	<li><a href="add-bed.php" class="active">Add New Bed</a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>Add New Bed</h2>
                
                <div id="main">
                <form method="post" class="jNice">
					<h3>Registration Form</h3>
                    <?php
						if(isset($_POST['save']))
						{
							$type=$_POST['type'];
							$ward=$_POST['ward'];
							
							if($type=="none"){ $error="<br><span class=error>Please select a type</span><br><br>"; }
							elseif($ward=="none"){ $error="<br><span class=error>Please select a ward</span><br><br>"; }
							else
							{
								mysql_query("INSERT INTO beds (type,ward) VALUES ('$type','$ward')");
								echo $msg;
							}
							
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset>
                            <p><label>Type:</label>
                            <select name="type">
                            	<option value="none">[--------SELECT--------]</option>
                            	<option value="Manual">Manual</option>
                            	<option value="Bariatric">Bariatric</option>
                            	<option value="Full-Electric">Full-Electric</option>
                            	<option value="Semi-Electric">Semi-Electric</option>
                                <option value="Low Bed">Low Bed</option>
                            </select>
                            </p>
                            <p><label>Ward:</label>
                            <select name="ward">
                            	<option value="none">[--------SELECT--------]</option>
                            	<option value="Postnatal">Postnatal</option>
                            	<option value="Pregnancy">Pregnancy</option>
                            	<option value="Critical Care">Critical Care</option>
                            	<option value="Orthopaedic">Orthopaedic</option>
                                <option value="Psychiatric">Psychiatric</option>
                                <option value="Accidents And Emergency">Accidents And Emergency</option>
                                <option value="Paediatric">Paediatric</option>
                            </select>
                            </p>
                            <input type="submit" value="Save" name="save" />
                        </fieldset>
                    </form>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('inc/footer.php');
?>               