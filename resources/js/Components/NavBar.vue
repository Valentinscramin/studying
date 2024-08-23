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
                        <a class="text-dark" @click="visibleCart">Carrinho</a>
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
    <div class="flex justify-end">
        <Cart :visible="isVisible" @update:visible="updateHide" :isLogged="logged"/>
    </div>
</template>

<script setup>
    import {
        Link
    } from '@inertiajs/vue3';
    import {
        ref
    } from 'vue';
    import Cart
    from './Cart.vue';

    const props = defineProps({
        logged: Boolean
    })

    const isVisible = ref(false);

    const updateHide = (value) => {
        isVisible.value = value;
    }

    const visibleCart = () => {
        isVisible.value = !isVisible.value
    }
</script>
