<template>
    <div class="min-h-screen bg-gray-50">
      <!-- Barra de navegación -->
      <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex items-center">
              <div class="flex-shrink-0 flex items-center">
                <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 2L3 7L12 12L21 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M3 17L12 22L21 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M3 12L12 17L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="ml-2 text-xl font-bold text-gray-800">PRISMA ERP</span>
              </div>
            </div>
            <div class="flex items-center">
              <Link v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Panel de Control
              </Link>
              <template v-else>
                <Link :href="route('login')"
                      class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition mr-4">
                  Iniciar Sesión
                </Link>
                <Link v-if="canRegister"
                      :href="route('register')"
                      class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition">
                  Registrarse
                </Link>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Contenido principal -->
      <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">Bienvenido a PRISMA ERP</h1>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Sistema de gestión empresarial integral para optimizar tus operaciones
          </p>
        </div>

        <!-- Tarjetas de módulos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="text-blue-600 mb-4">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Inventario</h3>
            <p class="text-gray-600">
              Gestión completa de stock, movimientos y reportes de inventario.
            </p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="text-blue-600 mb-4">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Ventas</h3>
            <p class="text-gray-600">
              Proceso de ventas completo con facturación electrónica integrada.
            </p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="text-blue-600 mb-4">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Contabilidad</h3>
            <p class="text-gray-600">
              Libros contables, balances y estados financieros automatizados.
            </p>
          </div>
        </div>

        <!-- Llamada a la acción -->
        <div class="mt-16 text-center">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">¿Listo para comenzar?</h2>
          <div class="flex justify-center space-x-4">
            <Link v-if="!$page.props.auth.user"
                  :href="route('login')"
                  class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-medium">
              Acceder al Sistema
            </Link>
            <Link href="/contacto"
                  class="px-6 py-3 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition font-medium">
              Contactar Soporte
            </Link>
          </div>
        </div>
      </main>

      <!-- Pie de página -->
      <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div class="text-center text-gray-500 text-sm">
            <p>© {{ new Date().getFullYear() }} PRISMA ERP. Todos los derechos reservados.</p>
          </div>
        </div>
      </footer>
    </div>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  import { defineProps } from 'vue';

  defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
  });
  </script>

  <style>
  /* Transiciones suaves para elementos interactivos */
  .transition {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
  }

  /* Efecto hover para tarjetas */
  .hover\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  }
  </style>
