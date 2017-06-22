/*
 * @Author: Rituparna
 * @Date:   2017-06-22 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-22 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jslint eqeq: true*/

function searchregisterTable(inputVal) {
    "use strict";
	$("#userDetails").addClass("new_new");
	var table = $('#userDetails'),
        check = false,
        allCells = '',
        hidden_cnt = '',
        i = 0,
        numOfVisibleRows = '';
	table.find('tr.show_rows').each(function (index, row) {
		$(row).removeClass("for_search");
		allCells = $(row).find('td');
		hidden_cnt = $('#hidden_cnt').val();
		i = 0;
		if (allCells.length > 0) {


			var found = false;
			allCells.each(function (index, td) {
				var regExp = new RegExp(inputVal, 'i');
				if (regExp.test($(td).text())) {

					found = true;
					check = true;
					return false;
				}
			});
			if (found == true) {  // jshint ignore:line
				$('#hidden_tr').hide();
				$(row).show();
				$(row).addClass("for_search");
				$('#userDetails').find("thead tr").addClass("for_search");
				$(".for_title").css("display", "table-row");
			} else {
				$(row).hide();
			}
			$(".for_title").css("display", "table-row");
		    $('.hidden_head').hide();

		}
	});
	if (check == false) {  // jshint ignore:line
		$('#hidden_tr').show();
		$('.hidden_head').hide();
        $('.numberclasscheck').text("Number Of User(s) :0"); //when no rows match

	} else {
		$('#hidden_tr').hide();
		$('.hidden_head').hide();
        numOfVisibleRows = ($('tr:visible').length); //when rows match
        $('.numberclasscheck').text("Number Of User(s) :" + numOfVisibleRows); //when rows match
	}
}

$(function () {
    "use strict";
    $('#registeredtableSearch').keyup(function () {
        searchregisterTable($(this).val());
    });


});
