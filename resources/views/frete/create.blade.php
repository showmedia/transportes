@extends('layouts.main')

@section('content')

<main>
    <section>
        <h2>Billy Transportes</h2>
    </section>
    <section>
        <button onclick="redirecionar('/')" class="cadastrar">
            Voltar
        </button>
        <button onclick="redirecionar('/search')"  class="cadastrar">
            Pesquisar
        </button>
    </section>
    <div class="lista text-center">
        <form action="/frete" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="data" class="col-sm-2 col-form-label"><b>Data</b></label>
                <div class="col-sm-10">
                <input type="date" class="form-control form-control-lg" name="data" id="datahoje">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cliente" class="col-sm-2 col-form-label"><b>Cliente</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" required="required" name="cliente" id="cliente">
                </div>

                <input type="hidden" name="empresaid" id="empresaid">
            </div>

            <div class="lista-cliente">
                <table id="table-cliente"><tr></tr></table>
            </div>

            <div class="mb-3 row">
                <label for="local" class="col-sm-2 col-form-label"><b>Local</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" name="local" id="local">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="valor" class="col-sm-2 col-form-label"><b>Valor</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" name="valor" id="valor">
                </div>
            </div>

            <section>
                <button type="button" onclick="this.disabled = true; this.innerHTML = 'Adicionando..'; this.form.submit();" class="cadastrar primary">
                    Adicionar
                </button>
            </section>
        </form>
    </div>
</main>

@endsection