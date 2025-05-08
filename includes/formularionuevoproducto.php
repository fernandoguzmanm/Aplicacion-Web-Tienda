<?php
require_once __DIR__ . '/formularios.php';
require_once __DIR__ . '/producto.php';
require_once __DIR__ . '/categoria.php';

class formularionuevoproducto extends formularios
{
    public function __construct()
    {
        parent::__construct('formNuevoProducto', [
            'method' => 'POST',
            'action' => htmlspecialchars($_SERVER['REQUEST_URI']),
            'urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos'
        ]);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $precio = $datos['precio'] ?? '';
        $stock = $datos['stock'] ?? '';
        $id_categoria = $datos['id_categoria'] ?? '';

        // Si el usuario es un vendedor, asigna automáticamente su id_usuario
        $id_vendedor = ($_SESSION['rol'] === 'vendedor') ? $_SESSION['id_usuario'] : ($datos['id_vendedor'] ?? '');

        // Obtener todas las categorías desde la base de datos
        $categorias = Categoria::obtenerTodas();

        // Generar las opciones del select para categorías
        $opcionesCategorias = '<option value="" ' . ($id_categoria == '' ? 'selected' : '') . '>Selecciona una categoría</option>';
        foreach ($categorias as $categoria) {
            $selected = ($id_categoria == $categoria->getIdCategoria()) ? 'selected' : '';
            $opcionesCategorias .= '<option value="' . htmlspecialchars($categoria->getIdCategoria()) . '" ' . $selected . '>' . ucfirst(htmlspecialchars($categoria->getNombre())) . '</option>';
        }

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'descripcion', 'precio', 'stock', 'id_vendedor', 'id_categoria', 'imagen'], $this->errores, 'span', ['class' => 'error']);

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" required />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required>$descripcion</textarea>
                {$erroresCampos['descripcion']}
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input id="precio" type="number" step="0.01" name="precio" value="$precio" required />
                {$erroresCampos['precio']}
            </div>
            <div>
                <label for="stock">Stock:</label>
                <input id="stock" type="number" name="stock" value="$stock" required />
                {$erroresCampos['stock']}
            </div>
        EOF;

        // Solo muestra el campo de ID Vendedor si el usuario no es un vendedor
        if ($_SESSION['rol'] !== 'vendedor') {
            $html .= <<<EOF
            <div>
                <label for="id_vendedor">ID Vendedor:</label>
                <input id="id_vendedor" type="number" name="id_vendedor" value="$id_vendedor" required />
                {$erroresCampos['id_vendedor']}
            </div>
            EOF;
        }

        // Agregar el select dinámico para categorías
        $html .= <<<EOF
            <div>
                <label for="id_categoria">Categoría:</label>
                <select id="id_categoria" name="id_categoria" required>
                    $opcionesCategorias
                </select>
                {$erroresCampos['id_categoria']}
            </div>
            <div>
                <label for="imagen">Imagen:</label>
                <input id="imagen" type="file" name="imagen" />
                {$erroresCampos['imagen']}
            </div>
            <div>
                <button type="submit" name="añadir">Añadir Producto</button>
            </div>
        </fieldset>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $descripcion = trim($datos['descripcion'] ?? '');
        $precio = trim($datos['precio'] ?? '');
        $stock = trim($datos['stock'] ?? '');
        $id_categoria = trim($datos['id_categoria'] ?? '');

        // Asigna automáticamente el id_usuario del vendedor si el rol es vendedor
        $id_vendedor = ($_SESSION['rol'] === 'vendedor') ? $_SESSION['id_usuario'] : trim($datos['id_vendedor'] ?? '');

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

        $imagen = $datos['imagen'] ?? null;
        if (!empty($datos['imagen'])) {
            $rutaImagen = RUTA_IMGS . 'productos/' . basename($datos['imagen']);
            /*
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                $imagen = basename($_FILES['imagen']['name']);
            } else {
                $this->errores['imagen'] = 'Error al subir la imagen.';
            }*/
        }

        if (count($this->errores) === 0) {
            $productoModel = new Producto(Aplicacion::getInstance()->getConexionBd());
            $resultado = $productoModel->añadirProducto($nombre, $descripcion, $precio, $stock, $id_vendedor, $id_categoria, $imagen);

            if ($resultado) {
                if ($_SESSION['rol'] === 'vendedor') {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=vendedor&action=mostrarVendedor';
                } else {
                    $this->urlRedireccion = RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos';
                }
            } else {
                $this->errores[] = 'Error al añadir el producto. Por favor, inténtalo de nuevo.';
            }
        }
    }
}