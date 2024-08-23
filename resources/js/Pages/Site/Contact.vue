<template>
    <SiteLayout :logged="logged">
        <Head title="Contato"/>
        <h1>Contact</h1>
    </SiteLayout>
</template>
<script setup>
    import SiteLayout from '@/Layouts/SiteLayout.vue';
    import { Head } from '@inertiajs/vue3';
    const props = defineProps({
        logged: Boolean
    })
</script>
<style lang="">

</style>
