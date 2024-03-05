function mostrarCliente (){
    document.getElementById('enderecoidInput').style.display = 'none';
    document.getElementById('enderecoidLabel').style.display = 'none';
    document.getElementById('complementoidInput').style.display = 'none';
    document.getElementById('complementoidLabel').style.display = 'none';
    document.getElementById('cepidInput').style.display = 'none';
    document.getElementById('cepidLabel').style.display = 'none';
    document.getElementById('cid').style.display = 'none';
    document.getElementById('cidadeidLabel').style.display = 'none';
    document.getElementById('uf').style.display = 'none';
    document.getElementById('estadoidLabel').style.display = 'none';

    document.getElementById('nascimentoidInput').style.display = 'block';
    document.getElementById('nascimentoidLabel').style.display = 'block';

    document.getElementById('enderecoidInput').removeAttribute('required');
    document.getElementById('cepidInput').removeAttribute('required');
    document.getElementById('cid').removeAttribute('required');
    document.getElementById('uf').removeAttribute('required');

    document.getElementById('nascimentoidInput').setAttribute('required', true);


    document.getElementById('nomeidLabel').innerHTML = 'Nome completo';
    document.getElementById('nomeidInput').placeholder = 'Digite seu nome completo';



    }

    function mostrarEstabelecimento() {
    document.getElementById('enderecoidInput').style.display = 'block';
    document.getElementById('enderecoidLabel').style.display = 'block';
    document.getElementById('complementoidInput').style.display = 'block';
    document.getElementById('complementoidLabel').style.display = 'block';
    document.getElementById('cepidInput').style.display = 'block';
    document.getElementById('cepidLabel').style.display = 'block';
    document.getElementById('cid').style.display = 'block';
    document.getElementById('cidadeidLabel').style.display = 'block';
    document.getElementById('uf').style.display = 'block';
    document.getElementById('estadoidLabel').style.display = 'block';

    document.getElementById('nascimentoidInput').style.display = 'none';
    document.getElementById('nascimentoidLabel').style.display = 'none';


    document.getElementById('enderecoidInput').setAttribute('required', true);
    document.getElementById('cepidInput').setAttribute('required', true);
    document.getElementById('cid').setAttribute('required', true);
    document.getElementById('uf').setAttribute('required', true);
    
    document.getElementById('nascimentoidInput').removeAttribute('required');


    document.getElementById('nomeidLabel').innerHTML = 'Nome da barbearia';
    document.getElementById('nomeidInput').placeholder = 'Digite o nome da barbearia';
}