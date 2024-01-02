<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressBookRequest;
use App\Models\AddressBook;

class AddressBookController extends Controller
{
    public function index()
    {
        $data = AddressBook::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($data, 200);
    }

    public function store(AddressBookRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['created_at'] = now();

        AddressBook::create($validatedData);

        return response()->json(['message' => 'Data stored successfully'], 201);
    }

    public function show(AddressBook $addressBook)
    {
        return response()->json(['data' => $addressBook], 200);
    }

    public function update(AddressBookRequest $request, AddressBook $addressBook)
    {
        $validatedData = $request->validated();
        $validatedData['created_by'] = auth()->user()->id;

        $addressBook->update($validatedData);

        return response()->json(['message' => 'Data updated successfully'], 201);
    }

    public function destroy(AddressBook $addressBook)
    {
        $addressBook->delete();
        return response()->json(['message' => 'Data Deleted successfully', 'data' => $addressBook], 200);
    }
}

