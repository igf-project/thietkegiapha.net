// JavaScript Document
function docheckall(name,status){
	var objs=document.getElementsByName(name);
	for(i=0;i<objs.length;i++)
		objs[i].checked=status;
	getIDchecked(name);
}
function docheckonce(name){
	var objs=document.getElementsByName(name);
	var flag=true;
	for(i=0;i<objs.length;i++)
		if(objs[i].checked!=true)
		{
			flag=false;
			break;
		}
	document.getElementById("chkall").checked=flag;
	getIDchecked(name);
}
function getIDchecked(name){
	var objs=document.getElementsByName(name);
	var strids="";
	for(i=0;i<objs.length;i++)
		if(objs[i].checked==true)
		{
			strids+=objs[i].value+",";
		}
	document.getElementById("txtids").value=strids;
	activeTr();
}
function activeTr(){
	var Trs=document.getElementsByName("trow");
	for(i=0;i<Trs.length;i++)
	{
		var check=Trs[i].getElementsByTagName("input");
		if(check[0].checked==true)
			Trs[i].className="active";
		else
			Trs[i].className="";
	}
}
function dosubmitAction(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true){
		if(frmID=="frm_action")
		document.getElementById("cmdsave").click();
		else
		document.frm_menu.submit();
	}
}
function saveOrder(){
    var ids = document.getElementsByName("chk"); 
	var orders= document.getElementsByName("txt_order");
    var strids ='';
    var strorder ='';
    
    for (var i=0;i<ids.length;i++) {
        strids  += ids[i].value+",";
        strorder  += orders[i].value+",";        
    }
    document.getElementById("txtids").value = strids;
    document.getElementById("txtorders").value = strorder;
	document.getElementById("txtaction").value='order';
    document.frm_menu.submit(); 
}

function doSave(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true)
	{
		if(frmID=="frm_action")
			document.getElementById("cmdsave").click();
		else
			document.frm_menu.submit();
	}
}

function gotopage(page)
{
	document.getElementById("txtCurnpage").value=page;
	document.frmpaging.submit();
}
function openlink(url)
{
	window.location=url;
}
function onsearch(thisitem,type){
	var str=thisitem.value;
	if(type==0 && str=="")
		thisitem.value="Keyword";
	if(type==1)
		thisitem.value="";
}
function cbo_Selected(id,value)
{
	var obj=document.getElementById(id);
	for(i=0;i<obj.length;i++)
		if(obj[i].value==value)
			obj.selectedIndex=i;
}
function OpenPopup(url){
	myWindow=window.open(url,'_blank','width=750,height=400');
}
function openBox(url){
	var xmlhttp;
	if (url.length==0)
	  {
	  document.getElementById("shopcart").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("shopcart").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
function add2cart(ItemID)
{
	var xmlhttp;
	if (ItemID.length==0)
	  {
	  document.getElementById("txtHint").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","index.php?com=add2cart&ItemID="+ItemID,true);
	xmlhttp.send();
}
function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,9}$/;
   if(!re.test(phone.value)){alert("Số điện thoại của bạn không hợp lệ. Số điện thoại chỉ bao gồm số từ 0 đến 9.");return false;}
   return true;
}
function checkField(field,name){
   if(field.value == ""){
      alert(name + ' không được bỏ trống');
      field.focus();
   }
}
function checkEmail(email){
   re=/^(([a-zA-Z0-9])+\.?)*([a-zA-Z0-9])+@(([a-zA-Z0-9])+\.)+[a-zA-Z]{2,4}$/;
   if(!re.test(email.value)){return false;}
   return true;
}
function detele_field(url) {
	if(confirm("Bạn có chắc chắn muốn xóa thông tin này không?")) {
		window.location=url;
	}
}
function getID_Order(cur_id,str) {
	document.getElementById("txtIDs").value = cur_id;
	document.getElementById("txtType").value = str;
	frmlist.submit();
}
function getID_Order_Menu() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
		//alert(ctr[i].innerHTML);
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
	
}
function selectall(status){
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	for(i=0;i<objopt.length;i++){
		if(status==1 && objopt[i].value!="")
		objopt[i].selected=true;
		else
		objopt[i].selected=false;
	}
	if(status==0){
		obj.disabled=true;
		obj.style.backgroundColor="#ccc";
	}
	else if(status==1){
		obj.disabled=true;
		obj.style.backgroundColor="#fff";
	}
	else{
		obj.disabled=false;
		obj.style.backgroundColor="#fff";
	}
	getIDs();
}
function getIDs(){
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	var strids="";
	var flag=true;
	for(i=0;i<objopt.length;i++){
		if(objopt[i].selected==true &&  objopt[i].value!="")
			strids+=objopt[i].value+",";
		else
			objopt[i].selected=false;
		if(objopt[i].selected==false &&  objopt[i].value!="")
		flag=false;
	}
	if(flag==true)
		document.getElementById("txtmenus").value="all";
	else
		document.getElementById("txtmenus").value=strids;
}
function selectedIDs(flag) {
	var ids=document.getElementById("txtmenus").value;
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	
	if(flag==1) {
		for(i=0;i<objopt.length;i++){
			objopt[i].selected==true;
		}
	}
	else if(flag==3) {
		var arr = new Array();
		arr = ids.split(",");
		for(i=0;i<objopt.length;i++){ 
			for(j=0;j<arr.length-1;j++) {
				if(objopt[i].value==arr[j]){
					objopt[i].selected=true;
				}
			}
		}
	}
}
function getID_Order_Category() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
}
function getID_Order_Content() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
}