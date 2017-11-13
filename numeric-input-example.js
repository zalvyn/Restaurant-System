/* this is an example for validation and change events */
// $.fn is jquery's namespace; $.fn.abc() is extend abc function for jquery, so that every jquery instance can use. eg. $("#div").abc();
var idChange = [], insertRows=[], deleteRows=[], element={};
var associativeArray = {};
var currentCell = {};

$.fn.numericInputExample = function () {
	'use strict';
	element = $(this);
		// footer = element.find('tfoot tr'),
		// dataRows = element.find('tbody tr');

	element.find('td').off().on('change', function (evt) { // when cell change
		// console.log("when cell change");

		var cell = $(this),	column = cell.index();
		var id = parseInt($(this).parent().find("td").first().text());
		idChange.push(id);
		// console.log("idchange"+idChange);
		// console.log("diff="+ $(idChange).not(insertRows).get() ); 
		// console.log("insert="+insertRows);

	}).on('validate', function (evt, value) { // validate before change
		var cell = $(this), column = cell.index();
		// console.log("validate="+column);
		if (column === 1 || column===2) { // for column name
			var re = /^[a-zA-Z ]+$/g;
			return !!value && value.trim().length > 0 && !!value.match(re);
			// !! check if is null
		} else if (column === 0) {
			var tmp = parseInt(value);
			return !isNaN(tmp) && tmp<1000;
		} else if (column === 3) {
			// return !isNaN(parseFloat(value)) && isFinite(value); // is finite
			var re = /^[a-zA-Z@_#$%-.]+$/g;
			return !!value && value.trim().length > 0 && !!value.match(re);
		}
	}).on('click', function(){
		currentCell = element.find('td:focus');
		// console.log(currentCell.text());
	});

	return this;
};

$(document).ready(function(){
	// update row
	$("#updateBtn").click(function(){
		var asso = {}, valueList=[], layer1=[], layer2=[], header=[], index=1, match_update=[], match_insert=[];
		// var mySet = new Set(idChange);
		$("#mainTable thead tr th").each(function(){
		    header.push($(this).text());
		});
		// finding update row index
		// var updateRows = $(idChange).not(insertRows).get();
		var updateRows = $(idChange).get();

		// console.log("idChange="+idChange);
		// console.log("updateRows:"+updateRows);
		// console.log("insert="+insertRows);
		// console.log("deleteRows:"+deleteRows);

		$("#mainTable tbody tr td:nth-child(1)").each(function(){
			// console.log($(this).text());
		    if ( updateRows.includes( parseInt($(this).text()) )){
		        match_update.push(index);
		    }
			// else if (insertRows.includes( parseInt($(this).text()) )) {
			// 	match_insert.push(index);
		    // }
		    index++;
		});
		// console.log("match_update"+match_update);
		// console.log("match_insert"+match_insert);

		match_update.forEach(function(j, index,ar){
		    valueList=[];
		    $("#mainTable tbody tr:nth-child("+j+") td").each(function(){
		        valueList.push($(this).text());
		    });
		    layer1.push(valueList);
		});
		// match_insert.forEach(function(j, index,ar){
		//     valueList=[];
		//     $("#mainTable tbody tr:nth-child("+j+") td").each(function(){
		//         valueList.push($(this).text());
		//     });
		//     layer2.push(valueList);
		// });

		// layer1.forEach(function(val,index,ar){
		//     console.log("1:"+val);
		// });
		// layer2.forEach(function(val,index,ar){
		//     console.log("2:"+val);
		// });

		if (match_update.length>0){
			$.ajax({
				type: "POST",
				url: "update.php",
				data: { "valueList": layer1, "headerList": header, "operation": "update"},
				success: function(data, txt, jqxhr){
					// alert(data);
					alert("You have successfully updated.");
					idChange=[];
				}
			}).done(function(msg){
				// console.log("done");
			}).fail(function(xhr, status, error){
				alert(error);
			});
		}
		//
		// if (match_insert.length>0){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "update.php",
		// 		data: { "valueList": layer2, "headerList": header, "operation": "insert"},
		// 		success: function(data, txt, jqxhr){
		// 			alert(data);
		// 			insertRows=[];
		// 		}
		// 	}).fail(function(xhr, status, error){
		// 		alert(error);
		// 	});
		// }

	});

	function refreshTable(){
		$.ajax({
			type: "POST",
			url: "index.php",
			success: function(){
				window.location = "index.php";
			}
		});
	}

	// add button
	$("#addBtn").click(function(){
		// var id = parseInt($("#mainTable tbody tr:last td:first").text())+1;
		// insertRows.push(id);
		$.ajax({
			type: "POST",
			url: "update.php",
			data: { "valueList": [['','','']], "operation": "insert"},
			success: function(data, txt, jqxhr){
				// alert("You have successfully added.");
				refreshTable();
			}
		}).fail(function(xhr, status, error){
			alert(error);
		});

		// $('#mainTable').editableTableWidget().numericInputExample();
	});

	// delete button
	$("#delBtn").click(function(){
		var thisRow = currentCell.parent();
		var id = parseInt(thisRow.find("td").first().text());

		$.ajax({
			type: "POST",
			url: "update.php",
			data: { "valueList": [id], "operation": "delete"},
			success: function(data, txt, jqxhr){
				// alert(data);
				// refreshTable();
				// console.log($('#mainTable tbody tr td:focus').text());
				thisRow.remove();
			}
		}).fail(function(xhr, status, error){
			alert(error);
		});
	});

});

