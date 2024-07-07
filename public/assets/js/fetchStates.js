const statesUrl = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome';

let stateFetched = new CustomEvent('stateFetched', { detail: 'fetched' })

function fillStatesSelect(input, states) {
    states.forEach(state => {
        const option = document.createElement('option');
        option.value = state.sigla;
        option.textContent = state.nome;
        input.appendChild(option);
    })

    input.dispatchEvent(stateFetched);    
}

document.addEventListener('DOMContentLoaded', function() {
    const statesSelectInput = document.getElementById('address[state]');

    fetch(statesUrl)
        .then(response => response.json())
        .then(data => fillStatesSelect(statesSelectInput, data))
        .catch(_ => console.log('Erro ao processar estados.'));
});