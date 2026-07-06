<script setup>
import Footer from '../components/Footer.vue';
import Header from '../components/Header.vue';
</script>

<template>
    <Header />
    <main class="px-5 md:px-20">
        <RouterView />
    </main>
    <Footer />
</template>
