function mostrarCliente (){
  document.getElementById('enderecoidInput').style.display = 'none';
  document.getElementById('enderecoidLabel').style.display = 'none';
  document.getElementById('complementoidInput').style.display = 'none';
  document.getElementById('complementoidLabel').style.display = 'none';
  document.getElementById('cepidInput').style.display = 'none';
  document.getElementById('cepidLabel').style.display = 'none';
  document.getElementById('cidadeidSelect').style.display = 'none';
  document.getElementById('cidadeidLabel').style.display = 'none';
  document.getElementById('estadoidSelect').style.display = 'none';
  document.getElementById('estadoidLabel').style.display = 'none';

  document.getElementById('nascimentoidInput').style.display = 'block';
  document.getElementById('nascimentoidLabel').style.display = 'block';

  document.getElementById('enderecoidInput').removeAttribute('required');
  document.getElementById('cepidInput').removeAttribute('required');
  document.getElementById('cidadeidSelect').removeAttribute('required');
  document.getElementById('estadoidSelect').removeAttribute('required');

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
  document.getElementById('cidadeidSelect').style.display = 'block';
  document.getElementById('cidadeidLabel').style.display = 'block';
  document.getElementById('estadoidSelect').style.display = 'block';
  document.getElementById('estadoidLabel').style.display = 'block';

  document.getElementById('nascimentoidInput').style.display = 'none';
  document.getElementById('nascimentoidLabel').style.display = 'none';


  document.getElementById('enderecoidInput').setAttribute('required', true);
  document.getElementById('cepidInput').setAttribute('required', true);
  document.getElementById('cidadeidSelect').setAttribute('required', true);
  document.getElementById('estadoidSelect').setAttribute('required', true);
  
  document.getElementById('nascimentoidInput').removeAttribute('required');


  document.getElementById('nomeidLabel').innerHTML = 'Nome da barbearia';
  document.getElementById('nomeidInput').placeholder = 'Digite o nome da barbearia';
}