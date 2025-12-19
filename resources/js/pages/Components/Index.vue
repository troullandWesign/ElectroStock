<script setup lang="ts">
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '../Layout/AppLayout.vue';

interface Component {
  id: number;
  name: string;
  reference: string;
  type: 'resistor' | 'capacitor' | 'microcontroller';
  price: number;
  stock_quantity: number;
  description?: string;
}

interface Stats {
  total: number;
  resistors: number;
  capacitors: number;
  microcontrollers: number;
}

interface Props {
  components: {
    data: Component[];
    links: any[];
    meta?: {
      total: number;
    };
  };
  filters: {
    search?: string;
    type?: string;
  };
  stats: Stats;
}

const props = defineProps<Props>();
const searchQuery = ref(props.filters.search || '');

function search() {
  router.get('/components', { search: searchQuery.value }, {
    preserveState: true,
    preserveScroll: true,
  });
}

function deleteComponent(id: number) {
  if (confirm('Etes-vous sur de vouloir supprimer ce composant ?')) {
    router.delete(`/components/${id}`);
  }
}

function getTypeLabel(type: string): string {
  const labels: Record<string, string> = {
    resistor: 'Resistance',
    capacitor: 'Condensateur',
    microcontroller: 'Microcontroleur',
  };
  return labels[type] || type;
}

function getTypeEmoji(type: string): string {
  const emojis: Record<string, string> = {
    resistor: '&#128308;',
    capacitor: '&#128309;',
    microcontroller: '&#128994;',
  };
  return emojis[type] || '';
}

function getTypeBadgeStyle(type: string): string {
  const styles: Record<string, string> = {
    resistor: 'background-color: #fee2e2; color: #991b1b;',
    capacitor: 'background-color: #dbeafe; color: #1e40af;',
    microcontroller: 'background-color: #dcfce7; color: #166534;',
  };
  return styles[type] || 'background-color: #f3f4f6; color: #374151;';
}

function getStockColor(quantity: number): string {
  if (quantity === 0) return 'color: #dc2626;';
  if (quantity < 10) return 'color: #ea580c;';
  return 'color: #16a34a;';
}
</script>

