<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display all gallery images.
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store new image.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(
            public_path('uploads/gallery'),
            $imageName
        );

        Gallery::create([
            'title' => $request->title,
            'image' => 'uploads/gallery/' . $imageName,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display one image.
     */
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show edit form.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update image.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/gallery'),
                $imageName
            );

            $gallery->image = 'uploads/gallery/' . $imageName;
        }

        $gallery->title = $request->title;
        $gallery->save();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image updated successfully.');
    }

    /**
     * Delete image.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        if (file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted successfully.');
    }
}