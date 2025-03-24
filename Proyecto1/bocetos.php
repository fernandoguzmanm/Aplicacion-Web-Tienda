<main>
    <?php
    $bocetos = [
        "inicio" => "Página de Inicio",
        "catalogo" => "Página de Catálogo",
        "carrito" => "Página del Carrito",
        "pago" => "Página de Pago",
        "sobrenosotros" => "Página Sobre Nosotros",
        "contacto" => "Página de Contacto",
        "lista" => "Página de Lista"
    ];

    foreach ($bocetos as $id => $titulo) {
        echo "<h2 id='$id'>$titulo</h2>";
        echo "<p>" . obtenerDescripcion($id) . "</p>";
        echo "<img src='bocetos/$id.png' alt='Boceto de la $titulo' class='bocetos-img'>";
    }

    function obtenerDescripcion($pagina) {
        $descripciones = [
            "inicio" => "Esta es la página principal donde los usuarios encuentran la información destacada y opciones de navegación.",
            "catalogo" => "En esta sección, los usuarios pueden explorar los productos disponibles y filtrarlos según sus preferencias.",
            "carrito" => "Aquí los usuarios pueden revisar los productos añadidos al carrito antes de proceder al pago.",
            "pago" => "En esta pantalla, el usuario introduce sus datos de pago y dirección para completar la compra.",
            "sobrenosotros" => "Sección informativa sobre la empresa, su historia y valores.",
            "contacto" => "Aquí los usuarios pueden enviar consultas o contactar con el soporte.",
            "lista" => "Esta página muestra una lista de artículos, pedidos o productos recomendados."
        ];
        return $descripciones[$pagina] ?? "Descripción no disponible.";
    }
    ?>
</main>

</body>
</html>


<?php require './includes/vistas/plantillas/plantilla2.php'; ?>