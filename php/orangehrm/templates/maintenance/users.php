<?
/*
OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures 
all the essential functionalities required for any enterprise. 
Copyright (C) 2006 hSenid Software International Pvt. Ltd, http://www.hsenid.com

OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
the GNU General Public License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.

OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program;
if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
Boston, MA  02110-1301, USA
*/

require_once ROOT_PATH . '/lib/confs/sysConf.php';
	
	$sysConst = new sysConf(); 
	$locRights=$_SESSION['localRights'];
	
	if ((isset($this->getArr['capturemode'])) && ($this->getArr['capturemode'] == 'addmode')) {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? require_once ROOT_PATH . '/scripts/archive.js'; ?>
<script>		

function echeck(str) {

		var lat=str.indexOf('@');
		var lstr=str.length;
		var ldot=str.indexOf('.');
		if (str.indexOf('@')==-1){
		   return false;
		}

		if (str.indexOf('@')==-1 || str.indexOf('@')==0 || str.indexOf('@')==lstr){
		   return false;
		}

		if (str.indexOf('.')==-1 || str.indexOf('.')==0 || str.indexOf('.')==lstr){
		    return false;
		}

		 if (str.indexOf('@',(lat+1))!=-1){
		    return false;
		 }

		 if (str.substring(lat-1,lat)=='.' || str.substring(lat+1,lat+2)=='.'){
		    return false;
		 }

		 if (str.indexOf('.',(lat+2))==-1){
		    return false;
		 }
		
		 if (str.indexOf(" ")!=-1){
		    return false;
		 }

 		 return true;
	}

function name(txt)
{
var flag=true;
var i,code;

if(txt.value=="")
   return false;

for(i=0;txt.value.length>i;i++)
	{
	code=txt.value.charCodeAt(i);
    if((code>=65 && code<=122) || code==32 || code==46)
	   flag=true;
	else
	   {
	   flag=false;
	   break;
	   }
	}
return flag;
}

function goBack() {
		location.href = "./CentralController.php?uniqcode=<?=$this->getArr['uniqcode']?>&VIEW=MAIN";
	}

	function addSave() {
		var frm=document.frmUsers;
		if (frm.txtUserName.value.length < 5 ) {
			alert ("UserName should be atleast five characters long!");
			frm.txtUserName.focus();
			return false;
		}
		
		if(frm.txtUserPassword.value.length < 4) {
			alert("Password should be atleast four characters long!");
			frm.txtUserPassword.focus();
			return;
		}
		
		if(frm.txtUserPassword.value != frm.txtUserConfirmPassword.value) {
			alert("Password Mismatch!");
			frm.txtUserPassword.focus();
			return;
		}
		
		if(!name(frm.txtUserFirstName)) {
			alert("Field should be Alphabetic!")
			frm.txtUserFirstName.focus();
			return;
		}
		
		if(frm.chkUserIsAdmin.checked == false && frm.cmbUserEmpID.value == '0') {
			alert("Employee ID should be defined");
			frm.cmbUserEmpID.focus();
			return;
		}
		
		if(frm.chkUserIsAdmin.checked == false && frm.cmbUserGroupID.value != '0') {
			alert('Normal User, no User Group should be defined');
			frm.cmbUserGroupID.focus();
			return;
		}
		
		if(frm.chkUserIsAdmin.checked == true && frm.cmbUserGroupID.value == '0') {
			alert("Field should be selected!");
			frm.cmbUserGroupID.focus();
			return;
		}

		document.frmUsers.sqlState.value = "NewRecord";
		document.frmUsers.submit();		
	}			
	
	function toggleAdmin(obj) {
		if (obj.checked) {
			document.getElementById("lyrUserGroupID").style.visibility = 'visible';
			document.getElementById("lyrUserGroupID1").style.visibility = 'visible';
		} else {
			document.getElementById("lyrUserGroupID").style.visibility = 'hidden';
			document.getElementById("lyrUserGroupID1").style.visibility = 'hidden';
		}
	}
</script>
<link href="../../themes/beyondT/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">@import url("../../themes/beyondT/css/style.css"); </style>
</head>
<body>
<table width='100%' cellpadding='0' cellspacing='0' border='0' class='moduleTitle'>
  <tr>
    <td valign='top'> </td>
    <td width='100%'><h2>Users</h2></td>
    <td valign='top' align='right' nowrap style='padding-top:3px; padding-left: 5px;'></td>
  </tr>
</table>
<p>
<p> 
<table width="431" border="0" cellspacing="0" cellpadding="0" ><td width="177">
<form name="frmUsers" method="post" action="<?=$_SERVER['PHP_SELF']?>?uniqcode=<?=$this->getArr['uniqcode']?>">

  <tr> 
    <td height="27" valign='top'> <p> <img title="Back" onMouseOut="this.src='../../themes/beyondT/pictures/btn_back.jpg';" onMouseOver="this.src='../../themes/beyondT/pictures/btn_back_02.jpg';"  src="../../themes/beyondT/pictures/btn_back.jpg" onClick="goBack();">
        <input type="hidden" name="sqlState" value="">
      </p></td>
    <td width="254" align='left' valign='bottom'> <font color="red" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
      <?
		if (isset($this->getArr['msg'])) {
			$expString  = $this->getArr['msg'];
			$expString = explode ("%",$expString);
			$length = sizeof($expString);
			for ($x=0; $x < $length; $x++) {		
				echo " " . $expString[$x];		
			}
		}		
		?>

    </font> </td>
  </tr><td width="177">
</table>

              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="13"><img name="table_r1_c1" src="../../themes/beyondT/pictures/table_r1_c1.gif" width="13" height="12" border="0" alt=""></td>
                  <td background="../../themes/beyondT/pictures/table_r1_c2.gif"><img name="table_r1_c2" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td width="13"><img name="table_r1_c3" src="../../themes/beyondT/pictures/table_r1_c3.gif" width="13" height="12" border="0" alt=""></td>
                  <td width="339"><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="12" border="0" alt=""></td>
                </tr>
                <tr>
                  <td background="../../themes/beyondT/pictures/table_r2_c1.gif"><img name="table_r2_c1" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><table width="100%" border="0" cellpadding="5" cellspacing="0" class="">
						  <tr> 
							    <td>Code</td>
							    <td><strong><?=$this->popArr['newID']?></strong></td>
								<td></td>
								<td></td>
								<td></td>
						  </tr>
						  <tr> 
							    <td>User Name</td>
							    <td><input type="text" name="txtUserName"></td>
								<td></td>
								<td>Name</td>
							  	<td><input type="text" name="txtUserFirstName"></td>
						  </tr>
						  <tr>
							  <td>Password</td>
							  <td><input type="password" name="txtUserPassword"></td>
							  <td></td>
							  <td nowrap="nowrap">Confirm Password</td>
							  <td><input type="password" name="txtUserConfirmPassword"></td> 
						  </tr>						 
						  <tr>
							  <td>Status</td>
						   	  <td><select name="cmbUserStatus">
						   			<option>Enabled</option>
						   			<option>Disabled</option>
						   		  </select></td>
							  <td></td>
							  <td>Employee ID</td>
							  <td><select name="cmbUserEmpID" >
							  		<option value="0">--Select EmpID--</option>
<?									$emplist=$this->popArr['emplist'] ; 
									for($c=0;$emplist && count($emplist)>$c;$c++)
										echo "<option value='" . $emplist[$c][0] ."'>" .$emplist[$c][0]. "</option>";
?>							  
							  
							  </select></td> 							  
						   </tr>
						   <tr>
							   <td>Is HR Admin</td>
							   <td><input type="checkbox" name="chkUserIsAdmin" onChange="toggleAdmin(this);"></td>
							   <td></td>							   
							   <td><div id="lyrUserGroupID" style="visibility:hidden">User Group</div></td>
							   <td><div id="lyrUserGroupID1" style="visibility:hidden"><select name="cmbUserGroupID" id ="cmbUserGroupID">
							  		<option value="0">--Select UserGroup--</option>
<?									$uglist=$this->popArr['uglist'] ; 
									for($c=0;$uglist && count($uglist)>$c;$c++)
										echo "<option value='" . $uglist[$c][0] ."'>" .$uglist[$c][1]. "</option>";
?>							  
							  </select></div></td>
						   </tr>
					  <tr><td align="right" width="100%"><img onClick="addSave();" onMouseOut="this.src='../../themes/beyondT/pictures/btn_save.jpg';" onMouseOver="this.src='../../themes/beyondT/pictures/btn_save_02.jpg';" src="../../themes/beyondT/pictures/btn_save.jpg"></td>
					  <td><img onClick="document.frmUsers.reset();" onMouseOut="this.src='../../themes/beyondT/pictures/btn_clear.jpg';" onMouseOver="this.src='../../themes/beyondT/pictures/btn_clear_02.jpg';" src="../../themes/beyondT/pictures/btn_clear.jpg"></td>
					  <td></td></tr>
                  </table></td>
                  <td background="../../themes/beyondT/pictures/table_r2_c3.gif"><img name="table_r2_c3" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                </tr>
                <tr>
                  <td><img name="table_r3_c1" src="../../themes/beyondT/pictures/table_r3_c1.gif" width="13" height="16" border="0" alt=""></td>
                  <td background="../../themes/beyondT/pictures/table_r3_c2.gif"><img name="table_r3_c2" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><img name="table_r3_c3" src="../../themes/beyondT/pictures/table_r3_c3.gif" width="13" height="16" border="0" alt=""></td>
                  <td><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
                </tr>
              </table>


</form>
</body>
</html>
<? } else if ((isset($this->getArr['capturemode'])) && ($this->getArr['capturemode'] == 'updatemode')) {
	$message = $this->popArr['editArr'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? require_once ROOT_PATH . '/scripts/archive.js'; ?>
<script>			
function echeck(str) {

		var lat=str.indexOf('@');
		var lstr=str.length;
		var ldot=str.indexOf('.');
		if (str.indexOf('@')==-1){
		   return false;
		}

		if (str.indexOf('@')==-1 || str.indexOf('@')==0 || str.indexOf('@')==lstr){
		   return false;
		}

		if (str.indexOf('.')==-1 || str.indexOf('.')==0 || str.indexOf('.')==lstr){
		    return false;
		}

		 if (str.indexOf('@',(lat+1))!=-1){
		    return false;
		 }

		 if (str.substring(lat-1,lat)=='.' || str.substring(lat+1,lat+2)=='.'){
		    return false;
		 }

		 if (str.indexOf('.',(lat+2))==-1){
		    return false;
		 }
		
		 if (str.indexOf(" ")!=-1){
		    return false;
		 }

 		 return true;
	}

function name(txt)
{
var flag=true;
var i,code;

if(txt.value=="")
   return false;

for(i=0;txt.value.length>i;i++)
	{
	code=txt.value.charCodeAt(i);
    if((code>=65 && code<=122) || code==32 || code==46)
	   flag=true;
	else
	   {
	   flag=false;
	   break;
	   }
	}
return flag;
}


	function goBack() {
		location.href = "./CentralController.php?uniqcode=<?=$this->getArr['uniqcode']?>&VIEW=MAIN";
	}

function mout() {
	if(document.Edit.title=='Save') 
		document.Edit.src='../../themes/beyondT/pictures/btn_save.jpg'; 
	else
		document.Edit.src='../../themes/beyondT/pictures/btn_edit.jpg'; 
}

function mover() {
	if(document.Edit.title=='Save') 
		document.Edit.src='../../themes/beyondT/pictures/btn_save_02.jpg'; 
	else
		document.Edit.src='../../themes/beyondT/pictures/btn_edit_02.jpg'; 
}
	
function edit()
{
	if(document.Edit.title=='Save') {
		addUpdate();
		return;
	}
	
	var frm=document.frmUsers;
//  alert(frm.elements.length);
	for (var i=0; i < frm.elements.length; i++)
		frm.elements[i].disabled = false;
	document.Edit.src="../../themes/beyondT/pictures/btn_save.jpg";
	document.Edit.title="Save";
}

	function addUpdate() {
		
		var frm=document.frmUsers;
		if (frm.txtUserName.value.length < 5 ) {
			alert ("UserName should be atleast five characters long!");
			frm.txtUserName.focus();
			return false;
		}
		
		if(!name(frm.txtUserFirstName)) {
			alert("Field should be Alphabetic!")
			frm.txtUserFirstName.focus();
			return;
		}

		if(frm.chkUserIsAdmin.checked == false && frm.cmbUserEmpID.value == '0') {
			alert("Employee ID should be defined");
			frm.cmbUserEmpID.focus();
			return;
		}
		
		if(frm.chkUserIsAdmin.checked == false && frm.cmbUserGroupID.value != '0') {
			alert('Normal User, no User Group should be defined');
			frm.cmbUserGroupID.focus();
			return;
		}
		
		if(frm.chkUserIsAdmin.checked == true && frm.cmbUserGroupID.value == '0') {
			alert("Field should be selected!");
			frm.cmbUserGroupID.focus();
			return;
		}

		
		document.frmUsers.sqlState.value = "UpdateRecord";
		document.frmUsers.submit();		
	}			

	function toggleAdmin(obj) {
		if (obj.checked) {
			document.getElementById("lyrUserGroupID").style.visibility = 'visible';
			document.getElementById("lyrUserGroupID1").style.visibility = 'visible';
			document.getElementById("lyrEmpID").style.visibility = 'hidden';
		} else {
			document.getElementById("lyrUserGroupID").style.visibility = 'hidden';
			document.getElementById("lyrUserGroupID1").style.visibility = 'hidden';
			document.getElementById("lyrEmpID").style.visibility = 'visible';
		}
	}
</script>
<link href="../../themes/beyondT/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">@import url("../../themes/beyondT/css/style.css"); </style>
</head>
<body>
<table width='100%' cellpadding='0' cellspacing='0' border='0' class='moduleTitle'>
  <tr>
    <td valign='top'> </td>
    <td width='100%'><h2>Users</h2></td>
    <td valign='top' align='right' nowrap style='padding-top:3px; padding-left: 5px;'></td>
  </tr>
</table>
<p>
<p> 
<table width="431" border="0" cellspacing="0" cellpadding="0" ><td width="177">
<form name="frmUsers" method="post" action="<?=$_SERVER['PHP_SELF']?>?id=<?=$this->getArr['id']?>&uniqcode=<?=$this->getArr['uniqcode']?>">

  <tr> 
    <td height="27" valign='top'> <p>
        <input type="hidden" name="sqlState" value="">
      </p></td>
    <td width="254" align='left' valign='bottom'> <font color="red" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
      <?
		if (isset($this->getArr['msg'])) {
			$expString  = $this->getArr['msg'];
			$expString = explode ("%",$expString);
			$length = sizeof($expString);
			for ($x=0; $x < $length; $x++) {		
				echo " " . $expString[$x];		
			}
		}		
		?>
    </font> </td>
  </tr><td width="177">
</table>

              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="13"><img name="table_r1_c1" src="../../themes/beyondT/pictures/table_r1_c1.gif" width="13" height="12" border="0" alt=""></td>
                  <td width="339" background="../../themes/beyondT/pictures/table_r1_c2.gif"><img name="table_r1_c2" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td width="13"><img name="table_r1_c3" src="../../themes/beyondT/pictures/table_r1_c3.gif" width="13" height="12" border="0" alt=""></td>
                  <td width="11"><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="12" border="0" alt=""></td>
                </tr>
                <tr>
                  <td background="../../themes/beyondT/pictures/table_r2_c1.gif"><img name="table_r2_c1" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><table width="100%" border="0" cellpadding="5" cellspacing="0" class="">
						  <tr> 
							    <td>Code</td>
							    <td> <input type="hidden"  name="txtUserID" value=<?=$message[0][0]?>> <strong><?=$message[0][0]?></strong> </td>
								<td></td>
								<td></td>
								<td></td>
						  </tr>
						  <tr> 
							    <td valign="top" nowrap><span class="error">*</span> User Name</td>
							    <td><input type="text" name="txtUserName" disabled value="<?=$message[0][1]?>"></td>
								<td></td>
								<td valign="top" nowrap><span class="error">*</span> Name</td>
							  	<td><input type="text" name="txtUserFirstName" disabled value="<?=$message[0][2]?>"></td>
						  </tr>						  
						  <tr>
						  	  <td>Status</td>
							  <td><select name="cmbUserStatus" disabled>
							   			<option>Enabled</option>
							   			<option <?=$message[0][9]=='Disabled' ? 'selected' : ''?>>Disabled</option>
							   	</select></td>
							  <td></td>
							  <td valign="top" nowrap><div id="lyrEmpID"><span class="error">*</span></div> Employee ID</td>
							  <td><select name="cmbUserEmpID" disabled>
							  		<option value="0">--Select EmpID--</option>
<?									$emplist=$this->popArr['emplist'] ; 
									for($c=0;$emplist && count($emplist)>$c;$c++)
										if($message[0][3]==$emplist[$c][0])
											echo "<option selected value='" . $emplist[$c][0] ."'>" .$emplist[$c][0]. "</option>";
										else
											echo "<option value='" . $emplist[$c][0] ."'>" .$emplist[$c][0]. "</option>";
?>							  
							  </select></td> 
							  <td></td>
							  <td></td>							  
						   </tr>
						   <tr>
							   <td>Is HR Admin</td>
							   <td><input type="checkbox" name="chkUserIsAdmin" disabled <?=$message[0][4]=='Yes' ? 'checked' : ''?> onChange="toggleAdmin(this);"></td>
							   <td></td>
							   <td valign="top" nowrap><div id="lyrUserGroupID" style="visibility:<?=$message[0][4]=='Yes' ? 'visible' : 'hidden'?>"><span class="error">*</span> User Group</div></td>
							   <td><div id="lyrUserGroupID1" style="visibility:<?=$message[0][4]=='Yes' ? 'visible' : 'hidden'?>"><select name="cmbUserGroupID" disabled>
							  		<option value="0">--Select UserGroup--</option>
<?									$uglist=$this->popArr['uglist'] ; 
									for($c=0;$uglist && count($uglist)>$c;$c++)
										if($message[0][10]==$uglist[$c][0])
											echo "<option selected value='" . $uglist[$c][0] ."'>" .$uglist[$c][1]. "</option>";
										else
											echo "<option value='" . $uglist[$c][0] ."'>" .$uglist[$c][1]. "</option>";
?>							  
							  </select></div></td>
						   </tr>
						   
					  <tr><td></td><td align="right" width="100%">
<?			if($locRights['edit']) { ?>
			        <img src="../../themes/beyondT/pictures/btn_edit.jpg" title="Edit" onMouseOut="mout();" onMouseOver="mover();" name="Edit" onClick="edit();">
<?			} else { ?>
			        <img src="../../themes/beyondT/pictures/btn_edit.jpg" onClick="alert('<?=$sysConst->accessDenied?>');">
<?			}  ?>
									  <img src="../../themes/beyondT/pictures/btn_clear.jpg" onMouseOut="this.src='../../themes/beyondT/pictures/btn_clear.jpg';" onMouseOver="this.src='../../themes/beyondT/pictures/btn_clear_02.jpg';" onClick="clearAll();" >

                  </table></td>
                  <td background="../../themes/beyondT/pictures/table_r2_c3.gif"><img name="table_r2_c3" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                </tr>
                <tr>
                  <td><img name="table_r3_c1" src="../../themes/beyondT/pictures/table_r3_c1.gif" width="13" height="16" border="0" alt=""></td>
                  <td background="../../themes/beyondT/pictures/table_r3_c2.gif"><img name="table_r3_c2" src="../../themes/beyondT/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><img name="table_r3_c3" src="../../themes/beyondT/pictures/table_r3_c3.gif" width="13" height="16" border="0" alt=""></td>
                  <td><img src="../../themes/beyondT/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
                </tr>
              </table>


</form>
<span id="notice">Fields marked with an asterisk <span class="error">*</span> are required.</span>
</body>
</html>
<? } ?>