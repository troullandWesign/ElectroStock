<script setup lang="ts">
import { ref, watch } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '../Layout/AppLayout.vue';

interface Props {
  component: {
    id: number;
    name: string;
    reference: string;
    type: string;
    description: string;
    price: number;
    stock_quantity: number;
    specifications: any;
  };
}

const props = defineProps<Props>();

const form = useForm({
  type: props.component.type,
  name: props.component.name,
  reference: props.component.reference,
  description: props.component.description,
  price: props.component.price,
  stock_quantity: props.component.stock_quantity,
  specifications: props.component.specifications,
});

const specificationsText = ref(
  props.component.specifications 
    ? JSON.stringify(props.component.specifications, null, 2) 
    : ''
);

watch(specificationsText, (newValue) => {
  try {
    form.specifications = newValue ? JSON.parse(newValue) : null;
  } catch (e) {
    // Ignorer
  }
});

function submit() {
  form.put(`/components/${props.component.id}`);
}
</script>

<template>
  <AppLayout>
    <div class="px-6 py-12 sm:px-12 lg:px-20">
      <!-- Page header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: #0F110C;">Modifier le Composant</h1>
        <p class="mt-2" style="color: #0F110C; opacity: 0.7;">Modifiez les informations de {{ component.name }}</p>
      </div>

      <!-- Form card - WHITE background -->
      <div class="max-w-2xl mx-auto">
        <div class="rounded-xl shadow-lg p-8" style="background-color: white;">
          <form @submit.prevent="submit">
            <!-- Type -->
            <div class="mb-6">
              <label class="block font-semibold mb-2" style="color: #0F110C;">Type *</label>
              <select 
                v-model="form.type"
                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                required
              >
                <option value="">-- Choisir un type --</option>
                <option value="resistor">&#128308; Resistance</option>
                <option value="capacitor">&#128309; Condensateur</option>
                <option value="microcontroller">&#128994; Microcontroleur</option>
              </select>
              <p v-if="form.errors.type" class="text-sm mt-1" style="color: #dc2626;">
                {{ form.errors.type }}
              </p>
            </div>

            <!-- Nom -->
            <div class="mb-6">
              <label class="block font-semibold mb-2" style="color: #0F110C;">Nom *</label>
              <input
                v-model="form.name"
                type="text"
                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                placeholder="Ex: Resistance 1k 1/4W"
                required
              />
              <p v-if="form.errors.name" class="text-sm mt-1" style="color: #dc2626;">
                {{ form.errors.name }}
              </p>
            </div>

            <!-- Reference -->
            <div class="mb-6">
              <label class="block font-semibold mb-2" style="color: #0F110C;">Reference *</label>
              <input
                v-model="form.reference"
                type="text"
                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                placeholder="Ex: RES-1K-001"
                required
              />
              <p v-if="form.errors.reference" class="text-sm mt-1" style="color: #dc2626;">
                {{ form.errors.reference }}
              </p>
            </div>

            <!-- Description -->
            <div class="mb-6">
              <label class="block font-semibold mb-2" style="color: #0F110C;">Description</label>
              <textarea
                v-model="form.description"
                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                rows="3"
                placeholder="Description du composant..."
              ></textarea>
            </div>

            <!-- Prix et Stock sur la meme ligne -->
            <div class="grid grid-cols-2 gap-6 mb-6">
              <div>
                <label class="block font-semibold mb-2" style="color: #0F110C;">Prix (&#8364;) *</label>
                <input
                  v-model="form.price"
                  type="number"
                  step="0.01"
                  class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                  style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                  required
                />
                <p v-if="form.errors.price" class="text-sm mt-1" style="color: #dc2626;">
                  {{ form.errors.price }}
                </p>
              </div>
              <div>
                <label class="block font-semibold mb-2" style="color: #0F110C;">Quantite en stock *</label>
                <input
                  v-model="form.stock_quantity"
                  type="number"
                  class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition"
                  style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                  required
                />
                <p v-if="form.errors.stock_quantity" class="text-sm mt-1" style="color: #dc2626;">
                  {{ form.errors.stock_quantity }}
                </p>
              </div>
            </div>

            <!-- Specifications -->
            <div class="mb-8">
              <label class="block font-semibold mb-2" style="color: #0F110C;">
                Specifications (optionnel, format JSON)
              </label>
              <textarea
                v-model="specificationsText"
                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition font-mono text-sm"
                style="border-color: #9D6381; color: #0F110C; background-color: #FDECEF;"
                rows="4"
                placeholder='{"resistance_value": "1000", "tolerance": "5%"}'
              ></textarea>
            </div>

            <!-- Boutons -->
            <div class="flex gap-4">
              <button
                type="submit"
                :disabled="form.processing"
                class="flex-1 px-6 py-4 rounded-lg font-semibold transition hover:opacity-90 disabled:opacity-50 cursor-pointer"
                style="background-color: #9D6381; color: #FDECEF;"
              >
                {{ form.processing ? 'Enregistrement...' : '&#128190; Enregistrer les modifications' }}
              </button>
              <Link
                href="/components"
                class="px-6 py-4 rounded-lg font-semibold transition hover:opacity-90 text-center cursor-pointer"
                style="background-color: #0F110C; color: #FDECEF;"
              >
                Annuler
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
