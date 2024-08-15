<template lang="">
    <div>
        <nav class="flex justify-between p-4 bg-grey">
            <div class="text-lg">NavBar</div>
            <div>
                <ul class="flex gap-x-4 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('home')">Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('shop')">Shop</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('about')">Sobre nós</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('contact')">Contato</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('login')">Login</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="text-dark" :href="route('register')">Register</Link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script setup>
    import {
        Link
    } from '@inertiajs/vue3';
</script>
<style lang="">

</style>
