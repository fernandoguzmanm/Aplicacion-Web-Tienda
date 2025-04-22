<?php
require_once RUTA_INCLUDES . 'formularios.php';

class formulariocheckout extends formularios
{
    public function __construct() {
        parent::__construct('formCheckout', ['urlRedireccion' => RUTA_APP . 'confirmacion.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? '';
        $correo = $datos['correo'] ?? '';
        $direccion = $datos['direccion'] ?? '';
        $numeroTarjeta = $datos['numero_tarjeta'] ?? '';
        $fechaVencimiento = $datos['fecha_vencimiento'] ?? '';
        $cvv = $datos['cvv'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'correo', 'direccion', 'numero_tarjeta', 'fecha_vencimiento', 'cvv'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
                <label for="nombre">Nombre Completo:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="correo">Correo Electrónico:</label>
                <input id="correo" type="email" name="correo" value="$correo" />
                {$erroresCampos['correo']}
            </div>
            <div>
                <label for="direccion">Dirección:</label>
                <input id="direccion" type="text" name="direccion" value="$direccion" />
                {$erroresCampos['direccion']}
            </div>
            <div>
                <label for="numero_tarjeta">Número de Tarjeta:</label>
                <input id="numero_tarjeta" type="text" name="numero_tarjeta" value="$numeroTarjeta" maxlength="16" />
                {$erroresCampos['numero_tarjeta']}
            </div>
            <div>
                <label for="fecha_vencimiento">Fecha de Vencimiento (MM/AA):</label>
                <input id="fecha_vencimiento" type="text" name="fecha_vencimiento" value="$fechaVencimiento" maxlength="5" />
                {$erroresCampos['fecha_vencimiento']}
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input id="cvv" type="text" name="cvv" value="$cvv" maxlength="3" />
                {$erroresCampos['cvv']}
            </div>
            <div>
                <button type="submit" name="pagar">Realizar Pago</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || mb_strlen($nombre) < 5) {
            $this->errores['nombre'] = 'El nombre debe tener al menos 5 caracteres.';
        }

        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
        if (!$correo) {
            $this->errores['correo'] = 'El correo electrónico no es válido.';
        }

        $direccion = trim($datos['direccion'] ?? '');
        $direccion = filter_var($direccion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$direccion || mb_strlen($direccion) < 5) {
            $this->errores['direccion'] = 'La dirección debe tener al menos 5 caracteres.';
        }

        $numeroTarjeta = trim($datos['numero_tarjeta'] ?? '');
        if (!preg_match('/^\d{16}$/', $numeroTarjeta)) {
            $this->errores['numero_tarjeta'] = 'El número de tarjeta debe tener 16 dígitos.';
        }

        $fechaVencimiento = trim($datos['fecha_vencimiento'] ?? '');
        if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $fechaVencimiento)) {
            $this->errores['fecha_vencimiento'] = 'La fecha de vencimiento debe tener el formato MM/AA.';
        } else {
            // Validar que la tarjeta no esté caducada
            $partesFecha = explode('/', $fechaVencimiento);
            $mes = intval($partesFecha[0]);
            $anio = intval('20' . $partesFecha[1]); // Convertir el año a formato completo (por ejemplo, "25" a "2025")

            $mesActual = intval(date('m'));
            $anioActual = intval(date('Y'));

            if ($anio < $anioActual || ($anio === $anioActual && $mes < $mesActual)) {
                $this->errores['fecha_vencimiento'] = 'La tarjeta está caducada.';
            }
        }

        $cvv = trim($datos['cvv'] ?? '');
        if (!preg_match('/^\d{3}$/', $cvv)) {
            $this->errores['cvv'] = 'El CVV debe tener 3 dígitos.';
        }

        if (count($this->errores) === 0) {
            // Calcular el total del carrito
            $total = 0;
            foreach ($_SESSION['carrito'] as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }

            // Crear el pedido
            require_once RUTA_INCLUDES . 'pedido.php';
            require_once RUTA_INCLUDES . 'detallespedido.php';
            $conn = Aplicacion::getInstance()->getConexionBd();
            $pedido = new Pedido($conn);

            $id_usuario = $_SESSION['id_usuario']; // ID del usuario logueado
            $estado = "pendiente";

            if ($pedido->crearPedido($id_usuario, $estado, $total)) {
                $id_pedido = $pedido->getIdPedido(); // Obtén el ID del pedido recién creado

                $detallesPedido = new DetallesPedido($conn);
                foreach ($_SESSION['carrito'] as $producto) {
                    $id_producto = $producto['id_producto'];
                    $cantidad = $producto['cantidad'];
                    $precio_unidad = $producto['precio'];

                    if (!$detallesPedido->agregarDetalle($id_pedido, $id_producto, $cantidad, $precio_unidad)) {
                        $this->errores['general'] = 'No se pudo agregar un detalle del pedido. Por favor, inténtalo de nuevo.';
                        return;
                    }
                }

                // Vaciar el carrito después de crear el pedido
                unset($_SESSION['carrito']);

                // Redirigir a la página de confirmación
                return RUTA_APP . 'confirmacion.php';
            } else {
                $this->errores['general'] = 'No se pudo procesar el pedido. Por favor, inténtalo de nuevo.';
            }
        }
    }
}