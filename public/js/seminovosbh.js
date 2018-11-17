$( document ).ready(function() {


    /**
     * View: Both methods above are responsible for our view. They clean and show the crawled informations
     * to the user.
     */
    function cleanTableCells(url) {
        // clean the table before show the data

        $(`#${url.id}_marca`).empty();
        $(`#${url.id}_modelo`).empty();
        $(`#${url.id}_ano_fabricacao`).empty();
        $(`#${url.id}_ano_modelo`).empty();
        $(`#${url.id}_preco`).empty();
        $(`#${url.id}_codigo_veiculo`).empty();
        $(`#${url.id}_status_crawler`).empty();
    }

    function insertDataIntoTable(data) {
        // fill the table with the crawled information

        let img = $("<img />").attr('src', 'img/correct-symbol.png')
        .on('load', function() {
            $(`#${data.url_id}_status_crawler`).append(img);
        });

        $(`#${data.url_id}_marca`).append(`<td>${data.marca}</td>`);
        $(`#${data.url_id}_modelo`).append(`<td>${data.modelo}</td>`);
        $(`#${data.url_id}_ano_fabricacao`).append(`<td>${data.ano_fabricacao}</td>`);
        $(`#${data.url_id}_ano_modelo`).append(`<td>${data.ano_modelo}</td>`);
        $(`#${data.url_id}_preco`).append(`<td>${data.preco}</td>`);
        $(`#${data.url_id}_codigo_veiculo`).append(`<td>${data.veiculo_id}</td>`);
    }


    /**
     * This function receives the URL to Crawl and and the token, related to security Laravel. 
     * The method calls 'crawlStore' responsible to Crawl the data ans save them into database. 
     * Least but not least, it calls the methos cleanTableCells and insertDataIntoTable to clean 
     * ans show those informations in the View.
     */
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

    /**
     * When 'Start Crawl' is clicked, this function is responsible for recover all links' information
     * in the data base and then call 'crawlUrl' to each URL recovered.
     */
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