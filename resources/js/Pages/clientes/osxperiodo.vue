<template>
    <AuthenticatedLayout>
      <template #header>
        <h1>Clientes por Periodo</h1>
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

        <!-- Tabla con Resultados -->
        <a-table :dataSource="clientes" :columns="columns" :rowKey="'IdDoc'" bordered>
          <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex === 'IdDoc'">{{ record.IdDoc }}</template>
            <template v-else-if="column.dataIndex === 'NroDI'">{{ record.NroDI }}</template>
            <template v-else-if="column.dataIndex === 'Rz_Social'">{{ record.Rz_Social }}</template>
            <template v-else-if="column.dataIndex === 'Documento'">{{ record.Documento }}</template>
            <template v-else-if="column.dataIndex === 'NroMR'">{{ record.NroMR }}</template>
            <template v-else-if="column.dataIndex === 'sMnd'">{{ record.sMnd }}</template>
            <template v-else-if="column.dataIndex === 'Total'">{{ record.Total }}</template>
            <template v-else-if="column.dataIndex === 'Saldo'">{{ record.Saldo }}</template>
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
    name: 'OsxPeriodo',
    components: {
        AuthenticatedLayout,
    },
    setup() {
        const clientes = ref([]);
        const anio = ref(new Date().getFullYear()); // Año actual
        const mes = ref((new Date().getMonth() + 1).toString().padStart(2, '0')); // Mes actual
        const aniosDisponibles = ref([2023, 2024, 2025]); // Años disponibles
        const mesesDisponibles = ref(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']); // Meses

        const columns = ref([
            { title: 'ID Documento', dataIndex: 'IdDoc', key: 'IdDoc' },
            { title: 'Número Documento Identidad', dataIndex: 'NroDI', key: 'NroDI' },
            { title: 'Razón Social', dataIndex: 'Rz_Social', key: 'Rz_Social' },
            { title: 'Documento', dataIndex: 'Documento', key: 'Documento' },
            { title: 'Número MR', dataIndex: 'NroMR', key: 'NroMR' },
            { title: 'Moneda', dataIndex: 'sMnd', key: 'sMnd' },
            { title: 'Total', dataIndex: 'Total', key: 'Total' },
            { title: 'Saldo', dataIndex: 'Saldo', key: 'Saldo' },
        ]);

        // Generar el parámetro AñoMes dinámico
        const anioMes = computed(() => `${anio.value}${mes.value}`);

        const getClientes = async () => {
            try {
                const response = await axios.get('/api/clientes/osxperiodo', {
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
