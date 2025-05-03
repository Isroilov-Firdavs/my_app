<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\PostStoreRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $teachers = Teacher::paginate(100);
    //     return view("teachers.index", compact("teachers"));
    // }
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Agar qidiruv so‘rovi bo‘lsa
        if ($request->has('search') && $request->search != '') {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // So‘rovni bajarish va teacherlarni olish
        $teachers = $query->orderBy('created_at', 'asc')->paginate(10);

        return view('teachers.index', compact('teachers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $json = Storage::get('countries.json');
        $countries = json_decode($json, true);

        return view('teachers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        Teacher::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "language" => $request->language,
        ]);
        return redirect()->route('teachers.index')->with('success', 'Post muvaffaqiyatli qo\'shildi');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Teacher::findOrFail($id);
        $post->delete();  // Soft delete

        return redirect()->route('teachers.index')->with('success', 'Post o\'chirildi');
    }
    public function fetch()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }
}
