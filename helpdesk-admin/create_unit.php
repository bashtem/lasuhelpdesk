<?php session_start();
include("admin_session.php");

?>

<div>
			

					<div class="col-md-2"></div>
					<div class="col-md-6 text-center" >
					<h4>Create Unit</h4><hr>
                    <p id="create_notify" class="notify"></p>
					<form action="" class="form-horizontal" method="post">
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                    <input type="text" id="utitle" class="form-control"  name="text" placeholder="Unit Title"  required />
                                    </div>
                                </div>                           
                                <div class="form-group">
                                    <div class="col-md-12">
                                        
                                    </div>
                                </div>      

                                <div class="form-group push-up-30">
                                     <div class="col-md-12 text-center">
                                         
                                         <a href="#" id="create_unit" onclick="create_unit()" class="btn btn-primary" > Create Unit</a>
                                    </div>
                                </div>
                                
                        </form> 
                        
                     </div>
                   <div class="col-md-2"></div>   
                   
                   <table class='table table-striped table-bordered'>
                            <thead>
                                <tr class="text-center">
                                    <td>SN</td>                                    
                                    <td>UNIT TITLE</td>
                                    <td>ACTIONS</td>
                                                                        
                                </tr>
                                
                            </thead>
                            <tbody>
                        <?php
$sql = "SELECT * FROM units_table ";
if (($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query)>0)) {$c=0;


    while ($row = mysqli_fetch_array($query)) { $c++;
        $id = $row['id'];
?>
<tr class="text-center">
    <td><?php echo $c;?></td>
    <td><?php echo $row['name'];?> </td>
    
    <td> 

         <span><a href="#" class="btn btn-default" onclick="add_view_sub('view/hide',<?php echo $id; ?>)">View / Hide Subjects</a></span> 
         <span><a href="#" class="btn btn-default" onclick="add_view_sub('add',<?php echo $id; ?>)">Add Subject</a></span>

         <span id=<?php echo "add_span".$id; ?> style="display: none"> <input type="text" id=<?php echo "add_sub".$id; ?> >&nbsp;<a href="#" class="btn btn-success" onclick="add_view_sub('submit',<?php echo $id; ?>)"> Add</a></span><hr>
         <div style="display: none" id=<?php echo "view".$id;?> >
                 <?php
                    $sqlsub = "SELECT * FROM unit_subjects WHERE units_table_id='$id'";
                    if(($querysub=mysqli_query($con,$sqlsub)) ){
                        while($rowsub=mysqli_fetch_array($querysub)){

                 ?>
                <span id=<?php echo "btn_sub".$id; ?> ><a href="#" onclick="add_view_sub('del_sub',<?php echo $rowsub['sub_id']?>)" class="btn btn-xs btn-success"><?php echo $rowsub['subject']?> <span style="color:#B96666" class="glyphicon glyphicon-remove"></span></a></span>
                <?php

                        }
                    }
                 ?>
             
         </div>
   
    </td>
    
    
</tr>
        <?php
    }
}

 ?>
                                
</tbody>
</table>                        

</div>