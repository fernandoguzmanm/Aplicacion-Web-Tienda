<?php
require_once RUTA_INCLUDES . 'formularios.php';

class formulariobuscar extends formularios
{
    public function __construct() {
        parent::__construct('formBuscar', ['urlRedireccion' => RUTA_APP . 'buscar.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $query = $datos['query'] ?? '';
        $categoria = $datos['categorias'] ?? '';

        $min_precio = $datos['min_precio'] ?? '';
        $max_precio = $datos['max_precio'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['query', 'categorias','min_precio', 'max_precio'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <form action="controller.php" method="GET" class="busqueda-form">
            <input type="text" name="query" placeholder="Buscar productos" value="$query">
            {$erroresCampos['query']}
            <select name="categorias">
                <option value="" " . ($categoria == '' ? 'selected' : '') . ">Todas las categorías</option>
                <option value="cereales" " . ($categoria == 'cereales' ? 'selected' : '') . ">Cereales</option>
                <option value="fruta" " . ($categoria == 'fruta' ? 'selected' : '') . ">Fruta</option>
                <option value="lacteo" " . ($categoria == 'lacteo' ? 'selected' : '') . ">Lácteos</option>
                <option value="dulce" " . ($categoria == 'dulce' ? 'selected' : '') . ">Dulces</option>
                <option value="refresco" " . ($categoria == 'refresco' ? 'selected' : '') . ">Refrescos</option>
            </select>
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
            {$erroresCampos['categorias']}
            <input type="hidden" name="controller" value="busqueda">
            <input type="hidden" name="action" value="mostrarBusqueda">
            <button type="submit">Buscar</button>
        </form>
        EOF;
        
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $query = trim($datos['query'] ?? '');
        $categoria = trim($datos['categorias'] ?? '');

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
            $params = [];
            if (!empty($query)) {
                $params[] = "query=" . urlencode($query);
            }
            if (!empty($categoria)) {
                $params[] = "categorias=" . urlencode($categoria);
            }
            if (!empty($min_precio)) {
                $params[] = "min_precio=" . urlencode($min_precio);
            }
        
            if (!empty($max_precio)) {
                $params[] = "max_precio=" . urlencode($max_precio);
            }
                    
            $queryString = implode("&", $params);
            header("Location: " . RUTA_APP . "controller.php?controller=busqueda&action=mostrarBusqueda&$queryString");
            exit();
        }
    }
}