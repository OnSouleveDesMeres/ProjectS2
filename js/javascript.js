$(document).ready(function () {
    $("#searchbarStudent").keyup(function (event) {
        console.log($(this).attr("id"));
        var input = $(this);
        var val = input.val();
        if(val == ''){
            $('#studentList tr').show();
        }
        var temp = '(.*)'+val+'(.*)';
        var regexp = '\\b(.*)'+temp+'\\b';
        $('#studentList tr').show();

        $('#studentList').find('tr').each(function () {
            isOk = false;
            $(this).find('td').each(function () {
                var p = $(this);
                console.log(p.text());
                var results = p.text().match(new RegExp(regexp, "i"));

                if(results){
                    isOk = true
                }
            });

            if(!isOk && $(this).attr("id") != "titleTableStudent"){
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });

    });
});
$(document).ready(function () {
    $("#searchbarObservable").keyup(function (event) {
        console.log($(this).attr("id"));
        var input = $(this);
        var val = input.val();
        if(val == ''){
            $('#ObservableList tr').show();
        }
        var temp = '(.*)'+val+'(.*)';
        var regexp = '\\b(.*)'+temp+'\\b';
        $('#ObservableList tr').show();

        $('#ObservableList').find('tr').each(function () {
            isOk = false;
            $(this).find('td').each(function () {
                var p = $(this);
                console.log(p.text());
                var results = p.text().match(new RegExp(regexp, "i"));

                if(results){
                    isOk = true
                }
            });

            if(!isOk && $(this).attr("id") != "titleTableObservable"){
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });

    });
});
$(document).ready(function () {
    $("#searchbarCategory").keyup(function (event) {
        console.log($(this).attr("id"));
        var input = $(this);
        var val = input.val();
        if(val == ''){
            $('#CategoryList tr').show();
        }
        var temp = '(.*)'+val+'(.*)';
        var regexp = '\\b(.*)'+temp+'\\b';
        $('#CategoryList tr').show();

        $('#CategoryList').find('tr').each(function () {
            isOk = false;
            $(this).find('td').each(function () {
                var p = $(this);
                console.log(p.text());
                var results = p.text().match(new RegExp(regexp, "i"));

                if(results){
                    isOk = true
                }
            });

            if(!isOk && $(this).attr("id") != "titleTableCategory"){
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });

    });
});