<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InjectGlobalFeedback
{
    private const MARKER = '<!-- global-feedback-injected -->';

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1) Flash otomatis untuk aksi POST/PUT/PATCH/DELETE yang berhasil
        if (in_array(strtoupper($request->method()), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            if ($response->isRedirection()
                && !session()->has('success')
                && !session()->has('error')
                && !session()->has('errors')) {
                $msg = match (strtoupper($request->method())) {
                    'DELETE' => 'Data berhasil dihapus.',
                    'PUT', 'PATCH' => 'Data berhasil diperbarui.',
                    default => $request->is('*login*') ? 'Selamat datang kembali!' : 'Data berhasil disimpan.',
                };
                session()->flash('success', $msg);
            }
        }

        // 2) Suntik komponen global hanya untuk halaman HTML penuh
        if ($response instanceof BinaryFileResponse || $response instanceof StreamedResponse) {
            return $response;
        }
        if ($response->isRedirection() || $request->ajax() || $request->expectsJson()) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type', '');
        if (!str_contains($contentType, 'text/html')) {
            return $response;
        }

        $content = $response->getContent();
        if (!is_string($content) || $content === '') {
            return $response;
        }

        // Jangan suntik dua kali (mis. kalau layout sudah memuatnya)
        if (str_contains($content, self::MARKER)) {
            return $response;
        }

        // Ganti HANYA </body> yang paling akhir (bukan semua kemunculan)
        $pos = strripos($content, '</body>');
        if ($pos === false) {
            return $response;
        }

        $injected = self::MARKER . view('components.global-feedback')->render();
        $response->setContent(substr_replace($content, $injected, $pos, 0));

        return $response;
    }
}