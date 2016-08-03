$("#user_id").autocomplete({
	source: "http://josesebastianmanunta.com/erp2.0/includes/autoplete.php?user_id=true", minLength: 3
	});
	$("#config_item").autocomplete({
	source: "http://josesebastianmanunta.com/erp2.0/includes/autoplete.php?config_item=true", minLength: 3
	});		

function ajax_post_data()
{
	//might need to use .text() to return only text without html markup
	name = $("input[name='name']").val();
	ci_data = $("input[name='ci_data']").val();
	assigned_group = $("select[name='assigned_group']").val();
	urgency = $("select[name='urgency']").val();
	impact = $("select[name='impact']").val();
	state = $("select[name='state']").val();
	description = $("[name='description']").val();
	new_notes = $("[name='new_notes']").val();
	wo_id = $("h2#order_id").text();
	
	$.ajax({
	  type: "POST",
	  url: "widgets/quick_ticket/validate_update.php",
	  data: { name: name
		, ci_data: ci_data
		, assigned_group: assigned_group
		, urgency: urgency
		, impact: impact
		, state: state
		, description: description
		, new_notes: new_notes
		, id : wo_id}
	}).done(function()
	{
		alert('Updated succesfully!!!');
	});
}
