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
        <h1 class="text-6xl font-bold mb-8 mt-6 text-left">Política de Privacidad de GorillaLabs</h1>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 space-y-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-2 text-primary">Quiénes somos</h2>
                    <p class="mb-4">GorillaLabs es una empresa especializada en la realización de pruebas de suelo y agua, proporcionando resultados confiables y precisos para satisfacer las necesidades de nuestros clientes. Nuestro sitio web es: <a href="http://gorillalabs.com" class="text-green-600 hover:underline">http://gorillalabs.com</a>.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Comentarios</h2>
                    <p class="mb-4"><span class="font-semibold">Datos recopilados:</span> Recopilamos la dirección IP del visitante y la cadena del agente de usuario del navegador para ayudar en la detección de spam.</p>
                    <p class="mb-4">Gravatar puede recibir una cadena anónima creada de tu dirección de correo para verificar su uso. Política de Gravatar: <a href="https://automattic.com/privacy/" class="text-green-600 hover:underline">https://automattic.com/privacy/</a>.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Medios</h2>
                    <p class="mb-4"><span class="font-semibold">Recomendación:</span> Evita subir imágenes con datos de ubicación incrustados (EXIF GPS), ya que estos pueden ser extraídos por los visitantes.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Cookies</h2>
                    <p class="mb-4">Usamos cookies para mejorar tu experiencia en nuestro sitio. A continuación, detallamos los tipos de cookies que empleamos:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><span class="font-semibold">Comentarios:</span> Al dejar un comentario, puedes optar por guardar tu nombre, correo electrónico y sitio web en cookies para futuros comentarios (duran un año).</li>
                        <li><span class="font-semibold">Acceso:</span> Colocamos una cookie temporal para determinar si tu navegador acepta cookies. Se elimina al cerrar el navegador.</li>
                        <li><span class="font-semibold">Inicio de sesión:</span> Guardamos tus datos de acceso y preferencias de pantalla. Duran hasta dos días, o dos semanas si seleccionas "Recuérdame".</li>
                        <li><span class="font-semibold">Edición de artículos:</span> Si editas o publicas un artículo, una cookie adicional indicará el ID del artículo editado (expira en un día).</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Contenido Incrustado de Otros Sitios Web</h2>
                    <p class="mb-4">Los artículos de este sitio pueden incluir contenido incrustado (por ejemplo, vídeos, imágenes, artículos). Este contenido se comporta igual que si visitaras el sitio de origen, por lo que puede recopilar datos, utilizar cookies y monitorear tu interacción.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Con Quién Compartimos Tus Datos</h2>
                    <p class="mb-4"><span class="font-semibold">Restablecimiento de contraseña:</span> Si solicitas un restablecimiento, tu dirección IP será incluida en el correo de restablecimiento.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Cuánto Tiempo Conservamos Tus Datos</h2>
                    <p class="mb-4">Los comentarios y sus metadatos se conservan indefinidamente para facilitar la moderación. Los usuarios registrados pueden ver, editar o eliminar su información personal en cualquier momento (salvo el nombre de usuario).</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Qué Derechos Tienes Sobre Tus Datos</h2>
                    <p class="mb-4">Si tienes una cuenta o has dejado comentarios, puedes solicitar un archivo de tus datos personales o pedir su eliminación. Esto no incluye la información que debemos retener por razones legales o de seguridad.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-2 mt-8 text-primary">Dónde Enviamos Tus Datos</h2>
                    <p class="mb-4">Los comentarios pueden ser revisados mediante un servicio automático de detección de spam para proteger la seguridad de nuestro sitio y nuestros usuarios.</p>
                </div>

                <p class="mt-8 text-sm text-gray-600">Esta política asegura la transparencia en el manejo de datos en GorillaLabs, reflejando nuestro compromiso con la privacidad y protección de la información de nuestros clientes y visitantes.</p>
            </div>
        </div>
    </div>
</body>

</html>