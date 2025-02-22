<template>
    <AuthenticatedLayout>
      <template #header>
        <h1>Clientes por Facturar</h1>
      </template>

      <div>
        <!-- Selector de Año y Mes -->
        <a-space>
          <a-select v-model:value="anio" placeholder="Seleccione Año">
            <a-select-option v-for="year in aniosDisponibles" :key="year" :value="year">
              {{ year }}
            </a-select-option>
          </a-select>

          <a-select v-model:value="mes" placeholder="Seleccione Mes">
            <a-select-option v-for="month in mesesDisponibles" :key="month" :value="month">
              {{ month }}
            </a-select-option>
          </a-select>

          <a-button type="primary" @click="getClientes">Buscar</a-button>
        </a-space>

        <a-table :dataSource="clientes" :columns="columns" :rowKey="'Anx_Id'" bordered>
          <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex === 'Anx_Id'">{{ record.Anx_Id }}</template>
            <template v-else-if="column.dataIndex === 'NroDI'">{{ record.NroDI }}</template>
            <template v-else-if="column.dataIndex === 'Raz_Soc'">{{ record.Raz_Soc }}</template>
            <template v-else-if="column.dataIndex === 'OtraPropiedad'">{{ record.OtraPropiedad }}</template>
          </template>
        </a-table>
      </div>
    </AuthenticatedLayout>
  </template>


  <script>
  import axios from 'axios';
  import { defineComponent, ref, computed, onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  export default defineComponent({
    name: 'Clientes',
    components: {
      AuthenticatedLayout,
    },
    setup() {
      const clientes = ref([]);
      const anio = ref(new Date().getFullYear()); // Año actual
      const mes = ref((new Date().getMonth() + 1).toString().padStart(2, '0')); // Mes actual
      const aniosDisponibles = ref([2023, 2024, 2025, 2026]); // Años disponibles
      const mesesDisponibles = ref(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']); // Meses

      const columns = ref([
        { title: 'Anx_Id', dataIndex: 'Anx_Id', key: 'Anx_Id' },
        { title: 'RUC', dataIndex: 'NroDI', key: 'NroDI' },
        { title: 'Razón Social', dataIndex: 'Raz_Soc', key: 'Raz_Soc' },
        { title: 'Productos (prds)', dataIndex: 'prds', key: 'prds' },
        { title: 'Moneda (Mnd)', dataIndex: 'Mnd', key: 'Mnd' },
        { title: 'Importe (Imp)', dataIndex: 'Imp', key: 'Imp' },
        { title: 'Provincia', dataIndex: 'Provincia', key: 'Provincia' },
        { title: 'Distrito', dataIndex: 'Distrito', key: 'Distrito' },
        ]);


      // Generar el parámetro AñoMes dinámico
      const anioMes = computed(() => `${anio.value}${mes.value}`);

      const getClientes = async () => {
        try {
          const response = await axios.get('/clientes/por-facturar', {
            params: { anio_mes: anioMes.value },
          });
          clientes.value = response.data;
        } catch (error) {
          console.error('Error al obtener los clientes:', error);
        }
      };

      onMounted(() => {
        getClientes(); // Carga inicial con el mes y año actual
      });

      return {
        clientes,
        columns,
        anio,
        mes,
        aniosDisponibles,
        mesesDisponibles,
        getClientes,
      };
    },
  });
  </script>
