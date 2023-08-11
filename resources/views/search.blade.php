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
        <button onclick="redirecionar('/frete')" class="cadastrar">
            Lançar Novo
        </button>
    </section>

    <div class="lista text-center">
        <form action="/search" method="post">
            @csrf

            <div class="mb-3 row">
                <div class="col-sm-12">
                <input type="search" placeholder="Pesquisar pelo nome do cliente ou local" class="form-control form-control-lg" name="search" id="search">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="data" class="col-sm-2 col-form-label"><b>Data Inicio</b></label>
                <div class="col-sm-10">
                <input type="date" class="form-control form-control-lg" name="dataini">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="data" class="col-sm-2 col-form-label"><b>Data Fim</b></label>
                <div class="col-sm-10">
                <input type="date" class="form-control form-control-lg" name="datafim">
                </div>
            </div>



            <section>
                <button type="button" onclick="this.disabled = true; this.innerHTML = 'Adicionando..'; this.form.submit();" class="cadastrar primary">
                    Pesquisar
                </button>
            </section>
        </form>
    </div>
    </main>
@endsection