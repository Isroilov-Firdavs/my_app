<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Elon;

class Eloncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //code
        // dd(time());
        $posts = Elon::orderBy("id", "desc")->paginate(5);
        return view("elon.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //code
        return view("elon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        if($request->hasFile("img")){
            $file = $request->file("img");
            $imgName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imgName);
            $requestData["img"] = $imgName;
        }

        Elon::create($requestData);
        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //code
        $post = Elon::findOrFail($id);
        return  view("elon.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //code
        $post = Elon::findOrFail($id);
        return view("elon.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //code
        $post = Elon::findOrFail($id);

        // 2. Formadan kelgan malumotlarni tekshiramiz (validation)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'img' => 'nullable|image|max:2048', // ixtiyoriy rasm
        ]);

        if($request->hasFile("img")){
            $file = $request->file("img");
            $imgName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imgName);
            $post["img"] = $imgName;
        }

        // 4. Ma’lumotlarni yangilaymiz
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->save();

        // 5. Foydalanuvchini qayta yo‘naltiramiz
        return redirect()->route('posts.index')->with('success', 'Post muvaffaqiyatli yangilandi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //code
        $post = Elon::findOrFail($id);
        $post->delete();  // Soft delete

        return redirect()->route('posts.index')->with('success', 'Post o\'chirildi');
    }
}
