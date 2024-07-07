<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonNotFoundException;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePeopleRequest;
use App\Services\PersonService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct(
        private readonly PersonService $personService,
    ) {
    }

    public function index(Request $request): View|Factory|Application
    {
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page');
        $people = $this->personService->listAllPaginated($perPage, $page);

        return view('person.index', compact('people'));
    }

    public function create(): View|Factory|Application
    {
        return view('person.form');
    }

    public function store(StorePersonRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->personService->create($data);

        return response()->redirectToRoute('people.index')->with('success');
    }

    /**
     * @throws PersonNotFoundException
     */
    public function show(int $id): View|Factory|Application
    {
        $person = $this->personService->findById($id);

        return view('person.show', compact('person'));
    }

    /**
     * @throws PersonNotFoundException
     */
    public function edit(int $id): View|Factory|Application
    {
        $person = $this->personService->findById($id);

        return view('person.form', compact('person'));
    }

    public function update(UpdatePeopleRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $this->personService->update($id, $data);

        return response()->redirectToRoute('people.index')->with('success');

    }

    public function destroy(int $id): RedirectResponse
    {
        $this->personService->delete($id);

        return response()->redirectToRoute('people.index')->with('success');
    }
}
