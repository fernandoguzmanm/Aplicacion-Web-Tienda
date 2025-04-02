<?php
require_once RUTA_INCLUDES . 'formularios.php';

class formularioprecio extends formularios
{
    public function __construct() {
        parent::__construct('formPrecio', ['urlRedireccion' => RUTA_APP . 'buscar.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $min_precio = $datos['min_precio'] ?? '';
        $max_precio = $datos['max_precio'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['min_precio', 'max_precio'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
            <div>
                <label for="min_precio">Precio Mínimo:</label>
                <input type="number" id="min_precio" name="min_precio" step="0.01" value="$min_precio" placeholder="Mínimo">
                {$erroresCampos['min_precio']}
            </div>
            <div>
                <label for="max_precio">Precio Máximo:</label>
                <input type="number" id="max_precio" name="max_precio" step="0.01" value="$max_precio" placeholder="Máximo">
                {$erroresCampos['max_precio']}
            </div>
            <input type="hidden" name="controller" value="busqueda">
            <input type="hidden" name="action" value="mostrarBusqueda">
            <div>
                <button type="submit">Filtrar</button>
            </div>
        EOF;
        return $html;
    }
    
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $min_precio = trim($datos['min_precio'] ?? '');
        $max_precio = trim($datos['max_precio'] ?? '');
        $max_precio = ($max_precio === '') ? PHP_INT_MAX : (float) $max_precio;

        if ((!is_numeric($min_precio) || $min_precio < 0) && $min_precio !== '') {
            $this->errores['min_precio'] = 'El precio mínimo debe ser un número válido y no negativo.';
        }
        
        if ((!is_numeric($max_precio) || $max_precio < 0) && $max_precio !== '') {
            $this->errores['max_precio'] = 'El precio máximo debe ser un número válido y no negativo.';
        }
        
        if (($min_precio !== '' && $max_precio !== '' && $min_precio > $max_precio)) {
            $this->errores['min_precio'] = 'El precio mínimo no puede ser mayor que el máximo.';
        }

        if (count($this->errores) === 0) {
            $queryString = http_build_query([
                'controller' => 'busqueda',
                'action' => 'mostrarBusqueda',
                'min_precio' => $min_precio,
                'max_precio' => $max_precio
            ]);

            header("Location: " . RUTA_APP . "controller.php?$queryString");
            exit();
        }
    }
}