<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Auditoría de Membresías (Catálogo vs Realidad)</h1>
        <a-tag color="blue">Valores en Dólares (USD)</a-tag>
      </div>
    </template>

    <div class="p-6 bg-white shadow rounded-lg m-4">

      <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
        <a-row :gutter="[16, 16]" align="bottom">
          <a-col :span="8">
            <label class="block font-bold mb-1 text-gray-600">Producto:</label>
            <a-select
                v-model:value="filtros.prd_id"
                show-search
                placeholder="Seleccione Producto"
                style="width: 100%"
                :options="listaProductos"
                :filter-option="filterOption"
            />
          </a-col>

          <a-col :span="4">
             <label class="block font-bold mb-1 text-gray-600">Tipo Historial:</label>
             <a-select
                v-model:value="filtros.tipo"
                style="width: 100%"
                placeholder="Ej: vend"
                :options="listaTipos"
                :field-names="{ label: 'TIPO', value: 'TIPO' }"
             />
          </a-col>

          <a-col :span="3">
             <label class="block font-bold mb-1 text-gray-600">Año:</label>
             <a-select v-model:value="filtros.anio" style="width: 100%">
                <a-select-option value="2025">2025</a-select-option>
                <a-select-option value="2024">2024</a-select-option>
                <a-select-option value="2026">2026</a-select-option>
             </a-select>
          </a-col>

          <a-col :span="5">
             <label class="block font-bold mb-1 text-gray-600">Mes:</label>
             <a-select v-model:value="filtros.mes" style="width: 100%" :options="mesesSelect" />
          </a-col>

          <a-col :span="4">
            <a-button type="primary" block size="large" @click="consultar" :loading="loading">
              AUDITAR
            </a-button>
          </a-col>
        </a-row>
      </div>

      <div v-if="datos.length > 0" class="mb-4">
        <a-input-search
          v-model:value="filtroTexto"
          placeholder="Buscar por Razón Social o RUC en los resultados cargados..."
          allow-clear
          size="large"
        />
      </div>

      <a-table
        v-if="datosFiltrados.length > 0"
        :dataSource="datosFiltrados"
        :columns="columns"
        size="middle"
        bordered
        rowKey="ruc"
        :pagination="{ pageSize: 20 }"
      >
        <template #bodyCell="{ column, record }">

            <template v-if="column.dataIndex === 'rs'">
                <div class="font-bold text-gray-800">{{ record.rs }}</div>
                <div class="text-xs text-gray-400">RUC: {{ record.ruc }}</div>
            </template>

            <template v-if="column.dataIndex === 'cant_real'">
                <div class="text-center">
                    <span class="text-lg font-bold text-blue-600">{{ record.cant_real }}</span>
                </div>
            </template>

            <template v-if="column.dataIndex === 'info'">
                <div class="text-center">
                    <a-popover title="Análisis de Membresía" trigger="click">
                        <template #content>
                            <div class="w-72 space-y-2">
                                <div class="bg-blue-50 p-2 rounded">
                                    <p class="m-0 text-xs font-bold text-blue-800">REALIDAD:</p>
                                    <p class="m-0">Usa <b>{{ record.cant_real }}</b> vendedores.</p>
                                    <p class="m-0">Precio pactado: <b>{{ formatCurrency(record.precio_pactado) }}</b></p>
                                </div>
                                <div class="bg-orange-50 p-2 rounded">
                                    <p class="m-0 text-xs font-bold text-orange-800">CATÁLOGO OFICIAL:</p>
                                    <p class="m-0">Escala: <b>{{ record.cat_fct }}</b> (Cód: {{ record.cat_codigo }})</p>
                                    <p class="m-0">Precio Catálogo: <b>{{ formatCurrency(record.cat_precio) }}</b></p>
                                </div>
                                <div class="p-2 border-t font-bold text-center" :class="record.diferencia < 0 ? 'text-red-600' : 'text-green-600'">
                                    Diferencia: {{ formatCurrency(record.diferencia) }}
                                </div>
                            </div>
                        </template>
                        <a-button size="small" type="primary" ghost>Ver Info</a-button>
                    </a-popover>
                </div>
            </template>

            <template v-if="column.dataIndex === 'status'">
                <div class="text-center">
                    <a-tag :color="record.status === 'OK' ? 'green' : 'red'">
                        {{ record.status }}
                    </a-tag>
                </div>
            </template>

            <template v-if="column.dataIndex === 'pago_factura_me'">
                <div class="text-right font-semibold">
                    {{ formatCurrency(record.pago_factura_me) }}
                </div>
            </template>

        </template>
      </a-table>

      <div v-else-if="buscado && !loading" class="text-center py-20 bg-gray-50 rounded border-2 border-dashed border-gray-100">
          <p class="text-gray-400">No se encontraron resultados que coincidan con la búsqueda.</p>
      </div>

    </div>
  </AuthenticatedLayout>
