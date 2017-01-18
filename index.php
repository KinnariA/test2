<html>
    <head>
        <title>Phonebook</title>
        <style type="text/css">
            body
            {
             font-family: calibri;   
            }
            #loginbox
            {
                margin: auto;
                margin-top:150px;
                padding: 5px;
                width: 500px;
                height: 400px;
                border: 1px solid blue;
            }
            #header
            {
                margin: auto;
                padding: 20px;
                width: 1000px;
                height: 150px;
                border: 1px solid steelblue;
            }
            #menu
            {
               width: 130px;
               height: 150px;
            }
            #title
            {
                margin: auto;
                margin-top:-180px; 
                width: 500px;
                height: 100px;
                font-size: 30px;
                color: slategray;
            }
            #submenu
            {
               margin-left: 800px;
               margin-top: -130px;
               width: 200px;
               height: 30px;
            }
            #display
            {
                margin: auto;
                margin-top: 40px;
                width: 1100px;
                height: auto;
                border: 1px solid steelblue;
            }
            #addcontact
            {
                margin: auto;
                margin-top:50px;
                padding: 5px;
                width: 700px;
                height:500px;
                border: 1px solid steelblue;
            }
            #contactadded
            {
                margin: auto;
                margin-top:150px;
                padding: 5px;
                width: 500px;
                height: 400px;
                border: 1px solid blue;
            }
            #sort
            {
                margin: auto;
                margin-top: 40px;
                width: 1000px;
                height: 100px;
                border: 1px solid steelblue;
            }
            
            h1
            {
                text-align: center;
            }
            td
            {
                text-align: center;
            }
            td.text
            {
                text-align: right;
                font-size: 20px;
                font-weight: bold;
            }
            input.data
            {
                width: 220px;
                height: 25px;
            }
            input.submit
            {
                width: 120px;
                height: 35px;
                font-weight: bold;
            }
            a
            {
                text-decoration: none;
                font-weight:bold;
                color:blue;
            }
            td.data,th
            {
                font-size: 20px;
            }
            input.button
            {
                width: 120px;
                height: 35px;
                font-weight: bold;
            }
        </style>
        <script type="text/javascript">
            function loginvalidate()
            {
               /*
		*/
var abc;

var test;                var username,password;
                
                username = document.getElementById("username").value;
                password = document.getElementById("password").value;
                
                if(username == "" || password == "")
                    {
                        alert("Please Enter All The Fields");
                        return false;
                    }
                 else
                     {
                         return true;
                     }
                     
                    
            }
            
            function passwordvalidate()
            {
                var oldpassword, newpassword, rnewpassword;
                
                oldpassword = document.getElementById("oldpassword").value;
                newpassword = document.getElementById("newpassword").value;
                rnewpassword = document.getElementById("rnewpassword").value;
                
                if(oldpassword == "" || newpassword == "" || rnewpassword == "")
                    {
                        alert("Please Enter All The Fields");
                        return false;
                    }
                    else
                        {
                            return true;
                        }   
            }
            
            function contactvalidate()
            {
                var firstname,lastname,number;
                
                firstname = document.getElementById("firstname").value;
                lastname = document.getElementById("lastname").value;
                number = document.getElementById("number").value;
                
                if(firstname=="" || lastname=="" || number=="")
                    {
                        alert("Please Enter All The Fields");
                        return false;
                    }
                    else
                        {
                            return true;
                        }
            }
            
            
        </script>
    </head>
    <body>
        <?php
		
		@ session_start();
        
        // This Page will be displayed after submitting the changepassword form.
        if(isset($_POST['changepassword']))
        {
            $con = mysql_connect('localhost','root','');
            mysql_select_db("phonebook",$con);
            
            echo '
                     <div id="contactadded">
                     <center>
                     ';
           
           $id = $_SESSION['user_id'];
           $oldpassword = $_REQUEST['oldpassword'];
           $newpassword = $_REQUEST['newpassword'];
           $rnewpassword = $_REQUEST['rnewpassword'];
           
           if($newpassword != $rnewpassword)
           {
               echo "<br>The New Password Does Not Match<br>";
               echo "<br><br><a href=index.php?cp=cp>Click Here To Go Back</a>";
           }
           
           else 
           {
               $sql = "SELECT * FROM phoneauthuser WHERE Id=".$id;
               $result = mysql_query($sql);
               $row = mysql_fetch_array($result);
               $temp = $row['Password'];
               if($temp != $oldpassword)
               {
                   echo "<br>The Old Password Does Not Match";
                   echo "<br><br><a href=index.php?cp=cp>Click Here To Go Back</a>";
               }
               else
               {
                   $sql = "UPDATE phoneauthuser SET Password='$newpassword' WHERE Id='$id'";
                   $result = mysql_query($sql,$con);
                   if($result)
                   {
                       echo '<br><b>Password Updated Successfully</b>';    
                       echo "<br><br><a href=index.php?Id=$id><input class=button type=button name=list value='List Contacts' /></a>";
                   }
                   else
                   {
                       echo mysql_error();
                   }
               }
           }
           
           
           echo '</center></div>';
        }
        
        
        else
        {    
        
        @ $changepassword = $_REQUEST['cp'];
        
        // Change Password Page
        if($changepassword)
        {
            
        echo '
            <div id="addcontact">
            <h1>Change Password</h1>
            <br>
            <center>
            <form onsubmit="return passwordvalidate()" action="index.php" method="POST">
            <table width="80%" height="80%">
                <tr>
                    <td class="text">Enter Old Password :</td>
                    <td><input class="data" type="password" name="oldpassword" id="oldpassword" /></td>
                </tr>
                <tr>
                    <td class="text">Enter New Password :</td>
                    <td><input class="data" type="password" name="newpassword" id="newpassword" /></td>
                </tr>
                <tr>
                    <td class="text">REENTER NEW PASSWORD :</td>
                    <td><input class="data" type="password" name="rnewpassword" id="rnewpassword" /></td>
                </tr>
                <tr>
                     <td colspan="2"><input class="submit" type="submit" name="changepassword" value="Change" /></td>
                </tr>    
            </table>    
            </form>
            </center>
            </div>


               ';
        }
        
        
        else
        {    
        
        // This Page will be displayed after deleting the contact    
        if(isset($_POST['deletecontact']))
        {
           $con = mysql_connect('localhost','root','');
           mysql_select_db("phonebook",$con);
           
           $id = $_SESSION['user_id'];
           $recordid = $_REQUEST['recordid'];
           
           $sql = "DELETE FROM phoneinfo WHERE Id='$recordid'";
           $result = mysql_query($sql,$con);
           if($result)
           {
               echo '
                     <div id="contactadded">
                     <center>
                     <b><br>Contact Deleted Successfully</b>';    
               echo "<br><br><a href=index.php?Id=$id><input class=button type=button name=list value='List Contacts' /></a>";
               echo  '</center></div>';
           }
           else
           {
               echo mysql_error();
           }
         
        }
        
        
        else
        {    
        
        // This Page will be displayed after updating the contact            
        if(isset($_POST['updatecontact']))
        {
           $con = mysql_connect('localhost','root','');
           mysql_select_db("phonebook",$con);
           
           $id = $_SESSION['user_id'];
           $recordid = $_REQUEST['recordid'];
           $firstname = $_REQUEST['firstname'];
           $lastname = $_REQUEST['lastname'];
           $number = $_REQUEST['number'];
           
           $sql = "UPDATE phoneinfo SET FirstName='$firstname', LastName='$lastname', Contact_Number='$number' WHERE Id='$recordid'";
           $result = mysql_query($sql,$con);
           if($result)
           {
               echo '
                     <div id="contactadded">
                     <center>
                     <b><br>Contact Updated Successfully</b>';    
               echo "<br><br><a href=index.php?Id=$id><input class=button type=button name=list value='List Contacts' /></a>";
               echo  '</center></div>';
           }
           else
           {
               echo mysql_error();
           }
         
        }
        
        
        else
        {    
         
        // This Page will be displayed When the New Contact is Added
        
        if(isset($_POST['addcontact']))
        {
           $con = mysql_connect('localhost','root','');
           mysql_select_db("phonebook",$con);
           
           $id = $_SESSION['user_id'];
           $firstname = $_REQUEST['firstname'];
           $lastname = $_REQUEST['lastname'];
           $number = $_REQUEST['number'];
           $con = mysql_connect('localhost','root','');
           mysql_select_db("phonebook",$con);
           $sql = "INSERT INTO phoneinfo(User_Id,FirstName,LastName,Contact_Number) VALUES('$id','$firstname','$lastname','$number')";
           $result = mysql_query($sql,$con);
           if($result)
           {
               echo '
                     <div id="contactadded">
                     <center>
                     <b><br>Contact Added Successfully</b>';    
               echo "<br><br><a href=index.php?Id=$id><input class=button type=button name=list value='List Contacts' /></a>";
               echo  '</center></div>';
           }
           else
           {
               echo mysql_error();
           }
         
        }
        
        
        else
        {
            
        @ $value = $_REQUEST['value'];    
        
        // Add Contact Page
        if($value)
        {
            echo '
            <div id="addcontact">
            <h1>Add Contact</h1>
            <br>
            <center>
            <form onsubmit="return contactvalidate()" action="index.php" method="POST">
            <table width="80%" height="80%">
                <tr>
                    <td class="text">First Name :</td>
                    <td><input class="data" type="text" name="firstname" id="firstname" /></td>
                </tr>
                <tr>
                    <td class="text">Last Name :</td>
                    <td><input class="data" type="text" name="lastname" id="lastname" /></td>
                </tr>
                <tr>
                    <td class="text">Contact Number :</td>
                    <td><input class="data" type="number" name="number" id="number" /></td>
                </tr>
                <tr>
                     <td colspan="2"><input class="submit" type="submit" name="addcontact" value="ADD CONTACT" /></td>
                </tr>    
            </table>    
            </form>
            </center>
            </div>


               ';
        }
        
        else
        {
        @ $id = $_REQUEST['Id'];
        @ $sort = $_REQUEST['Sort'];
        @ $recordid = $_REQUEST['RecordId'];
        
        
        // HOME Page After Login
        if(isset($_POST['submit'])) 
        {
           $con = mysql_connect('localhost','root','');
           mysql_select_db("phonebook",$con);
            
           $username = $_REQUEST['username'];
           $password = $_REQUEST['password'];
            
            
           
           $sql = "SELECT * from phoneauthuser WHERE Username='$username' AND Password='$password'";
           $result = mysql_query($sql,$con);
           $row = mysql_num_rows($result);
           if($row > 0)
           {
               $row = mysql_fetch_array($result);
               
               $_SESSION['user_id'] = $row['Id'];
               echo '
                   
              <div id="header">
              <div id="menu">
                  <img src="images/add_contact.jpg" height="120"  width="130"></img><br>
                  <span style="padding-left: 10px"><a href="index.php?value=addnewrecord">Add New Contact</a></span>
              </div>
              <div id="title">
              <h1>PHONE BOOK</h1>
              </div>
              <div id="submenu">
                  <table width="100%" height="100%">
                      <tr>
                          <td><a href="index.php?cp=cp">Change Password</a></td>
                          <td><a href="index.php">Logout</a></td>
                      </tr>
                  </table>
              </div>
               </div>
               <div id="sort">
               <table width="100%" height="100%" border="1">
               <tr>
               <td><b>Sort BY :</b></td>
               <td><a href="index.php?Sort=FirstName">FirstName</a></td>
               <td><a href="index.php?Sort=LastName">LastName</a></td>
               <td><a href="index.php?Sort=Contact_Number">Contact Number</a></td>
               </tr>
               </table>
              </div>
               <div id="display">';
               
               $sql = "SELECT * FROM phoneinfo WHERE User_Id=".$_SESSION['user_id'];
               $result = mysql_query($sql);
 
               echo '<table width="100%" height="100%" border="1">
                     <tr>
                     <th>FirstName</th>
                     <th>LastName</th>
                     <th>Contact Number</th>
                     </tr>
                 ';
               while($row = mysql_fetch_array($result))
               {
                echo "<tr>
                 <td class=data>$row[FirstName]</td>                    
                 <td class=data>$row[LastName]</td>                    
                 <td class=data><a href='index.php?RecordId=$row[Id]'>$row[Contact_Number]</a></td>                    
                </tr>";
                   
               }
               
               echo '</div>
               ';
               
           }
           
           else
           {
              echo '
                     <div id="contactadded">
                     <center>
                     <br>
                     Invalid Username / Password <br><br>
                     <a href="index.php">Click Here To Login</a>
                     </center>
                     </div>
                ';
              
           }
           
        }
        
        // This Page Will Be Displayed After Clicking On 'List Contacts' Button
        else if($id)
           {
            
            $con = mysql_connect('localhost','root','');
            mysql_select_db("phonebook",$con);
            
               echo '
                   
              <div id="header">
              <div id="menu">
                  <img src="images/add_contact.jpg" height="120"  width="130"></img><br>
                  <span style="padding-left: 10px"><a href="index.php?value=addnewrecord">Add New Contact</a></span>
              </div>
              <div id="title">
              <h1>PHONE BOOK</h1>
              </div>
              <div id="submenu">
                  <table width="100%" height="100%">
                      <tr>
                          <td><a href="index.php?cp=cp">Change Password</a></td>
                          <td><a href="index.php">Logout</a></td>
                      </tr>
                  </table>
              </div>
               </div>
               <div id="sort">
               <table width="100%" height="100%" border="1">
               <tr>
               <td>Sort BY :</td>
               <td><a href="index.php?Sort=FirstName">FirstName</a></td>
               <td><a href="index.php?Sort=LastName">LastName</a></td>
               <td><a href="index.php?Sort=Contact_Number">Contact Number</a></td>
               </tr>
               </table>
              </div>
              <div id="display">';
   
              
               $sql = "SELECT * FROM phoneinfo WHERE User_Id=".$id;
               $result = mysql_query($sql);
 
               echo '<table width="100%" height="100%" border="1">
                     <tr>
                     <th>FirstName</th>
                     <th>LastName</th>
                     <th>Contact Number</th>
                     </tr>
                 ';
               while($row = mysql_fetch_array($result))
               {
                echo "<tr>
                 <td class=data>$row[FirstName]</td>                    
                 <td class=data>$row[LastName]</td>                    
                 <td class=data><a href='index.php?RecordId=$row[Id]'>$row[Contact_Number]</td>                    
                </tr>";
                   
               }
               
               echo '</div>
               ';
               
               
           }
           
           
          // This Page will Be Displayed After Clicking on Sort By FirstName / LastName / Contact_Number             
        else if($sort)
        {
               $con = mysql_connect('localhost','root','');
               mysql_select_db("phonebook",$con);
               
            
            echo '
                   
              <div id="header">
              <div id="menu">
                  <img src="images/add_contact.jpg" height="120"  width="130"></img><br>
                  <span style="padding-left: 10px"><a href="index.php?value=addnewrecord">Add New Contact</a></span>
              </div>
              <div id="title">
              <h1>PHONE BOOK</h1>
              </div>
              <div id="submenu">
                  <table width="100%" height="100%">
                      <tr>
                          <td><a href="index.php?cp=cp">Change Password</a></td>
                          <td><a href="index.php">Logout</a></td>
                      </tr>
                  </table>
              </div>
               </div>
               <div id="sort">
               <table width="100%" height="100%" border="1">
               <tr>
               <td>Sort BY :</td>
               <td><a href="index.php?Sort=FirstName">FirstName</a></td>
               <td><a href="index.php?Sort=LastName">LastName</a></td>
               <td><a href="index.php?Sort=Contact_Number">Contact Number</a></td>
               </tr>
               </table>
              </div>
               <div id="display">';
               
               $sql = "SELECT * FROM phoneinfo WHERE User_Id=".$_SESSION['user_id']." ORDER BY ".$sort;
               $result = mysql_query($sql);
 
               echo '<table width="100%" height="100%" border="1">
                     <tr>
                     <th>FirstName</th>
                     <th>LastName</th>
                     <th>Contact Number</th>
                     </tr>
                 ';
               while($row = mysql_fetch_array($result))
               {
                echo "<tr>
                 <td class=data>$row[FirstName]</td>                    
                 <td class=data>$row[LastName]</td>                    
                 <td class=data><a href='index.php?RecordId=$row[Id]'>$row[Contact_Number]</td>                    
                </tr>";
                   
               }
               
               echo '</div>
               ';
            
            
        }
        // Update Contact Page
        else if($recordid)
        {
            
            $con = mysql_connect('localhost','root','');
            mysql_select_db("phonebook",$con);
            $sql = "SELECT * FROM phoneinfo WHERE Id=".$recordid;
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            echo "
            <div id='addcontact'>
            <h1>Update Contact</h1>
            <br>
            <center>
            <form onsubmit='return contactvalidate()' action='index.php?recordid=$recordid' method='POST'>
            <table width='80%' height='80%'>
                <tr>
                    <td class='text'>First Name :</td>
                    <td><input class='data' type='text' name='firstname' id='firstname' value='$row[FirstName]' /></td>
                </tr>
                <tr>
                    <td class='text'>Last Name :</td>
                    <td><input class='data' type='text' name='lastname' id='lastname' value='$row[LastName]' /></td>
                </tr>
                <tr>
                    <td class='text'>Contact Number :</td>
                    <td><input class='data' type='number' name='number' id='number' value='$row[Contact_Number]' /></td>
                </tr>
                <tr>
                     <td><input class='submit' type='submit' name='updatecontact' value='UPDATE' /></td>
                     <td><input class='submit' type='submit' name='deletecontact' value='DELETE' /></td>
                </tr>    
            </table>    
            </form>
            </center>
            </div>


               ";
        }
        
        
      // This is the Deafault Login Page (index.php)   
       else
       {
           echo '
        <div id="loginbox">
            <h1>Login</h1>    
        <form onsubmit="return loginvalidate()" action="index.php" method="post">
            <center>
            <table width="80%" height="80%">
                <tr>
                    <td class="text">Username :</td>
                    <td><input class="data" type="text" name="username" id="username" /></td>
                </tr>
                <tr>
                    <td class="text">Password :</td>
                    <td><input class="data" type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input class="submit" type="submit" name="submit" value="LOGIN" /></td>
                </tr>    
            </table>
            </center>   
        </form>
        </div> ';  
       }
       
      }
     }
    }
   }
  }
 }
       ?>     
</body>
</html>
