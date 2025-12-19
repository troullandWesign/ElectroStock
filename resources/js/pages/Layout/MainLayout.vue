<template>
  <div class="min-h-screen" style="background-color: #FDECEF;">
    <!-- Header -->
    <header class="sticky top-0 z-50" style="background-color: #0F110C;">
      <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold flex items-center gap-3" style="color: #9D6381;">
              <span class="text-4xl">&#9889;</span>
              ElectroStock
            </h1>
            <p class="mt-1 opacity-75" style="color: #9D6381;">Gestion de composants electroniques</p>
          </div>
          <Link href="/" class="px-4 py-2 rounded-lg font-medium transition hover:opacity-80" style="background-color: #9D6381; color: #FDECEF;">
            Accueil
          </Link>
        </div>
      </div>
    </header>

    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-72 shadow-lg min-h-screen p-6 border-r-2" style="background-color: #FDECEF; border-color: #9D6381;">
        <nav class="space-y-3">
          <!-- Main nav -->
          <div class="space-y-2">
            <Link 
              href="/"
              class="flex items-center gap-3 px-4 py-3 rounded-lg hover:opacity-75 transition font-semibold"
              style="color: #0F110C;"
            >
              &#127968; Accueil
            </Link>
            <Link 
              href="/components/create"
              class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-semibold"
              style="background-color: #9D6381; color: #FDECEF;"
            >
              &#10133; Nouveau composant
            </Link>
          </div>

          <!-- Filter section -->
          <div class="pt-6 border-t-2 mt-6" style="border-color: #9D6381;">
            <p class="text-xs font-bold uppercase tracking-wider mb-3 px-4" style="color: #9D6381;">Filtrer par type</p>
            <div class="space-y-1">
              <Link 
                href="/components?type=resistor"
                class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg hover:opacity-75 transition"
                style="color: #0F110C;"
              >
                &#128308; Resistances
              </Link>
              <Link 
                href="/components?type=capacitor"
                class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg hover:opacity-75 transition"
                style="color: #0F110C;"
              >
                &#128309; Condensateurs
              </Link>
              <Link 
                href="/components?type=microcontroller"
                class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg hover:opacity-75 transition"
                style="color: #0F110C;"
              >
                &#128994; Microcontroleurs
              </Link>
            </div>
          </div>

          <!-- Stock alerts -->
          <div class="pt-6 border-t-2 mt-6" style="border-color: #9D6381;">
            <p class="text-xs font-bold uppercase tracking-wider mb-3 px-4" style="color: #9D6381;">Alertes stock</p>
            <div class="space-y-1">
              <Link 
                href="/components?low_stock=true"
                class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg hover:opacity-75 transition"
                style="color: #0F110C;"
              >
                &#9888; Stock faible
              </Link>
              <Link 
                href="/components?out_of_stock=true"
                class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg hover:opacity-75 transition"
                style="color: #0F110C;"
              >
                &#10060; Rupture de stock
              </Link>
            </div>
          </div>
        </nav>
      </aside>

      <!-- Main content -->
      <main class="flex-1 p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
