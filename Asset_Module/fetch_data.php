
<?php  
    //fetch.php  
    include 'db_connect.php'; 
    /*if(isset($_POST["assetID"]))  
    {  
    $query  = "SELECT * FROM assets WHERE assetID = '".$_POST["assetID"]."'";  
    $result = mysqli_query($conn, $query);;  
   //$row    = mysqli_fetch_array($result);  
           // echo json_encode($row);  
    }  
    */
    $query  = "SELECT * FROM assets";  
    $result = mysqli_query($conn, $query);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<table>
 		<tr>
                                   <th>assetID</th>
                                   <th>nameBI</th>
                                   <th>nameBM</th>
                                   <th>Category</th>
                                   <th>Description</th>
                                   <th>Cost</th>
                                   <th>Amount</th>
                                   <th>Condition</th>
                                   <th>Purchased Date</th>
                                   <!--<th>Actions</th> -->
 		</tr>

 		<?php 
 		while($row=mysqli_fetch_assoc($result)){
 			
 		 ?>
 		 <tr>
 		 
 		 		<td><?php echo $row["assetID"]; ?></td>  
                                   <td><?php echo $row["nameBI"]; ?></td>  
                                   <td><?php echo $row["nameBM"]; ?></td>  
                                   <td><?php echo $row["category"]; ?></td>  
                                   <td><?php echo $row["description"]; ?></td>  
                                   <td><?php echo $row["cost"]; ?></td>  
                                   <td><?php echo $row["amount"]; ?></td>  
                                   <td><?php echo $row["asset_condition"]; ?></td>  
                                   <td><?php echo $row["date_purchased"]; ?></td>  
                                  
                                  <!-- <td><input type="button" name="edit" value="Edit" id="<?php //echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /> </td> 
                           -->
 		 	
 		 </tr>
 		                 <?php  
                               }  
                               ?>  
 	</table>

 </body>
 </html>
