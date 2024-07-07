const citiesUrl = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/{UF}/municipios?orderBy=nome';

function clearSelect() {
    document.querySelectorAll('.city-option').forEach(e => e.remove());
}

function fillCitiesSelect(input, cities) {
    cities.forEach(city => {
        const option = document.createElement('option');
        option.classList.add('city-option')
        option.value = city.nome;
        option.textContent = city.nome;
        input.appendChild(option);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const stateSelectInput = document.getElementById('address[state]');
    const citySelectInput  = document.getElementById('address[city]');

    stateSelectInput.addEventListener('change', function (_) {
        clearSelect();
        fetch(citiesUrl.replace("{UF}", this.value))
            .then(response => response.json())
            .then(data => fillCitiesSelect(citySelectInput, data))
            .catch(_ => console.log("Erro ao carregar cidades."));
    })
});

