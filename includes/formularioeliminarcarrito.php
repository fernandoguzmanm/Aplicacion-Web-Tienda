<?php
require_once RUTA_INCLUDES . 'formularios.php';

class formularioeliminarcarrito extends formularios
{
    private $id_producto;

    public function __construct($id_producto) {
        parent::__construct('formEliminarCarrito_' . $id_producto, ['urlRedireccion' => RUTA_APP . 'carrito.php']);
        $this->id_producto = $id_producto;
    }

    protected function generaCamposFormulario(&$datos)
    {
        $id_producto = $this->id_producto;
        $numero_unidades = $datos['numero_unidades'] ?? '';
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['numero_unidades'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <form action="controller.php" method="GET">
            <input type="hidden" name="id" value="$id_producto">
            <input type="number" id="numero_unidades_$id_producto" name="numero_unidades" step="1" min="1" value="$numero_unidades" placeholder="Número">
            {$erroresCampos['numero_unidades']}
            <input type="hidden" name="controller" value="carrito">
            <input type="hidden" name="action" value="eliminarProducto">
            <button type="submit" class="btn">Eliminar</button>
        </form>
        EOF;
        
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        
        $id_producto = trim($datos['id'] ?? '');
        $numero_unidades = trim($datos['numero_unidades'] ?? '');

        if (empty($id_producto) || !ctype_digit($id_producto)) {
            $this->errores['id'] = 'ID de producto no válido.';
        }

        if (empty($numero_unidades) || !ctype_digit($numero_unidades) || (int)$numero_unidades < 1) {
            $this->errores['numero_unidades'] = 'Debe ingresar un número válido de unidades (mínimo 1).';
        }
        
        if (count($this->errores) === 0) {
            $queryString = http_build_query([
                'controller' => 'carrito',
                'action' => 'eliminarProducto',
                'id' => $id_producto,
                'numero_unidades' => $numero_unidades
            ]);

            header("Location: " . RUTA_APP . "controller.php?$queryString");
            exit();
        }
    }
}