<script setup>
import Footer from '../components/Footer.vue';
import Navbar from '../components/Navbar.vue'
</script>

<template>
    <Navbar />
    <main class="px-5 md:px-20">
        <RouterView />
    </main>
    <Footer />
</template>
