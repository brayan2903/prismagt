<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { PieChartOutlined, BarChartOutlined, UserOutlined, ShoppingOutlined } from '@ant-design/icons-vue';

// Datos ficticios
const stats = ref([
  { title: 'Usuarios Activos', value: 1500, icon: UserOutlined, color: 'blue', percent: 80 },
  { title: 'Ventas Totales', value: '$25,000', icon: ShoppingOutlined, color: 'green', percent: 60 },
  { title: 'Órdenes Procesadas', value: 320, icon: BarChartOutlined, color: 'orange', percent: 90 },
  { title: 'Tasa de Retención', value: '87%', icon: PieChartOutlined, color: 'purple', percent: 70 },
]);

// Datos para los círculos de progreso
const circleStats = ref([
  { title: 'Usuarios Nuevos', value: 75, color: 'cyan' },
  { title: 'Conversiones', value: 50, color: 'magenta' },
  { title: 'Satisfacción', value: 90, color: 'lime' },
]);
</script>

<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Datos de prueba (simulado)</h2>
      </div>
    <div class="p-6 bg-gray-100">

      <!-- Tarjetas con Barras de Progreso -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a-card
          v-for="(stat, index) in stats"
          :key="index"
          class="shadow"
          :style="{ borderLeft: `5px solid ${stat.color}` }"
        >
          <template #title>
            <component :is="stat.icon" class="text-2xl" />
            <span class="ml-2">{{ stat.title }}</span>
          </template>
          <p class="text-3xl font-bold">{{ stat.value }}</p>
          <a-progress :percent="stat.percent" :stroke-color="stat.color" />
        </a-card>
      </div>

      <!-- Tarjetas con Círculos de Progreso -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <a-card v-for="(stat, index) in circleStats" :key="index" class="shadow text-center">
          <h3 class="text-lg font-semibold mb-2">{{ stat.title }}</h3>
          <a-progress type="circle" :percent="stat.value" :stroke-color="stat.color" />
        </a-card>
      </div>

      <!-- Sección de Resumen -->
      <div class="mt-8 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">Resumen de Actividad</h3>
        <p>Aquí puedes agregar gráficos o datos adicionales.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
