<x-layouts.app>

    <div class="w-10/12 flex flex-col py-2 gap-2">
        <div class="w-full flex justify-between">
            <h2 class="text-lg font-bold flex items-center">Pessoas</h2>
            <a
                href="{{ route('people.index') }}"
                class="flex  items-center rounded bg-blue-500 px-6 py-2 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none"
            >
                <x-icons.undo /> Voltar
            </a>
        </div>

        <div>
           <x-table>
                <tbody>
                    <x-table.tr :isStripe="false">
                        <x-table.td class="w-2/5">Nome</x-table.td>
                        <x-table.td colSpan="3">{{ $person->name }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="true">
                        <x-table.td class="w-2/5">CPF</x-table.td>
                        <x-table.td colSpan="3">{{ $person->document_number }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="false">
                        <x-table.td class="w-2/5">Data de nascimento</x-table.td>
                        <x-table.td colSpan="3">{{ $person->birth_formatted }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="true">
                        <x-table.td class="w-2/5">Email</x-table.td>
                        <x-table.td colSpan="3">{{ $person->email }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="false">
                        <x-table.td class="w-2/5">Telefone</x-table.td>
                        <x-table.td colSpan="3">{{ $person->phone_number }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="true">
                        <x-table.td class="w-2/5">Logradouro</x-table.td>
                        <x-table.td colSpan="3">{{ $person->address->street }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="false">
                        <x-table.td class="w-2/5">Cidade</x-table.td>
                        <x-table.td colSpan="3">{{ $person->address->city }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr :isStripe="true">
                        <x-table.td class="w-2/5">Estado</x-table.td>
                        <x-table.td colSpan="3">{{ $person->address->state }}</x-table.td>
                    </x-table.tr>
                </tbody>
           </x-table>
        </div>
    </div>


    {{-- <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface">
                        <thead class="border-b border-neutral-200 bg-white font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Nome</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->name }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">CPF</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->document_number }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Data de Nascimento</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->birth }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Email</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->email }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Telefone</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->phone_number }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Logradouro</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->address->street }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Cidade</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->address->city }}</td>
                            </tr>
                            <tr class="border-b border-neutral-200 bg-black/[0.02]">
                                <td class="whitespace-nowrap px-6 py-4">Estado</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $person->address->state }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</x-layouts.app>