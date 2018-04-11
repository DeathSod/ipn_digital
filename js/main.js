$(document).ready(function() {
	
	(function(){
		$("#inputRole").change(function()
		{
			if($("#inputRole option:selected").text() == "Choose One...")
			{
				$("#regLayout").hide();
			}
			else if($("#inputRole option:selected").text() == "Person")
			{
				$("#regLayout").show();
				$("#companyLayout").hide();
				$("#personLayout").show();
			}
			else if($("#inputRole option:selected").text() == "Company")
			{
				$("#regLayout").show();
				$("#personLayout").hide();
				$("#companyLayout").show();
			}
		});
		
		if($("#inputRole option:selected").text() == "Choose One...")
		{
			$("#regLayout").hide();
		}
		else if($("#inputRole option:selected").text() == "Person")
		{
			$("#regLayout").show();
			$("#companyLayout").hide();
			$("#personLayout").show();
		}
		else if($("#inputRole option:selected").text() == "Company")
		{
			$("#regLayout").show();
			$("#personLayout").hide();
			$("#companyLayout").show();
		}
	}());

});