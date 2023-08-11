@extends('layouts.main')

@section('content')

<main>
    <section>
        <h2>Billy Transportes</h2>
    </section>
    <section>
        <button onclick="redirecionar('/frete')" class="cadastrar">
            Lançar Novo
        </button>
        <button onclick="redirecionar('/search')" class="cadastrar">
            Pesquisar
        </button>
    </section>
    <div class="lista">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Local</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($fretes->reverse() as $frete)
                    <tr class="{{$frete->pago ? 'table-success' : ''}}">
                        <td>{{ date('d/m/Y', strtotime($frete->data)) }}</td>
                        <td> {{ $frete->empresa->nome ?? ''}} </td>
                        <td> {{ $frete->local ?? '' }} </td>
                        <td> {{'R$ '.number_format($frete->valor,2,',','.')}} </td>
                        <td> 
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$frete->id}}"><ion-icon name="trash-outline"></ion-icon></button>
                            @if(!$frete->pago)
                            <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#pago{{$frete->id}}"> <ion-icon name="card-outline"></ion-icon> </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
<div class="modal fade" id="pago{{$frete->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Pagamento?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja confirmar o Pagamento do frete do cliente <b>{{$frete->empresa->nome }} </b>no valor de <b> R$ {{number_format($frete->valor,2,',','.')}}</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="/frete/{{$frete->id}}" method="post">
            @csrf 
            @method('put')
        <button type="button" onclick="this.disabled = true; this.innerHTML = 'Adicionando..'; this.form.submit();" class="btn btn-primary">Adicionar</button>

        </form>
    </div>
    </div>
  </div>
</div>

         <!-- Modal -->
         <div class="modal fade" id="delete{{$frete->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar frete?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja deletar o frente do cliente <b>{{$frete->empresa->nome }} do dia {{ date('d/m/Y', strtotime($frete->data)) }} </b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="/frete/{{$frete->id}}" method="post">
            @csrf 
            @method('delete')
        <button type="button" onclick="this.disabled = true; this.innerHTML = 'Deletando..'; this.form.submit();" class="btn btn-danger">Deletar</button>

        </form>
      </div>
    </div>
  </div>
</div>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection