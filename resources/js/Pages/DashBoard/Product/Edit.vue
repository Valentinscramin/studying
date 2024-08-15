<template>

    <Head title="Produtos" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produtos</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Editando: {{ product . name }}
                        <Link class="btn btn-warning btn-sm m-10" :href="route('products.index')">Voltar</Link>
                        <div v-if="$page.props.flash.message" class="alert">
                            {{ $page . props . flash . message }}
                        </div>
                        <form @submit.prevent="save()">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" v-model="form.name" id="name" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.name" class="text-red-500">{{ errors . name }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" v-model="form.description" id="description" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.description" class="text-red-500">{{ errors . description }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <input type="text" v-model="form.price" id="price" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.price" class="text-red-500">{{ errors . price }}</div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" :disabled="form.processing"> <span
                                        v-if="form.processing">Atualizando...</span>
                                    <span v-else>Salvar</span></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';

    const props = defineProps({
        errors: Object,
        product: Object
    });

    const form = useForm({
        name: props.product.name,
        description: props.product.description,
        price: props.product.price,
    });

    const save = () => {
        const res = form.put(route('products.update', props.product.id));
        if (res) {
            form.reset();
        }
    }
</script>
