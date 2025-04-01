<?php
//use es\ucm\fdi\aw\Usuario; 
//use es\ucm\fdi\aw\formularios;
require_once 'usuario.php';
require_once 'formularios.php';

class formulariocontacto extends formularios 
{
    public function __construct() {
        parent::__construct('formContacto', ['urlRedireccion' => 'contacto.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $correo = $datos['correo'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['correo', 'password'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <form action="contacto.php" method="post" class="formulario-form">
            <fieldset>
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>
                </div>
                <div>
                    <label for="correo">Correo Electrónico:</label>
                    <input type="text" id="correo" name="correo" required><br><br>
                </div>

                <p>Motivo de la consulta:</p>
                
                <div>
                    <label for="evaluacion">Evaluación</label><br>
                    <input type="radio" id="evaluacion" name="motivo" value="Evaluación" required>
                </div>
                <div>
                    <label for="sugerencias">Sugerencias</label><br>
                    <input type="radio" id="sugerencias" name="motivo" value="Sugerencias" required>
                </div>
                <div>
                    <label for="criticas">Críticas</label><br><br>
                    <input type="radio" id="criticas" name="motivo" value="Críticas" required>
                </div>
                <div>
                    <label for="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
                    <input type="checkbox" id="terminos" name="terminos" required>
                </div>
                <div>
                    <label for="mensaje">Consulta:</label><br>
                    <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>
                </div>
                <div>
                    <button type="submit" name="contacto">Enviar</button>
                </div>
            </fieldset>
        </form>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {   
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || mb_strlen($nombre) == 0) {
            $this->errores['nombre'] = 'El nombre no puede estar vacio.';
        }
        var_dump($nombre);
        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $correo || empty($correo) ) {
            $this->errores['correo'] = 'El correo del usuario no puede estar vacío';
        }
        //$motivo = htmlspecialchars($_POST['motivo']);
        //$mensaje = htmlspecialchars($_POST['mensaje']);
        $motivo = htmlspecialchars($datos['motivo'] ?? '');
        $mensaje = htmlspecialchars($datos['mensaje'] ?? '');

        if (count($this->errores) === 0) {
            return [
                "nombre" => $nombre,
                "correo" => $correo,
                "motivo" => $motivo,
                "mensaje" => $mensaje
            ];
        }
    }


    
}