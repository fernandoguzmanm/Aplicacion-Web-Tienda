<?php
// filepath: c:\xampp\htdocs\AW\includes\formulariomodificarproducto.php
require_once RUTA_INCLUDES . 'formularios.php';
require_once './includes/config.php';

class formulariomodificarproducto extends formularios
{
    private $producto;

    public function __construct($producto) {
        parent::__construct('formModificarProducto', ['urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos']);
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
                <label for="id_categoria">ID Categoría:</label>
                <input type="number" id="id_categoria" name="id_categoria" value="$id_categoria" required>
                {$erroresCampos['id_categoria']}
            </div>
            <div>
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen">
                <input type="hidden" name="imagen_actual" value="$imagen">
                {$erroresCampos['imagen']}
            </div>
            <div>
                <label for="imagen_url">URL de la imagen:</label>
                <input type="url" id="imagen_url" name="imagen_url" placeholder="Introduce la URL de la imagen">
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
        $imagen = $datos['imagen'] ?? $datos['imagen_actual'];
        
        // Validaciones
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

        if (count($this->errores) === 0) {
            if (!empty($_POST['imagen_url'])) {
                $urlImagen = $_POST['imagen_url'];
                $nombreArchivo = basename(parse_url($urlImagen, PHP_URL_PATH)); // Obtiene el nombre del archivo
                $rutaDestino = RUTA_IMGS . 'productos/' . $nombreArchivo;

                // Descarga la imagen y guárdala en la carpeta
                if (copy($urlImagen, $rutaDestino)) {
                    $imagen = $nombreArchivo; // Usa la imagen descargada
                } else {
                    $this->errores['imagen'] = 'No se pudo descargar la imagen desde la URL proporcionada.';
                }
            } elseif (!empty($datos['imagen'])) {
                // Procesa la imagen subida desde el ordenador
                $rutaImagen = RUTA_IMGS . 'productos/' . basename($datos['imagen']);
                /*
                if (move_uploaded_file($datos['imagen']['tmp_name'], $rutaImagen)) {
                    $imagen = basename($datos['imagen']);
                } else {
                    $this->errores['imagen'] = 'Error al subir la imagen.';
                }*/
            } else {
                $imagen = $datos['imagen_actual']; // Usa la imagen actual si no se proporciona una nueva
            }

            $productoModel = new Producto(Aplicacion::getInstance()->getConexionBd());
            $resultado = $productoModel->modificarProducto($id_producto, $nombre, $descripcion, $precio, $stock, $id_vendedor, $id_categoria, $imagen);

            if ($resultado) {
                $this->urlRedireccion = RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos';
            } else {
                $this->errores[] = 'Error al actualizar el producto. Por favor, inténtalo de nuevo.';
            }
        }
    }
}