</template>


<script setup>
import { ref, reactive, onMounted, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import { message } from 'ant-design-vue';

// --- ESTADOS ---
const loading = ref(false);
const buscado = ref(false);
const datos = ref([]);
const listaProductos = ref([]);
const listaTipos = ref([]);
const filtroTexto = ref(''); // Variable para el buscador RUC/RS

const filtros = reactive({
    prd_id: undefined,
    tipo: 'vend',
    anio: '2025',
    mes: '12'
});

const mesesSelect = [
    {value:'01', label:'Enero'}, {value:'02', label:'Febrero'}, {value:'03', label:'Marzo'},
    {value:'04', label:'Abril'}, {value:'05', label:'Mayo'}, {value:'06', label:'Junio'},
    {value:'07', label:'Julio'}, {value:'08', label:'Agosto'}, {value:'09', label:'Septiembre'},
    {value:'10', label:'Octubre'}, {value:'11', label:'Noviembre'}, {value:'12', label:'Diciembre'}
];

const columns = [
  { title: 'Empresa / Cliente', dataIndex: 'rs', key: 'rs' },
  { title: 'Uso Real (Cant)', dataIndex: 'cant_real', key: 'cant_real', width: 130, align: 'center' },
  { title: 'Pagó Fact (USD)', dataIndex: 'pago_factura_me', key: 'pago_factura_me', width: 150, align: 'right' },
  { title: 'Análisis Catálogo', dataIndex: 'info', key: 'info', width: 150, align: 'center' },
  { title: 'Estado', dataIndex: 'status', key: 'status', width: 120, align: 'center' },
];

// --- LÓGICA DE FILTRADO (FRONTEND) ---
const datosFiltrados = computed(() => {
    if (!filtroTexto.value) return datos.value;
    const search = filtroTexto.value.toLowerCase();
    return datos.value.filter(item =>
        item.rs.toLowerCase().includes(search) ||
        item.ruc.includes(search)
    );
});

// --- FUNCIONES ---
const formatCurrency = (val) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(val);
};

const filterOption = (input, option) => {
    return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const cargarListas = async () => {
    try {
        const [resProd, resTipos] = await Promise.all([
            axios.get('/api/lista-productos'),
            axios.get('/api/lista-tipos')
        ]);
        listaProductos.value = resProd.data.map(p => ({ value: p.Prd_Id, label: `${p.Codigo} - ${p.Nombre}` }));
        listaTipos.value = resTipos.data;
    } catch (e) {
        console.error("Error al cargar filtros iniciales", e);
    }
};

const consultar = async () => {
    if(!filtros.prd_id) return message.warning('Debe seleccionar un producto');

    loading.value = true;
    buscado.value = true;
    datos.value = [];
    filtroTexto.value = ''; // Limpiar búsqueda al hacer nueva consulta

    try {
        const res = await axios.get('/api/comparativo-precios', { params: filtros });
        datos.value = res.data;
        if(res.data.length === 0) message.info('No se hallaron registros');
    } catch (e) {
        message.error('Error al procesar la auditoría');
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    cargarListas();
});
</script>

<style scoped>
:deep(.ant-table-thead > tr > th) {
    background-color: #f8fafc !important;
    font-weight: 700;
}
</style>
