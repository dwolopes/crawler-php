$( document ).ready(function() {

    function cleanTableCells(url) {
        $(`#${url.id}_marca`).empty();
        $(`#${url.id}_modelo`).empty();
        $(`#${url.id}_ano_fabricacao`).empty();
        $(`#${url.id}_ano_modelo`).empty();
        $(`#${url.id}_preco`).empty();
        $(`#${url.id}_codigo_veiculo`).empty();
        $(`#${url.id}_status_crawler`).empty();
    }

    function insertDataIntoTable(data) {
        $(`#${data.url_id}_marca`).append(`<td>${data.marca}</td>`);
        $(`#${data.url_id}_modelo`).append(`<td>${data.modelo}</td>`);
        $(`#${data.url_id}_ano_fabricacao`).append(`<td>${data.ano_fabricacao}</td>`);
        $(`#${data.url_id}_ano_modelo`).append(`<td>${data.ano_modelo}</td>`);
        $(`#${data.url_id}_preco`).append(`<td>${data.preco}</td>`);
        $(`#${data.url_id}_codigo_veiculo`).append(`<td>${data.veiculo_id}</td>`);
        $(`#${data.url_id}_status_crawler`).append(`<td>Sucesso!</td>`);
    }


    function crawlUrl(url, token) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            /* the route pointing to the post function */
            url: '/crawl',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {url: url.url, id: url.id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                cleanTableCells(url);
                insertDataIntoTable(data);
            },

            error: function (e) {
                $(`#${url.id}_status_crawler`).empty();
                $(`#${url.id}_status_crawler`).append(`<td>Falhou :(</td>`);
            }
        });

    };

    $("#formLinksToCrawl").submit(function (event) {
        event.preventDefault();
        let token = $("input[name='_token']").val();

        fetch('/getUrls')
            .then(
                function(response) {
                    if (response.status !== 200) {
                        console.log(`Looks like there was a problem. Status Code: ${response.status}`);
                        return;
                    }
                    // Examine the text in the response
                    response.json().then(function(data) {
                        for(let i = 0; i < data.length; i++){
                            crawlUrl(data[i], token);
                        }
                    });
                }
            )
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });

    });
})