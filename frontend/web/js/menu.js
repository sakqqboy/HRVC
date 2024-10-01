function hideGroupMenu(groupname) { 
	$("#" + groupname).hide();
	$("#" + groupname + '-hide').hide();
	$("#" + groupname+'-show').show();
}
function showGroupMenu(groupname) { 
	$("#" + groupname).show();
	$("#" + groupname + '-show').hide();
	$("#" + groupname+'-hide').show();
}