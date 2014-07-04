<?php
  require_once "Db.php";
     
  $cmd = post("cmd");
  $message = "";
  $name=post("name");
  $gender=post("gender");
  $sname = "";
  $wname="";
  $father_id= 0 + post("father_id");
  $mother_id = 0 + post("mother_id");
  $person_id = 0 + post("person_id");
  
  $p = kvRow("select * from person where person_id=?", array($person_id));
  if($p){
      /* 
	   Set parent ids of groom to a bride 
	   
	   $father_id = $p->father_id;   //father id of selected person
	   $mother_id = $p->mother_id;   //mother id of selected person
	   
	  */
	  $sname = $p->person_name;
	  
	  //Spouse details
	  $sql = "select person_name from person where person_id = (select female_id from marriage where male_id=?)";
	  $wname = kvSingle($sql, array($person_id));
	  if(!$wname){
	  	$sql = "select person_name from person where person_id = (select male_id from marriage where female_id=?)";
	   $wname = kvSingle($sql, array($person_id));
	  }
  }
  
  if($cmd == "Add") {
  	 $array = array( $father_id ? $father_id : null, $mother_id ? $mother_id : null,$name,$gender);
  	 kvExecute("insert into person (father_id,mother_id,person_name,gender) values (?,?,?,?)", $array);
  }
  if($cmd == "Add Wife") {
  	 $array = array( $father_id ? $father_id : null, $mother_id ? $mother_id : null,$name,$gender);
  	 kvExecute("insert into person (father_id,mother_id,person_name,gender) values (?,?,?,?)", $array);
	 $female_id = kvSingle("select max(person_id) from person", array());
	 $male_id = $person_id;
	 kvExecute("insert into marriage (male_id,female_id) values (?,?)", array($male_id,$female_id));
	 $name = "";
	 $gender="";
  }
  if($cmd == "Add Child") {
  	 $father_id = $person_id;
  	 $mother_id = kvSingle("select female_id from marriage where male_id=?",array($person_id));
	
  	 $array = array( $father_id ? $father_id : null, $mother_id ? $mother_id : null,$name,$gender);
  	 kvExecute("insert into person (father_id,mother_id,person_name,gender) values (?,?,?,?)", $array);
	 
	 $name = "";
	 $gender="";
  }
  if($cmd == "Select"){
  	 
  }
  if($cmd == "Delete"){
     kvExecute("delete from  person where person_id=?", array($person_id));  	
  }
  $rows = kvRows("select * from person", array());
?>

<!doctype html>

<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>Example of Geneaology Data Structure</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="col-md-3">
			<form method="post" role="form" class="form-horizontal">
				<?php
				  if($sname){
				  	?>
				  	<div class="panel-default">
				  	 <h3 class="panel-heading"><?=$sname?> - <?=$wname?></h3>
				  	</div> 
				  	<?php
				  }
				?>
				<input type="hidden" name="person_id" value="<?=$person_id?>"/>
				<input type="hidden" name="father_id" value="<?=$father_id?>"/>
				<input type="hidden" name="monther_id" value="<?=$monther_id?>"/>
				<div class="form-group">
					<label for="name" class="col-md-3 control-label">Name</label>
				  <div class="col-md-8">
				  	<input type="text" name="name" id="name" value="<?=$name?>" 
					  class="form-control"/>
				  </div>
				</div>
				<div class="form-group">
					<label for="gender" class="col-md-3 control-label">Gender</label>
				  <div class="col-md-8">
				  	<label class="radio">
				  		<input type="radio" name="gender" <?= $gender=="Male" ? 'checked' : ''?> id="gender" value="Male"/> Male
				     </label>
				     <label class="radio">
				      <input type="radio" name="gender" <?= $gender=="Female" ? 'checked' : ''?> id="gender" value="Female" /> Female 	
				     </label>
				  </div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-1 col-md-10">
						
						<?php
						 if($p){
						   ?>
						   <input type="submit" name="cmd" value="Add Wife" class="btn-primary"/>
						   <input type="submit" name="cmd" value="Add Child" class="btn-primary"/>
						   <?php	
						 }else{
						 	?>
						 	<input type="submit" name="cmd" value="Add" class="btn-primary"/>
						 	<?php
						 }
						
						?>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<table class="table">
				<?php
				  foreach($rows as $r) {
				  	?>
				  	<tr>
				  		<td><?=$r->person_name ?></td>
				  		<td><?=$r->gender?></td>
				  		<td>
				  			<form method="post">
				  				<input type="hidden" name="person_id" value="<?=$r->person_id?>"/>
				  				<input type="submit" name="cmd" value="Select" class="btn-link"/>
				  				<input type="submit" name="cmd" value="Delete" class="btn-link"/>
				  			</form>
				  		</td>
				  	</tr>
				  	
					<?php
				  }
				?>
			</table>
		</div>
	</body>
</html>

