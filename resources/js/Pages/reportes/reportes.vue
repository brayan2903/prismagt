<template>
    <AuthenticatedLayout>
      <template #header>
        <h1>Generación de Reportes</h1>
      </template>

      <div>
        <!-- Generar Reporte de Contrato -->
        <a-card title="Generar Reporte de Contrato" style="margin-bottom: 20px;">
          <a-row :gutter="[16, 16]">
            <a-col :xs="24" :sm="16" :md="12" :lg="8">
              <a-input v-model:value="ruc" placeholder="Ingrese el RUC" />
            </a-col>
            <a-col :xs="24" :sm="8" :md="6" :lg="4">
              <a-button type="primary" block @click="descargarContrato">
                Contrato PDF
              </a-button>
            </a-col>
          </a-row>
          <p v-if="errorMensajeContrato" style="color: red; margin-top: 10px;">{{ errorMensajeContrato }}</p>
        </a-card>

        <!-- Generar Reporte de Cotización -->
        <a-card title="Generar Reporte de Cotización">
          <a-row :gutter="[16, 16]">
            <a-col :xs="24" :sm="16" :md="12" :lg="8">
              <a-input v-model:value="cotizacion" placeholder="Ingrese el Número de Cotización" />
            </a-col>
            <a-col :xs="24" :sm="8" :md="6" :lg="4">
              <a-button type="primary" block @click="descargarCotizacion">
                Cotización PDF
              </a-button>
            </a-col>
            <a-col :xs="24" :sm="8" :md="6" :lg="4">
              <a-button type="primary" block @click="descargarCombinado">
                Contrato PDF
              </a-button>
            </a-col>
          </a-row>
          <p v-if="errorMensajeCotizacion" style="color: red; margin-top: 10px;">{{ errorMensajeCotizacion }}</p>
        </a-card>
      </div>
    </AuthenticatedLayout>
  </template>

  <script>
  import { defineComponent, ref } from "vue";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { FilePdfOutlined } from '@ant-design/icons-vue';

  export default defineComponent({
    name: "Reportes",
    components: {
      AuthenticatedLayout,
      FilePdfOutlined,
    },
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

      // Función para descargar el reporte combinado
      const descargarCombinado = () => {
        if (!cotizacion.value) {
          errorMensajeCotizacion.value = "Por favor, ingrese un número de cotización válido.";
          return;
        }
        errorMensajeCotizacion.value = "";
        window.open(`/reporte-combinado/${cotizacion.value}`, "_blank");
      };

      return {
        ruc,
        errorMensajeContrato,
        descargarContrato,
        cotizacion,
        errorMensajeCotizacion,
        descargarCotizacion,
        descargarCombinado,
      };
    },
  });
  </script>
