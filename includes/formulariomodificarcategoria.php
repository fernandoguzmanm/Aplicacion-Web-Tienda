<?php
require_once RUTA_INCLUDES . 'formularios.php';
require_once RUTA_INCLUDES . 'categoria.php';

class formulariomodificarcategoria extends formularios
{
    private $categoria;

    public function __construct($categoria)
    {
        parent::__construct('formModificarCategoria', ['urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarCategorias']);
        $this->categoria = $categoria;
    }

    protected function generaCamposFormulario(&$datos)
    {
        $id_categoria = $this->categoria->getIdCategoria();
        $nombre = $datos['nombre'] ?? $this->categoria->getNombre();

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre'], $this->errores, 'span', ['class' => 'error']);

        $html = <<<EOF
        $htmlErroresGlobales
        <form method="POST" action="controller.php?controller=admin&action=modificarCategoria" class="formulario-form">
            <div>
                <label for="id_categoria">ID de la Categoría:</label>
                <input id="id_categoria" type="text" value="$id_categoria" disabled>
            </div>
            <input type="hidden" name="id_categoria" value="$id_categoria">
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" required>
                {$erroresCampos['nombre']}
            </div>
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $id_categoria = $this->categoria->getIdCategoria();
        $nombre = trim($datos['nombre'] ?? $this->categoria->getNombre());

        if (!$nombre) {
            $this->errores['nombre'] = 'El nombre de la categoría no puede estar vacío.';
        }

        if (count($this->errores) === 0) {
            $resultado = Categoria::modificarCategoria($id_categoria, $nombre);
            if ($resultado) {
                $this->urlRedireccion = RUTA_APP . 'controller.php?controller=admin&action=gestionarCategorias';
            } else {
                $this->errores[] = 'Error al modificar la categoría. Por favor, inténtalo de nuevo.';
            }
        }
    }
}