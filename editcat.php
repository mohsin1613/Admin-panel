<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if(!isset($_GET['catid']) || $_GET['catid']==null)
{
echo "<script>window.location='catlist.php';</script>";
///header("Location:catlist.php");   
}
else{
    $id=$_GET['catid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                   <?php 
                   if($_SERVER['REQUEST_METHOD']=='POST')
                   {
                       $name=$_POST['name'];
                    $name=mysqli_real_escape_string($db->link,$name);
                    if(empty($name))
                    {
                        echo "<span class='error'>Field must not be empty!</span>";
                    } 
                    else{
                        $query="
                        update tbl_category
                        set
                        name='$name'
                        where id='$id'";
                        $updated=$db->update($query); 
                        if($updated)
                        {
                         echo"<span class='success'>Category Updated Successfully!</span>";   
                        }  
                        else {
                            echo " <span class='error'>Category Not Updated!</span>";
                        }
                    }
                   }
                   
                   ?>
                   <?php
                   $query="select *from tbl_category where id='$id' order by id desc";
                  $category= $db->select($query);
                 while($result=$category->fetch_assoc())
                  {
                   ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php } ?>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>