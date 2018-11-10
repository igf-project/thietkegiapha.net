<?php
$day=$_POST['txt_day'];
$people=$_POST['txt_people'];
$region=$_POST['cbo_region'];
$level=$_POST['cbo_level'];
?>
<div class="padding-inter">
<script language="javascript">
	$(document).ready(function(){
		$('#txt_date').datepicker();
	})
	function chechemail(){
		var surname=document.getElementById("sur_name");
		var givenname=document.getElementById("given_name");
		var capchar=document.getElementById("txt_sercurity");
		var content=document.getElementById("content");
		var pemail=document.getElementById("txt_email");
		var pdays=document.getElementById("txt_pday");
		var ppeople=document.getElementById("txt_ppeople");
		var pregion=document.getElementById("cbo_pregion");
		var plevel=document.getElementById("cbo_plevel");
		var when=document.getElementById("txt_date");
		var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_\.]*@[\w\d.]+.\w{2,4}$/;
		var error=false;
		if(!reg1.test(pemail.value)){
            alert(pemail.value+ " Invalid format E-mail address!");
            pemail.focus();
            error=true;
        }
		if(surname.value=='' || givenname.value=='' || capchar.value=='' || content.value=='' || pemail.value=='' || pday.value=='' || ppeople.value=='' || pregion.value=='' || plevel=='' || when=='' )
			error=true;
		if(error==true){
			alert('Please fill this blank target!'); 
			return false;
		}
		return true;
	}
</script>
<fieldset>
<div style='text-align:left'>To enquire about creating your own Customized Tour itinerary, 
please drop us some information as below. We will then contact you to discuss your travel 
plans in more detail. The reply will be sent to you within 24 hours.</div>
<div style='text-align:left;'>Items marked <font color="#FF0000">*</font> are required</div>
<form action="" method="post" style="padding: 0px; margin:0px;" >
<center><strong><?php //echo $err; ?></strong></center>
<table style="border: 0px; margin: 0 auto;" id="frmContact" width="100%" border="0" cellpadding="3" cellspacing="1">
<tr>
	<td align="left">
	<input placeHolder='*Title/*Surname' type="text" id="sur_name" name="sur_name"/>
	<input placeHolder='*Given name:' type="text" id="given_name" name="given_name"/>
	</td>
</tr>
<tr>
	<td align="left">
	<strong>*Email</strong><br/>
	<input type="text" name="txt_email" size="75" id="txt_email" /></td>
</tr>
<tr>
	<td align="left">
	<strong>*How many days you would like to be travelling for?</strong><br/>
	<input name="txt_pday" type="text" id="txt_pday" size="75" value='<?php echo $day;?>' /></td>
</tr>
<tr>
	<td align="left">
	<strong>*How many people are travelling?</strong><br/>
	<input name="txt_ppeople" type="text" id="txt_ppeople" size="75" value='<?php echo $people;?>' /></td>
</tr>
<tr>
	<td align="left">
	<strong>*Where are you interested in travelling to?</strong><br/>
	<select name='cbo_pregion' id='cbo_pregion'>
		<option value="">Region</option>
		<option value="Vietnam">Vietnam</option>
		<option value="Laos">Laos</option>
		<option value="Cambodya">Cambodya</option>
		
	</select>
	<script type='text/javascript'>
		obj=document.getElementById('cbo_pregion')
		for(i=0;i<obj.length;i++){
			if(obj[i].value=='<?php echo $region;?>')
				obj.selectedIndex=i;
		}
	</script>
	</td>
</tr>
<tr>
	<td align="left">
	<strong>*What level of hotel you would like?</strong><br/>
	<select name='cbo_plevel' id='cbo_plevel'>
		<option value="">Level of accommodation</option>
		<option value="Standard">Standard</option>
		<option value="3 star hotel">3 star hotel</option>
		<option value="4-5 star hotel">4-5 star hotel</option>
		<script type='text/javascript'>
		obj=document.getElementById('cbo_plevel')
		for(i=0;i<obj.length;i++){
			if(obj[i].value=='<?php echo $level;?>')
				obj.selectedIndex=i;
		}
		</script>
	</select>	
	</td>
</tr>
<tr>
	<td align="left">
	<strong>*When you would like to travel?</strong><br/>
	<input name="txt_date" type="text" id="txt_date" size="75" /></td>
</tr>
<tr>
	<td align="left">
	*Are there any specific ideas of destionation, expectation or travel style that you would like to tell us?:<br/>
	<textarea rows="10" name="content" id="content"></textarea></td>
</tr>
<tr>
	<td align="left">
		<strong style='float:left;'>*Capcha<font color="#FF0000">*</font>:</strong>
		<input style="float:left;width:75px;" type="text" size="7" name="txt_sercurity" id="txt_sercurity" class="text"/>
		<img src="extensions/captcha/CaptchaSecurityImages.php?width=75&height=24" align="left" alt="" />
	</td>
</tr>
<tr>
	<td align="left"><input type="submit" name="cmd_ask_tours" value="Send" class="btninput" onclick="return chechemail();" /><input type="reset" value="Cancel" class="btninput btnright" /></td>
</tr>
</table>
</form>
</fieldset>
</div>