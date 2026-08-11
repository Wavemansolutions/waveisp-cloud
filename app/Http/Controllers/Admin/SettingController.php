<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        SiteSettings::ensureDefaults();

        $defaults = SiteSettings::defaults();

        $groups = collect($defaults)
            ->mapToGroups(fn ($item, $key) => [$item['group'] => [
                'key' => $key,
                'type' => $item['type'],
                'value' => SiteSetting::where('setting_key', $key)->value('setting_value') ?? $item['value'],
            ]])
            ->toArray();

        return view('admin.settings.index', compact('groups', 'defaults'));
    }

    public function update(Request $request)
    {
        SiteSettings::ensureDefaults();

        $defaults = SiteSettings::defaults();

        foreach ($defaults as $key => $meta) {
            $value = $request->input($key);

            if ($meta['type'] === 'color' && blank($value)) {
                $value = $meta['value'];
            }

            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                [
                    'setting_group' => $meta['group'],
                    'setting_value' => $value,
                    'input_type' => $meta['type'],
                    'is_public' => true,
                ]
            );
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings and branding updated successfully.');
    }
}