<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Category\UpdateAttributeRequest;
use App\Models\Category;
use App\Models\Prompt;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        // Category Status Cases
        $data = Category::query()
            ->when(!empty($request['search']), function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request['search']}%")
                    ->orWhere('description', 'LIKE', "%{$request['search']}%")
                    ->orWhere('id', 'LIKE', "%{$request['search']}%");
            })
            ->get();

        return view('categories.index', ['items' => $data]);
    }


    public function create()
    {
        return view('categories.create');
    }


    public function add_prompt($jd)
    {
        $category=Category::find($jd);

        return view('prompts.create')->with(['categories'=>[$category]]);
    }

    public function show($id)
    {
        $item = Category::find($id)->load('prompts');
//        return $item->attributes;
        return view('categories.show', ['item' => $item]);
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // Create a new Prompt model instance with the validated data

        $item = new Category();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->attributes = $request->input('attributes');
        $item->spi_id = $request->input('spi_id') ?? '';
        $item->save();
        // Save the changes to the database

        $check = Category::find($item->id);

        if ($check) {
            return redirect()->route('categories.index')->with('success', 'creating server!');
        } else {
            return back()->withErrors(['error' => 'server not created , check logs']);
        }
    }


    public function update($id, Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // Create a new Prompt model instance with the validated data

        $item = Category::find($id);
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->attributes = $request->input('attributes');
        $item->save();
        // Save the changes to the database

        return back()->with('success', 'creating server!');
    }

    public function updateAttributes(UpdateAttributeRequest $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
        // Convert the attribute to collection
        $collection_attributes = collect($category->attributes);
        // Update items attributes
        $collection_attributes->transform(function ($item) use ($request) {
            $item['is_active'] = false;
            if (in_array($item['name'], array_keys($request->is_active))) {
                $item['is_active'] = true;
            }
            return $item;
        });
        // Get the active attribute where the is_active equal true
        $active_attributes = $collection_attributes->where('is_active', true)->toArray();
        // Update category attribute in DB
        $category->update(['attributes' => $collection_attributes->toArray(), 'active_attributes' => $active_attributes]);
        return back()->with('success', 'Attributes updated successfully.');
    }

}
