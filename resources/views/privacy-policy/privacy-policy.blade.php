<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-6xl font-bold mb-8 mt-6 text-left">POLÍTICA DE PRIVACIDAD Y DEVOLUCIONES</h1>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 space-y-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-2 text-primary">Quiénes somos</h2>
                    <p class="mb-4">La dirección de nuestro sitio web es: <a href="http://gorillalabs.com.co" class="text-green-600 hover:underline">http://gorillalabs.com.co</a>.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Privacidad y Datos Recopilados</h2>
                    <p class="mb-4">Al interactuar con nuestro sitio web, podemos recopilar datos personales como tu nombre, dirección de correo electrónico, dirección IP y cualquier otro dato proporcionado a través de formularios de consulta o solicitud de cotizaciones. Estos datos son necesarios para optimizar la experiencia del usuario y mejorar la precisión de los servicios ofrecidos.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Cookies</h2>
                    <p class="mb-4">Para mejorar tu experiencia en nuestro sitio, utilizamos cookies que permiten almacenar preferencias y facilitar el proceso de solicitud de cotizaciones y comparativas. Las cookies de acceso y de personalización de pantalla pueden permanecer activas hasta por un año, según tu configuración. Si decides desactivarlas, algunas funciones del sitio pueden verse afectadas.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Con quién compartimos tus datos</h2>
                    <p class="mb-4">En algunos casos, compartiremos la información necesaria para procesar solicitudes, cotizaciones y devoluciones, o para enviar notificaciones relacionadas con el uso de la plataforma. No compartimos tus datos personales con terceros fuera de este propósito.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Cuánto tiempo conservamos tus datos</h2>
                    <p class="mb-4">La información y metadatos de las solicitudes y cotizaciones se almacenan indefinidamente para facilitar el proceso de seguimiento y agilizar futuras solicitudes. Si te registras como usuario en el sitio (si es el caso), almacenaremos la información personal proporcionada en tu perfil. Puedes ver, editar o eliminar esta información en cualquier momento, a excepción del nombre de usuario.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Qué derechos tienes sobre tus datos</h2>
                    <p class="mb-4">Si tienes una cuenta en este sitio o has realizado solicitudes de servicio, puedes solicitar un archivo con tus datos personales recopilados o la eliminación de esta información. Esto no incluye los datos que estemos obligados a conservar por razones administrativas, legales o de seguridad.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Política de Devoluciones</h2>
                    <p class="mb-4">Si el servicio de Gorillalabs no cumple con tus expectativas, puedes solicitar una devolución en los primeros 30 días desde la contratación del servicio en nuestro sitio. De ser aprobada, te reembolsaremos el 90% del costo del servicio, reteniendo el 10% restante para cubrir gastos administrativos. Para ser elegible, asegúrate de cumplir con el plazo y de que el servicio no haya sido utilizado ni consumido.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Proceso de Devolución</h2>
                    <p class="mb-4">Para iniciar el proceso de devolución, sigue estos pasos:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Comunícate con nuestro equipo de atención al cliente en <a href="mailto:soporte@gorillalabs.com.co" class="text-green-600 hover:underline">soporte@gorillalabs.com.co</a>.</li>
                        <li>Proporciona los siguientes datos: número de pedido, fecha de solicitud, tipo de servicio y un número de contacto.</li>
                        <li>Nuestro equipo evaluará tu solicitud y te notificará los pasos a seguir.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Reembolsos</h2>
                    <p class="mb-4">Una vez aprobada tu solicitud, Gorillalabs reembolsará el importe en un plazo de 10 días hábiles desde la aprobación en nuestra plataforma. El tiempo total de devolución puede variar según los tiempos de procesamiento de tu entidad bancaria, lo que podría extenderse hasta un máximo de 59 días.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Atención al Cliente</h2>
                    <p class="mb-4">Para más consultas sobre devoluciones, privacidad u otros temas, contáctanos al (+57) 3128130988 o envíanos un correo a <a href="mailto:soporte@gorillalabs.com.co" class="text-green-600 hover:underline">soporte@gorillalabs.com.co</a>.</p>
                </div>

                <p class="mt-8 text-sm text-gray-600">Esta política asegura la transparencia en el manejo de datos en GorillaLabs, reflejando nuestro compromiso con la privacidad y protección de la información de nuestros clientes y visitantes.</p>
            </div>
        </div>
    </div>
</body>

</html>