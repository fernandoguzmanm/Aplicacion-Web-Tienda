<?php
require_once RUTA_INCLUDES . 'usuario.php';
require_once RUTA_INCLUDES . 'formularios.php';

class formulariocontacto extends formularios 
{
    public function __construct() {
        parent::__construct('formContacto', ['urlRedireccion' => RUTA_APP . 'contacto.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $nombre = $datos['nombre'] ?? '';
        $correo = $datos['correo'] ?? '';
        $motivo = $datos['motivo'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'correo', 'motivo', 'mensaje'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <form action="contacto.php" method="post" class="formulario-form">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="$nombre" required>
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="$correo" required>
                {$erroresCampos['correo']}
            </div>
            <p>Motivo de la consulta:</p>
            <div>
                <input type="radio" id="evaluacion" name="motivo" value="Evaluación" required>
                <label for="evaluacion">Evaluación</label>
            </div>
            <div>
                <input type="radio" id="sugerencias" name="motivo" value="Sugerencias" required>
                <label for="sugerencias">Sugerencias</label>
            </div>
            <div>
                <input type="radio" id="criticas" name="motivo" value="Críticas" required>
                <label for="criticas">Críticas</label>
            </div>
            <div>
                <label for="mensaje">Consulta:</label>
                <textarea id="mensaje" name="mensaje" rows="4" cols="50" required>$mensaje</textarea>
                {$erroresCampos['mensaje']}
            </div>
            <div>
                <label for="terminos">
                    <input type="checkbox" id="terminos" name="terminos" required>
                    Acepto los términos y condiciones
                </label>
            </div>
            <div>
                <button type="submit" name="contacto">Enviar</button>
            </div>
        </form>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {   
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || mb_strlen($nombre) == 0) {
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        }

        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
        if (!$correo) {
            $this->errores['correo'] = 'El correo no es válido.';
        }

        $motivo = htmlspecialchars($datos['motivo'] ?? '');
        if (!$motivo) {
            $this->errores['motivo'] = 'Debe seleccionar un motivo.';
        }

        $mensaje = htmlspecialchars($datos['mensaje'] ?? '');
        if (!$mensaje || mb_strlen($mensaje) < 10) {
            $this->errores['mensaje'] = 'El mensaje debe tener al menos 10 caracteres.';
        }

        if (count($this->errores) === 0) {

            $destinatario = "fvieites@ucm.es";
            $asunto = "Consulta: $motivo";
            $cuerpo = "Nombre: $nombre\n\n";
            $cuerpo .= "Mensaje: $mensaje";

            $mailto = "mailto:$destinatario?subject=" . rawurlencode($asunto) . "&body=" . rawurlencode($cuerpo);
            header("Location: $mailto");
            exit();
        }
    }
}