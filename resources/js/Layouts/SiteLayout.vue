<template>
    <div>
        <NavBar :logged="logged" />
        <slot />
    </div>
</template>
<script setup>
    import NavBar from '@/Components/NavBar.vue';
    import {
        onMounted
    } from 'vue';
    const props = defineProps({
        logged: Boolean
    });

    onMounted(() => {
        const cookies = document.cookie.split("; ");
        // console.log(cookies.find(row => row.startsWith('products=')));
        if (!cookies.find(row => row.startsWith('products='))) {
            console.log("OI");
            document.cookie =
                `products=; path=/; max-age=3600`; // 1 hour expiry
        }
    });
</script>
