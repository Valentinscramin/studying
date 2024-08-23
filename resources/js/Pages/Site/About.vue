<template>
    <SiteLayout :logged="logged">
        <Head title="Sobre Nós"/>
        <h1>About Us Page</h1>
    </SiteLayout>
</template>

<script setup>
    import SiteLayout from '@/Layouts/SiteLayout.vue';
    import { Head } from '@inertiajs/vue3';
    const props = defineProps({
        logged: Boolean
    })
</script>

<style lang="scss" scoped>

</style>
