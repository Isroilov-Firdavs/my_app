<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class AjaxConttroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ajax.index');
    }

    public function getData(Request $request)
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(10);
        return response()->json($teachers);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:teachers',
            'language'   => 'required|string',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json(['success' => 'O‘qituvchi qo‘shildi', 'data' => $teacher]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return response()->json(['success' => 'Maʼlumot yangilandi', 'data' => $teacher]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Teacher::findOrFail($id)->delete();
        return response()->json(['success' => 'O‘qituvchi o‘chirildi']);
    }
}
