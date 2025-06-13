<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateSoundRequest;
use App\Models\Sound;
use Illuminate\Http\Request;

class SoundsController extends Controller
{
    public function edit($id)
    {
        $sound = Sound::findOrFail($id);
        return view('dashboard.sounds.edit', compact('sound'));
    }

    public function update(UpdateSoundRequest $request, $id)
    {
        $data = $request->validated();

        $sound = Sound::findOrFail($id);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('sounds/additional', 'public');
        }
        
        $sound->update($data);

        return redirect()->route('dashboard.languages.edit', ['language' => $sound->language_id])->with('success', 'تم تحديث الصوت بنجاح');
    }

    public function destroy($id)
    {
        Sound::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم حذف الصوت بنجاح');
    }
}
