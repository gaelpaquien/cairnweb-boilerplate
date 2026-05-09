<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Statamic\Facades\GlobalSet;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data = $request->safe()->except(['website', 'form_loaded_at']);

        $recipient = GlobalSet::findByHandle('site')?->inCurrentSite()?->get('email')
            ?? config('mail.from.address');

        try {
            Mail::to($recipient)->send(new ContactMessage($data));
        } catch (\Throwable $e) {
            Log::error('Contact form mail failed', [
                'exception' => $e->getMessage(),
            ]);

            if ($request->expectsJson()) {
                $errorMessage = GlobalSet::findByHandle('contact')?->inCurrentSite()?->get('error_message');

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                ], 503);
            }

            return redirect('/#contact')
                ->with('contact_error', true);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true], 200);
        }

        return redirect('/#contact')
            ->with('contact_success', true);
    }
}
