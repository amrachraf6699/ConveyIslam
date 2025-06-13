<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreLanguageRequest;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Sound;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::withCount('sounds')->paginate(10);
        return view('dashboard.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        if (count($request->sound_names) !== count($request->file('sound_files'))) {
            return back()->withErrors(['sound_files' => 'عدد أسماء الأصوات يجب أن يتطابق مع عدد ملفات الأصوات'])
                      ->withInput();
        }

        $existingLanguage = Language::where('english_name', $request->english_name)
                                  ->orWhere('native_name', $request->native_name)
                                  ->first();
        
        if ($existingLanguage) {
            return back()->withErrors(['english_name' => 'هذه اللغة موجودة مسبقاً'])
                      ->withInput();
        }

        try {
            DB::beginTransaction();

            $flagPath = $request->file('flag')->store('flags', 'public');

            $mainSoundPath = $request->file('sound')->store('sounds/main', 'public');

            $language = Language::create([
                'user_id' => auth()->id(),
                'english_name' => $request->english_name,
                'native_name' => $request->native_name,
                'flag' => $flagPath,
                'sound' => $mainSoundPath,
            ]);

            $soundFiles = $request->file('sound_files');
            $soundNames = $request->sound_names;

            foreach ($soundFiles as $index => $soundFile) {
                $soundPath = $soundFile->store('sounds/additional', 'public');
                
                Sound::create([
                    'language_id' => $language->id,
                    'name' => $soundNames[$index],
                    'file' => $soundPath,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.languages.index')
                           ->with('success', 'تم إضافة اللغة بنجاح');

        } catch (Exception $e) {
            DB::rollBack();

            if (isset($flagPath)) {
                Storage::disk('public')->delete($flagPath);
            }
            if (isset($mainSoundPath)) {
                Storage::disk('public')->delete($mainSoundPath);
            }
            if (isset($soundPath)) {
                Storage::disk('public')->delete($soundPath);
            }

            return back()->withErrors(['error' => 'حدث خطأ أثناء إضافة اللغة. برجاء التواصل مع المطور'])
                      ->withInput();
        }
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
        //
    }
}
