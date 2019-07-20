<?php
 ob_start();
 session_start();
 if(!isset($_SESSION['user'])){
   header("Location:index.php");
}
 require_once 'dbconnect.php';

 $error = false;
 
 if ( isset($_POST['btn-apply']) ) {
  
$hostel= ($_POST['hostel']);
$duration= ($_POST['duration']);
if( !$error ) {
  $query = "INSERT INTO application(hostel,duration) VALUES('$hostel','$duration')";
   $res = mysql_query($query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully applied";
  
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } }}
if ( isset($_POST['btn-checkresult']) ) {
 
  $rooms = array(0, 0, 0, 0, 0); // 5 empty rooms
    $peopleNotInRoomsYet = 21; // We'll choose a number that won't divide evenly
    $roomNumber = 0;

    while($peopleNotInRoomsYet > 0){ // If there are people waiting...
        if($rooms[$roomNumber] == 4){ // If the room is full...
            $roomNumber ++; // Go to the next room
        }
        if($roomNumber == 5){ // If we are out of rooms...
            die("Too many people!!!"); // die
        }else{
        $rooms[$roomNumber] ++; // Otherwise, add someone to the room
        $peopleNotInRoomsYet --; // And remove them from the waiting list
    }}
    if( !$error ) {
      // $_SESSION['user'] = $row['user_id'];
       $query = "UPDATE `users` SET `Room_no` = $roomNumber WHERE `users`.`user_id` = {user}";
       $res = mysql_query($query);
    
 }else{
   echo "failed allocation";
 }
   /*if (!$error) {
$query1="SELECT users.user_id, users.userName, personal_details.Gender, application.hostel, application.duration , rooms.Room_no, rooms.Status FROM users 
RIGHT JOIN personal_details ON users.user_id=personal_details.user_id 
RIGHT JOIN rooms ON users.user_id=rooms.Room_no
RIGHT JOIN application ON users.user_id=application.user_id";
//$query1="SELECT user_id, userName FROM users";
$result=mysql_query($query1);
$row = mysql_fetch_assoc($result);
  if ($result > 0) {
      
      if($row["status"]==0){
$query = "UPDATE `rooms` SET `Status` = '0' WHERE `rooms`.`Room_no` = 4";
   $res = mysql_query($query);
   $query2="SELECT Room_no FROM rooms WHERE status=true ";
    $res2=mysql_query($query2);

      if($res2){
       echo "you have been allocated Room No:". $row["Room_no"]  ."<br>";
      
    // output data of each row
    //while($row = mysql_fetch_assoc($result)) {
 //echo "id: " . $row["user_id"]. " - Name: " . $row["userName"]." - Gender: " . $row["Gender"]." - HOSTEL: " . $row["hostel"]." - Duration: " . $row["duration"]." - ROOM NO: " . $row["Room_no"]." - STATUS: " . $row["status"]."<br>";
    
}}
   
}*/}
  ?>
 <!DOCTYPE html>
<html>
<body>
<?php
if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
 <label>
              Select Hostel<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="hostel">
  <option value="TUK MEN HOSTEL" name="men_hostel" >TUK MEN HOSTEL</option>
  <option value="TUK LADIES HOSTEL" name="ladies_hostel">TUK LADIES HOSTEL</option>/>
  
</select>
          </div>


           Select Duration Of Stay<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="duration">
  <option value="ONE MONTH">ONE MONTH</option>
  <option value="TWO MONTHS">TWO MONTHS</option>
  <option value="THREE MONTHS">THREE MONTHS</option>
  <option value="FOUR MONTHS">FOUR MONTHS</option>
 
</select>

          </div>
<br/>
          <br/>

 <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-apply">APPLY</button>
            </div>
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-checkresult">CHECK RESULT</button>
            </div>
 </form>


</body>
</html>
<?php ob_end_flush(); ?>