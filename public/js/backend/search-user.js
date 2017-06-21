/*
 * @Author: Rituparna
 * @Date:   2017-02-8 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-06-12 18:52:26
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
        i = 0;
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

	} else {
		$('#hidden_tr').hide();
		$('.hidden_head').hide();
	}
}

$(function () {
    "use strict";
    $('#registeredtableSearch').keyup(function () {
        searchregisterTable($(this).val());
    });


});