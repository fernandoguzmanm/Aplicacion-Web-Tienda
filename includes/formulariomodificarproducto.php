<?php
require_once RUTA_INCLUDES . 'formularios.php';
require_once './includes/config.php';
require_once __DIR__ . '/categoria.php';

class formulariomodificarproducto extends formularios
{
    private $producto;

    public function __construct($producto) {
        parent::__construct('formModificarProducto', [
            'urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos',
            'method' => 'POST',
            'enctype' => 'multipart/form-data'
        ]);
        $this->producto = $producto;
    }

    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? $this->producto['nombre'];
        $descripcion = $datos['descripcion'] ?? $this->producto['descripcion'];
        $precio = $datos['precio'] ?? $this->producto['precio'];
        $stock = $datos['stock'] ?? $this->producto['stock'];
        $id_vendedor = $datos['id_vendedor'] ?? $this->producto['id_vendedor'];
        $id_categoria = $datos['id_categoria'] ?? $this->producto['id_categoria'];
        $imagen = $this->producto['imagen'];

        $categorias = Categoria::obtenerTodas();

        $opcionesCategorias = '<option value="" ' . ($id_categoria == '' ? 'selected' : '') . '>Selecciona una categoría</option>';
        foreach ($categorias as $categoria) {
            $selected = ($id_categoria == $categoria->getIdCategoria()) ? 'selected' : '';
            $opcionesCategorias .= '<option value="' . htmlspecialchars($categoria->getIdCategoria()) . '" ' . $selected . '>' . ucfirst(htmlspecialchars($categoria->getNombre())) . '</option>';
        }

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'descripcion', 'precio', 'stock', 'id_vendedor', 'id_categoria', 'imagen'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <form method="POST" action="controller.php?controller=admin&action=actualizarProducto" enctype="multipart/form-data" class="formulario-form">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="$nombre" required>
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required>$descripcion</textarea>
                {$erroresCampos['descripcion']}
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="$precio" required>
                {$erroresCampos['precio']}
            </div>
            <div>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" step="1" value="$stock" required>
                {$erroresCampos['stock']}
            </div>
            <div>
                <label for="id_vendedor">ID Vendedor:</label>
                <input type="number" id="id_vendedor" name="id_vendedor" value="$id_vendedor" required>
                {$erroresCampos['id_vendedor']}
            </div>
            <div>
                <label for="id_categoria">Categoría:</label>
                <select id="id_categoria" name="id_categoria" required>
                    $opcionesCategorias
                </select>
                {$erroresCampos['id_categoria']}
            </div>
            <div>
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen">
                <p>Imagen actual: $imagen</p>
                {$erroresCampos['imagen']}
            </div>
            <input type="hidden" name="id_producto" value="{$this->producto['id_producto']}">
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $id_producto = $this->producto['id_producto'];
        $nombre = trim($datos['nombre'] ?? '');
        $descripcion = trim($datos['descripcion'] ?? '');
        $precio = trim($datos['precio'] ?? '');
        $stock = trim($datos['stock'] ?? '');
        $id_vendedor = trim($datos['id_vendedor'] ?? '');
        $id_categoria = trim($datos['id_categoria'] ?? '');
        $imagen = $this->producto['imagen'];

        if (!$nombre) {
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        }

        if (!$descripcion) {
            $this->errores['descripcion'] = 'La descripción no puede estar vacía.';
        }

        if (!$precio || $precio <= 0) {
            $this->errores['precio'] = 'El precio debe ser mayor a 0.';
        }

        if (!$stock || $stock < 0) {
            $this->errores['stock'] = 'El stock no puede ser negativo.';
        }

        if (!$id_vendedor) {
            $this->errores['id_vendedor'] = 'El ID del vendedor no puede estar vacío.';
        }

        if (!$id_categoria) {
            $this->errores['id_categoria'] = 'El ID de la categoría no puede estar vacío.';
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['imagen']['name']);
            $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($tipoArchivo, $tiposPermitidos)) {
                $rutaImagen = RUTA_IMGS . 'productos/' . $nombreArchivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                    $imagen = $nombreArchivo;
                } else {
                    $this->errores['imagen'] = 'Error al mover el archivo subido.';
                }
            } else {
                $this->errores['imagen'] = 'Tipo de imagen no permitido.';
            }
        }

        if (count($this->errores) === 0) {
            $productoModel = new Producto(Aplicacion::getInstance()->getConexionBd());
            $resultado = $productoModel->modificarProducto($id_producto, $nombre, $descripcion, $precio, $stock, $id_vendedor, $id_categoria, $imagen);

            if ($resultado) {
                if ($_SESSION['rol'] === 'administrador') {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos';
                } elseif ($_SESSION['rol'] === 'vendedor') {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=vendedor&action=mostrarVendedor';
                }
            } else {
                $this->errores[] = 'Error al actualizar el producto. Por favor, inténtalo de nuevo.';
            }
        }
    }
}