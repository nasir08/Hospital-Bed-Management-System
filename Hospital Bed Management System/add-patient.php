<?php
	session_start();
	require_once('inc/functions.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		$error="";
		$msg="<br><span class=msg>Patient Added Successfully</span><br><br>";
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
                    	<li><a href="add-patient.php" class="active">Add New Patient</a></li>
                    	<li><a href="assign-bed.php">Assign/Unassign Beds</a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>Add New Patient</h2>
                
                <div id="main">
                <form method="post" class="jNice">
					<h3>Registration Form</h3>
                    <?php
						if(isset($_POST['save']))
						{
							$name=trim($_POST['name']);
							$age=trim($_POST['age']);
							$sex=$_POST['sex'];
							$bg=trim($_POST['bg']);
							$phone=trim($_POST['phone']);
							
							if($name==""){ $error="<br><span class=error>Please enter a name</span><br><br>"; }
							elseif($age==""){ $error="<br><span class=error>Please enter the age</span><br><br>"; }
							elseif($age<1){ $error="<br><span class=error>Please enter a value greater than zero for age</span><br><br>"; }
							elseif(!is_numeric($age)){ $error="<br><span class=error>Age must be a number</span><br><br>"; }
							elseif($sex=="none"){ $error="<br><span class=error>Please select the sex</span><br><br>"; }
							elseif($bg==""){ $error="<br><span class=error>Please enter a blood group</span><br><br>"; }
							elseif($phone==""){ $error="<br><span class=error>Please enter the phone number</span><br><br>"; }
							else
							{
								mysql_query("INSERT INTO patients (name,age,sex,blood_group,phone) VALUES ('$name','$age','$sex','$bg','$phone')");
								$result=mysql_query("SELECT pat_id FROM patients ORDER BY pat_id DESC LIMIT 0,1");
								$row=mysql_fetch_array($result);
								
								mysql_query("INSERT INTO pat_to_bed (pat_id,bed_id) VALUES ('$row[pat_id]','none')");
								echo $msg;
							}
							
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset>
                        	<p><label>Patient Name:</label><input type="text" name="name" class="text-long" autofocus value="<?php echo $name; ?>" /></p>
                            <p><label>Age:</label><input type="number" name="age" class="text-long" value="<?php echo $age; ?>" /></p>
                            <p><label>Sex:</label>
                            <select name="sex">
                            	<option value="none">[--------SELECT--------]</option>
                            	<option value="Male">Male</option>
                            	<option value="Female">Female</option>
                            	<option value="Transexual">Transexual</option>
                            	<option value="Other">Other</option>
                            </select>
                            </p>
                            <p><label>Bloog Group:</label><input type="text" name="bg" class="text-long" value="<?php echo $bg; ?>" /></p>
                            <p><label>Phone Number:</label><input type="text" name="phone" class="text-long" value="<?php echo $phone; ?>" /></p>
                            <input type="submit" value="Save" name="save" />
                        </fieldset>
                    </form>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('inc/footer.php');
?>               