<template>
  <AppLayout>
    <div class="px-6 py-12 sm:px-12 lg:px-20">
      <!-- Page header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: #0F110C;">Mes Composants</h1>
        <p class="mt-2" style="color: #0F110C; opacity: 0.7;">Gerez votre inventaire de composants electroniques</p>
      </div>

      <!-- Stats - WHITE cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="p-6 rounded-xl shadow-lg border-l-4" style="background-color: white; border-color: #9D6381;">
          <p class="text-sm font-medium" style="color: #0F110C; opacity: 0.7;">Total composants</p>
          <p class="text-3xl font-bold mt-2" style="color: #9D6381;">{{ stats.total }}</p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-l-4" style="background-color: white; border-color: #dc2626;">
          <p class="text-sm font-medium" style="color: #0F110C; opacity: 0.7;">&#128308; Resistances</p>
          <p class="text-3xl font-bold mt-2" style="color: #dc2626;">{{ stats.resistors }}</p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-l-4" style="background-color: white; border-color: #2563eb;">
          <p class="text-sm font-medium" style="color: #0F110C; opacity: 0.7;">&#128309; Condensateurs</p>
          <p class="text-3xl font-bold mt-2" style="color: #2563eb;">{{ stats.capacitors }}</p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-l-4" style="background-color: white; border-color: #16a34a;">
          <p class="text-sm font-medium" style="color: #0F110C; opacity: 0.7;">&#128994; Microcontroleurs</p>
          <p class="text-3xl font-bold mt-2" style="color: #16a34a;">{{ stats.microcontrollers }}</p>
        </div>
      </div>

      <!-- Search bar - WHITE card -->
      <div class="p-6 rounded-xl shadow-lg mb-8" style="background-color: white;">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
          <div class="flex-1 w-full">
            <input
              v-model="searchQuery"
              @input="search"
              type="text"
              placeholder="&#128269; Rechercher par nom ou reference..."
              class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
              style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
            />
          </div>
          <Link 
            href="/components/create"
            class="px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2 hover:opacity-90 whitespace-nowrap cursor-pointer"
            style="background-color: #9D6381; color: #FDECEF;"
          >
            &#10133; Nouveau composant
          </Link>
        </div>
      </div>

      <!-- Success message -->
      <div 
        v-if="$page.props.flash?.success"
        class="px-6 py-4 rounded-lg font-semibold flex items-center gap-3 mb-8"
        style="background-color: #dcfce7; color: #166534;"
      >
        <span class="text-2xl">&#9989;</span>
        {{ $page.props.flash.success }}
      </div>

      <!-- Components grid - WHITE cards -->
      <div v-if="components.data?.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="component in components.data"
          :key="component.id"
          class="rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300"
          style="background-color: white;"
        >
          <!-- Type badge -->
          <div class="flex items-center justify-between mb-4">
            <span 
              class="inline-block px-4 py-2 text-xs font-bold rounded-full"
              :style="getTypeBadgeStyle(component.type)"
              v-html="getTypeEmoji(component.type) + ' ' + getTypeLabel(component.type)"
            >
            </span>
            <span class="text-xs font-medium px-2 py-1 rounded" style="background-color: #FDECEF; color: #9D6381;">
              #{{ component.id }}
            </span>
          </div>

          <!-- Name and reference -->
          <h3 class="text-lg font-bold mb-1" style="color: #0F110C;">{{ component.name }}</h3>
          <p class="text-sm mb-4" style="color: #9D6381;">Ref: <span class="font-mono font-semibold">{{ component.reference }}</span></p>

          <!-- Description -->
          <p v-if="component.description" class="text-sm mb-4 line-clamp-2" style="color: #0F110C; opacity: 0.7;">
            {{ component.description }}
          </p>

          <!-- Price and stock -->
          <div class="rounded-lg p-4 mb-4" style="background-color: #FDECEF;">
            <div class="flex justify-between items-center">
              <div>
                <p class="text-xs font-medium mb-1" style="color: #0F110C; opacity: 0.7;">Prix unitaire</p>
                <p class="text-2xl font-bold" style="color: #9D6381;">{{ component.price }}&#8364;</p>
              </div>
              <div class="text-right">
                <p class="text-xs font-medium mb-1" style="color: #0F110C; opacity: 0.7;">En stock</p>
                <p class="text-2xl font-bold" :style="getStockColor(component.stock_quantity)">
                  {{ component.stock_quantity }}
                </p>
              </div>
            </div>
          </div>

          <!-- Stock badge -->
          <div class="mb-4">
            <span 
              v-if="component.stock_quantity === 0"
              class="inline-block text-xs font-bold px-3 py-1 rounded-full"
              style="background-color: #fee2e2; color: #991b1b;"
            >
              &#10060; Rupture de stock
            </span>
            <span 
              v-else-if="component.stock_quantity < 10"
              class="inline-block text-xs font-bold px-3 py-1 rounded-full"
              style="background-color: #fef3c7; color: #92400e;"
            >
              &#9888; Stock faible
            </span>
            <span 
              v-else
              class="inline-block text-xs font-bold px-3 py-1 rounded-full"
              style="background-color: #dcfce7; color: #166534;"
            >
              &#9989; En stock
            </span>
          </div>

          <!-- Actions -->
          <div class="flex gap-3 pt-4 border-t" style="border-color: #FDECEF;">
            <Link
              :href="`/components/${component.id}/edit`"
              class="flex-1 px-4 py-3 rounded-lg text-center font-semibold transition flex items-center justify-center gap-2 hover:opacity-90 cursor-pointer"
              style="background-color: #9D6381; color: #FDECEF;"
            >
              &#9998; Modifier
            </Link>
            <button
              @click="deleteComponent(component.id)"
              class="px-4 py-3 rounded-lg font-semibold transition hover:opacity-90 cursor-pointer"
              style="background-color: #fee2e2; color: #991b1b;"
            >
              &#128465;
            </button>
          </div>
        </div>
      </div>

      <!-- No components -->
      <div v-else class="rounded-xl shadow-lg p-12 text-center" style="background-color: white;">
        <p class="text-4xl mb-4">&#128230;</p>
        <p class="text-xl font-semibold mb-2" style="color: #0F110C;">Aucun composant trouve</p>
        <p class="mb-6" style="color: #0F110C; opacity: 0.7;">Creez un premier composant pour commencer</p>
        <Link 
          href="/components/create"
          class="px-6 py-3 rounded-lg font-semibold transition inline-flex items-center gap-2 hover:opacity-90 cursor-pointer"
          style="background-color: #9D6381; color: #FDECEF;"
        >
          &#10133; Creer un composant
        </Link>
      </div>

      <!-- Pagination -->
      <div v-if="components.links?.length > 3" class="flex justify-center gap-2 mt-8">
        <Link
          v-for="link in components.links"
          :key="link.label"
          :href="link.url || '#'"
          class="px-4 py-2 rounded-lg font-semibold transition cursor-pointer"
          :class="[!link.url ? 'opacity-50 cursor-not-allowed' : '']"
          :style="link.active ? 'background-color: #9D6381; color: #FDECEF;' : 'background-color: white; color: #0F110C; border: 2px solid #9D6381;'"
          v-html="link.label"
        />
      </div>
    </div>
  </AppLayout>
</template>
