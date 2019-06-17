<?php session_start();
include("admin_session.php");

?>

<div>
			

					<div class="col-md-2"></div>
					<div class="col-md-6 text-center" >
					<h4>Add Head of Unit</h4><hr>
					<form action="" class="form-horizontal" method="post">
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="email" class="form-control"  name="email" placeholder="E-mail"  required />
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select required name='unit' class='form-control'>
                                            <option  value=''>Select Unit</option>
                                    <?php
                                        $sql = "SELECT * FROM units_table ";
                                        if ($query=mysqli_query($con,$sql)) {       
                                            while($row = mysqli_fetch_array($query)){
                                    ?>
                                            <option value=<?php echo $row['id']?> ><?php echo $row['name']?></option>
                                    <?php

                                            }
                                        }

                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                       <!--  <select hidden name='acc_type' class='form-control'>
                                            <option  value=''>Select Account Type</option>
                                            <option  value='unit_rep'>Schedule Officer Representative</option>
                                            <option  value='hou'>Head Of Schedule Officer's Unit</option>
                                            
                                        </select> -->
                                    <input hidden type="text" name="acc_type" value="hou">
                                    </div>
                                </div>      

                                <div class="form-group push-up-30">
                                     <div class="col-md-12 text-center">
                                         <input type="submit" name="add_agent" class="btn btn-success" value="Add Head Of Unit">
                                    </div>
                                </div>
                                
                            </form> 
                     </div>
                   <div class="col-md-2"></div>                           

</div>