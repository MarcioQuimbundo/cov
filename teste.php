            <html>
            <head>
            <title></title>
           <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script type="text/javascript">
            var counter = 0;
            $(function(){
             $('p#add_field').click(function(){
             counter += 1;
             $('#container').append(
             '<strong>Hobby No. ' + counter + '</strong><br />'
             + '<input id="field_' + counter + '" name="dynfields[]' + '" type="text" /><br />'

            +'<strong>HolidayReason ' + counter + '</strong>&nbsp;'
             + '<input id="holidayreason_' + counter + '" name="holireason[]' + '" type="text" />'
              );

             });
            });
            </script>

            <body>

            <?php
            if (isset($_POST['submit_val'])) {
            if (($_POST['dynfields'])&& ($_POST['holireason'])) {
                $no = count($_POST['dynfields']);
                for ($i=0; $i <$no ; $i++) { 
                echo $_POST['dynfields'][$i]."<br>";
                echo $_POST['holireason'][$i]."<br>";
                $abc = mysql_real_escape_string($_POST['dynfields'][$i]);
                $xyz = mysql_real_escape_string($_POST['holireason'][$i]);
                $sql =  "INSERT INTO my_hobbies (hobbies,Holidayreason) VALUES ('$abc','$xyz')";
                mysql_query($sql);
                        }
            }

            echo "<i><h2><strong>" . count($_POST['dynfields']) . "</strong> Hobbies Added</h2></i>";

             mysql_close();
            }
            ?>
            <?php if (!isset($_POST['submit_val'])) { ?>
             <h1>Add your Hobbies</h1>
             <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

             <div id="container">
             <p id="add_field"><a href="#"><span>Click To Add Hobbies</span></a></p>
             </div>

             <input type="submit" name="submit_val" value="Submit" />
             </form>
            <?php } ?>

            </body>
            </html>