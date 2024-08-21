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
            <div v-if="flashMessage" class="alert alert-success">
                {{ flashMessage }}
            </div>
            <div v-else>
                <form @submit.prevent="save()">
                    <div v-for="(item, index) in form.products" :key="index" data-bs-spy="scroll">
                        <div class="row flex wrap mt-1">
                            <div class="col-lg-6 col-md-6 bg-white w-50">
                                <img :src="'/storage/' + item.img">
                            </div>
                            <div class="col-lg-6 col-md-6 bg-white w-50">
                                <p>{{ item . name }}</p>
                                <p>R${{ item . multiple_price }}
                                    <input type="number" class="form-control" min="1" step="1"
                                        v-model="item.quantity" @change="updateBilling(item)" width="10px">
                                </p>
                            </div>
                        </div>
                        <hr class="my-4">
                    </div>
                </form>
                <div class="row flex justify-end mt-1">
                    <div class="col-md-12 bg-white">Total: {{ totalBill }}</div>
                </div>
                <div class="row flex justify-between gap-1 mt-5">
                    <button class="btn btn-success" @click="save" type="submit">Comprar Agora</button>
                    <button class="btn btn-danger" @click="cleanCart">Limpar Carrinho</button>
                </div>
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
        onUnmounted,
        watchEffect
    } from 'vue';
    import {
        useForm,
        usePage
    } from '@inertiajs/vue3';

    const props = defineProps({
        visible: Boolean
    });

    const products = ref([]);

    const cleanCart = () => {
        removeCookie()
    }

    const page = usePage();
    const flashMessage = ref(null);

    watchEffect(() => {
        if (page.props.flash.message) {
            flashMessage.value = page.props.flash.message;
            removeCookie();
            // Clear the message after 3 seconds
            setTimeout(() => {
                flashMessage.value = null;
            }, 3000);
        }
    });

    const updateBilling = (item) => {
        item.multiple_price = item.price * item.quantity;
        totalBill.value = updateTotalBill();
    }

    const totalBill = ref(0);

    const updateTotalBill = () => {
        if (Array.isArray(form.products)) {
            const total = form.products.reduce((sum, item) => {
                return sum + parseFloat(item.multiple_price);
            }, 0);
            return total.toFixed(2);
        } else {
            console.error('Products is not an array:', form.products);
            return 0;
        }
    };

    const removeCookie = () => {
        document.cookie = `products=; path=/; max-age=3600`; // 1 hour expiry
    }

    const readCookie = () => {
        const cookies = document.cookie.split("; ");
        const productCookie = cookies.find(row => row.startsWith('products='));
        if (productCookie) {
            let jsonString = decodeURIComponent(productCookie.split("=")[1]);

            // Remove the last character if necessary (e.g., if there's a trailing comma or invalid character)
            jsonString = jsonString.slice(0, -1);

            // If the JSON is expected to be an array of objects, ensure it starts and ends with brackets
            if (!jsonString.startsWith('[') && !jsonString.endsWith(']')) {
                jsonString = `[${jsonString}]`;
            }

            try {
                return JSON.parse(jsonString);
            } catch (error) {
                console.error('Erro ao analisar o JSON:', error);
            }
        } else {
            console.log('Cookie "products" não encontrado');
        }
    };

    // Initialize form with products array
    const form = useForm({
        products: readCookie() || [],
    });

    // Polling function to observe changes in the cookie
    let intervalId;
    const startPollingCookie = () => {
        intervalId = setInterval(() => {
            const newValue = readCookie();
            if (newValue.length !== form.products.length) {
                form.products = newValue;
                totalBill.value = updateTotalBill()
            }
        }, 1000); // Check every second (adjust as needed)
    };

    const data = ref([]);

    const save = () => {
        const res = form.post(route('cart.store'), {
            forceFormData: true,
            data: form,
            onSuccess: () => {
                form.reset();
            },
            onError: (errors) => {
                console.error(error);
            }
        });
    }

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
