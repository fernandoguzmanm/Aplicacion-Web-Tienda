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

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['query', 'categorias'], $this->errores, 'span', array('class' => 'error'));

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

        if (count($this->errores) === 0) {
            $params = [];
            if (!empty($query)) {
                $params[] = "query=" . urlencode($query);
            }
            if (!empty($categoria)) {
                $params[] = "categorias=" . urlencode($categoria);
            }
            
            $queryString = implode("&", $params);
            header("Location: " . RUTA_APP . "controller.php?controller=busqueda&action=mostrarBusqueda&$queryString");
            exit();
        }
    }
}