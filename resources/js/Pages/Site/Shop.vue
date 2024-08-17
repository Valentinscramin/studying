<template>
<SiteLayout>

    <Head title="Loja" />
    <h1>SHOP</h1>
    <div class="container">
        <div class="flex justify-between gap-10">
            <button class="btn btn-primary" v-for="item in categories" :key="item.id" @click="selectCategorie(item.id)">{{ item . name }}</button>
        </div>
        <hr class="my-4">
        <div class="flex justify-between gap-10">
            <CardProduct :data="data" v-if="isClicked"/>
        </div>
    </div>
</SiteLayout>
</template>

<script setup>
import SiteLayout from '@/Layouts/SiteLayout.vue';
import {
    Head,
} from '@inertiajs/vue3';
import {
    ref
} from 'vue';
import axios from 'axios';
import CardProduct from '@/Components/CardProduct.vue';

const props = defineProps({
    categories: Object
});

const isClicked = ref(false);
const lastCategory = ref(0);
const data = ref();
const error = ref();
const loading = ref();

const selectCategorie = async (categorieId) => {
    if (lastCategory.value != categorieId) {
        isClicked.value = true;
        lastCategory.value = categorieId;

        try {
            const response = await axios.get('http://127.0.0.1:8000/api/products/categories/' + categorieId)
            data.value = response.data;
        } catch (err) {
            error.value = 'Falha ao carregar os dados'
        } finally {
            loading.value = false
        }

    }
}
</script>
