<template>
<div>
    <div class="card" style="width: 18rem;" v-for="item in data" :key="item.id">
        <img :src="'/storage/'+item.img" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ item . name }}</h5>
            <p class="card-text">{{ item . description }}</p>
            <p class="card-text">{{ item . price }}</p>
            <div class="flex justify-between gap-1">
                <a href="" class="btn btn-primary">Ver Mais</a>
                <a @click="addCart(item)" class="btn btn-success">+ Carrinho</a>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import {
    reactive
} from 'vue';

const props = defineProps({
    data: {
        type: Array,
        default: () => ({})
    }
});

const addCart = (item) => {
    const product = {
        'id': item.id,
        'name': item.name,
        'price': item.price,
        'img': item.img
    };

    const jsonString = JSON.stringify(product);

    // Save the JSON string to a cookie
    document.cookie = `products=${encodeURIComponent(jsonString)}; path=/; max-age=3600`; // 1 hour expiry
}
</script>
