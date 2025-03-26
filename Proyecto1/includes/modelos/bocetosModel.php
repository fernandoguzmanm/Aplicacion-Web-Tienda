<?php
class BocetosModel {
    public function obtenerBocetos() {
        return [
            "inicio" => "Página de Inicio",
            "catalogo" => "Página de Catálogo",
            "carrito" => "Página del Carrito",
            "pago" => "Página de Pago",
            "sobrenosotros" => "Página Sobre Nosotros",
            "contacto" => "Página de Contacto",
            "lista" => "Página de Lista"
        ];
    }

    public function obtenerDescripcion($pagina) {
        $descripciones = [
            "inicio" => "Esta es la página principal donde los usuarios encuentran la información destacada.",
            "catalogo" => "Los usuarios pueden explorar productos y filtrarlos.",
            "carrito" => "Los usuarios revisan los productos antes del pago.",
            "pago" => "Aquí el usuario introduce sus datos para completar la compra.",
            "sobrenosotros" => "Sección informativa sobre la empresa.",
            "contacto" => "Los usuarios pueden enviar consultas o contactar con soporte.",
            "lista" => "Muestra una lista de artículos o pedidos."
        ];
        return $descripciones[$pagina] ?? "Descripción no disponible.";
    }
}
?>
