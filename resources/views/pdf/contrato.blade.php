<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
        header: pdfHeader; /* Aplica el encabezado a todas las páginas */
        margin-top: 110px; /* Aumenta el margen superior para evitar que el contenido se superponga */
        background-image: url("{{ public_path('images/fondo_aguas.png') }}");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 15cm 20cm; /* Ajusta el tamaño exacto de la imagen */
    }
 .header {
    width: 100%;
    text-align: center;
    border-bottom: 1px solid black;
    margin-bottom: 10px;
    padding-bottom: 5px;
}

.header-table {
    width: 100%;
}

.header-table td {
    width: 50%;
    vertical-align: middle;
    padding: 5px;
}

.left-logo {
    text-align: left;
}

.right-logo {
    text-align: right;
}

.title {
    text-align: center;
    font-weight: bold;
    font-style: italic;
    margin-top: -25px;
}

.logo {
    height: 50px;
}

.contract-title {
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    margin-top: 10px;
}

.contract-content {
    text-align: justify;
    font-size: 12px;
    line-height: 1.5;
}

.contract-section {
    margin-top: 15px;
    padding: 5px;
}

.contract-subtitle {
    font-weight: bold;
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 5px;
    text-align: left;
}

.bold {
    font-weight: bold;
    font-size: 12px;
}

.indent {
    text-indent: 20px;
}

.contract-content a {
    color: #007bff;
    text-decoration: none;
}

.contract-content a:hover {
    text-decoration: underline;
}

.text-right {
    text-align: right;
}

.signature-section {
    margin-top: 30px;
}

.signature-table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    text-align: center;
}

.signature-table td {
    width: 50%;
    padding: 5px;
    vertical-align: top;
    font-size: 12px;
}

.contract-list {
    padding-left: 20px; /* Indenta todo el contenido */
}

.contract-list .list-item {
    text-indent: -20px; /* Hace que el número se alinee correctamente */
    margin-left: 20px;
    margin-bottom: 5px;
}

.contract-list .sub-list {
    padding-left: 30px; /* Indenta los subniveles */
}

    </style>
@php
use Carbon\Carbon;

// Configurar en español si es necesario
setlocale(LC_TIME, 'es_ES.utf8');

// Obtener la fecha actual con el formato deseado
$fecha_actual = Carbon::now()->translatedFormat('d \d\e F \d\e\l Y');
@endphp

</head>
<body>

    <!-- Definición del encabezado que se repetirá en todas las páginas -->
    <htmlpageheader name="pdfHeader">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="left-logo">
                        <img src="{{ public_path('images/globaltech.png') }}" class="logo">
                    </td>
                    <td class="right-logo">
                        <img src="{{ public_path('images/erp_prisma.png') }}" class="logo">
                    </td>
                </tr>
            </table>
            <div class="title">
                ERP PRISMA
            </div>
        </div>
    </htmlpageheader>
