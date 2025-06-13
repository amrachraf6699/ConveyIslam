<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreLanguageRequest;
use App\Http\Requests\Dashboard\UpdateLanguageRequest;
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
    public function index(Request $request)
    {
        $query = Language::withCount('sounds');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('english_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('native_name', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('hasAudio')) {
            if ($request->hasAudio === 'yes') {
                $query->whereNotNull('sound_url')
                    ->where('sound_url', '!=', '');
            } elseif ($request->hasAudio === 'no') {
                $query->where(function ($q) {
                    $q->whereNull('sound_url')
                        ->orWhere('sound_url', '=', '');
                });
            }
        }

        $sortBy = $request->get('sortBy', 'name_asc');
        switch ($sortBy) {
            case 'name_asc':
                $query->orderBy('native_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('native_name', 'desc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'sounds_desc':
                $query->orderBy('sounds_count', 'desc');
                break;
            case 'sounds_asc':
                $query->orderBy('sounds_count', 'asc');
                break;
            default:
                $query->orderBy('native_name', 'asc');
        }

        $languages = $query->paginate(10)->appends($request->query());

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
        abort(404, 'Page not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::with('sounds')->findOrFail($id);
        return view('dashboard.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, string $id)
    {

        $data = $request->validated();
        $newSounds = $data['new_sounds'] ?? [];
        unset($data['new_sounds']);

        $language = Language::findOrFail($id);

        if ($request->hasFile('flag')) {
            $data['flag'] = $request->file('flag')->store('flags', 'public');
            if ($language->flag) {
                Storage::disk('public')->delete($language->flag);
            }
        }

        if ($request->hasFile('sound')) {
            $data['sound'] = $request->file('sound')->store('sounds/main', 'public');
            if ($language->sound) {
                Storage::disk('public')->delete($language->sound);
            }
        }

        $language->update($data);

        foreach ($newSounds as $sound) {
            Sound::create([
                'language_id' => $language->id,
                'name' => $sound['name'],
                'file' => $sound['file']->store('sounds/additional', 'public'),
            ]);
        }

        return redirect()->route('dashboard.languages.index')
            ->with('success', 'تم تحديث اللغة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);

        try {
            DB::beginTransaction();

            foreach ($language->sounds as $sound) {
                Storage::disk('public')->delete($sound->file);
                $sound->delete();
            }

            if ($language->sound) {
                Storage::disk('public')->delete($language->sound);
            }

            if ($language->flag) {
                Storage::disk('public')->delete($language->flag);
            }

            $language->delete();

            DB::commit();

            return redirect()->route('dashboard.languages.index')
                ->with('success', 'تم حذف اللغة بنجاح');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'حدث خطأ أثناء حذف اللغة. برجاء التواصل مع المطور']);
        }
    }
}
