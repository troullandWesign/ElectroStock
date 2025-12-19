<template>
  <div class="min-h-screen flex flex-col" style="background-color: #FDECEF;">
    <!-- Header -->
    <nav class="sticky top-0 z-50 backdrop-blur-md" style="background-color: rgba(15, 17, 12, 0.95);">
      <div class="mx-auto px-6 py-4 sm:px-12 lg:px-20">
        <div class="flex items-center justify-between">
          <Link href="/" class="flex items-center space-x-3 cursor-pointer">
            <span class="text-2xl">&#9889;</span>
            <span class="text-xl font-bold" style="color: #9D6381;">ElectroStock</span>
          </Link>
          <div class="flex items-center gap-4">
            <Link 
              href="/" 
              class="px-4 py-2 rounded-lg text-sm font-medium transition-all hover:opacity-80 cursor-pointer"
              style="color: #FDECEF;"
            >
              Accueil
            </Link>
            <Link 
              href="/components" 
              class="px-4 py-2 rounded-lg text-sm font-medium transition-all hover:scale-105 cursor-pointer"
              style="background-color: #9D6381; color: #FDECEF;"
            >
              Composants
            </Link>
            <Link 
              href="/components/create" 
              class="px-4 py-2 rounded-lg text-sm font-medium border-2 transition-all hover:opacity-80 cursor-pointer"
              style="border-color: #9D6381; color: #9D6381;"
            >
              + Nouveau
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main content -->
    <main class="flex-1">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="px-6 py-8 sm:px-12 lg:px-20" style="background-color: #0F110C;">
      <div class="mx-auto max-w-6xl text-center">
        <p class="text-lg font-medium" style="color: #9D6381;">
          &#9889; ElectroStock - Gestion de composants electroniques
        </p>
        <p class="mt-2 text-sm" style="color: #FDECEF; opacity: 0.75;">
          2025 - Tous droits reserves
        </p>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
