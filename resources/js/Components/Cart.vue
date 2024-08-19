<template>
    <div class="flex z-2 w-25 h-100 position-fixed p-4 rounded-3 bg-light" v-if="visible">
        <div class="container">
            <div class="row flex justify-between no-wrap mb-5 gap-10">
                <div class="col-md-5">
                    <h1 class="display-4">Carrinho</h1>
                </div>
                <div class="col-md-5 flex justify-end">
                    <button class="btn btn-primary btn-sm" @click="closeCart">X</button>
                </div>
            </div>
            <div v-for="(item, index) in products" :key="index" data-bs-spy="scroll">
                <div class="row flex wrap mt-1">
                    <div class="col-lg-6 col-md-6 bg-white w-50">
                        <img :src="'/storage/' + item.img">
                    </div>
                    <div class="col-lg-6 col-md-6 bg-white w-50">
                        <p>{{ item . name }}</p>
                        <p>Unitario: R${{ item . price }}
                            <input type="number" class="form-control" min="1" step="1" v-model="multiples"
                                @change="updateBilling(item . price)" width="10px">
                        </p>
                        <p v-if="totalBillingProduct != 0 && totalBillingProduct != item . price">Total: R${{ totalBillingProduct }}</p>
                    </div>
                </div>
                <hr class="my-4">
            </div>
            <div class="row flex justify-end mt-1">
                <div class="col-md-12 bg-white">Total:</div>
            </div>
            <div class="row flex justify-between gap-1 mt-5">
                <button class="btn btn-success">Comprar Agora</button>
                <button class="btn btn-danger">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {
        ref,
        defineProps,
        defineEmits,
        onMounted,
        onUnmounted
    } from 'vue';

    const props = defineProps({
        visible: Boolean
    });

    const products = ref([]);

    const multiples = ref(1);

    const totalBillingProduct = ref(0)

    const updateBilling = (price) => {
        totalBillingProduct.value = (price * multiples.value).toFixed(2);
    }

    const readCookie = () => {
        const cookies = document.cookie.split("; ");
        const productCookie = cookies.find(row => row.startsWith('products='));
        if (productCookie) {
            const jsonString = decodeURIComponent(productCookie.split("=")[1]);
            try {
                return [JSON.parse(jsonString)];
            } catch (error) {
                console.error('Erro ao analisar o JSON:', error);
            }
        } else {
            console.log('Cookie "products" não encontrado');
        }
    }

    // Polling function to observe changes in the cookie
    let intervalId;
    const startPollingCookie = () => {
        intervalId = setInterval(() => {
            const newValue = readCookie('myCookie');
            if (newValue !== products.value) {
                products.value = newValue;
            }
        }, 1000); // Check every second (adjust as needed)
    };

    onMounted(() => {
        startPollingCookie();
    })

    onUnmounted(() => {
        clearInterval(intervalId);
    });

    const emit = defineEmits(['update:visible']);

    const closeCart = () => {
        emit('update:visible', false);
    }
</script>
