<template>
    <AuthenticatedLayout>
      <template #header>
        <h1>Generación de Reportes</h1>
      </template>

      <div>
        <!-- Generar Reporte de Contrato -->
        <a-card title="Generar Reporte de Contrato" style="margin-bottom: 20px;">
          <a-space>
            <a-input v-model:value="ruc" placeholder="Ingrese el RUC" style="width: 250px" />
            <a-button type="primary" @click="descargarContrato" >
              Generar Contrato PDF
            </a-button>
          </a-space>
          <p v-if="errorMensajeContrato" style="color: red; margin-top: 10px;">{{ errorMensajeContrato }}</p>
        </a-card>

        <!-- Generar Reporte de Cotización -->
        <a-card title="Generar Reporte de Cotización">
          <a-space>
            <a-input v-model:value="cotizacion" placeholder="Ingrese el Número de Cotización" style="width: 250px" />
            <a-button type="primary" @click="descargarCotizacion">
              Generar Cotización PDF
            </a-button>
          </a-space>
          <p v-if="errorMensajeCotizacion" style="color: red; margin-top: 10px;">{{ errorMensajeCotizacion }}</p>
        </a-card>
      </div>
    </AuthenticatedLayout>
  </template>

  <script>
  import { defineComponent, ref } from "vue";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

  export default defineComponent({
    name: "Reportes",
    components: { AuthenticatedLayout },
    setup() {
      // Variables para el contrato
      const ruc = ref("");
      const errorMensajeContrato = ref("");

      // Variables para la cotización
      const cotizacion = ref("");
      const errorMensajeCotizacion = ref("");

      // Función para descargar el contrato
      const descargarContrato = () => {
        if (ruc.value.length !== 11) {
          errorMensajeContrato.value = "Por favor, ingrese un RUC válido de 11 dígitos.";
          return;
        }
        errorMensajeContrato.value = "";
        window.open(`/contrato/${ruc.value}`, "_blank");
      };

      // Función para descargar la cotización
      const descargarCotizacion = () => {
        if (!cotizacion.value) {
          errorMensajeCotizacion.value = "Por favor, ingrese un número de cotización válido.";
          return;
        }
        errorMensajeCotizacion.value = "";
        window.open(`/cotizacion/${cotizacion.value}`, "_blank");
      };

      return {
        ruc, errorMensajeContrato, descargarContrato,
        cotizacion, errorMensajeCotizacion, descargarCotizacion
      };
    },
  });
  </script>
