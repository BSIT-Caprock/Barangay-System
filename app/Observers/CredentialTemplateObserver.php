<?php

namespace App\Observers;

use App\Models\CredentialTemplate;
use Illuminate\Support\Facades\Storage;

class CredentialTemplateObserver
{
    /**
     * Handle the CredentialTemplate "created" event.
     */
    public function created(CredentialTemplate $credentialTemplate): void
    {
        //
    }

    /**
     * Handle the CredentialTemplate "updated" event.
     */
    public function updated(CredentialTemplate $credentialTemplate): void
    {
        if ($credentialTemplate->isDirty('filepath')) {
            Storage::disk('local')->delete($credentialTemplate->getOriginal('filepath'));
        }
    }

    /**
     * Handle the CredentialTemplate "deleted" event.
     */
    public function deleted(CredentialTemplate $credentialTemplate): void
    {
        //
    }

    /**
     * Handle the CredentialTemplate "restored" event.
     */
    public function restored(CredentialTemplate $credentialTemplate): void
    {
        //
    }

    /**
     * Handle the CredentialTemplate "force deleted" event.
     */
    public function forceDeleted(CredentialTemplate $credentialTemplate): void
    {
        //
    }
}
