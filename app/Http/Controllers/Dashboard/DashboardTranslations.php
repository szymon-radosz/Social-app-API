<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\Translation;
use Illuminate\Http\Request;

class DashboardTranslations extends Controller
{
    use ErrorLogTrait;

    public function getTranslations()
    {
        try {
            $translations = Translation::get();

            return response()->json(['status' => 'OK', 'result' => ['translations' => $translations]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-translations', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get translations']);
        }
    }

    public function updateTranslation(Request $request)
    {
        try {
            $id = $request->input('id');
            $name = $request->input('name');
            $en = $request->input('en');
            $de = $request->input('de');
            $fr = $request->input('fr');
            $es = $request->input('es');
            $zh = $request->input('zh');

            $translation = Translation::where('id', $id)
                ->update([
                    "name" => $name,
                    "en" => $en,
                    "de" => $de,
                    "fr" => $fr,
                    "es" => $es,
                    "zh" => $zh,
                ]);

            return response()->json(['status' => 'OK', 'result' => ['translation' => $translation]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/update-translation', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get translation']);
        }
    }

    public function addTranslation(Request $request)
    {
        try {
            $name = $request->input('name');

            $translation = new Translation();

            $translation->name = $name;

            $translation->save();

            return response()->json(['status' => 'OK', 'result' => ['translation' => $translation]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/add-translation', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot save translation']);
        }
    }

    public function removeTranslation(Request $request)
    {
        try {
            $id = $request->input('id');

            $translation = Translation::where('id', $id)
                ->delete();

            return response()->json(['status' => 'OK', 'result' => ['translation' => $translation]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/remove-translation', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot remove translation']);
        }
    }
}
