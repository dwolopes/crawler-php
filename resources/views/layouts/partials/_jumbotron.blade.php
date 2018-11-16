<div class="jumbotron">
    <h1 class="display-4">Ready to Crawl?</h1>
    <p class="lead">This is a simple crawler developed to SeminovosBH, The biggest website of car advertisements of Belo Horizonte.</p>
    <hr class="my-4">
    <p>
        The links in the table below represents the first step of the crawiling, which consisted recover all children links
        of this <a href="https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos">
            this page
        </a>
    </p>
    <p>
        Now, you can start the crawler again in these children links to recover cars' information hosted in these web's address.
    </p>
    <form id="formLinksToCrawl" method="post" action="{{url('crawl')}}" enctype="multipart/form-data">
        @csrf
        <button class="btn btn-primary btn-md" type="submit">Start crawling each of the links below</button>
    </form>
</div>