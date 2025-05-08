<?php
require_once RUTA_INCLUDES . 'formularios.php';
require_once RUTA_INCLUDES . 'categoria.php';

class formularioNuevaCategoria extends formularios
{
    public function __construct()
    {
        parent::__construct('formNuevaCategoria', ['urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarCategorias']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre'], $this->errores, 'span', ['class' => 'error']);

        $html = <<<EOF
        $htmlErroresGlobales
        <form method="POST" action="controller.php?controller=admin&action=crearCategoria" class="formulario-form">
            <div>
                <label for="nombre">Nombre de la Categoría:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" required />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <button type="submit" class="btn">Crear Categoría</button>
            </div>
        </form>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');

        if (!$nombre) {
            $this->errores['nombre'] = 'El nombre de la categoría no puede estar vacío.';
        }

        if (count($this->errores) === 0) {
            $categoria = Categoria::crea($nombre);
            if ($categoria) {
                if ($_SESSION['rol'] === 'vendedor') {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=vendedor&action=mostrarVendedor';
                } else {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=admin&action=gestionarCategorias';
                }
            } else {
                $this->errores[] = 'Error al crear la categoría. Por favor, inténtalo de nuevo.';
            }
        }
    }
}