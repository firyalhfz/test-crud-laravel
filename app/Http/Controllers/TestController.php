<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function index()
    {
        $tests = Test::latest()->paginate(5);

        return view('test.index', compact('tests'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Test::create($request->all());

        return redirect()->route('tests.index')
            ->with('success', 'Test created successfully.');
    }


    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        return view('tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $test->update($request->all());

        return redirect()->route('tests.index')
            ->with('success', 'Test updated successfully');
    }


    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully');
    }
}