<br>
    <!-- Sección del contrato -->
    <div class="contract-title">
        CONTRATO DE IMPLEMENTACIÓN
    </div>
    <div class="contract-title">
        (SISTEMA GESTIÓN EMPRESARIAL INTEGRADO - ERP PRISMA)
    </div>
    <div class="contract-content">
        Conste por el presente documento de Contrato de Licencia de Software que celebran de una parte
        <span class="bold">GLOBALTECH INNOVACIONES S.A.C.</span> con RUC N° <span class="bold">20552260679</span>,
        con domicilio Av. Franklin Delano Roosevelt Nro. 384 Int. 101 cercado De Lima, debidamente representado por
        JACKELINE SHANTAL HUAYTA VILAVILA a quien en adelante se le denominará el <span class="bold">PROVEEDOR</span>,
        y de otra parte; <span class="bold">{{ $empresa['rs'] }}</span> con RUC <span class="bold">{{ $empresa['ruc'] }}</span>,
        con domicilio fiscal {{ $empresa['direccion'] }} debidamente representado por
        {{ $empresa['rep_legal'] }} a quien en adelante se le denominará <span class="bold">CLIENTE</span>, el mismo que está
        interesado en formalizar el presente Contrato de Licencia de Software que se detallan, en los términos y
        condiciones estipulados en el presente contrato:
    </div>
        <!-- Sección de términos de implementación -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                1. TÉRMINOS DE IMPLEMENTACIÓN DE SOFTWARE
            </div>
            <div class="contract-content">
                <span class="bold">GENERALIDADES.</span><br>
                “ERP Prisma” es un Software ERP modular desarrollado por GlobalTech para agilizar los procesos de
                empresas del rubro comercial e Industrial, todos los módulos están basados en un estándar comercial vigente.<br>

                Los módulos están desarrollados en diferentes Lenguajes de programación para el uso adecuado según
                las plataformas más convenientes según sus funciones y herramientas que permitan la máxima explotación de su potencial.
                Todos estos Módulos se Implementan según los requerimientos de los Clientes, los clientes pueden agregar
                los módulos en cuanto lo requieran.<br>

                ERP Prisma está en constante mejora tanto en el desarrollo y Soporte respetando los estándares comerciales
                y normas ISO 27001 y ISO 19001 en la cual GlobalTech está Certificado, por lo tanto, los desarrollos serán
                soluciones innovadoras según las necesidades de sus clientes.
            </div>
        </div>

            <!-- Sección de derechos de instalación y uso -->
            <div class="contract-section">
                <div class="contract-subtitle bold">
                    2. DERECHOS DE INSTALACIÓN Y USO
                </div>
                <div class="contract-content contract-list">
                    <p class="list-item"><span class="bold">2.1</span> El cliente tiene derecho al uso de todos los módulos Suscritos del ERP Prisma en tanto este vigente su suscripción.</p>

                    <p class="list-item"><span class="bold">2.2</span> Tiene derecho de Instalar ERP Prisma Software Principal sin límite en el número de computadoras en las cuales requiera, o en todo caso dependerá de la capacidad del servidor. Siempre que el Software se encuentre en el mismo establecimiento.</p>

                    <p class="list-item"><span class="bold">2.3</span> En caso de equipos móviles, hay control sobre la cantidad de equipos que están trabajando y se rige al plan adquirido, en caso de crecimiento o reducción de reajustará a un nuevo plan.</p>

                    <p class="list-item"><span class="bold">2.4</span> Acceso a portal de Soporte ERP Prisma y el Portal de ayuda acceso a Manuales y cualquier Material didáctico, la misma que deben estar actualizadas por el proveedor, acceso a datos públicos de interés comercial como datos del RUC, DNI, Tipo de Cambio, datos de SBS.</p>

                    <p class="list-item"><span class="bold">2.5</span> El Cliente tiene derecho a descargar la última copia de seguridad de la base de datos desde el portal de Soporte.</p>

                    <p class="list-item"><span class="bold">2.6</span> El Cliente, puede cambiar la contraseña cuando lo requiera la contraseña de la base de datos Principal como a los módulos que manejan credenciales.</p>

                    <p class="list-item"><span class="bold">2.7</span> El Cliente tiene derecho de recibir actualizaciones cuando existan cambios exigidos por entidades del estado.</p>

                    <p class="list-item"><span class="bold">2.8</span> El Cliente tiene acceso a Informarse previamente sobre sobre la actualización de Software y nuevas actualizaciones exigidas por entidades del estado.</p>
                </div>
            </div>
        <!-- Sección de responsabilidades del proveedor -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                3. RESPONSABILIDADES DEL PROVEEDOR EN IMPLEMENTACIÓN.
            </div>
            <div class="contract-content contract-list">
                <p class="list-item"><span class="bold">3.1</span> Instalación y configuración del servidor de base de datos, y recomendaciones para el uso correcto, considerándose como equipo principal.</p>

                <p class="list-item"><span class="bold">3.2</span> El tiempo de Implementación es de 2 días hábiles a partir que el Cliente haya hecho alcance del Información básica, Cartera de Clientes, portafolio de Productos con lista de Precios. En caso no se migre de otras Fuentes, si no hay información a migrar el Proveedor facilitará el sistema para que se registre la Información, tanto clientes y/o productos como considere el Cliente previa coordinación con el Proveedor.</p>

                <p class="list-item"><span class="bold">3.3</span> Migración de información desde otras fuentes relacionada a los datos básicos actuales que cuenta la empresa al momento de la implementación. No incluye Migración de datos históricos, o en todo caso se evalúa la factibilidad y se cotiza al costo del servicio y se planifica el tiempo que implique. Se consideran histórico a información de ventas y compras de base de datos de sistemas que dejaran de usar.</p>

                <p class="list-item"><span class="bold">3.4</span> Capacitación al personal administrativo, y personal que hará uso del sistema en los módulos que comprenda en el área que desempeña el usuario.</p>

                <p class="list-item"><span class="bold">3.5</span> Puesta en marcha del sistema previa prueba piloto con usuarios capacitados, capacitación se realiza de manera virtual y en caso el Cliente requiera presencial el Proveedor asignará a un Personal. Los costos de estadía para caso de Visitas serán asumidos por el Cliente.</p>

                <p class="list-item"><span class="bold">3.6</span> Guardar absoluta confidencialidad de información de interés de la empresa sobre información existente en la base de datos.</p>
            </div>
        </div>

            <!-- Sección de servicios basados en internet -->
            <div class="contract-section">
                <div class="contract-subtitle bold">
                    4. SERVICIOS BASADOS EN INTERNET CON EL SISTEMA “PRISMA” ERP.
                </div>
                <div class="contract-content contract-list">
                    <p class="list-item"><span class="bold">4.1</span> Las conexiones remotas a base de datos del sistema, solo se podrá hacer uso en caso de que se haya instalado y configurado un IP fijo u otro medio de comunicación al servidor de base de datos previamente.</p>
                </div>
            </div>

        <!-- Sección de beneficios del soporte técnico -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                5. BENEFICIOS DEL SERVICIO DE SOPORTE TÉCNICO.
            </div>
            <div class="contract-content">
                <p class="list-item">- Para tener un adecuado servicio de soporte y mantenimiento, es necesario mantener compromiso de ambas partes, para ello se especifica los detalles en los siguientes puntos:</p>
            </div>

            <div class="contract-subtitle bold">
                5.1 RESPONSABILIDADES DEL CLIENTE EN EL SOPORTE Y MANTENIMIENTO.
            </div>
            <div class="contract-content contract-list">
                <p class="list-item"><span class="bold">5.1.1</span> Facilitar acceso al servidor de base de datos para el Seguimiento de tareas automáticas programadas y actualización del software.</p>

                <p class="list-item"><span class="bold">5.1.2</span> Mantener actualizado los datos de contacto, (Nombre, teléfono y correo) en el portal web <a href="https://www.globaltech.pe/soporte/login.php">www.globaltech.pe/soporte/login.php</a> en la misma que también debe estar actualizado usuario secundario de SUNAT (clave secundaria) además, usuario y contraseña para emisión de Guías de remisión electrónica.</p>

                <p class="list-item"><span class="bold">5.1.3</span> Usar el portal para indicar requerimientos o reclamos, donde puede adjuntar imágenes o archivos. Para atenciones menores se usarán las llamadas y WhatsApp.</p>

                <p class="list-item"><span class="bold">5.1.4</span> Asignar a un personal (operador) que coordine con las diferentes áreas de la empresa, (Almacén, Ventas y tesorería, etc.) quien será responsable de coordinar con el personal de soporte Prisma. Solo un personal para no tener controversias, y sus datos deben estar consignados en el portal de soporte.</p>

                <p class="list-item"><span class="bold">5.1.5</span> Contar con un servicio de internet adecuado, para la validación de comprobantes como para brindar el soporte.</p>

                <p class="list-item"><span class="bold">5.1.6</span> Estar pendiente o no ignorar las alertas del sistema, como y tener en cuenta los plazos para la validación de comprobantes.</p>

                <p class="list-item"><span class="bold">5.1.7</span> Mantener los Equipos de cómputo adecuados con Antivirus. En caso del Servidor, con un UPS.</p>

                <p class="list-item"><span class="bold">5.1.8</span> En caso de reemplazar a algún personal operativo, debe ser capacitado con el personal que deja el cargo y sobre ello reforzará el Equipo de soporte.</p>

                <p class="list-item"><span class="bold">5.1.9</span> El horario de atención es de lunes a viernes 9:00am a 6:30 pm (hora de refrigerio 1:00pm a 2:00pm), y sábados de 9:00am a 2:00 pm.</p>

                <p class="list-item"><span class="bold">5.1.10</span> Para casos de emergencia y fuera del horario de trabajo como domingos y feriados, se asigna un número de celular desde donde serán atendidos. Esta atención será exclusiva para casos de <span class="bold">INCIDENCIAS DE “PRISMA” ERP</span>, más no para requerimientos, ni solicitudes de soluciones a largo plazo.</p>
            </div>
        </div>


            <!-- Sección de responsabilidades del proveedor en soporte y mantenimiento -->
            <div class="contract-section">
                <div class="contract-subtitle bold">
                    5.2 RESPONSABILIDADES DEL PROVEEDOR EN EL SOPORTE Y MANTENIMIENTO.
                </div>
                <div class="contract-content contract-list">
                    <p class="list-item"><span class="bold">5.2.1</span> Disponer el portal de Soporte ERP Prisma y portal web de Ayuda
                        <a href="http://www.globaltech.pe/ayuda/">http://www.globaltech.pe/ayuda/</a> en donde se publica las Novedades, Preguntas Frecuentes, Manuales, Video Tutoriales, Instaladores, y se publica los teléfonos del personal de soporte.</p>

                    <p class="list-item"><span class="bold">5.2.2</span> Disponer la última Copia de Seguridad de la Base de datos, en el portal de Soporte, a la misma que solo puede acceder los usuarios con perfil gerente.</p>

                    <p class="list-item"><span class="bold">5.2.3</span> Actualizar Formatos de reportes, Libros electrónicos, PDTs, previamente antes que entre en vigencia la norma.</p>

                    <p class="list-item"><span class="bold">5.2.4</span> Asistencia por conexión remota para casos que no se pueda resolver por llamada o por WhatsApp.</p>

                    <p class="list-item"><span class="bold">5.2.5</span> Actualización a través de sentencia e instrucciones que se actualizará en el servidor mediante archivos adjuntos enviados por correo electrónico.</p>

                    <p class="list-item"><span class="bold">5.2.6</span> Enviar alertas o Informar sobre eventos que no sean coherentes en el sistema, las misma que se deben tratar.</p>

                    <p class="list-item"><span class="bold">5.2.7</span> Apoyo para obtener las consultas para que sean necesarias para otras áreas que no cuente el software.</p>
                </div>
            </div>

    <!-- Sección de exclusiones de la garantía -->
    <div class="contract-section">
        <div class="contract-subtitle bold">
            6. EXCLUSIONES DE LA GARANTÍA.
        </div>
        <div class="contract-content contract-list">
            <p class="list-item"><span class="bold">6.1</span> Esta garantía no cubre los problemas causados por acciones u omisiones, acciones de terceros o eventos más allá del control razonable que pueda realizar el sistema, el presente contrato no cubrirá la solución de aquellos problemas surgidos por mal uso del programa, fallo de la red informática u ordenador, virus informáticos y cualquier causa diferente al uso del programa. Las soluciones de este tipo de actos serán evaluados y cotizados previamente para ser solucionados en caso sea factible.</p>
        </div>
    </div>

        <!-- Sección de limitación de licencia y garantías -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                7. LIMITACIÓN DE LICENCIA Y GARANTÍAS
            </div>
            <div class="contract-content contract-list">
                <p class="list-item"><span class="bold">7.1</span> No podrá realizar copias o instalaciones en otras empresas, el Sistema es de uso exclusivo con la empresa contratante/cliente.</p>

                <p class="list-item"><span class="bold">7.2</span> Eludir las limitaciones técnicas del Software.</p>

                <p class="list-item"><span class="bold">7.3</span> Utilizar técnicas de ingeniería inversa, descompilar o desensamblar el software, excepto y únicamente en la medida en que ello esté expresamente permitido por la ley a pesar de la presente limitación.</p>

                <p class="list-item"><span class="bold">7.4</span> Hacer más copias del software de las que especifica este contrato o permite la legislación vigente a pesar de esta limitación.</p>

                <p class="list-item"><span class="bold">7.5</span> Hacer público el software para que otros lo copien, alquilar, arrendar o ceder el software.</p>

                <p class="list-item"><span class="bold">7.6</span> Utilizar el software para prestar servicios de alojamiento de software comercial.</p>
            </div>
        </div>

            <!-- Sección de acuerdo de confidencialidad -->
            <div class="contract-section">
                <div class="contract-subtitle bold">
                    8. ACUERDO DE CONFIDENCIALIDAD.
                </div>
                <div class="contract-content contract-list">
                    <p class="list-item"><span class="bold">8.1</span> Las Partes se obligan a no revelar, ni permitir que sea revelada a terceros la Información Confidencial. A mayor abundamiento, Las Partes se obligan a:</p>

                    <div class="sub-list">
                        <p class="list-item"><span class="bold">8.1.1</span> Adoptar las medidas adecuadas para garantizar el carácter secreto de la Información Confidencial de manera que no pase ésta a dominio público ni sea conocida por terceros. Dichas medidas deberán adecuarse a la diligencia máxima que cada Parte emplee para salvaguardar la confidencialidad de su propia información, y que en ningún caso será inferior a la diligencia de un ordenado empresario.</p>

                        <p class="list-item"><span class="bold">8.1.2</span> Revelar la Información Confidencial solamente a aquellas personas y entidades que deban tener acceso a la misma durante la Colaboración; y solamente cuando éstas estén sujetas a un compromiso de confidencialidad en virtud del cual se obliguen a preservar la Información Confidencial en términos al menos similares a los previstos en este Acuerdo.</p>
                    </div>

                    <p class="list-item"><span class="bold">8.2</span> No constituye incumplimiento de las obligaciones asumidas en la cláusula 8.1 la comunicación o transmisión de Información Confidencial tras requerimiento expreso por algún organismo o ente público con jurisdicción sobre Las Partes; siempre y cuando la Parte que deba revelar la Información Confidencial:</p>

                    <div class="sub-list">
                        <p class="list-item"><span class="bold">8.2.1</span> Lo comunique previamente a la otra Parte;</p>

                        <p class="list-item"><span class="bold">8.2.2</span> Revele solamente aquellas partes de la Información Confidencial que esté legalmente obligada a revelar; y</p>

                        <p class="list-item"><span class="bold">8.2.3</span> Procure, en la medida de lo posible, obtener un compromiso de confidencialidad por parte del organismo o ente público correspondiente.</p>
                    </div>

                    <p class="list-item"><span class="bold">8.3</span> Las Partes se obligan expresamente a utilizar la Información Confidencial en el contexto de la Colaboración solamente, comprometiéndose a no darle ninguna otra finalidad ni usarla en beneficio propio a expensas de quien la proporcionó.</p>

                    <p class="list-item"><span class="bold">8.4</span> Las Partes se obligan a devolver o destruir a requerimiento de la otra Parte todos los documentos que contengan Información Confidencial con independencia de quien los haya generado; y a suministrar a la otra Parte durante los siete (7) días siguientes al referido requerimiento un certificado firmado atestiguando que todos los documentos que contenían Información Confidencial han sido devueltos o destruidos de acuerdo con lo previsto en esta cláusula 8.4. Cada una de las Partes se obliga igualmente a borrar con carácter definitivo y a requerimiento de la otra Parte toda la Información Confidencial guardada en archivos electrónicos.</p>
                </div>
            </div>

        <!-- Sección de propiedad de la información confidencial -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                9. PROPIEDAD DE LA INFORMACIÓN CONFIDENCIAL
            </div>
            <div class="contract-content contract-list">
                <p class="list-item"><span class="bold">9.1</span> Las Partes reconocen expresamente que la Información Confidencial es titularidad única y exclusiva de la otra Parte y que la celebración de este Acuerdo no le otorga derecho alguno sobre la Información Confidencial, excepto el derecho de utilizarla dentro de las limitaciones establecidas en la cláusula 8.</p>
            </div>
        </div>


        <!-- Sección de ley aplicable y resolución de controversias -->
        <div class="contract-section">
            <div class="contract-subtitle bold">
                10. LEY APLICABLE Y RESOLUCIÓN DE CONTROVERSIAS.
            </div>
            <div class="contract-content contract-list">
                <p class="list-item"><span class="bold">10.1</span> Este acuerdo se regirá por la legislación peruana y las Partes renuncian expresamente al fuero judicial que pudiera corresponderles, de manera que cualquier cuestión que se plantee entre ellas en relación con la interpretación y cumplimiento de este Acuerdo se someterá a arbitraje de derecho, bajo la organización y administración del Centro de Arbitraje de la Cámara de Comercio de Lima y conforme a su estatuto, reglamentos. Cualquier procedimiento arbitral en relación con este Acuerdo se dilucidará en idioma castellano, y Las Partes se comprometen, asimismo, a cumplir el laudo arbitral que en su caso se dicte y que tendrá carácter firme y ejecutivo.</p>
            </div>
        </div>
            <!-- Sección de cierre del documento -->
    <div class="contract-section">
        <div class="contract-content">
            <p>Ambas partes se ratifican en el contenido del presente documento, y no habiendo mediado de la voluntad que pueda anularlo, lo firman en señal de conformidad, por duplicado.<br></p>
        </div>
    <div class="contract-content text-right">
        <p><br>Celebrado en la Ciudad de Lima, el {{ $fecha_actual }}</p>
    </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
        <!-- Sección de firmas -->
        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td><img src="{{ public_path('images/sellogt1.png') }}"></td>
                    <td class="bold"></td>
                </tr>
                <tr>
                    <td class="signature-line">_________________________________</td>
                    <td class="signature-line">_________________________________</td>
                </tr>
                <tr>
                    <td class="bold">PROVEEDOR</td>
                    <td class="bold">CLIENTE</td>
                </tr>
                <tr>
                    <td>GLOBALTECH INNOVACIONES S.A.C.</td>
                    <td>{{ $empresa['rs'] }}</td>
                </tr>
                <tr>
                    <td>JACKELINE SHANTAL HUAYTA VILAVILA</td>
                    <td>{{ $empresa['rep_legal'] }}</td>
                </tr>
                <tr>
                    <td>DNI: 44604340</td>
                    <td>DNI: {{ $empresa['rep_nrodi'] }}</td>
                </tr>
                <tr>
                    <td>GERENTE GENERAL</td>
                    <td>GERENTE GENERAL</td>
                </tr>
            </table>
        </div>


</body>
</html>


