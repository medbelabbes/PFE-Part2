var CB=1;
var HTMLtbl =
    {
        getData: function (table) {
            var data = [];

            table.find('tr').not(':first').each(function (rowIndex, r) {
                if ($("#chk_" + CB).is(':checked'))
                    {
                    var cols = [];
                    $(this).find('td').each(function (colIndex, c) {                      
                        cols.push($(this).text().trim());     

                    });
                    data.push(cols);
                }
                CB++;
            });
            CB = 1;
            return data;
        }
    }