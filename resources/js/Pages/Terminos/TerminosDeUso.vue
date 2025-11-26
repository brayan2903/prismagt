<template>
  <div class="min-h-screen bg-gray-100 flex flex-col items-center pt-6 sm:pt-0">

    <Head title="Términos y Condiciones" />

    <div class="w-full bg-white shadow-sm py-4 mb-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
         <h1 class="text-xl font-bold text-gray-800">ERP PRISMA</h1>
      </div>
    </div>

    <div class="w-full max-w-7xl sm:px-6 lg:px-8 mb-12">

      <a-card :bordered="false" class="shadow-md rounded-lg" style="width: 100%;">

        <div class="text-center border-b pb-6 mb-8">
          <h2 class="text-3xl font-bold text-gray-900">Términos y Condiciones de Uso</h2>
          <p class="text-gray-500 mt-2 text-lg">Acuerdo de Licencia y Soporte</p>
        </div>

        <div class="mb-10">
          <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
            <span class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
              <span class="h-3 w-3 bg-blue-600 rounded-full"></span>
            </span>
            Beneficios del Servicio de Soporte Técnico
          </h3>

          <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
              <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Responsabilidades del Cliente</h4>
              <ul class="list-disc pl-5 space-y-2 text-gray-700 text-justify">
                <li>Facilitar acceso al servidor para el seguimiento de tareas automáticas y actualización del software.</li>
                <li>Mantener actualizados los datos de contacto y claves secundarias de SUNAT en el portal web.</li>
                <li>Usar el portal oficial para indicar requerimientos o reclamos, adjuntando imágenes. Las llamadas se usarán para atenciones menores.</li>
                <li>Asignar a un solo personal responsable de coordinar con el soporte para evitar controversias.</li>
                <li>Contar con un servicio de internet adecuado y mantener los equipos con Antivirus. El servidor debe tener un UPS.</li>
                <li>Respetar el horario de atención: Lunes a Viernes (9:00am a 6:30pm) y sábados (9:00am a 2:00pm).</li>
              </ul>
            </div>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
              <h4 class="font-bold text-gray-800 mb-4 border-b pb-2 border-blue-200">Responsabilidades del Proveedor</h4>
              <ul class="list-disc pl-5 space-y-2 text-gray-700 text-justify">
                <li>Disponer del Portal de Soporte con novedades, preguntas frecuentes, manuales y videos tutoriales.</li>
                <li>Disponer la última copia de seguridad de la base de datos (acceso exclusivo para gerencia).</li>
                <li>Actualizar formatos de reportes y libros electrónicos previamente antes de que entre en vigencia la norma.</li>
                <li>Brindar asistencia por conexión remota y actualizaciones mediante archivos enviados por correo.</li>
                <li>Enviar alertas o informar sobre eventos que no sean coherentes en el sistema.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="mb-10">
          <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center">
            <span class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
              <span class="h-3 w-3 bg-red-600 rounded-full"></span>
            </span>
            Exclusiones de la Garantía
          </h3>
          <div class="bg-white p-5 border-l-4 border-red-500 shadow-sm">
            <p class="text-gray-700 mb-2 text-justify">
              La garantía <strong>no cubre</strong> los problemas causados por acciones u omisiones, acciones de terceros o eventos más allá del control razonable. Específicamente no cubre:
            </p>
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
              <li>Mal uso del programa.</li>
              <li>Fallo de la red informática u ordenador.</li>
              <li>Virus informáticos.</li>
            </ul>
            <p class="text-sm text-gray-500 mt-3 italic">
              * Las soluciones para este tipo de actos serán evaluadas y cotizadas previamente para ser solucionados en caso sea factible.
            </p>
          </div>
        </div>

        <div class="mb-10">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
              <span class="h-3 w-3 bg-gray-600 rounded-full"></span>
            </span>
            Limitación de Licencia y Garantías
          </h3>
          <p class="mb-4 text-gray-600">El sistema es de uso exclusivo con la empresa contratante. Queda prohibido:</p>

          <div class="grid sm:grid-cols-2 gap-4">
            <div class="p-4 border rounded hover:bg-gray-50 transition">
              <strong class="text-gray-900 block mb-1">Copias</strong>
              <span class="text-gray-600 text-sm">No realizar copias o instalaciones en otras empresas.</span>
            </div>
            <div class="p-4 border rounded hover:bg-gray-50 transition">
              <strong class="text-gray-900 block mb-1">Ingeniería Inversa</strong>
              <span class="text-gray-600 text-sm">No utilizar técnicas de ingeniería inversa, descompilar o desensamblar el software.</span>
            </div>
            <div class="p-4 border rounded hover:bg-gray-50 transition">
              <strong class="text-gray-900 block mb-1">Distribución</strong>
              <span class="text-gray-600 text-sm">No alquilar, arrendar, ceder o hacer público el software para que otros lo copien.</span>
            </div>
            <div class="p-4 border rounded hover:bg-gray-50 transition">
              <strong class="text-gray-900 block mb-1">Hosting</strong>
              <span class="text-gray-600 text-sm">No utilizar el software para prestar servicios de alojamiento comercial.</span>
            </div>
          </div>
        </div>

        <div class="mb-8">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <span class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
              <span class="h-3 w-3 bg-yellow-600 rounded-full"></span>
            </span>
            Acuerdo de Confidencialidad
          </h3>
          <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
            <p class="text-gray-800 text-justify mb-3">
              Las Partes se obligan a no revelar Información Confidencial a terceros y a adoptar las medidas adecuadas para garantizar su carácter secreto. Solo se revelará a aquellas personas indispensables que estén sujetas a un compromiso de confidencialidad.
            </p>
            <hr class="border-yellow-200 my-3">
            <p class="text-sm text-gray-700 font-semibold">
              Devolución de Información: Al finalizar, las partes se obligan a devolver o destruir los documentos confidenciales en un plazo de siete (7) días y borrar archivos electrónicos definitivamente.
            </p>
          </div>
        </div>

        <div class="text-center mt-12">
          <a-button type="primary" size="large" href="/" style="padding-left: 40px; padding-right: 40px;">
            Volver al Inicio
          </a-button>
        </div>

      </a-card>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from '@inertiajs/vue3';
import { Card, Button } from 'ant-design-vue';

export default defineComponent({
  name: "TerminosDeUso",
  components: {
    Head,
    'a-card': Card,
    'a-button': Button
  },
});
</script>

<style scoped>
.ant-card-body {
    padding: 2rem !important;
}
</style>
