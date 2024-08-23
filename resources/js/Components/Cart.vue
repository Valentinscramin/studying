<template>
    <transition name="fade">
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
                    <div class="row">
                        <div class="col-md-12">Você possui {{ form . products . length }} itens no carrinho</div>
                    </div>
                    <div class="scroll">
                        <form @submit.prevent="save()">
                            <div v-for="(item, index) in form.products" :key="index"
                                class="mt-3 border rounded" data-bs-spy="scroll">
                                <div class="row flex wrap">
                                    <div class="col-lg-10 col-md-10 bg-white w-50">
                                        <img :src="'/storage/' + item.img" class="m-2">
                                    </div>
                                    <div class="col-lg-2 col-md-2 bg-white w-50 flex justify-end">
                                        <a class="btn btn-danger btn-sm m-2" @click="removeProduct(index)">X</a>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-lg-6 col-md-6 bg-white w-50">
                                        <p class="m-2">{{ item . name }}</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 bg-white w-50">
                                        <p class="m-2 flex justify-end">Total</p>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="col-lg-6 col-md-6 bg-white w-50">
                                        <p class="m-2"><input type="number" class="form-control" min="1"
                                                step="1" v-model="item.quantity" @change="updateBilling(item)">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 bg-white w-50">
                                        <p class="m-2 flex justify-end">R${{ item . multiple_price }}</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row flex justify-end mt-2">
                        <div class="col-md-12 flex justify-end">Total: R${{ totalBill }}</div>
                    </div>
                    <div class="row flex justify-between gap-1 mt-5" v-if="isLogged">
                        <button class="btn btn-success" @click="save">Comprar Agora</button>
                        <button class="btn btn-danger" @click="cleanCart">Limpar Carrinho</button>
                    </div>
                    <div class="row flex justify-between gap-1 mt-5" v-else>
                        <a class="btn btn-primary btn-sm" :href="route('login')" rel="noopener noreferrer">Faça o
                            login...</a>
                    </div>
                </div>
            </div>
        </div>
    </transition>
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
        visible: Boolean,
        isLogged: Boolean
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

    const totalBill = ref(0)

    const removeProduct = (product_index) => {
        form.products = form.products.filter(function(item, index) {
            return index !== product_index
        });

        document.cookie = `products=; path=/; max-age=3600`; // 1 hour expiry

        const jsonString = JSON.stringify(form.products);

        const cookies = document.cookie.split("; ");
        const productCookie = cookies.find(row => row.startsWith('products='));
        const currentjsonString = decodeURIComponent(productCookie.split("=")[1]);

        // Save the JSON string to a cookie
        document.cookie =
            `products=${encodeURIComponent([jsonString] + "," + [currentjsonString])}; path=/; max-age=3600`; // 1 hour expiry
    }

    const updateTotalBill = () => {
        if (Array.isArray(form.products)) {
            const total = form.products.reduce((sum, item) => {
                return sum + parseFloat(item.multiple_price);
            }, 0)
            return total.toFixed(2)
        } else {
            console.error('Products is not an array:', form.products);
            return 0
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

<style scoped="scoped">
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .scroll {
        max-height: 55vh;
        overflow-y: scroll;
        overflow-x: hidden;
        /* Hide horizontal scrollbar */
    }
</style>
