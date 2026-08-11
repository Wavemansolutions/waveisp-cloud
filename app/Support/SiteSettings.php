<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;

class SiteSettings
{
    public static function defaults(): array
    {
        return [
            'brand_name' => ['group' => 'branding', 'type' => 'text', 'value' => 'WaveISP'],
            'brand_tagline' => ['group' => 'branding', 'type' => 'text', 'value' => 'Cloud HotSpot Billing'],
            'primary_color' => ['group' => 'branding', 'type' => 'color', 'value' => '#0b63f6'],
            'accent_color' => ['group' => 'branding', 'type' => 'color', 'value' => '#ffd04f'],
            'dark_color' => ['group' => 'branding', 'type' => 'color', 'value' => '#061b51'],
            'logo_text' => ['group' => 'branding', 'type' => 'text', 'value' => 'W'],
            'favicon_url' => ['group' => 'branding', 'type' => 'text', 'value' => '/favicon.svg'],

            'support_phone' => ['group' => 'contact', 'type' => 'text', 'value' => '+234 813 696 3037'],
            'support_whatsapp' => ['group' => 'contact', 'type' => 'text', 'value' => '2348136963037'],
            'business_location' => ['group' => 'contact', 'type' => 'text', 'value' => 'Port Harcourt, Rivers State'],
            'footer_text' => ['group' => 'contact', 'type' => 'textarea', 'value' => 'Cloud HotSpot billing for MikroTik routers. Built for Wi-Fi businesses, estates, schools, lounges, homes and local internet providers.'],

            'home_badge' => ['group' => 'home_page', 'type' => 'text', 'value' => 'Oracle-style Cloud Billing + MikroTik Agent'],
            'home_title' => ['group' => 'home_page', 'type' => 'text', 'value' => 'WaveISP Cloud MikroTik HotSpot Billing'],
            'home_subtitle' => ['group' => 'home_page', 'type' => 'textarea', 'value' => 'A cloud billing system designed for MikroTik HotSpot. Customers connect to Wi-Fi, choose a plan, pay online, and get internet access.'],

            'plans_title' => ['group' => 'plans_page', 'type' => 'text', 'value' => 'Choose the Perfect Plan for You'],
            'plans_subtitle' => ['group' => 'plans_page', 'type' => 'textarea', 'value' => 'Select a data package, pay securely, and get connected instantly.'],

            'support_title' => ['group' => 'support_page', 'type' => 'text', 'value' => 'Need Support?'],
            'support_subtitle' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Get help with payment, connection, expired plan, or data exhaustion.'],
            'support_whatsapp_title' => ['group' => 'support_page', 'type' => 'text', 'value' => 'WhatsApp Support'],
            'support_whatsapp_text' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Chat with WaveISP support for quick help with payment, login, connection, or plan activation.'],
            'support_call_title' => ['group' => 'support_page', 'type' => 'text', 'value' => 'Call Support'],
            'support_call_text' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Speak directly with support if your payment succeeded but internet access did not activate.'],
            'support_connection_title' => ['group' => 'support_page', 'type' => 'text', 'value' => 'Connection Help'],
            'support_connection_text' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Restart Wi-Fi, reconnect to the hotspot, then open neverssl.com if the captive portal does not appear.'],

            'faq_1_question' => ['group' => 'support_page', 'type' => 'text', 'value' => 'My payment was successful but I am not connected.'],
            'faq_1_answer' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Please contact support with your phone number and payment reference.'],
            'faq_2_question' => ['group' => 'support_page', 'type' => 'text', 'value' => 'Can I reconnect after restarting my phone?'],
            'faq_2_answer' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Yes. If your data is still valid and not exhausted, reconnect to the Wi-Fi and the system should reconnect you.'],
            'faq_3_question' => ['group' => 'support_page', 'type' => 'text', 'value' => 'What happens when my data finishes?'],
            'faq_3_answer' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'You will be redirected to buy another data package.'],
            'faq_4_question' => ['group' => 'support_page', 'type' => 'text', 'value' => 'Can I get free trial access?'],
            'faq_4_answer' => ['group' => 'support_page', 'type' => 'textarea', 'value' => 'Yes. The system is designed to support a free 50MB trial before payment.'],
        ];
    }

    public static function ensureDefaults(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        foreach (self::defaults() as $key => $item) {
            SiteSetting::firstOrCreate(
                ['setting_key' => $key],
                [
                    'setting_group' => $item['group'],
                    'setting_value' => $item['value'],
                    'input_type' => $item['type'],
                    'is_public' => true,
                ]
            );
        }
    }

    public static function all(): array
    {
        $settings = [];

        foreach (self::defaults() as $key => $item) {
            $settings[$key] = $item['value'];
        }

        if (! Schema::hasTable('site_settings')) {
            return $settings;
        }

        $rows = SiteSetting::where('is_public', true)->get();

        foreach ($rows as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }

        return $settings;
    }
}