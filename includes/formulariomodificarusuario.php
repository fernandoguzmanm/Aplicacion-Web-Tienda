<?php
require_once RUTA_INCLUDES . 'formularios.php';
require_once './includes/config.php';

class formularioModificarUsuario extends formularios
{
    private $usuario;

    public function __construct($usuario) {
        parent::__construct('formModificarUsuario', ['urlRedireccion' => RUTA_APP . 'controller.php?controller=admin&action=gestionarUsuarios']);
        $this->usuario = $usuario;
    }

    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? $this->usuario->getNombre();
        $email = $datos['email'] ?? $this->usuario->getEmail();
        $tipo_usuario = $datos['tipo_usuario'] ?? $this->usuario->getTipoUsuario();

        // Determinar las opciones disponibles para el tipo de usuario
        $opcionesTipoUsuario = '';
        if ($_SESSION['rol'] === 'administrador') {
            $opcionesTipoUsuario = <<<EOF
                <option value="administrador" {$this->selected($tipo_usuario, 'administrador')}>Administrador</option>
                <option value="vendedor" {$this->selected($tipo_usuario, 'vendedor')}>Vendedor</option>
                <option value="cliente" {$this->selected($tipo_usuario, 'cliente')}>Cliente</option>
            EOF;
        } else {
            $opcionesTipoUsuario = <<<EOF
                <option value="vendedor" {$this->selected($tipo_usuario, 'vendedor')}>Vendedor</option>
                <option value="cliente" {$this->selected($tipo_usuario, 'cliente')}>Cliente</option>
            EOF;
        }

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'email', 'contraseña', 'tipo_usuario', 'puntos_fidelidad'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <form method="POST" action="controller.php?controller=usuario&action=actualizarUsuario" class="formulario-form">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="$nombre" required>
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="$email" required>
                {$erroresCampos['email']}
            </div>
            <div>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña">
                {$erroresCampos['contraseña']}
            </div>
            <div>
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    $opcionesTipoUsuario
                </select>
                {$erroresCampos['tipo_usuario']}
            </div>
            <input type="hidden" name="id_usuario" value="{$this->usuario->getId()}">
            <button type="submit" class="btn">Guardar Cambios</button>
        </form>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $id_usuario = $this->usuario->getId();
        $nombre = trim($datos['nombre'] ?? $this->usuario->getNombre());
        $email = trim($datos['email'] ?? $this->usuario->getEmail());
        $contraseña = trim($datos['contraseña'] ?? $this->usuario->getContraseña());
        $tipo_usuario = trim($datos['tipo_usuario'] ?? $this->usuario->getTipoUsuario());

        if (!$nombre) {
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        }

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errores['email'] = 'El email no es válido.';
        }

        if ($_SESSION['rol'] !== 'administrador' && $tipo_usuario === 'administrador') {
            $this->errores['tipo_usuario'] = 'No tienes permiso para asignarte como administrador.';
        } elseif (!in_array($tipo_usuario, ['administrador', 'vendedor', 'cliente'])) {
            $this->errores['tipo_usuario'] = 'El tipo de usuario no es válido.';
        }

        if (count($this->errores) === 0) {
            
            $resultado = Usuario::modificarUsuario($id_usuario, $nombre, $email, $contraseña, $tipo_usuario, 0);
            
            if ($resultado) {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['rol'] = $tipo_usuario;
                $this->urlRedireccion = RUTA_APP . 'index.php';
            } else {
                $this->errores[] = 'Error al actualizar el usuario. Por favor, inténtalo de nuevo.';
            }
        }
    }

    private function selected($currentValue, $optionValue) {
        return $currentValue === $optionValue ? 'selected' : '';
    }
}