<template>
  <AuthenticatedLayout>
    <template #header>
      <h1 class="text-xl font-bold">Historial Estadístico por Empresa</h1>
    </template>

    <div class="p-6 bg-white shadow rounded-lg m-4">
      <a-row :gutter="16" class="mb-6">
        <a-col :span="12">
          <label class="block mb-1 font-semibold">Empresa (RUC o Razón Social):</label>
          <a-select
            v-model:value="filtros.ruc"
            show-search
            placeholder="Escriba para buscar..."
            style="width: 100%"
            :default-active-first-option="false"
            :filter-option="false"
            :not-found-content="fetching ? undefined : 'No encontrado'"
            :options="opcionesEmpresas"
            @search="handleSearchEmpresa"
            @change="cargarDatos"
          >
            <template v-if="fetching" #notFoundContent>
              <a-spin size="small" />
            </template>
          </a-select>
        </a-col>

        <a-col :span="6">
          <label class="block mb-1 font-semibold">Tipo:</label>
          <a-select
            v-model:value="filtros.tipo"
            style="width: 100%"
            placeholder="Todos"
            allowClear
            @change="cargarDatos"
          >
            <a-select-option v-for="t in listaTipos" :key="t.tipo" :value="t.tipo">
              {{ t.tipo }}
            </a-select-option>
          </a-select>
        </a-col>
      </a-row>

      <div v-if="datosCargados" class="h-96 w-full mb-8 p-4 border border-gray-100 rounded-xl bg-gray-50/50">
        <Bar :data="chartData" :options="chartOptions" />
      </div>
      <div v-else class="text-center text-gray-400 mt-10 mb-10 border-2 border-dashed border-gray-200 p-10 rounded">
        <p class="text-lg">Seleccione una empresa para visualizar el gráfico estadístico.</p>
      </div>

      <div v-if="datosCargados">
         <a-divider orientation="left">Detalle de Registros</a-divider>
         <a-table
            :dataSource="rawData"
            :columns="columns"
            size="small"
            bordered
            :rowKey="(record) => record.periodo + record.tipo"
            :pagination="{ pageSize: 6 }"
          >
            <template #bodyCell="{ column, record }">
                <template v-if="column.dataIndex === 'periodo'">
                    <span class="font-bold text-gray-600">{{ formatearPeriodoTexto(record.periodo) }}</span>
                </template>
                <template v-else-if="column.dataIndex === 'imp'">
                    S/ {{ parseFloat(record.imp).toFixed(2) }}
                </template>
            </template>
         </a-table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import { debounce } from 'lodash';

// Importaciones de Chart.js
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js';
import { Bar } from 'vue-chartjs';
import ChartDataLabels from 'chartjs-plugin-datalabels'; // Importar Plugin

// Registrar componentes y el plugin de etiquetas
ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ChartDataLabels
);

// --- ESTADO ---
const filtros = reactive({ ruc: undefined, tipo: undefined });
const rawData = ref([]);
const listaTipos = ref([]);
const opcionesEmpresas = ref([]);
const datosCargados = ref(false);
const fetching = ref(false);

const yearColors = {
    '2023': '#3b82f6', // Blue 500
    '2024': '#10b981', // Emerald 500
    '2025': '#f59e0b', // Amber 500
    '2026': '#ef4444', // Red 500
    'default': '#94a3b8'
};

const columns = [
  { title: 'Periodo', dataIndex: 'periodo', key: 'periodo' },
  { title: 'Tipo', dataIndex: 'tipo', key: 'tipo' },
  { title: 'Cantidad', dataIndex: 'cant', key: 'cant', align: 'center' },
  { title: 'Importe Total', dataIndex: 'imp', key: 'imp', align: 'right' },
];

// --- FORMATOS ---
const obtenerMesNombre = (mesStr) => {
    const meses = ["", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    return meses[parseInt(mesStr)] || mesStr;
};

const formatearPeriodoGrafico = (periodoStr) => {
    if (!periodoStr || periodoStr.length !== 6) return periodoStr;
    return `${obtenerMesNombre(periodoStr.substring(4, 6))}-${periodoStr.substring(2, 4)}`;
};

const formatearPeriodoTexto = (periodoStr) => {
    if (!periodoStr || periodoStr.length !== 6) return periodoStr;
    return `${obtenerMesNombre(periodoStr.substring(4, 6))} ${periodoStr.substring(0, 4)}`;
};

// --- CONFIGURACIÓN GRÁFICO (CON DATALABELS) ---
const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  layout: {
    padding: {
      top: 30 // Espacio extra arriba para que el número no se corte
    }
  },
  plugins: {
    legend: { display: false },
    datalabels: {
      anchor: 'end',      // Anclado al final de la barra
      align: 'top',       // Posición arriba de la barra
      offset: 4,          // Espacio entre la barra y el número
      color: '#475569',   // Color Slate 600
      font: {
        weight: 'bold',
        size: 13
      },
      formatter: (value) => value > 0 ? value : '' // No mostrar si es 0
    },
    tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.8)',
      padding: 12
    }
  },
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        color: '#f1f5f9' // Líneas horizontales muy suaves
      },
      border: { display: false }
    },
    x: {
      grid: { display: false }, // Sin líneas verticales
      ticks: {
        color: '#64748b',
        font: { weight: '500' }
      }
    }
  }
};

const chartData = computed(() => {
  const labels = rawData.value.map(item => formatearPeriodoGrafico(item.periodo));
  const dataValues = rawData.value.map(item => item.cant);
  const backgroundColors = rawData.value.map(item => {
      const anio = item.periodo.substring(0, 4);
      return yearColors[anio] || yearColors['default'];
  });

  return {
    labels,
    datasets: [{
        data: dataValues,
        backgroundColor: backgroundColors,
        borderRadius: 6,        // Barras redondeadas
        barPercentage: 0.6,     // Grosor de la barra
    }]
  };
});

// --- MÉTODOS API ---
const cargarTipos = async () => {
    try {
        const res = await axios.get('/api/obtener-tipos');
        listaTipos.value = res.data;
    } catch (e) { console.error(e); }
};

const handleSearchEmpresa = debounce(async (val) => {
    if (!val || val.length < 2) return;
    fetching.value = true;
    try {
        const res = await axios.get('/api/buscar-empresas', { params: { q: val } });
        opcionesEmpresas.value = res.data;
    } catch (e) { console.error(e); }
    finally { fetching.value = false; }
}, 500);

const cargarDatos = async () => {
  if (!filtros.ruc) return;
  try {
    const res = await axios.get('/api/historial-empresa', {
      params: { ruc: filtros.ruc, tipo: filtros.tipo }
    });
    rawData.value = res.data;
    datosCargados.value = rawData.value.length > 0;
  } catch (e) { console.error(e); }
};

onMounted(() => {
    cargarTipos();
    handleSearchEmpresa('');
});
</script>

<style scoped>
/* Estilo para que el contenedor del gráfico se vea más profesional */
canvas {
  filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.05));
}
</style>
