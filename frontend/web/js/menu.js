function hideGroupMenu(groupname) { 
	//$("#" + groupname).hide();
	$("#" + groupname).slideUp(200);
	$("#" + groupname + '-hide').hide();
	$("#" + groupname+'-show').show();
}
function showGroupMenu(groupname) { 
	$("#" + groupname).slideDown(200);;
	$("#" + groupname + '-show').hide();
	$("#" + groupname+'-hide').show();
}

$(document).mouseup(function (e) {
	var profile = $("#profileMenu");
	if (!profile.is(e.target) && profile.has(e.target).length === 0) {
		if ($("#showMenu").is(e.target) || $("#showMenu2").is(e.target)) {
			$("#profileMenu").toggle();
		} else { 
			profile.hide();
		}
	}
	var country = $("#countryMenu");
	if (!country.is(e.target) && country.has(e.target).length === 0) {
		if ($("#showCountryMenu").is(e.target) || $("#showCountryMenu2").is(e.target) || $("#showCountryMenu3").is(e.target)) {
			$("#countryMenu").toggle();
		} else { 
			country.hide();
		}
	}
});