<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Hypefactors\Laravel\Follow\Traits\CanFollow;
use Hypefactors\Laravel\Follow\Contracts\CanFollowContract;
use Hypefactors\Laravel\Follow\Traits\CanBeFollowed;
use Hypefactors\Laravel\Follow\Contracts\CanBeFollowedContract;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable implements MustVerifyEmail,CanBeFollowedContract,CanFollowContract
{
    use HasApiTokens;
    use HasFactory;
    use HasTeams;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanFollow;
    use CanBeFollowed;
    use Liker;

    static $rules = [
        'location' => 'max:16',
        'about_me' => 'max:4096',
        'profile_photo_path' => 'file|mimes:jpg,jpeg,png|max:4096',
        'banner_photo_path' => 'file|mimes:jpg,jpeg,png|max:4096',
        'email' => 'max:320',
        'password' => 'max:64',
        'name' => 'max:16'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function updateProfilePhoto(UploadedFile $photo, $storagePath = 'profile-photos')
    {
        tap($this->profile_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'profile_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->profilePhotoDisk()]
                ),
            ])->save();

            if ($previous && !str_contains($previous,"BitCritic-Profile-Picture-Default-View-Game-Review-Community.png")) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {

        if (is_null($this->profile_photo_path)) {
            return;
        }

        if (str_contains($this->profile_photo_path,"Profile-Picture-Default")) {
            return;
        } else {
            Storage::disk($this->profilePhotoDisk())->delete($this->profile_photo_path);

            $this->forceFill([
                'profile_photo_path' => 'img/BitCritic-Profile-Picture-Default-View-Game-Review-Community.png',
            ])->save();
        }
        
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->profile_photo_path
                    ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
                    : $this->defaultProfilePhotoUrl();
        });
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        // $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
        //     return mb_substr($segment, 0, 1);
        // })->join(' '));

        // return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        return url('img/BitCritic-Profile-Picture-Default-View-Game-Review-Community.png');
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }

    public function updateBannerPhoto(UploadedFile $photo, $storagePath = 'banner-photos')
    {
        tap($this->banner_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'banner_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->bannerPhotoDisk()]
                ),
            ])->save();

            if ($previous && !str_contains($previous, "BitCritic-Banner-Default-View-Game-Review-Community.png")) {
                Storage::disk($this->bannerPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteBannerPhoto()
    {

        if (is_null($this->banner_photo_path)) {
            return;
        }

        if (str_contains($this->banner_photo_path,"img/BitCritic-Banner-Default-View-Game-Review-Community.png")) {
            return;
        } else {
            Storage::disk($this->bannerPhotoDisk())->delete($this->banner_photo_path);

            $this->forceFill([
                'banner_photo_path' => 'img/BitCritic-Banner-Default-View-Game-Review-Community.png',
            ])->save();
        }
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function bannerPhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->banner_photo_path
                    ? Storage::disk($this->bannerPhotoDisk())->url($this->banner_photo_path)
                    : $this->defaultBannerPhotoUrl();
        });
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultBannerPhotoUrl()
    {
        // $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
        //     return mb_substr($segment, 0, 1);
        // })->join(' '));

        // return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        return 'img/BitCritic-Banner-Default-View-Game-Review-Community.png';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function bannerPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }
}
