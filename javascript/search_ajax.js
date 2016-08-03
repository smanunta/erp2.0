var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
	var xmlHttp;
	
	if(window.ActiveXObject)
	{
		try
		{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e)
		{
			xmlHttp = false;
		}
	}
	else
	{
		try
		{
			xmlHttp = new XMLHttpRequest();
		}catch(e)
		{
			xmlHttp = false;
		}
	}

	if(!xmlHttp)
		alert("cant create object");
	else
		return xmlHttp;
		
		
}

function process_search()
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
	{
		search_parameter = encodeURIComponent(document.getElementById("userInput").value);
		search_type = encodeURIComponent(document.getElementById("userOptions").value);
		xmlHttp.open("GET", "../pages/search_xml.php?search_parameter=" + search_parameter + "&search_type=" + search_type, true);
		if(search_type == "find_users")
		{
			xmlHttp.onreadystatechange = handleServerResponse;
			xmlHttp.send(null);
		}
		else if(search_type == "find_config_item")
		{
			xmlHttp.onreadystatechange = handleServerResponseConfig;
			xmlHttp.send(null);
		}
		else if(search_type == "find_wo")
		{
			xmlHttp.onreadystatechange = handleServerResponseWorkOrders;
			xmlHttp.send(null);
		}
	}
	else
	{
		//setTimeout('process_search()',5000);
	}
}

function handleServerResponse()    //RESPONSE FOR FIND_USERS
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{
			xmlResponse = xmlHttp.responseXML;
			root = xmlResponse.documentElement;
			
			
				first_name = root.getElementsByTagName('first');
				last_name = root.getElementsByTagName('last');
				user_name = root.getElementsByTagName('username');
				
				document.getElementById("underInput").innerHTML = "";   //RESETS THE DIV BEFORE INSERTING DATA
				for(var i=0; i< first_name.length; i++)
				{
					usersUL = document.createElement('ul');
					usersUL.setAttribute("class", "usersFound");
					
					usersFirst = document.createElement('li');
					usersLast = document.createElement('li');
					usersName = document.createElement('li');		

					first = (first_name.item(i).firstChild.data) ? document.createTextNode(first_name.item(i).firstChild.data) : document.createTextNode("N/A") ;
					last = (last_name.item(i).firstChild.data) ? document.createTextNode(last_name.item(i).firstChild.data) : document.createTextNode("N/A");
					username = document.createTextNode(user_name.item(i).firstChild.data);
					
					usersFirst.appendChild(first); 
					usersLast.appendChild(last); 
					usersName.appendChild(username); 
					
					usersUL.appendChild(usersFirst);
					usersUL.appendChild(usersLast);
					usersUL.appendChild(usersName);
					underInput = document.getElementById("underInput");
					
					underInput.appendChild(usersUL);
				}
			
			//setTimeout('process_search()', 5000);
		}
		else
		{
			alert("something is wrong");
		}
	}
}

function handleServerResponseConfig() //RESPONSE FOR FIND CONFIG ITEMS
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{
			xmlResponse = xmlHttp.responseXML;
			root = xmlResponse.documentElement;
			
			
				item = root.getElementsByTagName('item');
				desc = root.getElementsByTagName('description');
				
				itemsUL = document.createElement('ul');
				itemsUL.setAttribute("id", "itemsFound");
				
				document.getElementById("underInput").innerHTML = "";   //RESETS THE DIV BEFORE INSERTING DATA
				for(var i=0; i< item.length; i++)
				{
					itemList = document.createElement('li');     // CREATE LIST ITEM ELEMENT
					t = document.createTextNode(item.item(i).firstChild.data + " - " + desc.item(i).firstChild.data);
					itemList.appendChild(t);
					itemsUL.appendChild(itemList);
					underInput = document.getElementById("underInput");
					
					underInput.appendChild(itemsUL);
				}
			
			
			
			//setTimeout('process_search()', 5000);
		}
		else
		{
			alert("something is wrong");
		}
	}
}

function handleServerResponseWorkOrders()    //RESPONSE FOR FIND_WO
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{
			xmlResponse = xmlHttp.responseXML;
			root = xmlResponse.documentElement;
			
				wo_id = root.getElementsByTagName('wo_id');
				wo_desc = root.getElementsByTagName('description');
				first_name = root.getElementsByTagName('first');
				last_name = root.getElementsByTagName('last');
				
				document.getElementById("underInput").innerHTML = "";   //RESETS THE DIV BEFORE INSERTING DATA
				for(var i=0; i< first_name.length; i++)
				{
					woUL = document.createElement('ul');   //creates the ul 
					woUL.setAttribute("class", "woFound");
					
					woId = document.createElement('li');   // creates the li
					woDesc = document.createElement('li');
					woUser = document.createElement('li');		

					id = (wo_id.item(i).firstChild) ? document.createTextNode(wo_id.item(i).firstChild.data) : document.createTextNode("N/A");     // text for the li's
					desc = (wo_desc.item(i).firstChild) ? document.createTextNode(wo_desc.item(i).firstChild.data): document.createTextNode("N/A");
					username = (last_name.item(i).firstChild && first_name.item(i).firstChild) ? document.createTextNode(last_name.item(i).firstChild.data + ", " +first_name.item(i).firstChild.data): document.createTextNode("N/A");
					
					woId.appendChild(id);   //add the text to the li's
					woDesc.appendChild(desc); 
					woUser.appendChild(username); 
					
					woUL.appendChild(woId);
					woUL.appendChild(woDesc);  // add the lis to the the ul
					woUL.appendChild(woUser);
					underInput = document.getElementById("underInput");
					
					underInput.appendChild(woUL);   //output the ul
				}
			
			//setTimeout('process_search()', 5000);
		}
		else
		{
			alert("something is wrong");
		}
	}
}
