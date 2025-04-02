<?php
require './includes/config.php';

$tituloPagina = 'Portada';

// La ruta completa de la imagen ya está definida en RUTA_IMGS
$rutaLogotipo = RUTA_IMGS . 'logotipo.jpeg';

$contenidoPrincipal = <<<EOS
    <h2>Bienvenido a ShopEasy</h2>
    <div class="logo-container">
        <img src="{$rutaLogotipo}" alt="Logotipo de ShopEasy" class="logo">
    </div>
    <h3>Breve descripción</h3>
    <p class="text">
        ShopEasy es una plataforma de comercio electrónico diseñada para ofrecer
        una experiencia de compra intuitiva y eficiente. Nuestra web permite a los usuarios
        encontrar productos de diversas categorías, comparar precios, leer reseñas y realizar
        compras de manera rápida y segura. A diferencia de otras plataformas, ShopEasy se
        enfoca en la personalización de la experiencia del usuario, recomendando productos
        basados en sus preferencias y hábitos de compra. Además, integra un sistema de
        fidelización donde los clientes acumulan puntos por sus compras y pueden canjearlos
        por descuentos o productos exclusivos.
    </p>
EOS;

require RUTA_VISTAS . '/plantillas/plantilla.php';