<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
echo "
<body> 
<div id='loading' class='ui-front loader ui-widget-overlay bg-white opacity-100'>
<img src='assets/images/loader-dark.gif' alt=''>
</div>
<div id='page-wrapper' class='demo-example'>";
include('models/topbar.php');
include("models/sidebar.php");
echo "
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>";
echo "
<div id='page-content-wrapper'>
<div id='page-title'>
<h3>Editar Produtos
</h3>
</div>
<div id='page-content'>
";
if(!empty($_POST))
{	
$vendor_name=$_POST['vendor_name'];	
$item_name=$_POST['item_name'];
$description=$_POST["description"];
$description=implode(" ",$description);
$price=$_POST['price'];
$date=$_POST['date'];
$Id=$_POST['Id'];
$prev_pic=$_POST['prev_pic'];
if((empty($_FILES['thefile']['tmp_name'])) && $prev_pic=="demo1.jpg")
$name="demo1.jpg";
else if((empty($_FILES['thefile']['tmp_name'])) && $prev_pic!="demo1.jpg")
$name=$prev_pic;
else
$name=upload();	
$con=connection();
$query="UPDATE quotations SET Vendor_Name='$vendor_name', Item_Name='$item_name', Description='$description', Price='$price', Date='$date', Picture='$name' WHERE Id='$Id'";
$a=mysqli_query($con,$query) ? true : false ;
if($a)
echo "
<div class='row'>
<div class='col-md-4'>

                <div class='infobox success-bg'>
                    <p>1 Quotation has been updated.</p>
                </div>
            </div>
			</div>
			";
else echo "
<div class='row'>
<div class='col-md-6'>

                <div class='infobox error-bg mrg0A'>
                    <p>Error Occured</p>
                </div>
            </div>
        </div>
		";

}
else
{
$con=connection();
$Id=$_GET['Id'];
$query="SELECT * FROM quotations WHERE Id = '$Id'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_row($result);
echo "
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
<input type='hidden' name='Id' value='$Id'>
<input type='hidden' name='prev_pic' value='$row[6]'>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='Vendor_Name'>
                        Vendor Name :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='vendor_name' id='vendor_name' onfocus='searchVendor()' value='$row[1]'>
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='Item_Name'>
                        Item Name :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='item_name' id='item_name' onfocus='searchItems()' value='$row[2]'>
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='Description'>
                     Description :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='description[]' id='description' value='$row[3]'>
                </div>
            </div>												
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='Description'>
                        Price :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='price' id='price' value='$row[4]'>
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='Description'>
                        Date : ".date('d-m-Y',strtotime($row[5]))."
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date' name='date' id='date' value='$row[5]'>
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-3'>
                    <label for='hcopy'>
                        Upload Hard Copy :
						</label>
					"; 
				if($row[6]!=Null)
				echo "
                    <a href='uploads/$row[6]' target='_blank'><img src='uploads/$row[6]' style='height:100px;width:100px;'>";
				else echo "Not Available";
				echo "	
                </div>
                <div class='form-input col-md-5'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='500000' />Select a File (Maximum Size 500 kb):<br />
<input type='file' name='thefile'>
                </div>
            </div>																		
<button class='btn primary-bg medium'>
<span class='button-content'>Update</span>
</button>
</form>";
}
echo "
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
