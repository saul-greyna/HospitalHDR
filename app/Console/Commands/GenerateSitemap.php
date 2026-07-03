<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate
                            {--url= : URL base del sitio (ej: https://hospitalhdr.com). Si no se pasa, usa APP_URL del .env}';

    protected $description = 'Genera el sitemap.xml completo incluyendo rutas de Vue y slugs del directorio médico';

    private array $slugsDoctores = [
        'victor-hugo-godinez-valdez',
        'augusto-ramirez-solis',
        'jaime-alonso-velazquez-fuentes',
        'jose-luis-cruz-sanchez',
        'santiago-ignacio-godinez-hernandez',
        'guadalupe-alejandra-uvina-quintero',
        'luis-arturo-castaldi-bermudez',
        'laura-darynka',
        'juan-carlos-viveros',
        'jorge-arturo-gutierrez-vargas',
        'palmira-hernandez-aguirre',
        'jaime-ivan-bustamente-garcia',
        'carolina-dominguez-meza',
        'fatima-irangani-cedillo-azuela',
        'roberto-avila',
        'raul-hernandez-centeno',
        'ernesto-rodriguez-alvarado',
        'fernando-chico-carpizo',
        'francisco-cabrales-garcia',
        'gerardo-bautista-diaz',
        'ramon-rodriguez-padilla',
        'valente-romero-rodriguez',
        'aldo-ivan-galvan-linares',
        'alberto-antonio-gonzalez-bravo',
        'benjamin-sanchez-trocino',
        'jacinto-armando-diaz-acevedo',
        'jose-alejandro-quintana',
        'julio-torres-escamilla',
        'nereida-cortez-lopez',
        'paulina-montano-ascencio',
        'francisco-jose-castrejon-aivar',
        'francisco-vilches-duran',
        'francisco-javier-mendoza-espinoza',
        'francisco-javier-orta-montejano',
        'edna-hernandez-sanchez',
        'fatima-teresa-de-la-o-garcia',
        'israel-renteria-troncoso',
        'jesus-estrada-hernandez',
        'claudia-carolina-castellanos-cervantes',
        'juan-gonzalez',
        'israel-armida-granados',
        'javier-medrano',
        'alejandra-munoz-valdivia',
        'jairo-barba',
        'asael-palafoz-cazarez',
        'maria-fernanda-guerrero-monjaraz',
        'juan-angel-cibrian-delgado',
        'juan-carlos-garcia-lino',
        'patricia-maldonado-valadez',
    ];

    public function handle(): void
    {
        // Prioridad: --url > .env APP_URL > dominio de producción por defecto
        $baseUrl = rtrim(
            $this->option('url') ?? config('app.url') ?? 'https://hospitalhdr.com',
            '/'
        );

        // Advertir si se detecta que sigue siendo una URL local
        if (str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, 'localhost')) {
            $this->warn("⚠️  La URL base es local ({$baseUrl}).");
            $this->warn("   Para producción usa: php artisan sitemap:generate --url=https://hospitalhdr.com");

            if (!$this->confirm('¿Continuar de todas formas?', false)) {
                $this->info('Operación cancelada.');
                return;
            }
        }

        $hoy = now()->toAtomString();

        $rutasEstaticas = [
            ['loc' => $baseUrl . '/',                  'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/quienes-somos',     'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/servicios',         'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/directorio-medico', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ];

        $rutasDoctores = array_map(fn(string $slug) => [
            'loc'        => $baseUrl . '/directorio-medico/' . $slug,
            'priority'   => '0.6',
            'changefreq' => 'monthly',
        ], $this->slugsDoctores);

        $todasLasRutas = array_merge($rutasEstaticas, $rutasDoctores);

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($todasLasRutas as $ruta) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($ruta['loc']) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $hoy . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>' . $ruta['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $ruta['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>' . PHP_EOL;

        $destino = public_path('sitemap.xml');
        file_put_contents($destino, $xml);

        $total = count($todasLasRutas);
        $this->info("   Sitemap.xml generado en: {$destino}");
        $this->info("   Base URL : {$baseUrl}");
        $this->info("   Total URLs: {$total} (" . count($rutasEstaticas) . " estáticas + " . count($rutasDoctores) . " doctores)");
    }
}
