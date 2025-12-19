<script setup lang="ts">
import AppLayout from './Layout/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative overflow-hidden px-6 py-24 sm:px-12 lg:px-20 lg:py-32">
      <div class="absolute top-20 left-10 w-64 h-64 rounded-full opacity-30 blur-3xl" style="background-color: #9D6381;"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full opacity-20 blur-3xl" style="background-color: #0F110C;"></div>
      
      <div class="relative mx-auto max-w-4xl text-center">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl" style="color: #0F110C;">
          Bienvenue sur
          <span class="block mt-2" style="color: #9D6381;">ElectroStock</span>
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed" style="color: #0F110C; opacity: 0.8;">
          Votre solution moderne de gestion d'inventaire pour composants electroniques.
        </p>
        
        <!-- Stats cards - WHITE background -->
        <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
          <div class="rounded-2xl p-6 shadow-lg" style="background-color: white;">
            <div class="text-3xl font-bold" style="color: #9D6381;">25+</div>
            <div class="mt-1 text-sm font-medium" style="color: #0F110C; opacity: 0.7;">Composants</div>
          </div>
          <div class="rounded-2xl p-6 shadow-lg" style="background-color: white;">
            <div class="text-3xl font-bold" style="color: #9D6381;">3</div>
            <div class="mt-1 text-sm font-medium" style="color: #0F110C; opacity: 0.7;">Types</div>
          </div>
          <div class="rounded-2xl p-6 shadow-lg" style="background-color: white;">
            <div class="text-3xl font-bold" style="color: #9D6381;">100%</div>
            <div class="mt-1 text-sm font-medium" style="color: #0F110C; opacity: 0.7;">Moderne</div>
          </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row">
          <Link 
            href="/components" 
            class="inline-flex items-center px-8 py-4 rounded-xl text-lg font-semibold shadow-xl transition-all hover:scale-105 hover:shadow-2xl cursor-pointer"
            style="background-color: #9D6381; color: #FDECEF;"
          >
            Decouvrir vos composants
          </Link>
          <Link 
            href="/components/create" 
            class="inline-flex items-center px-8 py-4 rounded-xl text-lg font-semibold border-2 transition-all hover:scale-105 cursor-pointer"
            style="border-color: #0F110C; color: #0F110C; background-color: transparent;"
          >
            Creer un composant
          </Link>
        </div>
      </div>
    </section>

    <!-- Features Section - WHITE background -->
    <section class="px-6 py-16 sm:px-12 lg:px-20" style="background-color: white;">
      <div class="mx-auto max-w-6xl">
        <h2 class="text-center text-3xl font-bold" style="color: #0F110C;">
          Fonctionnalites
        </h2>
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          <div class="rounded-2xl p-8 transition-all hover:shadow-xl" style="background-color: #FDECEF;">
            <div class="text-4xl mb-4">&#128230;</div>
            <h3 class="text-xl font-semibold" style="color: #0F110C;">Inventaire complet</h3>
            <p class="mt-3" style="color: #0F110C; opacity: 0.7;">Gerez tous vos composants electroniques en un seul endroit.</p>
          </div>
          <div class="rounded-2xl p-8 transition-all hover:shadow-xl" style="background-color: #FDECEF;">
            <div class="text-4xl mb-4">&#128269;</div>
            <h3 class="text-xl font-semibold" style="color: #0F110C;">Recherche rapide</h3>
            <p class="mt-3" style="color: #0F110C; opacity: 0.7;">Trouvez instantanement vos composants par nom ou reference.</p>
          </div>
          <div class="rounded-2xl p-8 transition-all hover:shadow-xl" style="background-color: #FDECEF;">
            <div class="text-4xl mb-4">&#128276;</div>
            <h3 class="text-xl font-semibold" style="color: #0F110C;">Alertes de stock</h3>
            <p class="mt-3" style="color: #0F110C; opacity: 0.7;">Soyez notifie quand vos stocks sont bas.</p>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
