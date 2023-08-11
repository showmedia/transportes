<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frete;
use App\Models\Empresa;
use App\Models\Info;

class FreteController extends Controller
{

    public function welcome(){
        $search = request('search');
        $dataini = request('dataini');
        $datafim = request('datafim');
        if($search || $dataini){
            if($dataini){
                if($search){
                    $fretes = Frete::join('empresas', 'empresas.id', '=', 'empresas_id')
                    ->where([
                        ['empresas.nome', 'like', '%'.$search.'%']
                    ])->orWhere([
                        ['local', 'like', '%'.$search.'%']
                    ])->select('fretes.*')
                    ->where([
                        ['data', '>=', $dataini]
                    ])->Where([
                        ['data', '<=', $datafim]
                    ])->get();
                }else{
                    $fretes = Frete::where([
                        ['data', '>=', $dataini]
                    ])->Where([
                        ['data', '<=', $datafim]
                    ])->get();
                }
            }else{
                $fretes = Frete::join('empresas', 'empresas.id', '=', 'empresas_id')
                ->where([
                    ['empresas.nome', 'like', '%'.$search.'%']
                ])->orWhere([
                    ['local', 'like', '%'.$search.'%']
                ])->select('fretes.*')->get();
            }
            
        }else{
            $fretes = Frete::all();
        }
    
        return view('welcome', ['fretes' => $fretes]);
    }

    public function create(){
        return view('frete.create');
    }

    public function store(Request $request){
        $frete = new Frete;
        if($request->empresaid){
            $empresa = Empresa::findOrFail($request->empresaid);
        }else{
            $empresa = new Empresa;
            $empresa->nome = $request->cliente;
            $empresa->save();
        }
        
        $frete->data = $request->data;
        $frete->local = $request->local;
        $valor = str_replace(".","", $request->valor);
        $valor = str_replace(",",".",$valor);
        $frete->valor = $valor;
        $frete->empresas_id = $empresa->id;

        $frete->save();
        return redirect('/')->with('msg', 'Frete adicionado!');
    }

    public function delete($id){
        $frete = Frete::findOrFail($id);
        $frete->delete();
        return redirect('/')->with('msg', 'Frete deletado com sucesso!');
    }

    public function update($id){
        $frete = Frete::findOrFail($id);
        $frete->pago = 1;
        $frete->update();
        return redirect('/')->with('msg', 'O pagamento do frete foi adicionado');
    }

    public function search(){
        return view('search');
    }

    public function addinfo($id, Request $request){
        $info = new Info;
        $info->descricao = $request->descricao;
        $info->fretes_id = $id;
        $info->save();
        return redirect('/')->with('msg', 'Informação adicionada');
    }
}
