<?php
class DetallesController {
    private $usuarios;
    private $funcionalidades;

    public function __construct() {
        $this->usuarios = $this->obtenerUsuarios();
        $this->funcionalidades = $this->obtenerFuncionalidades();
    }

    public function mostrarDetalles() {
        $tituloPagina = 'Detalles';
        $usuarios = $this->usuarios;
        $funcionalidades = $this->funcionalidades;

        require RUTA_VISTAS . 'detalles.php';
    }

    private function obtenerUsuarios() {
        return [
            "Usuario no registrado" => "Este tipo de usuario tiene acceso limitado a la plataforma, permitiéndole explorar la tienda y familiarizarse con los productos y servicios antes de registrarse. Sus funcionalidades incluyen: Navegar por la tienda y explorar todas las categorías de productos disponibles. Visualizar imágenes, descripciones y especificaciones de los productos. Leer reseñas y valoraciones de otros usuarios para conocer la opinión de compradores previos. Acceder a la información de los vendedores y sus respectivas tiendas. Consultar precios y disponibilidad de los productos. Utilizar el buscador y los filtros para encontrar productos específicos. No puede realizar compras ni dejar comentarios hasta que se registre.",
            "Usuario registrado" => "Un usuario registrado tiene acceso a una experiencia de compra completa y personalizada. Puede interactuar con la plataforma de manera más activa y disfrutar de beneficios exclusivos. Sus funcionalidades incluyen: Realizar compras de manera rápida y segura con múltiples métodos de pago. Dejar reseñas y valoraciones sobre los productos adquiridos para ayudar a otros compradores. Agregar productos a su lista de deseos para facilitar compras futuras. Acumular puntos de fidelización con cada compra y canjearlos por descuentos o productos exclusivos. Recibir recomendaciones personalizadas basadas en su historial de compras y preferencias. Gestionar su cuenta personal, incluyendo datos de pago y direcciones de envío. Seguir a sus tiendas y vendedores favoritos para recibir actualizaciones sobre nuevos productos y ofertas. Acceder a atención al cliente para resolver dudas o incidencias con sus pedidos.",
            "Vendedor" => "Los vendedores son comerciantes que pueden registrar su tienda dentro de la plataforma y vender sus productos a los usuarios. Sus funcionalidades incluyen: Registrar su tienda y configurar su perfil con información relevante, como nombre, descripción y políticas de venta. Subir y gestionar su inventario de productos, incluyendo imágenes, descripciones, precios y disponibilidad. Actualizar precios y aplicar descuentos o promociones en sus productos. Gestionar pedidos y envíos, asegurando una entrega eficiente a los compradores. Responder preguntas y consultas de los clientes en la sección de comentarios o mensajes directos. Revisar las reseñas y valoraciones recibidas sobre sus productos y responder a los compradores si es necesario. Acceder a herramientas de análisis para conocer el rendimiento de sus ventas, tendencias de compra y comportamiento de sus clientes. Participar en campañas promocionales organizadas por la plataforma para aumentar la visibilidad de sus productos.",
            "Administrador" => "El administrador tiene el control total de la plataforma, asegurando su correcto funcionamiento y supervisando la interacción entre compradores y vendedores. Sus funcionalidades incluyen: Gestionar usuarios y vendedores, asegurando que cumplan con los términos y condiciones de la plataforma. Aprobar o rechazar registros de vendedores, verificando su autenticidad antes de permitirles operar en la plataforma. Modificar o eliminar productos, tiendas o cuentas que infrinjan las normas de la plataforma. Moderar reseñas y comentarios, eliminando aquellos que sean fraudulentos, ofensivos o que no cumplan con las reglas de la comunidad. Resolver disputas de compra entre usuarios y vendedores, ofreciendo soluciones justas y mediadas. Supervisar el sistema de fidelización y asegurar que los puntos acumulados sean correctamente otorgados y utilizados. Monitorear la seguridad de la plataforma y responder a posibles amenazas o intentos de fraude. Gestionar las campañas publicitarias y estrategias de marketing para aumentar la visibilidad de la plataforma y atraer más usuarios. Realizar reportes y análisis del desempeño de la plataforma para optimizar su funcionamiento y mejorar la experiencia del usuario."
        ];
    }

    private function obtenerFuncionalidades() {
        return [
            "Gestión de productos" => "Esta funcionalidad se encarga de la administración eficiente de los productos dentro de la plataforma. Permitirá a los vendedores gestionar su inventario de manera sencilla y organizada, asegurando que la cantidad de cada producto se actualice en tiempo real según las ventas y reposiciones. Además, los vendedores podrán añadir nuevos productos con sus respectivas descripciones, imágenes, precios y categorías, así como modificar la información de los artículos existentes. También será posible eliminar productos que ya no estén disponibles o que deseen descontinuar. Esta gestión optimizada garantiza un control preciso del stock, evitando errores y mejorando la experiencia de compra del usuario.",
            "Sistema de puntos" => "Al realizar compras con nosotros obtendrás puntos, los cuales serán proporcionales al importe de la compra. Habrá una sección en la que podrás ver las ofertas disponibles y los puntos que necesitas para ellas, así como los puntos de los que dispones y la fecha de caducidad de los mismos. En esta sección podrás canjear tus puntos y activar la oferta, la cual te dará un código de descuento para canjear posteriormente.",
            "Compra y venta" => "Permite a los usuarios comprar productos de la tienda. Incluye funcionalidades como añadir productos al carrito de compras, realizar pagos seguros, gestionar pedidos y seguir el estado de las transacciones. También permite a los administradores de la tienda abastecerse comprando a sus proveedores, y la posibilidad de visualizar su inventario.",
            "Búsqueda avanzada" => "Esta herramienta facilita a los usuarios encontrar productos específicos utilizando filtros detallados. Pueden buscar por categorías, precios, marcas, valoraciones de otros usuarios, lo que mejora la experiencia de compra al permitir resultados más precisos y rápidos.",
            "Chat" => "Funcionalidad que permite a los usuarios comunicarse en tiempo real con el soporte del sistema. El chat puede usarse para hacer preguntas sobre productos, discutir detalles de una compra, saber el estado de su pedido o para recibir asistencia en general.",
            "Administrador" => "Es un panel de control destinado a los administradores del sistema. Les permite gestionar la plataforma, supervisar las transacciones, verificar el estado de los productos, manejar la cuenta de usuarios, ver estadísticas de la tienda y tomar decisiones clave para el funcionamiento del sitio."
        ];
    }

    public function getUsuarios() {
        return $this->usuarios;
    }

    public function getFuncionalidades() {
        return $this->funcionalidades;
    }
}
?>