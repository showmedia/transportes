
function redirecionar(url) {
    window.location.href = url; 
}

function adicionar(id) {
    $("#empresaid").val(id);

    $.ajax({
        url: "/api/empresa/"+id,
        type: "GET",    
        dataType: "json",
        success: function (retorno) {
            if(retorno.erro !== undefined){
               
            }else{
                console.log(retorno);
                $("#cliente").val(retorno.nome);
                $(".lista-cliente").hide();
                $("#cliente").prop("disabled", true);
            }
        },
        error: function(retorno){
           
        },
        complete: function(){
            //ação depois de completo
        }
    });
}

$(document).ready(function() {

        $(".lista-cliente").hide();

        $("#cliente").keyup(function(){

            $.ajax({
                url: "/api/empresa?search="+$(this).val(),
                type: "GET",    
                dataType: "json",
                success: function (retorno) {
                    if(retorno.erro !== undefined){
                       
                    }else{
                        console.log(retorno);
                        $(".lista-cliente").fadeIn();
                        let tabela = document.getElementById('table-cliente');
                        $("#table-cliente tr").remove();
                     
                    for(let i=0;i < retorno.length;i++){
                        let tr = tabela.insertRow();
                        
                        let td_cliente = tr.insertCell();
                        td_cliente.innerHTML = "<h6 onclick='adicionar("+retorno[i].id+")'>"+retorno[i].nome+"</h6>";
                    }
                      
                    }
                },
                error: function(retorno){
                   
                },
                complete: function(){
                    //ação depois de completo
                }
            });

        });
  
        const hoje = new Date();
        const ano = hoje.getFullYear();
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const dia = String(hoje.getDate()).padStart(2, '0');

        const dataFormatada = `${ano}-${mes}-${dia}`;
        
        $("#datahoje").val(dataFormatada);
    
});