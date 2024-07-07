<x-layouts.app>
    <div class="w-10/12 flex flex-col py-2 gap-2">
        <div class="w-full flex justify-between">
            <h2 class="text-lg font-bold flex items-center">Pessoas</h2>
            <a
                href="{{ route('people.create') }}"
                class="flex  items-center rounded bg-blue-500 px-6 py-2 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none"
            >
                <x-icons.plus /> Cadastrar
            </a>
        </div>

        <div>
            <x-table>
                <x-table.head>
                    <tr>
                        <x-table.th>#</x-table.th>
                        <x-table.th>Nome</x-table.th>
                        <x-table.th>CPF</x-table.th>
                        <x-table.th>Email</x-table.th>
                        <x-table.th>Ações</x-table.th>
                    </tr>
                </x-table.head>
                <tbody>
                    @foreach ($people as $key => $person)
                        <x-table.tr isStripe="{{ $key % 2 === 0 }}">
                            <x-table.td class="font-medium">{{ $person->id }}</x-table.td>
                            <x-table.td><a href="{{ route('people.show', (int) $person->id) }}" class="underline text-blue-500">{{ $person->name }}</a></x-table.td>
                            <x-table.td>{{ $person->document_number }}</x-table.td>
                            <x-table.td>{{ $person->email }}</x-table.td>
                            <x-table.td class="flex gap-2">
                                <a href="{{ route('people.show', $person->id) }}" class="underline text-blue-500">
                                    <x-icons.details />
                                </a>
                                <a href="{{ route('people.edit', $person->id) }}" class="underline text-blue-500">
                                    <x-icons.edit />
                                </a>
                                <form method="POST" action="{{ route('people.destroy', $person->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="underline text-blue-500">
                                        <x-icons.delete />
                                    </button>
                                </form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>
            <div class="mt-2 px-2">
                {{ $people->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>