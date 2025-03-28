<?php

$tituloPagina = 'Portada';

$contenidoPrincipal = <<<EOS
    <h2>Bienvenido a ShopEasy</h2>
    <div class="logo-container">
        <img src="./img/logotipo.jpeg" alt="Logotipo de ShopEasy" class="logo">
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

require './includes/vistas/plantillas/plantilla.php';
