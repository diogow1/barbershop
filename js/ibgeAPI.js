const urlUF = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

const uf = document.getElementById('uf');
const cidade = document.getElementById('cid');


uf.addEventListener('change', async ()=>{
    const urlCidades = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+uf.value+'/municipios';
    const request = await fetch(urlCidades);
    const response = await request.json();
    console.log(response.length);

    let opcoes = '';

    response.forEach(function(cidades){
        opcoes += '<option>'+cidades.nome+'</option>';
    })
    cidade.innerHTML = opcoes;
})

window.addEventListener('load', async ()=>{
    const request = await fetch(urlUF);
    const response = await request.json();

    const opcoes = document.createElement("optgroup");

    response.forEach(function(uf){
        opcoes.innerHTML += '<option>'+uf.sigla+'</option>';
    })

    uf.append(opcoes);

})