<?php

namespace App\Models;

use Database\Factories\ClinicSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicSetting extends Model
{
    /** @use HasFactory<ClinicSettingFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'clinic_name',
        'address',
        'phone',
        'secondary_phone',
        'email',
        'opening_hours',
        'whatsapp_number',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], static::defaults());
    }

    /**
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            'clinic_name' => 'MediDENT Multicare Clinic',
            'address' => 'SC - 296, Hapur Rd, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002',
            'phone' => '+91 88000 23032',
            'secondary_phone' => '0120-4169996',
            'email' => 'hello@medidentclinic.com',
            'opening_hours' => 'Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM',
            'whatsapp_number' => '+91 88000 23032',
            'facebook_url' => 'https://www.facebook.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'linkedin_url' => 'https://www.linkedin.com/',
        ];
    }

    public function phoneHref(): ?string
    {
        return $this->telHref($this->phone);
    }

    public function secondaryPhoneHref(): ?string
    {
        return $this->telHref($this->secondary_phone);
    }

    public function whatsappUrl(): ?string
    {
        $number = preg_replace('/\D+/', '', (string) $this->whatsapp_number);

        return $number !== '' ? "https://wa.me/{$number}" : null;
    }

    /**
     * @return list<string>
     */
    public function openingHoursLines(): array
    {
        return array_values(array_filter(array_map(
            'trim',
            explode('|', (string) $this->opening_hours),
        )));
    }

    private function telHref(?string $number): ?string
    {
        $clean = preg_replace('/[^\d+]/', '', (string) $number);

        return $clean !== '' ? "tel:{$clean}" : null;
    }
}
