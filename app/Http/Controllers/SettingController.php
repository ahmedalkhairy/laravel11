<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    private $settingService;

    public function __construct(SettingService $settingService = null) // Inject the service if using
    {
        $this->settingService = $settingService; // Assign the service if using
    }

    public function index()
    {
        $settings = Setting::all()->groupBy('group');

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key.*' => 'required|string',
            'value.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [];
        foreach ($request->input('key') as $key => $value) {
            $data[] = [
                'key' => $value,
                'value' => $request->input('value')[$key],
                'group' => $request->input('group')[$key], // Add group data
            ];
        }

        // Update settings in database (use service if applicable)
        Setting::upsert($data, ['key', 'value']);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }
}
