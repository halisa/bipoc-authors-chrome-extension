<?php
session_start();
require('db.php');
// gets what the xhr sent in string format
$in = file_get_contents('php://input');
// turns the json string into php code
$data2 = json_decode($in);
// builds the query 
$query = "SELECT * FROM books_authors Where Genre = 'Null'";
foreach($data2 as $d){
     $query .= "OR Genre = '" . $d ."'";
  }
$query .= ";";
// sends the query to database 
   $sql = @mysqli_query($link, $query);
//processes the results 
   if(mysqli_num_rows($sql) > 0){
       //output data of each row
       
        while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){ 
		 $lastName= $row[0] ;
            $_SESSION['lastName']= $lastName;
            $firstName = $row[1];
            $_SESSION['firstName']=$firstName;
            $title = $row[2];
            $_SESSION['title']=$title;
            $year = $row[3];
            $_SESSION['year']=$year;
            $genre2 = $row[4];
            $_SESSION['genre2']=$genre2;
            $theme2 = $row[5];
            $_SESSION['them2']=$theme2;
            $ident2 = $row[6];
            $_SESSION['ident2']=$ident2;
            $length2 = $row[7];
            $_SESSION['length2']=$length2;
            $isbn = $row[8];
            $_SESSION['isbn']=$isbn;
            $approval = $row[9];
            $_SESSION['approval']=$approval;
			$bookcover = $row[10];
			$_SESSION['book-cover'] = $bookcover;
			$description = $row[11];
			$_SESSION['description'] = $description;
			$booklink = $row[12];
		// what will be the this.responcetext 
		echo  '
        <h3>'.   $ident2  .'</h3>
        
          <img src=" ' . $bookcover. '" alt=" '.  $title .' (Cover)" width="200" height="330" class="image1">
          <p class = "title">Title: <a href="'. $booklink.'" target = "_blank">'. $title .'</a></p>
          <p class = "author">By: '.  $firstName .' '.$lastName .'</p>
          <p class = "genre">Genre: '.  $genre2.' </p>
          <p class = "ISBN">ISBN-13: '. $isbn . '</p>
          <br>
		  
    ' ;
		
		
		}
   }

?>