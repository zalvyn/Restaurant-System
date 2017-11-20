/* this is an example for validation and change events */
// $.fn is jquery's namespace; $.fn.abc() is extend abc function for jquery, so that every jquery instance can use. eg. $("#div").abc();
/**
deleted = (oldIDs-beforeChange)-(newIDs-afterChange)
inserted = (newIDs-afterChange)-(oldIDs-beforeChange)
updated = idChange-beforeChange-afterChange
**/
var idChange = [], insertRows=[], deleteRows=[], oldIDs=[], newIDs=[],beforeChange=[],afterChange=[], element={};
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
		console.log("idchange= "+idChange);

	}).on('validate', function (evt, value) { // validate before change
		// console.log("validate");
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

	/** get old IDs **/
	element.find('td:first-child').each(function(){
		oldIDs.push($(this).text())
	});
	// console.log(oldIDs);

	return this;
};

$(document).ready(function(){
	// update row
	$("#updateBtn").click(function(){
		var asso = {}, valueList=[], updateData=[], layer2=[], header=[], index=1, updateRowNo=[], match_insert=[];
		var updateRows = $(idChange).get();

		console.log("late idChange="+idChange);
		// console.log("updateRows:"+updateRows);
		// console.log("insert="+insertRows);
		// console.log("deleteRows:"+deleteRows);

		$("#mainTable tbody tr td:nth-child(1)").each(function(){
			// console.log($(this).text());
		    if ( updateRows.includes( parseInt($(this).text()) )){
		        updateRowNo.push(index);
		    }
		    index++;
		});
		// console.log("updateRowNo"+updateRowNo);
		// console.log("match_insert"+match_insert);

		updateRowNo.forEach(function(j, index,ar){
		    valueList=[];
		    $("#mainTable tbody tr:nth-child("+j+") td:not(.no_focus)").each(function(){
		        valueList.push($(this).text());
		    });
		    updateData.push(valueList);
		});

		updateData.forEach(function(val,index,ar){
		    console.log("1:"+val);
		});

		// header=['FirstName','LastName','Age','UserName','ContactNumber','Gender']
		// if (updateRowNo.length>0){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "update.php",
		// 		data: { "valueList": updateData,"target_table":"staff","headerList": header,"idField":idChange, "operation": "update"},
		// 		success: function(data, txt, jqxhr){
		// 			alert(data);
		// 			// alert("You have successfully updated.");
		// 			idChange=[];
		// 		}
		// 	}).done(function(msg){
		// 		// console.log("done");
		// 	}).fail(function(xhr, status, error){
		// 		alert(error);
		// 	});
		// }

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
	// $("#addBtn").click(function(){
	// 	// var id = parseInt($("#mainTable tbody tr:last td:first").text())+1;
	// 	// insertRows.push(id);
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "update.php",
	// 		data: { "valueList": [['','','']], "operation": "insert"},
	// 		success: function(data, txt, jqxhr){
	// 			// alert("You have successfully added.");
	// 			refreshTable();
	// 		}
	// 	}).fail(function(xhr, status, error){
	// 		alert(error);
	// 	});
	//
	// 	// $('#mainTable').editableTableWidget().numericInputExample();
	// });

	$("#addBtn").click(function(){
		var a = $("#mainTable tbody tr:nth-child(3) td:not(.no_focus)");
		console.log( a.text() ); //.not(".no_focus")
	});


	// delete button
	$(".delBtn").click(function(){
		console.log($(this).parent().parent().text());
		// var thisRow = currentCell.parent();
		// var id = parseInt(thisRow.find("td").first().text());

		alert('you sure to delete?');

		// $.ajax({
		// 	type: "POST",
		// 	url: "update.php",
		// 	data: { "valueList": [id], "operation": "delete"},
		// 	success: function(data, txt, jqxhr){
		// 		// alert(data);
		// 		// refreshTable();
		// 		// console.log($('#mainTable tbody tr td:focus').text());
		// 		thisRow.remove();
		// 	}
		// }).fail(function(xhr, status, error){
		// 	alert(error);
		// });
	});

});

function GoHome(link){
	if (idChange.length>0){
		alert('You have unsaved changes. Are you sure to exit?')
	}
}
