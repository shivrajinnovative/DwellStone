$("#formSubmitLoader").hide();

function showFormSubmitLoader()
{
	// spinner-grow is another class we can add instead of spinner-border
	$("#formSubmitLoader").show();
	$("#formSubmitLoader").addClass("mr-2 spinner-border spinner-border-sm text-dark");
	return true;
}

function hideFormSubmitLoader()
{
	$("#formSubmitLoader").removeClass("mr-2 spinner-border spinner-border-sm text-dark");
	$("#formSubmitLoader").hide();
}