<?php

namespace App\Http\Controllers;

use App\Enum\PromptsStatusEnum;
use App\Jobs\GeneratePRomptViaChatGptJob;
use App\Models\Category;
use App\Models\Prompt;
use Illuminate\Http\Request;

class PromptsController extends Controller
{

    public function index(Request $request)
    {
        // Prompts Status Cases
        $statuses = PromptsStatusEnum::cases();
        // Return data of the prompt
        $data = Prompt::query()->with('category')
            ->when(!empty($request['search']), function ($query) use ($request) {
                $query->where('key', 'LIKE', "%{$request['search']}%");
            })
            ->when(!empty($request['status']), function ($query) use ($request) {
                $query->where('is_active', PromptsStatusEnum::tryFrom($request['status'])?->toInt());
            })
            ->get();
        return view('prompts.index', ['items' => $data, 'statuses' => $statuses]);
    }

    public function edit($id)
    {
        $item = Prompt::find($id);
        $categories = Category::get();
        return view('prompts.edit', ['item' => $item, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('prompts.create', ['categories' => $categories]);
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
            'is_active' => 'boolean',
            'category_id' => 'required',
        ]);

        // Find the model by its ID
        $prompt = Prompt::findOrFail($id);

        if ($request->input('is_active') == 1) {
            $others = $prompt->category->prompts;

            foreach ($others as $item) {
                $item->is_active = false;
                $item->save();
            }
        }

        // Update the model's attributes
        $prompt->key = $request->input('key');
        $prompt->value = $request->input('value');
        $prompt->category_id = $request->input('category_id');
        $prompt->is_active = $request->input('is_active', false); // Default to false if not provided
        // Save the changes to the database
        $prompt->save();


        // Redirect back with a success message
        return redirect()->back()->with('success', 'Prompt updated successfully!');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // Create a new Prompt model instance with the validated data

        $prompt = new Prompt();
        $prompt->key = $request->input('key');
        $prompt->value = $request->input('value');
        $prompt->category_id = $request->input('category_id');
        $prompt->is_active = $request->input('is_active', false); // Default to false if not provided
        // Save the new model instance to the database
        $prompt->save();

        // Redirect to a desired location (e.g., a list of prompts) with a success message
        return redirect()->route('prompts')->with('success', 'Prompt created successfully!');
    }


    public function delete_prompt($id)
    {
        $prompt = Prompt::find($id);
        try {
            $prompt->delete();
            return back()->with(['success' => 'instance deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'error happened , please try later']);
        }

    }


    public function generate(Request $request)
    {
        $category = Category::find($request->category_id);
        $response= GeneratePRomptViaChatGptJob::dispatchSync($category);

        return response()->json($response);
    }

    public function delete_all()
    {
        try {
            Prompt::where('id', '<>', 0)->delete();
            return back()->with(['success' => 'instance deleted successfully']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'error happened , please try again']);
        }
    }

}
