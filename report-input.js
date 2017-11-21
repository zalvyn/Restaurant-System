$.fn.reportInit = function(data){
	// console.log(data[0]);
	$("#startYear").text(data[0]);
	$("#startMonth").text(data[1]);
	$("#startDay").text(data[2]);
	$("#endYear").text(data[3]);
	$("#endMonth").text(data[4]);
	$("#endDay").text(data[5]);
};

$(document).ready(function(){

	// filter words
	// $("header nav form #search").on("keyup", function(){
	// 	var value = $(this).val().toLowerCase();
	// 	// console.log('value:'+value);
	// 	$("#mainTable tbody tr").filter(function(){
	// 		console.log($(this).find('td:nth-child(5)').text());
	// 		$(this).toggle($(this).find('td:nth-child(5)').text().toLowerCase().indexOf(value) > -1);
	// 	});
	// });

	// function refreshTable(){
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "user-management.php",
	// 		success: function(){
	// 			window.location = "user-management.php";
	// 		}
	// 	});
	// }

	$("#startYearList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #startYear").text(txt);
	});
	$("#startMonthList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #startMonth").text(txt);
	});
	$("#startDayList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #startDay").text(txt);
	});
	$("#endYearList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #endYear").text(txt);
		console.log(txt);
	});
	$("#endMonthList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #endMonth").text(txt);
		console.log(txt);
	});
	$("#endDayList a").click(function(){
		var txt = $(this).text();
		$(".dropdown #endDay").text(txt);
		console.log(txt);
	});
	/* leave dropdown when click outside */
	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			$(".dropdown-content").hide();
	}};

	$("#time-filter").click(function(){
		var dr = [$("#startYear").text(),$("#startMonth").text(),$("#startDay").text(),$("#endYear").text(),$("#endMonth").text(),$("#endDay").text()];
		console.log(dr);
		$.ajax({
			type: "GET",
			url: "report.php",
			// data: { "dateRange": dateRange},
			// data: dateRange,
			success: function(){
				// alert(data);
				// location.reload();
				window.location.href = 'report.php?dr[]='+dr[0]+'&dr[]='+dr[1]+'&dr[]='+dr[2]+'&dr[]='+dr[3]+'&dr[]='+dr[4]+'&dr[]='+dr[5];
			}
		}).fail(function(xhr, status, error){
			alert(error);
		});

	});

});

function showDropdown(n){
	$(".dropdown-content").hide();
	switch (n) {
		case 1:
			$("#startYearList").toggle();
			break;
		case 2:
			$("#startMonthList").toggle();
			break;
		case 3:
			$("#startDayList").toggle();
			break;
		case 4:
			$("#endYearList").toggle();
			break;
		case 5:
			$("#endMonthList").toggle();
			break;
		case 6:
			$("#endDayList").toggle();
			break;
	}
}

// Close the dropdown menu if the user clicks outside of it
function GoHome(link){
	if (idChange.length>0){
		alert('You have unsaved changes. Are you sure to exit?');
	}
}
