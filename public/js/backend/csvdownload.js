/*
 * @Author: Rituparna
 * @Date:   2017-06-22 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-12 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl, Blob, URL*/

$(document).ready(function () {
    "use strict";
    function ExportTableToCSV($table, filename) {
        var $rows = '',
            tmpColDelim = '',
            tmpRowDelim = '',
            colDelim = '',
            rowDelim = '',
            csv = '',
            csvData = '',
            blob = '',
            csvUrl = '';
        if ($("#userDetails").hasClass("new_new")) {
            $rows = $table.find('tr.for_search:has(td)');
            tmpColDelim = String.fromCharCode(11);
            tmpRowDelim = String.fromCharCode(0);
            colDelim = '","';
            rowDelim = '"\r\n"';
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td.hidden-phone');
                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();
                    return text.replace(/"/g, '""'); // escape double quotes
                }).get().join(tmpColDelim);
            }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"';
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
            /*jshint validthis: true */
            $(this).attr({ // -> No Strict violation!
                'download': filename,
                'href': csvData,
                'target': '_blank'
            });

        } else {

            $rows = $table.find('tr:has(td)');
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11); // vertical tab character
            tmpRowDelim = String.fromCharCode(0); // null character

            // actual delimiter characters for CSV format
            colDelim = '","';
            rowDelim = '"\r\n"';

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"';

				// Deliberate 'false', see comment below
            if (window.navigator.msSaveBlob && false) {
                blob = new Blob([decodeURIComponent(csv)], {
	                type: 'text/csv;charset=utf8'
                });

            // Crashes in IE 10, IE 11 and Microsoft Edge
            // See MS Edge Issue #10396033: https://goo.gl/AEiSjJ
            // Hence, the deliberate 'false'
            // This is here just for completeness
            // Remove the 'false' at your own risk
                window.navigator.msSaveBlob(blob, filename);

            } else if (window.Blob && window.URL) {
						// HTML5 Blob
                blob = new Blob([csv], { type: 'text/csv;charset=utf8' });
                csvUrl = URL.createObjectURL(blob);

                $(this).attr({
                    'download': filename,
                    'href': csvUrl
                });
            } else {
            // Data URI
                csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

                $(this).attr({
                    'download': filename,
                    'href': csvData,
                    'target': '_blank'
                });
            }
        }
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        var $table = $('.table'),
            args = [$table, 'export.csv'];

        ExportTableToCSV.apply(this, args);

        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
