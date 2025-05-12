<?php
require_once RUTA_INCLUDES . 'formularios.php';
require_once RUTA_INCLUDES . 'usuario.php';

class formularioregistro extends formularios
{
    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => RUTA_APP . 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $correo = $datos['correo'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $tipoUsuario = $datos['tipo_usuario'] ?? 'cliente'; // Valor predeterminado: cliente

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['correo', 'nombre', 'password', 'password2', 'tipo_usuario'], $this->errores, 'span', array('class' => 'error'));

        $opcionAdministrador = '';
        if (isset($_SESSION['login']) && $_SESSION['rol'] === 'administrador') {
            $opcionAdministrador = '<option value="administrador" ' . $this->seleccionado($tipoUsuario, 'administrador') . '>Administrador</option>';
        }

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input id="correo" type="text" name="correo" value="$correo" />
                {$erroresCampos['correo']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
                <input id="password2" type="password" name="password2" />
                {$erroresCampos['password2']}
            </div>
            <div>
                <label for="tipo_usuario">Tipo de cuenta:</label>
                <select id="tipo_usuario" name="tipo_usuario">
                    <option value="cliente" {$this->seleccionado($tipoUsuario, 'cliente')}>Cliente</option>
                    <option value="vendedor" {$this->seleccionado($tipoUsuario, 'vendedor')}>Vendedor</option>
                    $opcionAdministrador
                </select>
                {$erroresCampos['tipo_usuario']}
            </div>
            <div>
                <button type="submit" name="registro">Registrar</button>
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
            $this->errores['nombre'] = 'El nombre tiene que tener una longitud de al menos 5 caracteres.';
        } elseif (mb_strlen($nombre) > 20) {
            $this->errores['nombre'] = 'El nombre no puede tener más de 20 caracteres.';
        }

        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$correo || empty($correo)) {
            $this->errores['correo'] = 'El correo del usuario no puede estar vacío';
        }

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password || mb_strlen($password) < 5) {
            $this->errores['password'] = 'La contraseña tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password2 || $password != $password2) {
            $this->errores['password2'] = 'Las contraseñas deben coincidir';
        }

        $tipoUsuario = $datos['tipo_usuario'] ?? 'cliente';
        if (!in_array($tipoUsuario, ['cliente', 'vendedor', 'administrador'])) {
            $this->errores['tipo_usuario'] = 'El tipo de cuenta seleccionado no es válido.';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaUsuario($correo);

            if ($usuario) {
                $this->errores[] = "El usuario ya existe";
            } else {
                $usuario = Usuario::crea($correo, $password, $nombre, $tipoUsuario);

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['id_usuario'] = $usuario->getId();
                $_SESSION['rol'] = $tipoUsuario;

                $this->urlRedireccion = RUTA_APP . 'index.php';
            }
        }
    }

    private function seleccionado($valor, $opcion)
    {
        return $valor === $opcion ? 'selected' : '';
    }
}