<?php
require_once __DIR__ . '/formularios.php';
require_once __DIR__ . '/usuario.php';

class formulariologin extends formularios
{
    public function __construct()
    {
        parent::__construct('formLogin', [
            'method' => 'POST',
            'action' => htmlspecialchars($_SERVER['REQUEST_URI']),
            'urlRedireccion' => RUTA_APP . 'index.php' // Cambia a la página deseada después del login
        ]);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $correo = $datos['correo'] ?? '';
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['correo', 'password'], $this->errores, 'span', ['class' => 'error']);

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
                <label for="correo">Correo:</label>
                <input id="correo" type="text" name="correo" value="$correo" required />
                {$erroresCampos['correo']}
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input id="password" type="password" name="password" required />
                {$erroresCampos['password']}
            </div>
            <div>
                <button type="submit" name="login">Entrar</button>
            </div>
        </fieldset>
        EOF;

        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        if (!$correo || empty($correo)) {
            $this->errores['correo'] = 'El correo no puede estar vacío.';
        }

        $password = trim($datos['password'] ?? '');
        if (!$password || empty($password)) {
            $this->errores['password'] = 'La contraseña no puede estar vacía.';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::login($correo, $password);
            if (!$usuario) {
                $this->errores[] = 'El correo o la contraseña no son correctos.';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
                //$_SESSION['vendedor'] = $usuario->esVendedor(); // Si aplica
                $this->urlRedireccion = RUTA_APP . 'index.php'; // Cambia a la página deseada
            }
        }
    }
}