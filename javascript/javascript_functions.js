on_load = $(document).ready(function() { 

$("#nav ul li.main").click(function() { $(this).next("ul").toggle(); });

	/*this is the search all function*/
	var option = $("#search_option").attr("value");$("#main_search").autocomplete({
	
		source: "http://josesebastianmanunta.com/erp2.0/includes/autoplete.php?main_search=true&option=" + option, minLength: 3
		});	
	$("select#search_option").change(function()
	{
		option = $("#search_option option:selected").attr("value");
		$("#main_search").autocomplete({
		
		source: "http://josesebastianmanunta.com/erp2.0/includes/autoplete.php?main_search=true&option=" + option, minLength: 3
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
	$('.wrapper .widget_header').append(exitButton);
	
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
					widget_creator();
					
					$('.wrapper:nth-child(2) .main_sec').load("widgets/wo_view/work_orders.php", function()
						{
							$(" ul.rows:even").css("background-color", "#ADD6FF");
						});
					$('.wrapper:nth-child(2)').fadeIn(1000);
				}else
				{
					$('#work_orders').parent().load("widgets/wo_view/work_orders.php", function()
						{
							$(" ul.rows:even").css("background-color", "#ADD6FF");
						});
					$('#work_orders').parents('.wrapper').fadeIn(1000);
				}
				
				break;
			}
			case "#search_view":
			{
				widget_creator();
			
				$('.wrapper:nth-child(2) .main_sec').load("./widgets/search_view/search_view.php");
				$('.wrapper:nth-child(2)').fadeIn(1000);
				break;
			}
			case "#quick_notes":
			{
				widget_creator();
				
				$('.wrapper:nth-child(2) .main_sec').load("./widgets/notes_widget/notes_widget.php");
				$('.wrapper:nth-child(2)').fadeIn(1000);
				break;
			}
			case "#quick_ticket":
			{
				widget_creator();
				
				$('.wrapper:nth-child(2) .main_sec').load("./widgets/quick_ticket/quick_ticket.php");
				$('.wrapper:nth-child(2)').fadeIn(1000);
				break;
			}
		}

	});

});


function open_widget_menu()
	{
		if($("ul#bottom_menu").css("display") == 'none')
		{
			$("ul#bottom_menu").fadeIn();
		}
		else
		{
			$("ul#bottom_menu").fadeOut();
		}
	}
function widget_creator()
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
		
		exitButton = document.createElement('button');
		exitButton.setAttribute('class', 'exitWidget');
		exitButton.setAttribute('onClick', '$(this).parents(".wrapper").fadeOut();');
		exitButton.innerHTML = "EXIT | X";
		
		resizeButton = document.createElement('button');
		resizeButton.setAttribute('class', 'resize');
		resizeButton.setAttribute('onClick', 'resize(this,event)');
		resizeButton.innerHTML= "Resize";
		
		new_header.appendChild(exitButton);
		new_header.appendChild(resizeButton);

}
function resize(event)
{
w = $(event).parents('.wrapper').css('width');
console.log($(event).parents('.wrapper').css('width'));
	if(w > '500px')
	{
		$(event).parents('.wrapper').stop().animate({
			width: '48%'
		},1000,function()
		{
			
		});
	}
	if(w < '501px'){
		$(event).parents('.wrapper').stop().animate({
			width: '100%'
		},1000,function()
			{
				
			});
	}
}