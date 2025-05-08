<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require RUTA_VISTAS . 'plantillas/plantilla2.php';
$tituloPagina = 'Detalles'; ?>

<main>
    <h2>Introducción</h2>
    <p>
    ShopEasy es una innovadora plataforma de comercio electrónico diseñada para ofrecer una experiencia de compra intuitiva, 
    eficiente y personalizada. Nuestro sitio web permite a los usuarios encontrar una amplia variedad de productos alimenticios, 
    desde ingredientes frescos y orgánicos hasta comidas preparadas y productos gourmet. Con una interfaz fácil de usar, 
    los clientes pueden explorar diversas categorías, comparar precios, leer reseñas detalladas y realizar compras de manera rápida y 
    segura. A diferencia de otras plataformas, ShopEasy se especializa en la personalización de la experiencia del usuario. 
    Gracias a un avanzado sistema de inteligencia artificial, analizamos las preferencias y hábitos de compra de cada cliente para 
    ofrecer recomendaciones precisas y relevantes. Así, nuestros usuarios pueden descubrir nuevos productos que se ajusten a 
    sus gustos y necesidades sin esfuerzo. Además, ShopEasy integra un sistema de fidelización que recompensa a nuestros clientes con 
    puntos por cada compra realizada. Estos puntos pueden acumularse y canjearse por descuentos exclusivos, productos especiales o 
    incluso envíos gratuitos. De esta manera, incentivamos la lealtad y premiamos la confianza de quienes eligen nuestra plataforma 
    para sus compras de alimentos. Nuestra prioridad es garantizar la frescura y calidad de los productos. Trabajamos con proveedores 
    confiables y locales para asegurar que los clientes reciban los mejores ingredientes y comidas. También ofrecemos opciones para 
    dietas especiales, incluyendo productos sin gluten, veganos, keto y más, para que cada persona encuentre lo que necesita según 
    su estilo de vida. ShopEasy no solo facilita la compra de alimentos, sino que también proporciona una experiencia segura y 
    placentera, optimizada para el ritmo de vida moderno. Con entregas rápidas, múltiples opciones de pago y un excelente servicio 
    al cliente, nos esforzamos por ser la mejor opción para quienes buscan comodidad, calidad y buenos precios en un solo lugar.
    </p>

    
    <h2>Tipos de usuarios</h2>
    <?php foreach ($usuarios as $tipo => $descripcion): ?>
        <h3><?= htmlspecialchars($tipo) ?></h3>
        <p><?= nl2br(htmlspecialchars($descripcion)) ?></p>
    <?php endforeach; ?>

    <h2>Funcionalidades</h2>
    <?php foreach ($funcionalidades as $titulo => $descripcion): ?>
        <h3><?= htmlspecialchars($titulo) ?></h3>
        <p><?= nl2br(htmlspecialchars($descripcion)) ?></p>
    <?php endforeach; ?>
</main>
