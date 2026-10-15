<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectGlobalFeedback
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Jika Controller lupa memberi pesan flash, berikan flash otomatis saat aksi POST/PUT/DELETE berhasil
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch') || $request->isMethod('delete')) {
            if ($response->isRedirection() && !session()->has('success') && !session()->has('error') && !session()->has('errors')) {
                $msg = match (strtoupper($request->method())) {
                    'DELETE' => 'Data berhasil dihapus.',
                    'PUT', 'PATCH' => 'Data berhasil diperbarui.',
                    default => $request->is('*login*') ? 'Selamat datang kembali!' : 'Data berhasil disimpan.'
                };
                session()->flash('success', $msg);
            }
        }

        // Menyuntikkan komponen global tepat sebelum tag </body> pada halaman HTML secara otomatis
        $contentType = $response->headers->get('Content-Type', '');
        if (str_contains($contentType, 'text/html') && !$request->ajax()) {
            $content = $response->getContent();
            if ($content && str_contains($content, '</body>')) {
                $injectedHtml = view('components.global-feedback')->render();
                $content = str_replace('</body>', $injectedHtml . '</body>', $content);
                $response->setContent($content);
            }
        }

        return $response;
    }
}