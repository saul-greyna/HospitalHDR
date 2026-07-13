<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para validar el consentimiento de cookies
 * Verifica si la cookie de consentimiento está presente y es válida
 * 
 * Uso en web.php:
 * Route::get('/analytics-api', function() {
 *     return response()->json(['data' => '...']);
 * })->middleware('validate.cookie.consent:analytics');
 */
class ValidateCookieConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $requiredType  Tipo de cookie requerida (analytics, marketing, preferences)
     */
    public function handle(Request $request, Closure $next, $requiredType = 'essential'): Response
    {
        $consentCookie = $request->cookie('cookie_consent');

        // Intenta parsear la cookie de consentimiento
        $consent = $this->parseConsentCookie($consentCookie);

        // Valida si el usuario dio consentimiento para el tipo requerido
        if (!$this->hasConsent($consent, $requiredType)) {
            return response()->json([
                'error' => 'Consentimiento no otorgado',
                'message' => "Se requiere consentimiento para: {$requiredType}",
                'consentRequired' => $requiredType,
            ], 403);
        }

        // Inyecta la información de consentimiento en la request
        $request->attributes->set('consent', $consent);

        return $next($request);
    }

    /**
     * Parsea la cookie de consentimiento JSON
     *
     * @param  mixed  $cookieValue
     * @return array|null
     */
    protected function parseConsentCookie($cookieValue): ?array
    {
        if (!$cookieValue) {
            return null;
        }

        try {
            $decoded = urldecode($cookieValue);
            $parsed = json_decode($decoded, true);

            return isset($parsed['consent']) ? $parsed['consent'] : $parsed;
        } catch (\Exception $e) {
            \Log::warning('Error al parsear cookie de consentimiento', [
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Verifica si se otorgó consentimiento para un tipo específico
     *
     * @param  array|null  $consent
     * @param  string  $type
     * @return bool
     */
    protected function hasConsent(?array $consent, string $type): bool
    {
        if ($type === 'essential') {
            return true; // Las cookies esenciales siempre están permitidas
        }

        if ($consent === null) {
            return false; // Sin consentimiento guardado
        }

        return $consent[$type] ?? false;
    }
}
