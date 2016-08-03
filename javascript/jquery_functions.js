$(document).ready(function() { 

$("#nav ul li.main").click(function() { $(this).next("ul").toggle(); });

	$("#user_id").autocomplete({
	source: "http://josesebastianmanunta.com/erp/pages/autoplete.php?user_id=true", minLength: 3
	});
	$("#config_item").autocomplete({
	source: "http://josesebastianmanunta.com/erp/pages/autoplete.php?config_item=true", minLength: 3
	});		
	/*this is the search all function*/
	var option = $("#search_option").attr("value");$("#main_search").autocomplete({
	
		source: "http://josesebastianmanunta.com/erp/pages/autoplete.php?main_search=true&option=" + option, minLength: 3
		});	
	$("select#search_option").change(function()
	{
		option = $("#search_option option:selected").attr("value");
		$("#main_search").autocomplete({
		
		source: "http://josesebastianmanunta.com/erp/pages/autoplete.php?main_search=true&option=" + option, minLength: 3
		});
	});
	height = $(document).height();
	/*$("#nav").css("height" , height);*/
	$(" ul.rows:even").css("background-color", "#ADD6FF"); //EVERYOTHER LINE DIFF COLOR
	/*END SEARCH ALL FUNCTION*/
	
	//THIS WILL BE A FUNCTION TO ADD AN EXIT BUTTON TO WIDGETS
	
	
	exitButton = document.createElement('button');
	exitButton.setAttribute('class', 'exitWidget');
	exitButton.setAttribute('onClick', '$(this).parents(".wrapper").fadeOut();');
	exitButton.innerHTML = "EXIT | X";
	$('.wrapper .widget_header').prepend(exitButton);
	
	//THIS WILL BE a FUNCTION TO OPEN PAGES AS WIDGETS
	$('.maina a[href^="#"]').click(function()
	{
		widget_name = $(this).attr('href'); 
		
		switch(widget_name)
		{
			case "#work_orders":
			{
				//check if exist on page first if it does just refresh
				widget_check = $('#work_orders');
				if(widget_check.length == 0)
				{
					new_wrapper = document.createElement('div'); //CREATES THE MAIN WRAPPER
					new_wrapper.setAttribute('class', 'wrapper');  //MAIN WRAPPER WILL HAVE 2 CHILDS 1 MAIN_SEC 1 HEADER
						new_header = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
						new_header.setAttribute('class', 'widget_header');  //MAIN_SEC WILL INCLUDE MAIN DATA
						new_main_sec = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
						new_main_sec.setAttribute('class', 'main_sec');
						new_wrapper.appendChild(new_header);
						new_wrapper.appendChild(new_main_sec);
						new_wrapper.style.display = 'none';
					
					$('#right_wrapper .wrapper:nth-child(1)').after(new_wrapper);
					$('.wrapper:nth-child(2)').css('display', 'none');
					
					$('.wrapper:nth-child(2) .main_sec').load("widgets/wo_view/work_orders.php");
					$('.wrapper:nth-child(2) .widget_header').append(exitButton);  //Working but should be turned into function for widget headers*********************
					$('.wrapper:nth-child(2)').fadeIn(1000);
				}else
				{
					$('#work_orders').parent().load("widgets/wo_view/work_orders.php");
					$('#work_orders').parents('.widget_header').append(exitButton);  //Working but should be turned into function for widget headers*********************
					$('#work_orders').parents('.wrapper').fadeIn(1000);
				}
				$(" ul.rows:even").css("background-color", "#ADD6FF");
				break;
			}
			case "#search_view":
			{
				new_wrapper = document.createElement('div'); //CREATES THE MAIN WRAPPER
				new_wrapper.setAttribute('class', 'wrapper');  //MAIN WRAPPER WILL HAVE 2 CHILDS 1 MAIN_SEC 1 HEADER
					new_header = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
					new_header.setAttribute('class', 'widget_header');  //MAIN_SEC WILL INCLUDE MAIN DATA
					new_main_sec = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
					new_main_sec.setAttribute('class', 'main_sec');
					new_wrapper.appendChild(new_header);
					new_wrapper.appendChild(new_main_sec);
					new_wrapper.style.display = 'none';
				
				$('#right_wrapper .wrapper:nth-child(1)').after(new_wrapper);
				$('.wrapper:nth-child(2)').css('display', 'none');
				
				$('.wrapper:nth-child(2) .main_sec').load("./widgets/search_view/search_view.php");
				$('.wrapper:nth-child(2) .widget_header').append(exitButton);
				$('.wrapper:nth-child(2)').fadeIn(1000);
				break;
			}
			case "#quick_notes":
			{
				new_wrapper = document.createElement('div'); //CREATES THE MAIN WRAPPER
				new_wrapper.setAttribute('class', 'wrapper');  //MAIN WRAPPER WILL HAVE 2 CHILDS 1 MAIN_SEC 1 HEADER
					new_header = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
					new_header.setAttribute('class', 'widget_header');  //MAIN_SEC WILL INCLUDE MAIN DATA
					new_main_sec = document.createElement('div');   //HEADER WILL INCLUDE WIDGET OPTIONS EX. EXIT
					new_main_sec.setAttribute('class', 'main_sec');
					new_wrapper.appendChild(new_header);
					new_wrapper.appendChild(new_main_sec);
					new_wrapper.style.display = 'none';
				
				$('#right_wrapper .wrapper:nth-child(1)').after(new_wrapper);
				$('.wrapper:nth-child(2)').css('display', 'none');
				
				$('.wrapper:nth-child(2) .main_sec').load("./widgets/notes_widget/notes_widget.php");
				$('.wrapper:nth-child(2) .widget_header').append(exitButton);
				$('.wrapper:nth-child(2)').fadeIn(1000);
				break;
			}
		}

	});

});
