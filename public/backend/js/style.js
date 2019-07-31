//select2 ajax
function bootstrap_select2_ajax(selector,parent,url){
    $(selector).select2({
        minimumInputLength: 3,
        allowClear: true,
        placeholder: 'Masukkan Keywords',
        theme: "bootstrap",
        dropdownParent: $(parent),
        ajax: {
        dataType: 'json',
        url: url,
        delay: 200,
        data: function(params) {
            return {
            search: params.term
            }
        },
        processResults: function (response) {
            var results = [];
            $.each(response, function (index, data) {
                results.push({
                    id: data.id,
                    text: data.name
                });
            });

            return {
                results: results
            };
        },
    }
    });
}

//typeahead
function typeahead(selector,url,wildcard){
    var enggine = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        remote: {
            url : url,
            wildcard: wildcard,
            filter: function (data) {
                return $.map(data.data, function (list) {
                    return {
                        name: list.name
                    };
                });
            }
        }
    });

    enggine.initialize();
    
    $(selector).typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        source: enggine,
        displayKey: 'name'
    });
}