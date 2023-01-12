<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TiempoExtension extends AbstractExtension
{
    const CONFIGURACION = ['formato' => 'd/m/Y H:m:s'];
    public function getFilters(): array
    {
        return [
            new TwigFilter('tiempo', [$this, 'formatearTiempo']),
        ];
    }

    public function formatearTiempo($fecha, $configuracion = [])
    {
        $configuracion = array_merge(self::CONFIGURACION, $configuracion);
        $fechaActual = new \DateTime();

        $fechaFormateada = $fecha->format($configuracion['formato']);

        $diferencia = $fechaActual->getTimestamp() - $fecha->getTimestamp();

        if($diferencia < 60 ){
            $fechaFormateada = 'Creado ahora mismo';
        }elseif ($diferencia < 3600){
            $fechaFormateada = 'Creado recientemente';
        }elseif ($diferencia < 14400){
            $fechaFormateada = 'Creado hace unas horas';
        }else{
            $fechaFormateada = $fechaFormateada;
        }

        return $fechaFormateada;
    }
}
