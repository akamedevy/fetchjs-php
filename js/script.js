const botao_yes = document.getElementById('yes');
const botao_no = document.getElementById('no');
const botao_cadastrar = document.getElementById("cadastrar");
var modal = document.getElementById('modal');


function chamaModal(){
    modal.classList.remove('oculta');
    modal.classList.add('chama');
}

function fecharModal(){
    modal.classList.remove('chama');
    modal.classList.add('oculta');
}


botao_cadastrar.addEventListener('click', function(event){
    event.preventDefault();
    
    let formulario = document.getElementById('formulario');
    chamaModal();

    botao_yes.addEventListener('click',async function(event){

        let formData = new FormData(formulario);
        
        let dados_php = await fetch('./action/cadastra_prod.php',{
            method: "post",
            body: formData
        });

        let response = await dados_php.json();
        console.log(response);

        if(response.status == 200){
            alert("clicouu");
            console.log('Retornou 200');
        }
        fecharModal();
    })
})