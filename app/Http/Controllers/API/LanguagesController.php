<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\LanguagesResource;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends APIBaseController
{
    public function index()
    {
        try {
            $languages = Language::withCount('sounds')
                ->paginate(10);

            return $this->success(200, 'Languages retrieved successfully', LanguagesResource::collection($languages));
        } catch (\Exception $e) {
            return $this->error(500, 'An error occurred while retrieving languages', $e->getMessage());
        }
    }

    public function show($language)
    {
        try {
            $language = Language::findOrFail($language);
            $language->loadCount('sounds');
            $language->load('sounds');

            return $this->success(200, 'Language retrieved successfully', new LanguagesResource($language));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error(404, 'Language not found');
        } catch (\Exception $e) {
            return $this->error(500, 'An error occurred while retrieving the language', $e->getMessage());
        }
    }
}
