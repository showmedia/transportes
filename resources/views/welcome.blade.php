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

                @foreach($fretes->reverse() as $frete)

                <div class="card {{$frete->pago ? 'bg-success-subtle' : ''}}">
                <div class="card-body">
                  <p>
                    <strong>Data: {{ date('d/m', strtotime($frete->data)) }} </strong> <br>
                    <strong>Cliente: </strong> {{$frete->empresa->nome ?? ''}} <br>
                    <strong>Local: </strong> {{ $frete->local ?? '' }} <br>
                    <strong>Valor: </strong>R$ {{ number_format($frete->valor, 2,',','.') }} <br>
                  </p>

                  @foreach($frete->infos->reverse() as $info)
                    <p>
                      <strong> {{date('d/m', strtotime($info->created_at)) }}: </strong> {{$info->descricao ?? ''}}
                    </p> 
                  @endforeach
                  
                </div>
                <div class="card-buttons">
                          <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$frete->id}}"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                            @if(!$frete->pago)
                            <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#pago{{$frete->id}}"> <ion-icon name="card-outline"></ion-icon> Pago</button>
                            @endif
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info{{$frete->id}}">+ Observações</button>
                </div>
              </div>

                   

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
                   <div class="modal fade" id="info{{$frete->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Informação?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/info/{{$frete->id}}" method="post">
        @csrf 

      
      <div class="modal-body">
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Adicione uma informação</label>
        <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        
        <button type="button" onclick="this.disabled = true; this.innerHTML = 'Adicionando..'; this.form.submit();" class="btn btn-primary">Adicionar</button>

        
    </div>
    </form>
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
    </div>
</main>

@endsection