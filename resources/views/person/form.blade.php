<x-layouts.app>
    @php
        $person = isset($person) ? $person : null;
    @endphp

    <div class="w-10/12 flex flex-col py-2 gap-2">
        <div class="w-full flex justify-between">
            <h2 class="text-lg font-bold flex items-center">{{ $person ? 'Editar pessoa' : 'Cadastrar nova pessoa'}}</h2>
            <a
                href="{{ route('people.index') }}"
                class="flex  items-center rounded bg-blue-500 px-6 py-2 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none"
            >
                <x-icons.undo /> Voltar
            </a>
        </div>

        <div class="min-w-full">
            <form method="POST" action="{{ $person ? route('people.update', $person->id) : route('people.store') }}" class="flex flex-col gap-2">
                @csrf
                @method($person ? 'PUT' : 'POST')
                <x-form.input name="name" placeholder="John Doe" value="{{ $person ? $person->name : '' }}">Nome</x-form.input>
                <x-form.input name="document_number" placeholder="xxx.xxx.xxx-xx" value="{{ $person ? $person->document_number : '' }}">CPF</x-form.input>
                <x-form.input-date name="birth"  value="{{ $person ? $person->birth : '' }}">Data de nascimento</x-form.input-date>
                <x-form.input name="email" placeholder="john@email.com" type="email"  value="{{ $person ? $person->email : '' }}">Email</x-form.input>
                <x-form.input name="phone_number" placeholder="(xx) 9xxxx-xxxx"  value="{{ $person ? $person->phone_number : '' }}">Telefone</x-form.input> 
                <x-form.select name="address[state]" label="Estado" validationName="address.state"  value="{{ $person ? $person->name : '' }}">
                    <option value="">Selecione um estado</option>
                </x-form.select>          
                <x-form.select name="address[city]" label="Cidade" validationName="address.city"  value="{{ $person ? $person->name : '' }}">
                    <option value="">Selecione uma cidade</option>
                </x-form.select> 
                <x-form.input name="address[street]" placeholder="Avenida laranjeiras" validationName="address.street"  value="{{ $person ? $person->address->street : '' }}">Logradouro</x-form.input> 
                <button
                    type="submit"
                    class="inline-block rounded bg-blue-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none"
                >
                    Salvar
                </button>
            </form>
        </div>
    </div>

    @section('scripts')
        <script type="text/javascript" src="{{ url('/assets/js/fetchStates.js') }}"></script>
        <script type="text/javascript" src="{{ url('/assets/js/fetchCities.js') }}"></script>
        <script type="text/javascript">
            const documentNumberInput = document.getElementById('document_number');
            const phoneNumberInput = document.getElementById('phone_number');
            const statesInput = document.getElementById('address[state]');
            const citiesInput = document.getElementById('address[city]');

            documentNumberInput.addEventListener('input', (e) => e.target.value = cpfMask(e.target.value));
            phoneNumberInput.addEventListener('input', (e) => e.target.value = phoneMask(e.target.value));

            statesInput.addEventListener('stateFetched', () => statesInput.value = '{{ old('address.state', null) ?? $person?->address?->state }}')

            document.addEventListener('DOMContentLoaded', function () {
                documentNumberInput.value = cpfMask(documentNumberInput.value)
                phoneNumberInput.value = phoneMask(phoneNumberInput.value)

                @if($city = old('address.city', null) ?? $person?->address?->city)
                    const option = document.createElement('option');
                    option.classList.add('city-option')
                    option.selected = true;
                    option.value = '{{ $city }}';
                    option.textContent = '{{ $city }}';
                    citiesInput.appendChild(option);
                @endif
            })
        </script>
    @stop

    @vite('resources/js/cpfMask.js')
    @vite('resources/js/phoneMask.js')
</x-layouts.app>