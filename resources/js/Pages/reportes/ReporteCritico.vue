<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold text-red-700">Auditoría Crítica de Membresías</h1>
        <a-button type="primary" @click="exportarExcel" class="bg-green-600 border-green-600">
          <file-excel-outlined /> Exportar Excel
        </a-button>
      </div>
    </template>

    <div class="p-6 bg-white shadow rounded-lg m-4">

      <a-row :gutter="[16, 16]" class="mb-6" align="bottom">
        <a-col :span="3"><label class="font-bold">Año:</label>
          <a-select v-model:value="filtros.anio" class="w-full">
            <a-select-option value="2024">2024</a-select-option>
            <a-select-option value="2025">2025</a-select-option>
          </a-select>
        </a-col>
        <a-col :span="4"><label class="font-bold">Mes:</label>
          <a-select v-model:value="filtros.mes" class="w-full" :options="mesesSelect" />
        </a-col>
        <a-col :span="4"><label class="font-bold">Tipo:</label>
          <a-select v-model:value="filtros.tipo" class="w-full" :options="listaTipos" :field-names="{label:'TIPO', value:'TIPO'}" />
        </a-col>
        <a-col :span="3">
          <a-button type="primary" block @click="consultar" :loading="loading">Auditar</a-button>
        </a-col>
        <a-col :span="10">
          <a-input-search v-model:value="buscar" placeholder="Buscar RUC o Cliente..." allow-clear />
        </a-col>
      </a-row>

      <a-table :dataSource="filteredData" :columns="columns" rowKey="anx_id" bordered size="small" :scroll="{ x: 1500 }">
        <template #bodyCell="{ column, record }">

          <template v-if="column.dataIndex === 'rs'">
            <div class="font-bold text-gray-800 text-[11px]">{{ record.rs }}</div>
            <div class="text-[10px] text-gray-400">RUC: {{ record.ruc }}</div>
            <div class="text-[10px] text-blue-500 italic">{{ record.producto }}</div>
          </template>

          <template v-if="column.dataIndex === 'diferencia'">
            <span class="font-bold" :class="record.diferencia < 0 ? 'text-red-600' : 'text-green-600'">
                {{ formatCurrency(record.diferencia) }}
            </span>
          </template>

          <template v-if="column.dataIndex === 'nivel'">
            <a-tag :color="record.nivel === 'CRITICO' ? 'red' : (record.nivel === 'ALERTA' ? 'orange' : 'green')">
              {{ record.nivel }}
            </a-tag>
          </template>

          <!-- <template v-if="column.dataIndex === 'perdida_anual'">
            <div class="text-right font-bold text-gray-700 bg-gray-50 px-1 rounded">
                {{ formatCurrency(record.perdida_anual) }}
            </div>
          </template> -->

          <template v-if="column.dataIndex === 'accion'">
            <a-button type="primary" size="small" @click="abrirGenerador(record)" class="bg-indigo-600 border-indigo-600">
               MSJ WhatsApp
            </a-button>
          </template>
        </template>
      </a-table>

      <a-modal v-model:visible="modalVisible" title="Mensaje de Regularización" @ok="copiarTexto" okText="Copiar Texto" cancelText="Cerrar">
        <a-textarea v-model:value="mensajeCuerpo" :rows="14" class="font-sans text-sm" />
      </a-modal>

    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import { message } from 'ant-design-vue';
import * as XLSX from 'xlsx';
import { FileExcelOutlined } from '@ant-design/icons-vue';

const loading = ref(false);
const datos = ref([]);
const buscar = ref('');
const listaTipos = ref([]);
const modalVisible = ref(false);
const mensajeCuerpo = ref('');
const filtros = reactive({ anio:'2025', mes:'12', tipo:'vend' });

const columns = [
  { title: 'Empresa / Producto', dataIndex: 'rs', key: 'rs', width: 280, fixed: 'left' },
  { title: 'Cant. Real', dataIndex: 'cant_real', key: 'cant_real', align: 'center', width: 90 },
  { title: 'Escala Cat.', dataIndex: 'escala_catalogo', key: 'escala_catalogo', align: 'center', width: 90 },
  { title: 'P. Unit Cat.', dataIndex: 'precio_unit_catalogo', key: 'precio_unit_catalogo', align: 'right', width: 100 },
  { title: 'Cobro Real', dataIndex: 'cobro_real_factura', key: 'cobro_real_factura', align: 'right', width: 110 },
  { title: 'Diferencia Mes', dataIndex: 'diferencia', key: 'diferencia', align: 'right', width: 120 },
//   { title: 'Pérdida Anual', dataIndex: 'perdida_anual', key: 'perdida_anual', align: 'right', width: 140 },
  { title: 'Nivel', dataIndex: 'nivel', key: 'nivel', align: 'center', width: 100 },
  { title: 'Acción', dataIndex: 'accion', key: 'accion', align: 'center', width: 130, fixed: 'right' },
];

const abrirGenerador = (record) => {
    mensajeCuerpo.value =
`Estimados amigos de *${record.rs}*,

Es un gusto saludarlos. Nos ponemos en contacto para informarles sobre una actualización en su servicio de *${record.producto}*.

Tras nuestra auditoría mensual, hemos detectado lo siguiente:

✅ *Uso Real:* ${record.cant_real} usuarios activos en sistema.
💰 *Tarifa Actual:* Ustedes pagan ${formatCurrency(record.cobro_real_factura)}.
📊 *Escala Aplicable:* Por la cantidad de usuarios, corresponde la escala de *${record.escala_catalogo} unidades*.

De acuerdo a nuestro catálogo vigente, el monto mensual a facturar por el uso real detectado debe ser de *${formatCurrency(record.monto_ideal)}*.

Deseamos que sigan operando con total normalidad y contando con todo nuestro soporte técnico. Por ello, a partir de su próxima renovación, se aplicará el ajuste a la escala correcta.

Quedamos atentos a cualquier duda o consulta.

Atentamente,
*ERPPRISMA*`;
    modalVisible.value = true;
};

const copiarTexto = () => {
    navigator.clipboard.writeText(mensajeCuerpo.value);
    message.success('Copiado. Pégalo en WhatsApp o Correo.');
    modalVisible.value = false;
};

const formatCurrency = (v) => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(v);

const consultar = async () => {
    loading.value = true;
    try {
        const res = await axios.get('/api/reporte-critico', { params: filtros });
        datos.value = res.data;
    } catch (e) { message.error('Error al cargar datos'); }
    finally { loading.value = false; }
};

const exportarExcel = () => {
    const ws = XLSX.utils.json_to_sheet(datos.value);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Auditoria");
    XLSX.writeFile(wb, `Auditoria_Critica.xlsx`);
};

const mesesSelect = [{value:'01', label:'Ene'},{value:'02', label:'Feb'},{value:'03', label:'Mar'},{value:'04', label:'Abr'},{value:'05', label:'May'},{value:'06', label:'Jun'},{value:'07', label:'Jul'},{value:'08', label:'Ago'},{value:'09', label:'Set'},{value:'10', label:'Oct'},{value:'11', label:'Nov'},{value:'12', label:'Dic'}];

onMounted(async () => {
    const res = await axios.get('/api/lista-tipos');
    listaTipos.value = res.data;
});

const filteredData = computed(() => {
    return datos.value.filter(i =>
        i.rs.toLowerCase().includes(buscar.value.toLowerCase()) ||
        i.ruc.includes(buscar.value)
    );
});
</script>
