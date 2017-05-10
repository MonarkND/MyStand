
/*ajax for discussion
	<script language = "javascript" type="text/javascript">

	function createXHR()
	{
		var ajaxRequest;  // The variable that makes Ajax possible!

		try
		{
			// Opera 8.0+, Firefox, Safari 
			ajaxRequest = new XMLHttpRequest();
		}catch (e)
			{

			// Internet Explorer Browsers
			try
			{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}catch (e) 
				{
				try
				{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}catch (e)
					{

					// Something went wrong
					alert("Your browser broke!");
					return false;
					}
				}
			}
	}
	function callback()
	{
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200)
			console.log("it's all done")
	}
	function quickdisplay()
	{
		var clone = document.getElementById("wrapper").getElementsByClassName("YourAsk");
		clone.getElementsByTagName("p")[0].innerHTML = "First msg";
		clone.getElementsByTagName("p")[1].innerHTML = "Second msg";
		document.getElementById("wrapper").insertBefore(clone, document.getElementById("wrapper").firstChild);
	}
	
	function mainfunction()
	{
		console.log("hello");
		event.preventDefault();
		quickdisplay();
		createXHR();
		ajaxRequest.onreadystatechange = callback;
		console.log("done part 1");
		return false;
	}
	document.getElementById("element").addEventListener("submit",function(evt){
		evt.preventDefault();
	}
	);
}
</script>



/****ask code function
<script>
function AddAsk()
		{
			document.getElementById('loaderIcon').style.display = "block";
		
			var JSNewsID = document.getElementById('NewsID').value;
			var JSAskQuestion = document.getElementById('AskQustion').value;
			var queryString;
			queryString = 'NewsID='+JSNewsID+'&AskQustion='+JSAskQuestion;
			
			var url = "AddAskQuestion.php?" + queryString; 	
			
			if (window.XMLHttpRequest) 
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} 
			else 
			{
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.open("GET",url,true);
			
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					var list = document.getElementById("Ask-list");
					list.innerHTML = xmlhttp.responseText +list.innerHTML;
					document.getElementById('NewsID').value = ""; 
					document.getElementById('loaderIcon').style.display = "none";
				}
			};
			xmlhttp.send(null);
		}	
		
</script>


<table border="1" style="width:25%" class="YourAsk EveryAsk" align="center">
							<tr><td colspan="2"><p><?php echo $Ask[$i][1] ?></p></td></tr>
							<tr>
								<td align="left"><?php echo "By {$Ask[$i][3]}"; ?></td>
								<td align="right"><?php echo "At {$Ask[$i][2]}"; ?></td>
							</tr>
							<tr>
								<td width="50%" align="center"><button name="CommentButton" <?php echo "onclick='OpenComments({$Ask[$i][0]},{$i})'"; ?>>Comments</button></td>
								<td align="center"><?php echo"<a href='DeleteAsk.php?AskID={$Ask[$i][0]}'><button>Delete</button></a>" ?></td>
							</tr>
						</table>
